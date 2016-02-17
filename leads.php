<?php
session_start();

if(!$_SESSION["LoggedIn"] == true)
{
	header("location: index.php");
}

include_once("application/functions/functions.php");
include_once("application/forms/forms.php");
include_once("application/views/partial/views.php");

include_once("application/views/partial/header.php");

echo "<div class='container' id='leads'>";
//$leads = getContacts();
//displayLeads($leads);
echo "</div>";


include_once("application/views/partial/footer.php");

?>
