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
die();
}

else {
$email = pg_fetch_rows($executeem, 0, 0);
print($email);

}
?>
