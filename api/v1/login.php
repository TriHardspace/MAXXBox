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
$result = pg_prepare($conn, "query1", "SELECT email FROM USERS WHERE email='$email'");

print($result);
// if (in_array($email, $result) == True) {
// print("You are already registered");
// die();
// }
// else {
// print("unfinished");
// UNFINISHED //
//}

}



else {
print("Password too short.");
die();
}


?>
