<?php

//getting user info from POST
$email = $_POST['email'];
$password = $_POST['password'];
$email = htmlspecialchars($email);

if (strlen($password) > 7) {
//test to see if user's password is somewhat safe (failsafe)

function getSalt($n) {
    // Generates a random string the length of the given integer
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
// Hashing and salting the password
$token = getSalt(64);
// Generating the user login token
$connectfile = fopen("/var/www/nonpublic/connect.txt", "r");
// Getting db connect string from file on 
$connectstring = fread($connectfile, filesize("/var/www/nonpublic/connect.txt"));
$conn = pg_connect($connectstring);
$querystring = pg_prepare($conn, "query1", "SELECT email FROM users WHERE email=$1");
$result = pg_execute($conn, "query1", array($email));
$numrows = pg_numrows($result);
if ($numrows != 0) {
$returnobj = new \stdClass();
// Just some bullshit to make php shut up
$returnobj->success = "false";
$returnobj->reason = "duplicate_account";
$returnobj = json_encode($returnobj);
echo $returnobj;
die();
}
else {
$insertstring1 = pg_prepare($conn, "insert1", "INSERT INTO users (email, password, token, salt, creation_date) VALUES ($1, $2, $3, $4, $5)");
$date = date('yyyy/mm/dd');
print($date);
$result2 = pg_execute($conn, "insert1", array($email, $password, $token, $salt, $date));
$returnobj = new \stdClass();
// Just some bullshit to make php shut up
$returnobj->token = $token;
$returnobj->success = "true";
$returnobj = json_encode($returnobj);
echo $returnobj;

}

}



else {
print("Password too short.");
die();
}


?>
