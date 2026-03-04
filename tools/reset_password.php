<?php
if ($argc < 3) {
    echo "Usage: php reset_password.php email newpassword\n";
    exit(1);
}
$email = $argv[1];
$new = $argv[2];
$hash = password_hash($new, PASSWORD_BCRYPT);
$db = new PDO('sqlite:database/database.sqlite');
$stmt = $db->prepare('UPDATE users SET password = :p WHERE email = :e');
$stmt->execute([':p' => $hash, ':e' => $email]);
echo "Updated password for $email\n";
