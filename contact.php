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
echo "<a class='btn btn-default' href='contact.php'>New Contact</a>";
echo " | ";
echo "<a class='btn btn-default' href='contacts.php'>Contacts</a>";
echo "</div><br />";


if ($_POST["submitted"]) {
	if ($_POST['id'] > 0) {
		$updated = updateContact($_POST);
		if ($updated == true) {
			header("location: home.php");
		} else {
			displayErrorMessage("There was an error updating your contact");
		}
	} else {
		$saved = saveContact($_POST);
		if ($saved == true) {
			header("location: home.php");
		} else {
			displayErrorMessage("There was an error saving your contact");
		}
	}

}

$id = $_GET['id'];

$contactResults = getContact($id);
$contact = mysql_fetch_assoc($contactResults);
echo "<div class='container'>";
displayContactForm($contact);
echo "</div>";

include_once("application/views/partial/footer.php");

?>
