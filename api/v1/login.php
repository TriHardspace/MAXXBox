<?php

$email = $_POST['email'];
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
$token = getSalt(64);
$pguser = getenv("POSTGRES_USER");
$pgpassword = getenv("POSTGRES_PASSWORD");
$dbname = getenv("POSTGRES_DB");
$connectstring = getenv('CONNECT_STRING');
$conn = pg_connect($connectstring);
$result = pg_prepare($conn, "query1", "SELECT password FROM USERS WHERE email = $email");
print($result);

}



else {
print("Password too short.");
}


?>
