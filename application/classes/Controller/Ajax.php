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
        $this->response->body($this->contentModel->getPageContent($this->request->query('page'), $this->request->query('param')));
    }

    public function action_get_project_page_content()
    {
        $this->response->body($this->contentModel->getProjectPageContent($this->request->query('id')));
    }

    public function action_remove_portfolio_item_img()
    {
        /** @var $portfolioModel Model_Portfolio */
        $portfolioModel = Model::factory('Portfolio');

        $portfolioModel->removeImg((int)$this->request->post('id'));

        $this->response->body(json_encode(['result' =>'success']));
    }

    public function action_remove_portfolio_item()
    {
        /** @var $portfolioModel Model_Portfolio */
        $portfolioModel = Model::factory('Portfolio');

        $portfolioModel->removeItem((int)$this->request->post('id'));

        $this->response->body(json_encode(['result' =>'success']));
    }
}
