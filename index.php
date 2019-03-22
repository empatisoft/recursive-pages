<?php
/**
 * Onur KAYA
 * empatisoft@gmail.com
 * empatisoft.com
 * Date: 2019-03-22
 * Time: 16:45
 */

define('DB_NAME', 'db_name');
define('DB_SERVER', 'localhost');
define('DB_PORT', 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');

require_once 'Recursive.php';

/**
 * Örnek Kullanımı:
 */

$recursive = new Recursive();

$pages = $recursive->getPages(
    array(
        'parent_id' => 0,
        'lang_id' => 0
    )
);

echo '<pre>';
print_r($pages);