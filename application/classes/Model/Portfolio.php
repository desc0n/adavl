<?php

/**
 * Class Model_Portfolio
 */
class Model_Portfolio extends Kohana_Model
{
    public $defaultLimit = 20;

    /**
     * @param int $page
     * @param int $limit
     *
     * @return array
     */
    public function findAll($page = 1, $limit = 20)
    {
        $query = DB::select('pi.*', ['pc.name', 'category_name'])
            ->from(['portfolio__items', 'pi'])
            ->join(['portfolio__categories', 'pc'])
            ->on('pc.id', '=', 'pi.category_id')
        ;

        $query = !empty($page) && !empty($limit) ? $query->offset((($page - 1) * $limit)) : $query;
        $query = !empty($limit) ? $query->limit($limit) : $query;

        return $query
            ->execute()
            ->as_array()
        ;
    }

    /**
     * @param int $categoryId
     *
     * @return array
     */
    public function findByCategory($categoryId)
    {
        return DB::select('pi.*', ['pc.name', 'category_name'])
            ->from(['portfolio__items', 'pi'])
            ->join(['portfolio__categories', 'pc'])
            ->on('pc.id', '=', 'pi.category_id')
            ->where('pi.category_id', '=', $categoryId)
            ->execute()
            ->as_array()
        ;
    }

    /**
     * @param int $id
     *
     * @return array|bool
     */
    public function findById($id)
    {
        return DB::select('pi.*', ['pc.name', 'category_name'])
            ->from(['portfolio__items', 'pi'])
            ->join(['portfolio__categories', 'pc'])
            ->on('pc.id', '=', 'pi.category_id')
            ->where('pi.id', '=', $id)
            ->execute()
            ->current()
        ;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return DB::select()
            ->from('portfolio__categories')
            ->execute()
            ->as_array('id', 'name')
        ;
    }

    /**
     * @param null $id
     * @param int $categoryId
     * @param string $title
     * @param string $description
     *
     * @return int
     */
    public function setItem($id = null, $categoryId, $title, $description)
    {
        if ($id === null) {
            $result = DB::insert('portfolio__items', ['category_id', 'title', 'description'])
                ->values([$categoryId, $title, $description])
                ->execute()
            ;

            return (int)$result[0];
        }

        DB::update('portfolio__items')
            ->set([
                'category_id' => $categoryId,
                'title' => $title,
                'description' => $description
            ])
            ->where('id', '=', $id)
            ->execute()
        ;

        return $id;
    }

    /**
     * @param int $id
     */
    public function removeItem($id)
    {
        DB::delete('portfolio__items')->where('id', '=', $id)->execute();
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function findImgsByItemId($id)
    {
        return DB::select()
            ->from('portfolio__imgs')
            ->where('item_id', '=', $id)
            ->execute()
            ->as_array()
        ;
    }

    /**
     * @param array $filesGlobal
     * @param int $itemId
     */
    public function loadPortfolioImg($filesGlobal, $itemId)
    {
        $filesData = [];

        foreach ($filesGlobal['imgname']['name'] as $key => $data) {
            $filesData[$key]['name'] = $filesGlobal['imgname']['name'][$key];
            $filesData[$key]['type'] = $filesGlobal['imgname']['type'][$key];
            $filesData[$key]['tmp_name'] = $filesGlobal['imgname']['tmp_name'][$key];
            $filesData[$key]['error'] = $filesGlobal['imgname']['error'][$key];
            $filesData[$key]['size'] = $filesGlobal['imgname']['size'][$key];
        }

        foreach ($filesData as $files) {
            $res = DB::insert('portfolio__imgs', ['item_id'])
                ->values([$itemId])
                ->execute();

            $new_id = $res[0];

            $imageName = preg_replace("/[^0-9a-z.]+/i", "0", Arr::get($files,'name',''));
            $file_name = 'public/img/original/' . $new_id . '_' . $imageName;

            if (copy($files['tmp_name'], $file_name))	{
//                $image = Image::factory($file_name);
//                $image
//                    ->resize(1000, NULL)
//                    ->save($file_name,100)
//                ;

                $thumb_file_name = 'public/img/thumb/' . $new_id . '_' . $imageName;

                if (copy($files['tmp_name'], $thumb_file_name))	{
                    $thumb_image = Image::factory($thumb_file_name);
                    $thumb_image
                        ->resize(500, NULL)
                        ->save($thumb_file_name,100)
                    ;

                    DB::update('portfolio__imgs')
                        ->set([
                            'src' => $new_id . '_' . $imageName
                        ])
                        ->where('id', '=', $new_id)
                        ->execute()
                    ;
                }
            }
        }
    }

    /**
     * @param int $itemId
     *
     * @return string
     */
    public function findMainItemImg($itemId)
    {
        $itemImgs = $this->findImgsByItemId($itemId);

        return isset($itemImgs[0]['src']) ? '/public/img/original/' . $itemImgs[0]['src'] : null;
    }

    /**
     * @param int $id
     */
    public function removeImg($id)
    {
        DB::delete('portfolio__imgs')->where('id', '=', $id)->execute();
    }
}