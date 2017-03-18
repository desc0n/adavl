<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller
{
	public function action_index()
	{
        /** @var $contentModel Model_Content */
        $contentModel = Model::factory('Content');

        View::set_global('title', 'Главная');
        View::set_global('rootPage', 'main');

		$template = $contentModel->getBaseTemplate();
        
		$template->content = View::factory('page')
            ->set('pageData', $contentModel->findPageBySlug('main'))
            ->set('get', $this->request->query())
        ;

		$this->response->body($template);
	}

	public function action_page()
	{
        /** @var $contentModel Model_Content */
        $contentModel = Model::factory('Content');

        $slug = $this->request->param('slug');
        
        View::set_global('title', 'Главная');
        View::set_global('rootPage', $slug);

        $template = $contentModel->getBaseTemplate();
        
		$template->content = View::factory('page')
			->set('pageData', $contentModel->findPageBySlug($slug))
			->set('get', $this->request->query())
        ;
        
		$this->response->body($template);
	}
}