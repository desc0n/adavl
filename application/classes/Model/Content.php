<?php

/**
 * Class Model_Content
 */
class Model_Content extends Kohana_Model
{
    private $contactTypes = ['address' => 'Адрес', 'phone' => 'Телефон', 'email' => 'E-mail'];

    /**
     * @return array
     */
    public function getContactTypes()
    {
        return $this->contactTypes;
    }

    public function getBaseTemplate($escapeFragment)
    {
        if (!empty($escapeFragment)) {
            return $this->getEscapeFragmentTemplate($escapeFragment);
        }

        /** @var $portfolioModel Model_Portfolio */
        $portfolioModel = Model::factory('Portfolio');

        return View::factory('template')
            ->set('portfolioCategories', $portfolioModel->getCategories())
            ->set('googlePlusNetwork', $this->getSocialNetworks('google+'))
            ->set('twitterNetwork', $this->getSocialNetworks('twitter'))
            ->set('facebookNetwork', $this->getSocialNetworks('facebook'))
        ;
    }

    public function getEscapeFragmentTemplate($page)
    {
        /** @var $portfolioModel Model_Portfolio */
        $portfolioModel = Model::factory('Portfolio');

        $view = View::factory('template');

        switch ($page) {
            case 'main' :
                $view =  View::factory('main_escape')
                    ->set('projectList', array_chunk($portfolioModel->findAll(), 2));
                break;
            case 'contacts' :
                $view =  View::factory('contacts_escape');
                break;
            case 'services' :
                $view =  View::factory('services_escape')
                    ->set('servicesList', $this->findAllServices());
                break;
            case 'activity' :
                $view =  View::factory('activity_escape')
                    ->set('pageData', $this->findPageBySlug('activity'));
                break;
            default:
                if(preg_match('/project/', $page)) {
                    $projectId = (int)str_replace('project', '', $page);
                    $view = View::factory('project_escape')
                        ->set('projectData', $portfolioModel->findById($projectId));
                }
        }

        return $view
            ->set('portfolioCategories', $portfolioModel->getCategories())
            ->set('googlePlusNetwork', $this->getSocialNetworks('google+'))
            ->set('twitterNetwork', $this->getSocialNetworks('twitter'))
            ->set('facebookNetwork', $this->getSocialNetworks('facebook'));
    }
    
    /**
     * @param string $slug
     * 
     * @return false|array
     */
    public function findPageBySlug($slug = '')
    {
        return DB::select()
            ->from('content__page')
            ->where('slug', '=', $slug)
            ->limit(1)
            ->execute()
            ->current()
        ;
    }

    /**
     * @param string $slug
     * @param string $content
     */
    public function updatePageContent($slug, $content)
    {
        DB::update('content__page')
            ->set(['content' => $content])
            ->where('slug', '=', $slug)
            ->execute()
        ;
    }

    /**
     * @param $page
     * @param $param
     *
     * @return View
     */
    public function getPageContent($page, $param)
    {
        /** @var $portfolioModel Model_Portfolio */
        $portfolioModel = Model::factory('Portfolio');

        switch ($page) {
            case 'main':
                $view = View::factory('main')
                    ->set('projectList', array_chunk($portfolioModel->findAll(), 2))
                ;

                break;
            case 'portfolio_category':
                $view = View::factory('main')
                    ->set('projectList', array_chunk($portfolioModel->findByCategory((int)$param), 2))
                ;

                break;

            case 'services':
                $view = View::factory('services')
                    ->set('servicesList', $this->findAllServices())
                ;

                break;

            case 'activity':
                $view = View::factory('activity')
                    ->set('pageData', $this->findPageBySlug('activity'))
                ;

                break;

            default:
                $view = View::factory($page);
        }

        return $view;
    }

    public function getProjectPageContent($id)
    {
        /** @var $portfolioModel Model_Portfolio */
        $portfolioModel = Model::factory('Portfolio');

        return View::factory('project')
            ->set('projectData', $portfolioModel->findById($id))
            ;
    }

    /**
     * @param null|array $type
     * @return array
     */
    public function getContacts($type = null)
    {
        $query = DB::select()
            ->from('content__contacts')
            ->where('', '', 1)
        ;

        $query = $type !== null ? $query->and_where('type', 'IN', $type) : $query;

        return $query->execute()->as_array();
    }

    /**
     * @param string $type
     * @param string $value
     *
     * @return bool
     */
    public function addContact($type, $value)
    {
        if (!array_key_exists($type, $this->getContactTypes())) {
            return false;
        }

        DB::insert('content__contacts', ['type', 'value'])
            ->values([$type, $value])
            ->execute()
        ;

        return true;
    }

    /**
     * @param array $params
     */
    public function updateContacts($params)
    {
        $ids = Arr::get($params, 'ids', []);
        $types = Arr::get($params, 'types', []);
        $values = Arr::get($params, 'values', []);

        foreach ($ids as $key => $id) {
            DB::update('content__contacts')
                ->set(['type' => $types[$key], 'value' => $values[$key]])
                ->where('id', '=', $id)
                ->execute()
            ;
        }
    }

    /**
     * @param int $id
     */
    public function removeContact($id)
    {
        DB::delete('content__contacts')
            ->where('id', '=', $id)
            ->execute()
        ;
    }

    /**
     * @return array
     */
    public function findAllServices()
    {
        return DB::select()
            ->from('content__services')
            ->execute()
            ->as_array()
            ;
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function findServiceById($id)
    {
        return DB::select()
            ->from('content__services')
            ->where('id', '=', $id)
            ->limit(1)
            ->execute()
            ->current()
        ;
    }

    /**
     * @param string $title
     * @param string $description
     *
     * @return bool
     */
    public function addService($title, $description)
    {
        DB::insert('content__services', ['title', 'description'])
            ->values([$title, $description])
            ->execute()
        ;

        return true;
    }

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     */
    public function updateService($id, $title, $description)
    {
        DB::update('content__services')
            ->set(['title' => $title, 'description' => $description])
            ->where('id', '=', $id)
            ->execute()
        ;
    }

    /**
     * @param int $id
     */
    public function removeService($id)
    {
        DB::delete('content__services')
            ->where('id', '=', $id)
            ->execute()
        ;
    }

    /**
     * @param array $files
     * @param int $id
     */
    public function loadServiceImg($id, $files)
    {
        $type = mb_strrchr ($files['imgname']['name'], '.', false);
        $fileName = 'public/img/services/' . $id . $type;

        if (copy($files['imgname']['tmp_name'], $fileName))	{
            $image = Image::factory($fileName);
            $image
                ->resize(500, NULL)
                ->save($fileName,100)
            ;
        }
    }

    /**
     * @param null|array $type
     * @return array
     */
    public function getSocialNetworks($type = null)
    {
        $query = DB::select()
            ->from('content__social_networks')
            ->where('', '', 1)
        ;

        $query = $type !== null ? $query->and_where('type', '=', $type) : $query;
        $query = $type !== null ? $query->limit(1) : $query;

        return $query = $type !== null ? $query->execute()->current() : $query->execute()->as_array();
    }

    /**
     * @param array $params
     */
    public function updateSocialNetworks($params)
    {
        $ids = Arr::get($params, 'ids', []);
        $values = Arr::get($params, 'values', []);

        foreach ($ids as $key => $id) {
            DB::update('content__social_networks')
                ->set(['value' => $values[$key]])
                ->where('id', '=', $id)
                ->execute()
            ;
        }
    }

}