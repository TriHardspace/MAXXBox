<?php

if (strlen($password) >= 8 | strlen($password) <= 25) {


function getSalt($n) {
    $characters = "qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM";
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];

    }

    return $randomString;
};


$username = $_POST['username'];
$password = $_POST['password'];
$salt = getSalt(strlen($password));
$password .= $salt;

$password = hash("sha256", $password);
print($password);


}

else {

print("Password either too long or too short.");
?>
