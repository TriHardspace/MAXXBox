<?php

$username = $_POST['username'];
$password = $_POST['password'];

 
if (strlen($password) > 7) {


function getSalt($n) {
    $characters = "qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM";
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];

    }

    return $randomString;
};


$salt = getSalt(strlen($password));
$password .= $salt;

$password = hash("sha256", $password);
print($password);


}

else {
print("Password too short.");
}


?>
