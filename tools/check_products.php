<?php
$db = new PDO('sqlite:database/database.sqlite');
$q = $db->query('SELECT id, name, image FROM products');
foreach ($q as $r) {
    echo $r['id'].'|'.$r['name'].'|'.$r['image'].PHP_EOL;
}
