<?php

$token = $_POST['token'];
$connectfile = fopen("/var/www/nonpublic/connect.txt", "r");
$connectstring = fread($connectfile, filesize("/var/www/nonpublic/connect.txt"));
$conn = pg_connect($connectstring);
$querystring = pg_prepare($conn, 'query1', 'SELECT email FROM users WHERE token = $1');
$executeem = pg_execute($conn, 'query1', array($token));
$numrows = pg_numrows($executeem);
if ($numrows != 1) {
$returnobj = new \stdClass();
$returnobj->success = "false";
$returnobj->reason = "invalid_token";
$returnobj = json_encode($returnobj);
print($returnobj);
die();
}

else {
$existsquerystring = pg_prepare($conn, 'existsquery', 'SELECT email FROM cart WHERE email=$1');
$existsquery = pg_execute($conn, 'existsquery', array($email));
$numrows = pg_fetch_rows($existsquery);
if ($numrows != 0) {
$returnobj = new \stdClass();
$returnobj->success = "false";
$returnobj->reason = "cart_already_exists";
$returnobj = json_encode($returnobj);
print($returnobj);
}
else {
$returnobj = new \stdClass();
$returnobj->success = "true";
$returnobj->total = "0.00";
$total = 0.00;
$zero = 0;
// lol I'm lazy as fuck
$email = pg_fetch_result($executeem, 0, 0);
$quertystring2 = pg_prepare($conn, 'query2', "INSERT INTO cart (email, total, hetzner_starter, hetzner_plus, hetzner_advanced) VALUES ($1, $2, $3, $4, $5)");
$executeem2 = pg_execute($conn, 'query2', array($email, $total, $zero, $zero, $zero));
$returnobj = json_encode($returnobj);
print($returnobj);
}
}
?>
