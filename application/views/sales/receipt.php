<?php $this->load->view("partial/header"); ?>
<?php
$is_integrated_credit_sale = false;
if (isset($error_message))
{
	echo '<h1 style="text-align: center;">'.$error_message.'</h1>';
	exit;
}
?>
<div id="receipt_wrapper">
	<div id="receipt_header">
	
		<div id="company_name"><?php echo $this->config->item('company'); ?></div>
		<?php if($this->config->item('company_logo')) {?>
		<div id="company_logo"><?php echo img(array('src' => $this->Appconfig->get_logo_image())); ?></div>
		<?php } ?>
		<div id="company_address"><?php echo nl2br($this->config->item('address')); ?></div>
		<div id="company_phone"><?php echo $this->config->item('phone'); ?></div>
		<?php if($this->config->item('website')) { ?>
			<div id="website"><?php echo $this->config->item('website'); ?></div>
		<?php } ?>
		<div id="sale_receipt"><?php echo $receipt_title; ?></div>
		<div id="sale_time"><?php echo $transaction_time ?></div>
	</div>
	<div id="receipt_general_info">
		<?php if(isset($customer))
		{
		?>
			<div id="customer"><?php echo lang('customers_customer').": ".$customer; ?></div>
		<?php
		}
		?>
		<div id="sale_id"><?php echo lang('sales_id').": ".$sale_id; ?></div>
		<div id="employee"><?php echo lang('employees_employee').": ".$employee; ?></div>
	</div>
	<?php
	foreach(array_reverse($cart, true) as $line=>$item)
	{
		$discount_exists=false;
		if($item['discount']>0)
		{
			$discount_exists=true;
		}
	  
	}
	?>
	<table id="receipt_items">
	<tr>
	<th style="width:<?php echo $discount_exists ? "33%" : "49%"; ?>;text-align:center;"><?php echo lang('items_item'); ?></th>
	<th style="width:20%;text-align:center;"><?php echo lang('common_price'); ?></th>
	<th style="width:15%;text-align:center;"><?php echo lang('sales_quantity'); ?></th>
	<?php if($discount_exists) 
    {
	?>
	<th style="width:16%;text-align:center;"><?php echo lang('sales_discount'); ?></th>
	<?php
	}
	?>
	<th style="width:16%;text-align:right;"><?php echo lang('sales_total'); ?></th>
	</tr>
	<?php
	foreach(array_reverse($cart, true) as $line=>$item)
	{
	?>
		<tr>
		<td style="text-align:center;"><span class='long_name'><?php echo $item['name']; ?></span><span class='short_name'><?php echo $item['name']; ?></span></td>
		<td style="text-align:center;"><?php echo to_currency($item['price']); ?></td>
		<td style='text-align:center;'><?php echo to_quantity($item['quantity']); ?></td>
		<?php if($discount_exists) 
		{
		?>
		<td style='text-align:center;'><?php echo $item['discount']; ?></td>
		<?php
		}
		?>
		<td style='text-align:right;'><?php echo to_currency($item['price']*$item['quantity']-$item['price']*$item['quantity']*$item['discount']/100); ?></td>
		</tr>

	    <tr>
	    <td colspan="2" align="center"><?php echo $item['description']; ?></td>
		<td colspan="2" ><?php echo isset($item['serialnumber']) ? $item['serialnumber'] : ''; ?></td>
		<td colspan="2"><?php echo '&nbsp;'; ?></td>
	    </tr>

	<?php
	}
	?>
	<tr>
	<td colspan="4" style='text-align:right;border-top:2px solid #000000;'><?php echo lang('sales_sub_total'); ?></td>
	<td colspan="2" style='text-align:right;border-top:2px solid #000000;'><?php echo to_currency($subtotal); ?></td>
	</tr>

	<?php foreach($taxes as $name=>$value) { ?>
		<tr>
			<td colspan="4" style='text-align:right;'><?php echo $name; ?>:</td>
			<td colspan="2" style='text-align:right;'><?php echo to_currency($value); ?></td>
		</tr>
	<?php }; ?>

	<tr>
	<td colspan="4" style='text-align:right;'><?php echo lang('sales_total'); ?></td>
	<td colspan="2" style='text-align:right'><?php echo $this->config->item('round_cash_on_sales') ?  to_currency(round_to_nearest_05($total)) : to_currency($total); ?></td>
	</tr>

    <tr><td colspan="6">&nbsp;</td></tr>

	<?php
		foreach($payments as $payment_id=>$payment)
	{ ?>
		<tr>
		<td colspan="2" style="text-align:right;"><?php echo (isset($show_payment_times) && $show_payment_times) ?  date(get_date_format().' '.get_time_format(), strtotime($payment['payment_date'])) : lang('sales_payment'); ?></td>
		<td colspan="2" style="text-align:right;"><?php $splitpayment=explode(':',$payment['payment_type']); echo $splitpayment[0]; ?> </td>
		<td colspan="2" style="text-align:right"><?php echo $this->config->item('round_cash_on_sales') ?  to_currency(round_to_nearest_05($payment['payment_amount'])) : to_currency($payment['payment_amount']); ?>  </td>
	    </tr>
	<?php
	}
	?>	
    <tr><td colspan="6">&nbsp;</td></tr>

	<?php foreach($payments as $payment) {?>
		<?php if (strpos($payment['payment_type'], lang('sales_giftcard'))!== FALSE) {?>
	<tr>
		<td colspan="2" style="text-align:right;"><?php echo lang('sales_giftcard_balance'); ?></td>
		<td colspan="2" style="text-align:right;"><?php echo $payment['payment_type'];?> </td>
		<td colspan="2" style="text-align:right"><?php echo to_currency($this->Giftcard->get_giftcard_value(end(explode(':', $payment['payment_type'])))); ?></td>
	</tr>
		<?php }?>
	<?php }?>
	
	<?php if ($amount_change >= 0) {?>
	<tr>
		<td colspan="4" style='text-align:right;'><?php echo lang('sales_change_due'); ?></td>
		<td colspan="2" style='text-align:right'><?php echo to_currency($amount_change); ?></td>
	</tr>
	<?php
	}
	else
	{
	?>
	<tr>
		<td colspan="4" style='text-align:right;'><?php echo lang('sales_amount_due'); ?></td>
		<td colspan="2" style='text-align:right'><?php echo to_currency($amount_change * -1); ?></td>
	</tr>	
	<?php
	} 
	if ($ref_no)
	{
	?>
	<tr>
		<td colspan="4" style='text-align:right;'><?php echo lang('sales_ref_no'); ?></td>
		<td colspan="2" style='text-align:right'><?php echo $ref_no; ?></td>
	</tr>	
	<?php
	}
	?>
	<tr>
		<td colspan="6" align="right">
		<?php if($show_comment_on_receipt==1)
			{
				echo $comment ;
			}
		?>
		</td>
	</tr>
	</table>

	<div id="sale_return_policy">
	<?php echo nl2br($this->config->item('return_policy')); ?>
   <br />   

	</div>
	<div id='barcode'>
	<?php echo "<img src='".site_url('barcode')."?barcode=$sale_id&text=$sale_id' />"; ?>
	</div>
	<?php if(!$this->config->item('hide_signature')) { ?>
	
	<div id="signature">
	
	<?php foreach($payments as $payment) {?>
		<?php if (strpos($payment['payment_type'], lang('sales_credit'))!== FALSE and $this->config->item('enable_credit_card_processing')) {?>
			<?php echo lang('sales_signature'); ?> --------------------------------- <br />	
			<?php 
			$is_integrated_credit_sale = $this->config->item('enable_credit_card_processing');
			echo lang('sales_card_statement');
			break;
			?>
	
		<?php }?>
	<?php }?>
	
	</div>
	<?php } ?>
</div>
<div id="feedback_bar"></div>

	<?php 
	 if ($this->Employee->has_module_action_permission('sales', 'edit_sale', $this->Employee->get_logged_in_employee_info()->person_id)){

		$pieces = explode(' ',$sale_id);

	echo form_open("sales/change_sale/".$pieces[1],array('id'=>'sales_change_form')); ?>
	<button class="submit_button" id="edit_sale" onclick="submit()" > <?php echo lang('sales_edit'); ?> </button>

	<?php }	?>
	</form>
	
<?php if ($this->config->item('print_after_sale'))
{
?>
<script type="text/javascript">
$(window).bind("load", function() {
	window.print();
});
</script>
<?php }  ?>
<button class="submit_button" id="print_button" onclick="print_receipt()" > <?php echo lang('sales_print'); ?> </button>

<?php $this->load->view("partial/footer"); ?>

<script type="text/javascript">
function print_receipt()
 {
 	window.print();
 }
</script>

<?php if($is_integrated_credit_sale && $is_sale) { ?>
<script type="text/javascript">
set_feedback(<?php echo json_encode(lang('sales_credit_card_processing_success'))?>, 'success_message', false);
</script>
<?php } ?>
