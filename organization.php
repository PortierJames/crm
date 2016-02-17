<?php
session_start();

if(!$_SESSION["LoggedIn"] == true)
{
	header("location: index.php");
}

include_once("application/functions/functions.php");
include_once("application/forms/forms.php");

include_once("application/views/partial/header.php");

echo "<div class='container'>";
foreach ($_POST as $key => $value) {
	echo "$key = $value <br />";
}
echo "</div><br />";

echo "<div class='container' id='menu'>";
echo "<a class='btn btn-default' href='organization.php'>New Organization</a>";
echo " | ";
echo "<a class='btn btn-default' href='organizations.php'>Organizations</a>";
echo "</div>";

if ($_POST["submitted"]) {
	if ($_POST['id'] > 0) {
		$updated = updateOrganization($_POST);
		if ($updated == true) {
			header("location: home.php");
		} else {
			displayErrorMessage("There was an error updating your contact");
		}
	} else {
		$saved = saveOrganization($_POST);
		if ($saved == true) {
			header("location: home.php");
		} else {
			displayErrorMessage("There was an error saving your contact");
		}
	}

}

$id = $_GET['id'];

$organizationResults = getOrganization($id);
$organization = mysql_fetch_assoc($organizationResults);
echo "<div class='container'>";
displayOrganizationForm($organization);
echo "</div>";

include_once("application/views/partial/footer.php");

?>
