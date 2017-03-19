<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller
{
    /** @var Model_Content */
    private $contentModel;

    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);
        $this->contentModel = Model::factory('Content');
    }

    public function action_get_page_content()
    {
        $this->response->body($this->contentModel->getPageContent($this->request->query('page')));
    }

    public function action_get_project_page_content()
    {
        $this->response->body($this->contentModel->getProjectPageContent($this->request->query('id')));
    }
}
