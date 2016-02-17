<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" rev="stylesheet" href="<?php echo base_url();?>css/login.css?<?php echo APPLICATION_VERSION; ?>" />
<title>PHP Point Of Sale <?php echo lang('login_login'); ?></title>
<script src="<?php echo base_url();?>js/jquery-1.5.2.min.js?<?php echo APPLICATION_VERSION; ?>" type="text/javascript" language="javascript" charset="UTF-8"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$("#login_form input:first").focus();
});
</script>
</head>
<body>

	<div id="welcome_message" class="top_message">
		<?php echo lang('login_welcome_message'); ?>
		<?php if (isset($subscription_cancelled_within_30_days) && $subscription_cancelled_within_30_days === true) { ?>
			<div class="top_message_error"><?php echo lang('login_subscription_cancelled_within_30_days'); ?></div>
		<?php } ?>
		<?php
		if ($_SERVER['HTTP_HOST'] == 'demo.phppointofsale.com' || $_SERVER['HTTP_HOST'] == 'demo.phppointofsalestaging.com')
		{
		?>
			<h2>Press login to continue</h2>
		<?php
		}
		?>
	</div>
	<?php if ($application_mismatch) {?>
		<div id="welcome_message" class="top_message_error">
			<?php echo $application_mismatch; ?>
		</div>
	<?php } ?>
	<?php if (validation_errors()) {?>
		<div id="welcome_message" class="top_message_error">
			<?php echo validation_errors(); ?>
		</div>
	<?php } ?>
<?php echo form_open('login') ?>
<div id="container">
	<div id="top">
		<?php echo img(array('src' => $this->Appconfig->get_logo_image()));?>
	</div>
	<table id="login_form">
	
		<tr id="form_field_username">	
			<td class="form_field_label"><?php echo lang('login_username'); ?>: </td>
			<td class="form_field">
			<?php echo form_input(array(
			'name'=>'username', 
			'value'=> $_SERVER['HTTP_HOST'] == 'demo.phppointofsale.com' || $_SERVER['HTTP_HOST'] == 'demo.phppointofsalestaging.com' ? 'admin' : '',
			'size'=>'20')); ?>
			</td>
		</tr>
	
		<tr id="form_field_password">	
			<td class="form_field_label"><?php echo lang('login_password'); ?>: </td>
			<td class="form_field">
			<?php echo form_password(array(
			'name'=>'password', 
			'value'=>$_SERVER['HTTP_HOST'] == 'demo.phppointofsale.com' || $_SERVER['HTTP_HOST'] == 'demo.phppointofsalestaging.com' ? 'pointofsale' : '',
			'size'=>'20')); ?>
			</td>
		</tr>
		
		<tr id="form_field_submit">	
			<td id="submit_button" colspan="2">
				<?php echo form_submit('login_button',lang('login_login')); ?>
			</td>
		</tr>
	</table>
	<table id="bottom">
		<tr>
			<td id="left">
				<?php echo anchor('login/reset_password', lang('login_reset_password')); ?> 
			</td>
			<td id="right">
				<?php echo date("Y")?> <?php echo lang('login_version'); ?> <?php echo APPLICATION_VERSION; ?>
			</td>
		</tr>
	</table>
</div>
<?php echo form_close(); ?>
</body>
</html>