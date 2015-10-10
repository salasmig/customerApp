<?php
//mysql connection information
$hostname_contacts = "localhost";  
$database_contacts = "booking_system"; //The name of the database
$username_contacts = "booking_system"; //The username for the database
$password_contacts = "booking"; // The password for the database
$prefix = '';
$contacts = mysql_connect($hostname_contacts, $username_contacts, $password_contacts) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_contacts, $contacts);
//
?>