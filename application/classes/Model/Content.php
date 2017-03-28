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

    public function getBaseTemplate()
    {
        /** @var $portfolioModel Model_Portfolio */
        $portfolioModel = Model::factory('Portfolio');

        return View::factory('template')
            ->set('portfolioCategories', $portfolioModel->getCategories())
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
}