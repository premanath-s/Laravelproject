<?php
require __DIR__.'/../vendor/autoload.php';
$db = new PDO('sqlite:database/database.sqlite');
$stmt = $db->prepare('UPDATE users SET is_admin = 1 WHERE id = :id');
$stmt->execute([':id' => 1]);
echo "User 1 set as admin\n";
