<?php


function getSalt($n) {
    $characters = "qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM";
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];

    }

    return $randomString;
};


$username = $_POST['email'];
$password = $_POST['password'];
$salt = getSalt(strlen($password))
$password .= $salt;
print($password);

?>
