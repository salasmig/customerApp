<?php


//mysql connection information

$hostname_contacts = "localhost";  
$database_contacts = "database_name"; //The name of the database
$username_contacts = "database_username"; //The username for the database
$password_contacts = "database_password"; // The password for the database
$contacts = mysql_connect($hostname_contacts, $username_contacts, $password_contacts) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_contacts, $contacts);

//

?>