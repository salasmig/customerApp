<?php require_once('includes/config.php'); 
ob_start();
session_start();
$res = mysql_query("SHOW TABLE STATUS LIKE 'users'") or die(mysql_error());
$table_exists = mysql_num_rows($res) == 1;
$success = 0;
$s = 0;


// Create connection
$conn = new mysqli($hostname_contacts, $username_contacts, $password_contacts, $database_contacts);
// Check connection
if ($conn->connect_error) 
    die("Connection failed: " . $conn->connect_error);




if (isset($_GET['s'])) {
$success = 1;
$s = 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Simple Customer: Installation</title>
<link href="includes/simplecustomer.css" rel="stylesheet" type="text/css" />
</head><body><div class="logincontainer" id="installcontainer"><h1><span class="loginheading">Simple Customer Installation</span></h1>
<?php if ($s!=1) { ?><form id="form1" name="form1" method="post" action="">
    <p>Your email address<br />
      <input name="email" type="text" id="email" size="35" />
</p>
    <p></p>
    <p>Choose a password <br />
      <input name="password" type="password" id="password" />
</p>
    <p></p>
    <input type="submit" name="Submit" value="Submit" />
  </form>
<?php } ?>
  <h1>
  
<?php
    function report_result($conn, $sql, $table)
    {
      if ($conn->query($sql) === TRUE)
          echo $table. " created successfully";
      else
          echo "Error creating table: " . $conn->error;
    }
?>  
<?php
  if (isset($_POST['email']) && $success==0) { 

    $sql = "CREATE TABLE ".$prefix."contacts (
      contact_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      contact_first varchar(255) default NULL,
      contact_last varchar(255) default NULL,
      contact_title varchar(255) default NULL,
      contact_image varchar(255) default NULL,
      contact_profile text,
      contact_tags text,
      contact_custom text,
      contact_company varchar(255) default NULL,
      contact_street varchar(255) default NULL,
      contact_city varchar(255) default NULL,
      contact_state varchar(255) default NULL,
      contact_country varchar(255) default NULL,
      contact_zip varchar(255) default NULL,
      contact_phone varchar(255) default NULL,
      contact_cell varchar(255) default NULL,
      contact_fax varchar(255) default NULL,
      contact_email varchar(255) default NULL,
      contact_web varchar(255) default NULL,
      contact_updated int(11) default NULL,
      contact_user int(11) default NULL
    )";
    report_result($conn,$sql,"contact");

    $sql = "CREATE TABLE ".$prefix."fields (
      field_id int(11) NOT NULL auto_increment PRIMARY KEY,
      field_type int(11) default NULL,
      field_title varchar(255) default NULL,
      field_content text
    )";
    report_result($conn,$sql,"fields");

    $sql = "CREATE TABLE ".$prefix."fields_assoc (
      cfield_id int(11) NOT NULL auto_increment PRIMARY KEY,
      cfield_contact int(11) default NULL,
      cfield_field int(11) default NULL,
      cfield_value text
    )";
    report_result($conn,$sql,"filelds_assoc");

    $sql = "CREATE TABLE ".$prefix."users (
      user_id int(11) NOT NULL auto_increment PRIMARY KEY,
      user_level int(11) default NULL,
      user_email varchar(255) default NULL,
      user_password varchar(255) default NULL,
      user_date int(10) default NULL,
      user_home varchar(255) default NULL  
    )";
    report_result($conn,$sql,"users");

    $sql = "INSERT INTO ".$prefix."users (user_id, user_level, user_email, user_password, user_date, user_home) VALUES (1, 1, '".trim($_POST['email'])."', '".trim($_POST['password'])."', NULL, 'index.php')";
    report_result($conn,$sql,"admin_user");
  
    $sql = "CREATE TABLE ".$prefix."history (
      history_id int(11) NOT NULL auto_increment PRIMARY KEY,
      history_type int(11) default NULL,
      history_contact int(11) default NULL,
      history_date int(10) default NULL,
      history_status int(11) default NULL,
      history_user int(11) default NULL  
    )";
    report_result($conn,$sql,"history");

    $sql = "CREATE TABLE ".$prefix."notes (
      note_id int(11) NOT NULL auto_increment PRIMARY KEY,
      note_contact int(11) default NULL,
      note_text text,
      note_date varchar(10) default NULL,
      note_status int(11) default NULL,
      note_user int(11) default NULL
    )";
    report_result($conn,$sql,"notes");

    $sql = "CREATE TABLE ".$prefix."tags (
      tag_id int(11) NOT NULL auto_increment PRIMARY KEY,
      tag_description varchar(255) character set utf8 default NULL
    )";
    report_result($conn,$sql,"tags");

    $sql = "CREATE TABLE ".$prefix."tags_assoc (            
      itag_id int(11) NOT NULL auto_increment PRIMARY KEY,
      itag_contact int(11) default NULL,
      itag_tag int(11) default NULL 
    )";
    report_result($conn,$sql,"tags_assoc");

    $_SESSION['user'] = $_POST['email'];
    header('Location: install.php?s'); die;

    $conn->close();   
  }
?>

<?php if ($success==1) { 
$query_usercheck = "SELECT * FROM ".$prefix."users ";
$usercheck = mysql_query($query_usercheck, $contacts) or die(mysql_error());
$row_usercheck = mysql_fetch_assoc($usercheck);
$totalRows_usercheck = mysql_num_rows($usercheck);
if ($totalRows_usercheck > 0) { $success = 1; } 
?>
Installation Successful!  Please delete install.php and <a href="index.php" class="links">proceed to login.</a></h1>
<?php } ?>
  

</div>

</body>
</html>





