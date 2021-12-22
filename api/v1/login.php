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
print("getSalt successful\n");
$password .= $salt;
$password = hash("sha256", $password);
print("password hash successful\n");
$token = getSalt(64);
$connectfile= fopen("connect.txt", "r");
$connectstring = fread($connectfile, filesize("connect.txt"));
$conn = pg_connect($connectstring);
$querystring = pg_prepare($conn, "query1", "SELECT email FROM USERS WHERE email=$1");
$result = pg_execute($conn, "query1", array($email));
$numrows = pg_numrows($result);
if ($numrows != 0) {
print("Already registered");
die();
}
else {
$insertstring1 = pg_prepare($conn, "insert1", "INSERT INTO users (email, password, token, salt) VALUES ($1, $2, $3, $4)");
$result2 = pg_execute($conn, "insert1", array($email, $password, $token, $salt));
return $token;

}

}



else {
print("Password too short.");
die();
}


?>
