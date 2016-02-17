<?php

include_once("../functions/functions.php");

function displayLoginForm()
{
	?>
	<div class="container">

      <form class="form-signin" method="post" action="">
        <h2 class="form-signin-heading">Login</h2>

        <label for="username" class="col-sm-2 control-label"></label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>

        <label for="password" class="col-sm-2 control-label"></label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitted" value="Login">Sign in</button>
      </form>

    </div> <!-- /container -->
	<?php
}

function displayContactForm($record)
{
	?>
	<form action="" method="post" name="contactForm" class="form-horizontal" role="form">
	  <fieldset>
	    <legend><?php echo ($record['id']>0) ? $record['name'] : "New Contact"; ?></legend>

			<div class="form-group">
		    <label for="name" class="col-sm-1 control-label">Name</label>
		    <input type="text" id="name" name="name" class="col-sm-2" value="<?php echo $record["name"]; ?>" />
		  </div>

		  <div class="form-group">
		    <label for="title" class="col-sm-1 control-label">Title</label>
		    <input type="text" name="title" class="col-sm-2" value="<?php echo $record["title"]; ?>" id="title" />
		  </div>

		  <div class="form-group">
		    <label for="org" class="col-sm-1 control-label">Org</label>
		    <input type="text" name="org" class="col-sm-2" value="<?php echo $record["org"]; ?>" id="org" />
		  </div>

		  <div class="form-group">
		    <button type="submit" class="btn btn-default" name="submitted" value="submitted">Submit</button>
		    <button type="reset" class="btn btn-default" name="reset">Cancel</button>
		  </div>

		  <div class="clr">
		    <input type="hidden" value="<?php echo ($record["id"]) ? $record["id"]: "0"; ?>" name="id" />
		  </div>
		</fieldset>
	</form>

<br />


	<?php
}

function displayOrganizationForm($record)
{
	?>
	<form action="" method="post" name="organizationForm" class="form-horizontal" role="form">
	  <fieldset>
	    <legend><?php echo ($record['ID']>0) ? $record['NAME'] : "New Organization"; ?></legend>

			<div class="form-group">
		    <label for="NAME" class="col-sm-1 control-label">Name</label>
		    <input type="text" id="NAME" class="col-sm-2" name="NAME" value="<?php echo $record["NAME"]; ?>" />
		  </div>

		  <div class="form-group">
		    <label for="EMPLOYEES" class="col-sm-1 control-label">Employees</label>
		    <input type="text" id="EMPLOYEES" class="col-sm-2" name="EMPLOYEES" value="<?php echo $record["EMPLOYEES"]; ?>" />
		  </div>

			<div class="form-group">
		    <label for="INDUSTRY" class="col-sm-1 control-label">Industry</label>
		    <input type="text" id="INDUSTRY" class="col-sm-2" name="INDUSTRY" value="<?php echo $record["INDUSTRY"]; ?>" />
		  </div>

			<div class="form-group">
		    <label for="FOUNDED" class="col-sm-1 control-label">Founded</label>
		    <input type="text" id="FOUNDED" class="col-sm-2" name="FOUNDED" value="<?php echo $record["FOUNDED"]; ?>" />
		  </div>

			<div class="form-group">
		    <label for="URL" class="col-sm-1 control-label">URL</label>
		    <input type="text" id="URL" name="URL" class="col-sm-2" value="<?php echo $record["URL"]; ?>" />
		  </div>

		  <div class="form-group">
		    <button type="submit" class="btn btn-default .col-xs-1" name="submitted" value="submitted">Submit</button>
		    <button type="reset" class="btn btn-default .col-xs-1" name="reset">Cancel</button>
		  </div>

		  <div class="clr">
		    <input type="hidden" value="<?php echo ($record["ID"]) ? $record["ID"]: "0"; ?>" name="id" />
		  </div>
		</fieldset>
	</form>

<br />


	<?php
}

?>
