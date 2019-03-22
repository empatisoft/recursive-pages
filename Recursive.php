<?php
/**
 * Onur KAYA
 * empatisoft@gmail.com
 * empatisoft.com
 * Date: 2019-03-22
 * Time: 16:42
 *
 * Sınırsız alt sayfa hiyerarşisi için örnek sınıftır.
 */

class Recursive {

    /**
     * @return null|PDO
     * Veritabanı bağlantısı
     */
    private function connect()
    {
        $db = null;
        if ($db === null) {
            try {
                $dsn = 'mysql:host='.DB_SERVER.';dbname='.DB_NAME.';port='.DB_PORT.';charset=utf8';
                $db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return $db;
    }

    /**
     * @param $array
     * @return stdClass
     *
     * Gelen diziyi nesneye dönüştürür.
     *
     * Array => Object
     */
    private function convertToObject($array) {
        $object = new stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = $this->convertToObject($value);
            }
            $object->$key = $value;
        }
        return $object;
    }

    /**
     * @param $parent_id
     * @param $lang_id
     * @return array
     *
     * Veritabanından sayfaları çeker ve metoda gönderir.
     */
    private function getData($parent_id, $lang_id) {

        if($lang_id == 0) {
            $query_string = 'SELECT p.page_id, p.name, p.url, p.parent_id, p.level FROM pages as p WHERE p.parent_id = :parent_id AND p.is_active = 1 ORDER BY p.item_number ASC';
            $where = array(
                'parent_id' => $parent_id
            );
        } else {
            $query_string = 'SELECT p.page_id, p.parent_id, p.level, t.name, t.url FROM pages as p INNER JOIN pages_translate as t ON t.page_id = p.page_id WHERE p.parent_id = :parent_id AND p.is_active = 1 AND t.lang_id = :lang_id AND t.is_active = 1 ORDER BY p.item_number ASC';
            $where = array(
                'parent_id' => $parent_id,
                'lang_id' => $lang_id
            );
        }

        try {
            $query = $this->connect()->prepare($query_string);
            $query->execute($where);
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch(PDOException $e) {
            trigger_error('Wrong SQL: ' . $query_string . ' Error: ' . $e->getMessage(), E_USER_ERROR);
        }
    }

    /**
     * @param $params
     * @return array
     *
     * Hiyerarşik olarak alt sayfaları listeler ve ana metoda gönderir.
     */
    private function getSubPages($params) {
        $parent_id = isset($params['parent_id']) ? $params['parent_id'] : 0;
        $lang_id = isset($params['lang_id']) ? $params['lang_id'] : 0;

        $data = $this->getData($parent_id, $lang_id);

        $pages = array();

        if($data != NULL)
        {
            foreach ($data as $d)
            {
                array_push(
                    $pages,
                    array(
                        'page_id' => $d->page_id,
                        'parent_id' => $d->parent_id,
                        'name' => $d->name,
                        'url' => $d->url,
                        'level' => $d->level,
                        'pages' => $this->getSubPages(
                            array(
                                'parent_id' => $d->page_id,
                                'lang_id' => $lang_id
                            )
                        )
                    )
                );
            }
        }

        return $pages;

    }

    /**
     * @param $params
     * @return array|stdClass
     *
     * Projenizden çağıracağınız metod
     */
    public function getPages($params) {
        $parent_id = isset($params['parent_id']) ? $params['parent_id'] : 0;
        $lang_id = isset($params['lang_id']) ? $params['lang_id'] : 0;
        $returnType = isset($params['type']) ? $params['type'] : 'object';

        $data = $this->getData($parent_id, $lang_id);

        $pages = array();

        if($data != NULL)
        {
            foreach ($data as $d)
            {
                array_push(
                    $pages,
                    array(
                        'page_id' => $d->page_id,
                        'parent_id' => $d->parent_id,
                        'name' => $d->name,
                        'url' => $d->url,
                        'level' => $d->level,
                        'pages' => $this->getSubPages(
                            array(
                                'parent_id' => $d->page_id,
                                'lang_id' => $lang_id
                            )
                        )
                    )
                );
            }
        }

        return $returnType == 'object' ? $this->convertToObject($pages) : $pages;
    }
}