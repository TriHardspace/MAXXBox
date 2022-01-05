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
$returnobj = new \stdClass();
$returnobj->success = "true";
$returnobj->total = "0.00";
$total = "0.00";
$email = pg_fetch_result($executeem, 0, 0);
$quertystring2 = pg_prepare($conn, 'query2', "INSERT INTO users (email, total) VALUES ($1, $2)");
$executeem2 = pg_execute($conn, 'query2', array($email, $total));
$returnobj = json_encode($returnobj);
print($returnobj);
}
?>
