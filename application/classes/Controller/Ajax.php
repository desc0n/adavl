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

    public function action_get_main_page_content()
    {
        $this->response->body($this->contentModel->getMainPageContent());
    }
}
