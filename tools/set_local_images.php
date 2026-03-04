<?php
// Map first N products to local sample images (cycles through sample1..sample5.png)
$db = new PDO('sqlite:database/database.sqlite');
$q = $db->query('SELECT id FROM products ORDER BY id');
$images = ['/images/sample1.png','/images/sample2.png','/images/sample3.png','/images/sample4.png','/images/sample5.png'];
$i = 0;
foreach($q as $r){
    $img = $images[$i % count($images)];
    $stmt = $db->prepare('UPDATE products SET image = :img WHERE id = :id');
    $stmt->execute([':img'=>$img,':id'=>$r['id']]);
    echo "Updated product {$r['id']} -> $img\n";
    $i++;
}
echo "Done.\n";
