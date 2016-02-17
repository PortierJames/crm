<?php
session_start();

include_once('application/forms/forms.php');
include_once('application/functions/functions.php');

if (!$_SESSION['LoggedIn']) {
	if ($_POST['submitted']) {
		if (processLogin($_POST) == true) {
			  header("Location: home.php");
		  } else {
		    include_once("application/views/partial/headerLogin.php");
		    echo "<link href='./css/signin.css' rel='stylesheet'>";
			  displayErrorMessage('Login credentials incorrect!');
			  echo "<div class='formDiv'>";
			  displayLoginForm();
			  echo "</div>";
		}
	} else {
	  include_once("application/views/partial/headerLogin.php");
		echo "<link href='./css/signin.css' rel='stylesheet'>";
		echo "<div class='container'>";
		displayLoginForm();
		echo "</div>";
	}
}
else {
	header("location: home.php");
}


include_once("application/footer.php");
?>
