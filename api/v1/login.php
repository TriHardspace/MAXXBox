<?php
print(getenv('CONNECT_STRING'));
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
// $connectstring = getenv('CONNECT_STRING');
// $conn = pg_connect($connectstring);
// $result = pg_prepare($conn, "query1", "SELECT email FROM USERS WHERE email = $email");
// if (in_array($email, $result) == True) {
// print("You are already registered");
// die();
// }
/ else {
// print("unfinished");
// THIS PART NEEDS TO BE WORKED ON STILL //

// }

}



else {
print("Password too short.");
die();
}


?>
