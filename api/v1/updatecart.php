<?php
$connectfile = fopen("/var/www/nonpublic/connect.txt", "r");
$hetzner_starter = intval($_POST['hetzner_starter']);
$hetzner_plus = intval($_POST['hetzner_plus']);
$hetzner_advanced = intval($_POST['hetzner_advanced']);
$token = $_POST['token'];
$prices = array(9.69, 17.69, 27.69);
// first is starter, second is plus, third is advanced 
$connectstring = fread($connectfile, filesize("/var/www/nonpublic/connect.txt"));
$conn = pg_connect($connectstring);
$preparestring1 = pg_prepare($conn, 'query1', 'SELECT email FROM users WHERE token=$1');
$result1 = pg_execute($conn, 'query1', array($token));
$numrows = pg_numrows($result1);
if ($numrows != 1) {
$returnobj = new \stdClass();
$returnobj->success = "false";
$returnobj->reason = "invalid_token";
die();
}
else {
$hetzner_starter_total = $hetzner_starter * $prices[0];
$hetzner_plus_total = $hetzner_plus * $prices[1];
$hetzner_advanced_total $hetzner_advanced * $prices[2];
$subtotal = $hetzner_starter_total + $hetzner_plus_total + $hetzner_advanced_total;
$subtotal = round($subtotal, 2);
$total = $subtotal * 1.0625;
$total = round($total, 2);
$email = pg_fetch_result($result1, 0, 0);
$preparestring2 = pg_prepare($conn, 'update1', 'UPDATE cart SET (hetzner_starter, hetzner_plus, hetzner_advanced, total, subtotal) = ($1, $2, $3, $4, $5) WHERE email = $6');
$result2 = pg_execute($conn, 'update1', array($hetzner_starter, $hetzner_plus, $hetzner_advanced, $total, $subtotal, $email));
$returnobj = new \stdClass();
$returnobj->success = "true";
$returnobj->total = $total;
$returnobj->subtotal = $subtotal;
$returnobj = json_encode($returnobj);
print($returnobj);
die();
}






?>
