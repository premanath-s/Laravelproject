<?php
$db = new PDO('sqlite:database/database.sqlite');
$q = $db->query('SELECT id, email, password FROM users');
foreach ($q as $r) {
    echo $r['id'] . '|' . $r['email'] . '|' . substr($r['password'], 0, 20) . PHP_EOL;
}
