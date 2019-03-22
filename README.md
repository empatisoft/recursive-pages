# Sınırsız Sayfalar

Hiyerarşik olarak oluşturabileceğiniz sınırsız sayfalar için örnektir.

<pre>
$recursive = new Recursive();

$pages = $recursive->getPages(
    array(
        'parent_id' => 0,
        'lang_id' => 0
    )
);
print_r($pages);
</pre>

Eğer nesne olarak değil de dizi olarak sonuçların gelmesini istiyorsanız "type" parametresini eklemeniz yeterlidir;

<pre>
$recursive = new Recursive();

$pages = $recursive->getPages(
    array(
        'parent_id' => 0,
        'lang_id' => 0,
        'type' => 'array'
    )
);
print_r($pages);
</pre>
