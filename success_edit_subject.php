<?php include_once("connection_local.php"); ?>

<?php
    session_start();// Starting Session
    // Storing Session
    $user_check=$_SESSION['admin_id'];
    // SQL Query To Fetch Complete Information Of User
    $ses_sql=mysql_query("SELECT * FROM administrator WHERE admin_id='" . $user_check . "'", $conn);
    $row = mysql_fetch_assoc($ses_sql);
    $login_session =$row['admin_id'];
    $logged_user=$row['admin_name'];
    if(!isset($login_session)){
      mysql_close($conn); // Closing Connection
      header('Location: index.php'); // Redirecting To Home Page
    }


    $sql = "SELECT * FROM subject where subject_id='". $_GET['subject_id'] . "'";
    $result = mysql_query($sql);

    $row = mysql_fetch_row($result);

    if(isset($_POST["submit"]))
{ 
$sql="update subject set subject_name='$_POST[subject_name]', semester='$_POST[semester]', section='$_POST[section]' where subject_id='" . $_GET['subject_id'] . "'";

if (!mysql_query($sql,$conn))
  {
  die('Error: ' . mysql_error());
  }
  else
  {
    header('Location: view_subjects.php'); 
  }
}
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Montessori De Sagrada Familia</title>
  <link rel="stylesheet" href="styles/style.css" />
</head>
<body>

  <?php include_once("template_pageTopAdminLogged.php"); ?>
  <div id="pageMiddle">
  <section>
    <h3>Administrator: <?php echo $logged_user; ?></h3>
    <h4>Edit existing subject.</h4>

		<form action="" method="post">
		<fieldset>
			<legend>Edit the following information...</legend>
			<label for="subject_name">Subject Name</label>
			<input required type="text" name="subject_name" id="subject_name" autocomplete="off" value="<?php echo $row[1]; ?>" />
			<br/>
			<label for="semester">Semester</label>
			<select required type="text" name="semester" id="semester" >
			  <option selected="selected"><?php echo $row[2]; ?></option>
			  <option>First Semester</option>
			  <option>Second Semester</option>
			</select>

			<br/>
			<label for="section">Section</label>
			<input required type="text" name="section" id="section" value="<?php echo $row[3]; ?>">
			<br/>
			
		</fieldset>
		<input name="submit" type="submit" value="Submit" />
  	</form>

    
  <?php include_once("admin_menu.php"); ?>

  </section>
  </div>
  <?php include_once("template_pageBottom.php"); ?>
</body>
</html>
