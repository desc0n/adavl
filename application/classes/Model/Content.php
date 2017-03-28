<?php

/**
 * Class Model_Content
 */
class Model_Content extends Kohana_Model
{
    public function getBaseTemplate()
    {
        /** @var $portfolioModel Model_Portfolio */
        $portfolioModel = Model::factory('Portfolio');

        return View::factory('template')
            ->set('portfolioCategories', $portfolioModel->getCategories())
            ->set('contacts', $this->findAllContacts())
        ;
    }
    
    /**
     * @return array
     */
    public function getPages()
    {
        return DB::select('p.*')
            ->from(['pages__pages', 'p'])
            ->join(['pages__menu', 'm'])
            ->on('m.page_id', '=', 'p.id')
            ->where('m.status_id', '=', 1)
            ->execute()
            ->as_array()
        ;
    }

    public function getPage($params = [])
    {
        $id = Arr::get($params, 'id', 0);

        return DB::select()
            ->from('pages__pages')
            ->where('id', '=', $id)
            ->limit(1)
            ->execute()
            ->current()
        ;
    }

    /**
     * @param string $slug
     * 
     * @return false|array
     */
    public function findPageBySlug($slug = '')
    {
        return DB::select()
            ->from('pages__pages')
            ->where('slug', '=', $slug)
            ->limit(1)
            ->execute()
            ->current()
        ;
    }

    /**
     * @param string $slug
     *
     * @return false|array
     */
    public function findMenuByPageSlug($slug = '')
    {
        return DB::select('p.*')
            ->from(['pages__pages', 'p'])
            ->join(['pages__menu', 'm'])
            ->on('p.id', '=', 'm.page_id')
            ->where('p.slug', '=', $slug)
            ->limit(1)
            ->execute()
            ->current()
        ;
    }

    /**
     * @return array
     */
    public function findAllContacts()
    {
        return DB::select()
            ->from('contacts__contacts')
            ->execute()
            ->as_array('name', 'value')
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
}