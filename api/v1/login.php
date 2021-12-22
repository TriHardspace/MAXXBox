$email = $_POST['email'];
$password = $_POST['email'];

$connectfile = fopen("/var/www/nonpublic/connect.txt", "r");
// Getting db connect string from file on 
$connectstring = fread($connectfile, filesize("/var/www/nonpublic/connect.txt"));
$conn = pg_connect($connectstring);
$preparestring1 = pg_prepare($conn, 'query1', 'SELECT email FROM users where email = $1');
$result1 = pg_execute($conn, 'query1', array($email));
$numrows = pg_numrows($result1);
if ($numrows != 1) {
returnobj = new \stdClass();
returnobj->success = "false";
returnobj->reason = "no_account";
returnobj = json_encode(returnobj);
echo returnobj;
die();
}
else {
preparestring2 = pg_prepare($conn, 'query2' 'SELECT password, salt, token FROM users where email = $1')
result2 = pg_execute($conn, 'query2', array($email));

