<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Cpanel extends Controller
{
    public function getBaseTemplate()
    {
        if (!Auth::instance()->logged_in('admin')) {
            HTTP::redirect('/cpanel/login');
        }

        return View::factory('cpanel/template')
            ->set('get', $_GET)
            ->set('post', $_POST)
            ;
    }

    public function action_index()
    {
        if (!Auth::instance()->logged_in('admin')) {
            HTTP::redirect('/cpanel/login');
        }

        if (Auth::instance()->logged_in() && isset($_POST['logout'])) {
            Auth::instance()->logout();
            HTTP::redirect('/');
        }

        $template = $this->getBaseTemplate();

        $template->content = View::factory('cpanel/index')
        ;

        $this->response->body($template);
    }

    public function action_login()
    {
        if (!Auth::instance()->logged_in() && isset($_POST['login'])) {
            Auth::instance()->login($this->request->post('username'), $this->request->post('password'),true);
            HTTP::redirect('/cpanel');
        }

        $template = View::factory('cpanel/login')
            ->set('post', $this->request->post())
        ;

        $this->response->body($template);
    }

    public function action_logout()
    {
        if (Auth::instance()->logged_in() && isset($_POST['logout'])) {
            Auth::instance()->logout();

            HTTP::redirect('/');
        }
    }

    public function action_registration()
    {
        if (!Auth::instance()->logged_in('admin')) {
            HTTP::redirect('/cpanel/login');
        }

        $template = View::factory('cpanel/registration')
            ->set('post', $this->request->post())
            ->set('error', '')
        ;

        if (count($this->request->post())) {
            if (empty(Arr::get($_POST,'username'))) {
                $template->set('error', '<div class="alert alert-danger"><strong>Не указан логин!</strong> Укажите Ваш логин.</div>');
            } elseif (empty(Arr::get($_POST,'email'))) {
                $template->set('error', '<div class="alert alert-danger"><strong>Не указана почта!</strong> Укажите Вашу почту.</div>');
            } elseif (Arr::get($_POST,'password','')=="") {
                $template->set('error', '<div class="alert alert-danger"><strong>Не указан пароль!</strong> Укажите Ваш пароль.</div>');
            } else if (Arr::get($_POST,'password') != Arr::get($_POST,'password2')) {
                $template->set('error', '<div class="alert alert-danger"><strong>Пароли не совпадают!</strong> Проверьте правильность подтверждения пароля.</div>');
            } else {
                $user = ORM::factory('User');
                $user->values(array(
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'password_confirm' => $_POST['password2'],
                ));
                $some_error = false;

                try {
                    $user->save();
                    $user->add("roles",ORM::factory("Role",1));
                }
                catch (ORM_Validation_Exception $e) {
                    $some_error = $e->errors('models');
                }

                if ($some_error) {
                    $template->set('error', '<div class="alert alert-danger"><strong>Ошибка регистрационных данных!</strong> Проверьте правильность ввода данных.</div>');

                    if (isset($some_error['username'])) {
                        if ($some_error['username'] == "models/user.username.unique") {
                            $template->set('error', '<div class="alert alert-danger"><strong>Такой логин уже есть в базе!</strong> Придумайте новый логин.</div>');
                        }
                    }
                    else if (isset($some_error['email'])) {
                        if ($some_error['email']=="email address must be an email address") {
                            $template->set('error', '<div class="alert alert-danger"><strong>Некорректный формат почты!</strong> Проверьте правильность написания почты.</div>');
                        }
                        if ($some_error['email']=="models/user.email.unique") {
                            $template->set('error', '<div class="alert alert-danger"><strong>Такая почта есть в базе!</strong> Укажите другую почту.</div>');
                        }
                    }
                } else {
                    HTTP::redirect('/cpanel');
                }
            }
        }

        $this->response->body($template);
    }

    public function action_portfolio_items_list()
    {
        /** @var $portfolioModel Model_Portfolio */
        $portfolioModel = Model::factory('Portfolio');

        $template = $this->getBaseTemplate();

        $template->content = View::factory('cpanel/portfolio_items_list')
            ->set('itemsList', $portfolioModel->findAll(
                Arr::get($this->request->query(), 'page', 1),
                Arr::get($this->request->query(), 'limit', 20)
            ))
            ->set('itemsListCount', count($portfolioModel->findAll(0,0)))
            ->set('page', Arr::get($this->request->query(), 'page', 1))
        ;

        $this->response->body($template);
    }

	public function action_add_portfolio_item()
	{
        /** @var $portfolioModel Model_Portfolio */
        $portfolioModel = Model::factory('Portfolio');

        $template = $this->getBaseTemplate();

        $template->content = View::factory('cpanel/add_portfolio_item')
            ->set('categories', $portfolioModel->getCategories())
            ->set('get', $this->request->query())
        ;

        if (isset($_POST['addPortfolioItem'])) {
            $id = $portfolioModel->setItem(
                null,
                (int)$this->request->post('category_id'),
                $this->request->post('title'),
                $this->request->post('description')
            );

            HTTP::redirect('/cpanel/redact_portfolio_item/' . $id);
        }

		$this->response->body($template);
	}

	public function action_redact_portfolio_item()
	{
        /** @var $portfolioModel Model_Portfolio */
        $portfolioModel = Model::factory('Portfolio');

        $template = $this->getBaseTemplate();
        
        $portfolioItemId = $this->request->param('id');
        $filename = Arr::get($_FILES, 'imgname', []);

        if ($portfolioItemId != '' && !empty($filename)) {
            $portfolioModel->loadPortfolioImg($_FILES, $portfolioItemId);

            HTTP::redirect($this->request->referrer());
        }

        if (isset($_POST['redactPortfolioItem'])) {
            $portfolioModel->setItem(
                $portfolioItemId,
                (int)$this->request->post('category_id'),
                $this->request->post('title'),
                $this->request->post('description')
            );

            HTTP::redirect($this->request->referrer());
        }

        $portfolioItem = $portfolioModel->findById($portfolioItemId);

        $template->content = View::factory('cpanel/redact_portfolio_item')
            ->set('portfolioItem', $portfolioItem)
            ->set('portfolioItemImgs', $portfolioModel->findImgsByItemId($portfolioItemId))
            ->set('categories', $portfolioModel->getCategories())
        ;

		$this->response->body($template);
	}

	public function action_redact_page()
	{
        /** @var $adminModel Model_Admin */
        $adminModel = Model::factory('Admin');

		/** @var $contentModel Model_Content */
		$contentModel = Model::factory('Content');

		$template = View::factory("admin_template");
		$admin_content = '';
        
		if (Auth::instance()->logged_in('admin')){
            if (isset($_POST['redactpage'])) {
                $adminModel->setPage($this->request->post());

                HTTP::redirect($this->request->referrer());
            }

            $admin_content = View::factory('admin_redact_page')
                ->set('pages', $contentModel->getPages())
                ->set('pageData', $contentModel->getPage($this->request->query()))
                ->set('get', $this->request->query())
            ;
		}

		$this->response->body($template->set('admin_content', $admin_content));
	}

	public function action_redact_contacts()
	{
        /** @var $adminModel Model_Admin */
        $adminModel = Model::factory('Admin');

		/** @var $contentModel Model_Content */
		$contentModel = Model::factory('Content');

		$template = View::factory("admin_template");
		$admin_content = '';

		if (Auth::instance()->logged_in('admin')){
            if (isset($_POST['redactcontacts'])) {
                $adminModel->setContacts($this->request->post());

                HTTP::redirect($this->request->referrer());
            }

            $admin_content = View::factory('admin_redact_contacts')
                ->set('contacts', $contentModel->findAllContacts())
            ;
		}

		$this->response->body($template->set('admin_content', $admin_content));
	}
}