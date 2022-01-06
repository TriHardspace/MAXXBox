<?php
$token = $_POST['token'];
$connectfile = fopen("/var/www/nonpublic/connect.txt", "r");
// Getting db connect string from file on 
$connectstring = fread($connectfile, filesize("/var/www/nonpublic/connect.txt"));
$conn = pg_connect($connectstring);
$preparestring1 = pg_prepare($conn, 'query1', 'SELECT email FROM users where token = $1');
$query1 = pg_execute($conn, 'query1', array($token));
$numrows = pg_numrows($query1);

if ($numrows != 1) {
$returnobj = new \stdClass();
$returnobj->success = "false";
$returnobj->reason = "invalid_token";
$print($returnobj);
}
else {
preparestring2 = pg_prepare($conn, 'query2', 'SELECT (total, subtotal, hetzner_starter, hetzner_plus, hetzner_advanced) FROM cart WHERE email=$1');
$returnobj = new \stdClass();
$returnobj->total = pg_fetch_result('query2', 0, 0);
$returnobj->subtotal = pg_fetch_result('query2', 0, 1);
$returnobj->hetzner_basic = pg_fetch_result('query2', 0, 2);
$returnobj->hetzner_plus = pg_fetch_result('query2', 0, 3);
$returnobj->hetzner_advanced = pg_fetch_result('query2', 0, 4);
$returnobj = json_encode($returnobj);
print($returnobj);
die();
}


?>

