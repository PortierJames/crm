<?php
session_start();

if(!$_SESSION["LoggedIn"])
{
	header('Location: index.php');
}

include_once('application/views/partial/header.php');

?>
<div id="main-container" class="container">
	<div id="topdiv">
		<div id=""></div>
	</div><!-- #topdiv -->
	<ul>
    <li><a class="btn btn-default" href="contacts.php" role="button">Contacts</a></li><br />
		<li><a class="btn btn-default" href="organizations.php" role="button">Organizations</a></li><br />
		<li><a class="btn btn-default" href="search.php" role="button">Search</a></li><br />
		<li><a class="btn btn-default" href="logout.php" role="button">Logout</a></li>
	</ul>
</div> <!-- #main-container -->
<?php

include_once("application/views/partial/footer.php");

?>
