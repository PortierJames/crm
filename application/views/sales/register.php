<div id='TB_load'><img src='<?php echo base_url()?>images/loading_animation.gif'/></div>
<?php if($this->sale_lib->get_change_sale_id()) { ?>
	<div id="editing_sale" > <?php echo lang('sales_editing_sale'); ?> <b> POS <?php echo $this->sale_lib->get_change_sale_id(); ?> </b> </div>
<?php } ?>
<table>
	<tr>
		<td id="register_items_container">
			<table id="title_section">
				<tr>
					<td id="title_icon">
						<img src='<?php echo base_url()?>images/menubar/sales.png' alt='title icon' />
					</td>
					<td id="title">
						<?php echo lang('sales_register'); ?>
					</td>
					<td id="register_wrapper">
						<?php echo form_open("sales/change_mode",array('id'=>'mode_form')); ?>
						<span><?php echo lang('sales_mode') ?></span>
						<?php echo form_dropdown('mode',$modes,$mode,'id="mode"'); ?>
						</form>
					</td>
					<td id="show_suspended_sales_button">
						<?php echo anchor("sales/suspended/width~600",
						"<div class='small_button'>".lang('sales_suspended_sales')."</div>",
						array('class'=>'thickbox none','title'=>lang('sales_suspended_sales')));
						?>
					</td>
				</tr>
			</table>
			<div id="reg_item_search">
				<?php echo form_open("sales/add",array('id'=>'add_item_form')); ?>
					<?php echo form_input(array('name'=>'item','id'=>'item','size'=>'40', 'accesskey' => 'i'));?>
					<div id="new_item_button_register" >
						<?php echo anchor("items/view/-1/width~550",
						"<div class='small_button'><span>".lang('sales_new_item')."</span></div>",
						array('class'=>'thickbox none','title'=>lang('sales_new_item')));?>
					</div>					
				</form>
			</div>
			<div id="register_holder">
			<table id="register">
				
				<thead>
					<tr>
						<th id="reg_item_del"></th>
						<th id="reg_item_name"><?php echo lang('sales_item_name'); ?></th>
						<th id="reg_item_number"><?php echo lang('sales_item_number'); ?></th>
						<th id="reg_item_stock"><?php echo lang('sales_stock'); ?></th>
						<th id="reg_item_price"><?php echo lang('sales_price'); ?></th>
						<th id="reg_item_qty"><?php echo lang('sales_quantity'); ?></th>
						<th id="reg_item_discount"><?php echo lang('sales_discount'); ?></th>
						<th id="reg_item_total"><?php echo lang('sales_total'); ?></th>
					</tr>
				</thead>
				<tbody id="cart_contents">
					<?php if(count($cart)==0)	{ ?>
					<tr>
						<td colspan='8' style="height:60px;border:none;">
								<div class='warning_message' style='padding:7px;'><?php echo lang('sales_no_items_in_cart'); ?></div>
						</td>
					</tr>
					<?php	}
					else	{
					foreach(array_reverse($cart, true) as $line=>$item)		{
						$cur_item_info = isset($item['item_id']) ? $this->Item->get_info($item['item_id']) : $this->Item_kit->get_info($item['item_kit_id']);
						?>
							<tr>
								<td colspan='8'>
								<?php
									echo form_open("sales/edit_item/$line", array('class' => 'line_item_form')); 	?>
							
									<table>
							
											<tr id="reg_item_top">
												<td id="reg_item_del" ><?php echo anchor("sales/delete_item/$line",lang('common_delete'), array('class' => 'delete_item'));?></td>
												<td id="reg_item_name"><?php echo $item['name']; ?></td>
												<td id="reg_item_number"><?php echo isset($item['item_id']) ? $item['item_number'] : $item['item_kit_number']; ?></td>
												<td id="reg_item_stock" ><?php echo property_exists($cur_item_info, 'quantity') ? to_quantity($cur_item_info->quantity) : ''; ?></td>
												
												<?php if ($this->Employee->has_module_action_permission('sales', 'edit_sale_price', $this->Employee->get_logged_in_employee_info()->person_id)){ ?>
												<td id="reg_item_price"><?php echo form_input(array('name'=>'price','value'=>$item['price'],'size'=>'6', 'id' => 'price_'.$line));?></td>
												<?php }else{ ?>
												<td id="reg_item_price"><?php echo $item['price']; ?></td>
												<?php echo form_hidden('price',$item['price']); ?>
												<?php }	?>
												
												<td id="reg_item_qty">
												<?php if(isset($item['is_serialized']) && $item['is_serialized']==1){
													echo to_quantity($item['quantity']);
													echo form_hidden('quantity',to_quantity($item['quantity']));
													}else{
													echo form_input(array('name'=>'quantity','value'=>to_quantity($item['quantity']),'size'=>'2', 'id' => 'quantity_'.$line));
													}?>
												</td>
												
													<?php if ($this->Employee->has_module_action_permission('sales', 'give_discount', $this->Employee->get_logged_in_employee_info()->person_id)){ ?>
												<td id="reg_item_discount"><?php echo form_input(array('name'=>'discount','value'=>$item['discount'],'size'=>'6', 'id' => 'discount_'.$line));?></td>
												<?php }else{ ?>
												<td id="reg_item_discount"><?php echo $item['discount']; ?></td>
												<?php echo form_hidden('discount',$item['discount']); ?>
												<?php }	?>
												
								
												<td id="reg_item_total"><?php echo to_currency($item['price']*$item['quantity']-$item['price']*$item['quantity']*$item['discount']/100); ?></td>
											</tr>
						
											<tr id="reg_item_bottom">
												<td id="reg_item_descrip_label"><?php echo lang('sales_description_abbrv').':';?></td>
												<td id="reg_item_descrip" colspan="4">
													<?php if(isset($item['allow_alt_description']) && $item['allow_alt_description']==1){
														echo form_input(array('name'=>'description','value'=>$item['description'],'size'=>'20', 'id' => 'description_'.$line));
													}else{
														if ($item['description']!=''){
															echo $item['description'];
															echo form_hidden('description',$item['description']);
														}else{
															echo 'None';
															echo form_hidden('description','');
														}
													}?>
												</td>
												<td id="reg_item_serial_label">
													<?php if(isset($item['is_serialized']) && $item['is_serialized']==1  && $item['name']!=lang('sales_giftcard')){
														echo lang('sales_serial').':';
													}?>
												</td>
												<td id="reg_item_serial" colspan="2">
													<?php if(isset($item['is_serialized']) && $item['is_serialized']==1  && $item['name']!=lang('sales_giftcard'))	{
														echo form_input(array('name'=>'serialnumber','value'=>$item['serialnumber'],'size'=>'20', 'id' => 'serialnumber_'.$line));
													}else{
														echo form_hidden('serialnumber', '');
													}?>
												</td>
											</tr>
									</table>
								</form>
							  </td>
							</tr>
						<?php
						}
					}?>
					</tbody>
				</table>
			</div>
			
			<div id="reg_item_base"></div>
			<?php if ($this->config->item('track_cash')) { ?>
			<div>
				<?php echo anchor(site_url('sales/closeregister?continue=home'), lang('sales_close_register')); ?>
			</div>
			<?php } ?>
			<?php if ($this->Employee->has_module_permission('giftcards', $this->Employee->get_logged_in_employee_info()->person_id)) {?>				
			
			<div id="new_giftcard_button_register" >
			
						<?php echo 
					anchor("sales/new_giftcard/width~550",
					lang('sales_new_giftcard'),
					array('class'=>'thickbox none new', 
						'title'=>lang('sales_new_giftcard')));
				?> 
					</div>	
					<?php } ?>
			<div id="sales_search" >
			
						<?php echo 
					anchor("reports/sales_generator",
					lang('sales_search_reports'),
					array('class'=>'none', 
						'title'=>lang('sales_search_reports')));
				?> 
					</div>	
		</td>
		<td style="width:8px;"></td>
		<td id="over_all_sale_container">
			<div id="overall_sale">
				
				<div id="suspend_cancel">
					<div id="suspend" <?php if(count($cart) > 0){ echo "style='visibility: visible;'";}?>>				
						<?php
						// Only show this part if there are Items already in the sale.
						if(count($cart) > 0){ ?>
								<div class='small_button' id='suspend_sale_button'> 
									<span><?php echo lang('sales_suspend_sale');?></span>
								</div>
						<?php }	?>
					</div>
					<div id="cancel" <?php if(count($cart) > 0){  echo "style='visibility: visible;'";}?>>											
						<?php
						// Only show this part if there are Items already in the sale.
						if(count($cart) > 0){ ?>
							<?php echo form_open("sales/cancel_sale",array('id'=>'cancel_sale_form')); ?>
								<div class='small_button' id='cancel_sale_button'>
									<span><?php echo lang('sales_cancel_sale'); ?></span>
								</div>
							</form>
						<?php } ?>
					</div>
				</div>
			
				<div id="customer_info_shell">
					<?php
					if(isset($customer))
					{
						echo "<div id='customer_info_filled'>";
							echo '<div id="customer_name">'.character_limiter($customer, 25).'</div>';
							echo '<div id="customer_email"></div>';
							echo '<div id="customer_edit">'.anchor("customers/view/$customer_id/width~550", lang('common_edit'),  array('class'=>'thickbox none','title'=>lang('customers_update'))).'</div>';
							echo '<div id="customer_remove">'.anchor("sales/delete_customer", lang('sales_detach'),array('id' => 'delete_customer')).'</div>';
						echo "</div>";
					}
					else
					{ ?>
						<div id='customer_info_empty'>
							<?php echo form_open("sales/select_customer",array('id'=>'select_customer_form')); ?>
							<label id="customer_label" for="customer">
								<?php echo lang('sales_select_customer'); ?>
							</label>
							<?php echo form_input(array('name'=>'customer','id'=>'customer','size'=>'30','value'=>lang('sales_start_typing_customer_name'),  'accesskey' => 'c'));?>
							</form>
							<div id="add_customer_info">
								<div id="common_or">
									<?php echo lang('common_or'); ?>
								</div>
								<?php 
									echo anchor("customers/view/-1/width~550",
									"<div class='small_button' style='margin:0 auto;'> <span>".lang('sales_new_customer')."</span> </div>", array('class'=>'thickbox none','title'=>lang('sales_new_customer')));
								?>
							</div>
							<div class="clearfix">&nbsp;</div>
						</div>
					<?php } ?>
				</div>
				
				<div id='sale_details'>
					<table id="sales_items">
						<tr>
							<td class="left"><?php echo lang('sales_items_in_cart'); ?>:</td>
							<td class="right"><?php echo $items_in_cart; ?></td>
						</tr>
						<?php foreach($payments as $payment) {?>
							<?php if (strpos($payment['payment_type'], lang('sales_giftcard'))!== FALSE) {?>
						<tr>
							<td class="left"><?php echo $payment['payment_type']. ' '.lang('sales_balance') ?>:</td>
							<td class="right"><?php echo to_currency($this->Giftcard->get_giftcard_value(end(explode(':', $payment['payment_type']))) - $payment['payment_amount']);?></td>
						</tr>
							<?php }?>
						<?php }?>
						<tr>
							<td class="left"><?php echo lang('sales_sub_total'); ?>:</td>
							<td class="right"><?php echo to_currency($subtotal); ?></td>
						</tr>
						<?php foreach($taxes as $name=>$value) { ?>
						<tr>
							<td class="left"><?php echo $name; ?>:</td>
							<td class="right"><?php echo to_currency($value); ?></td>
						</tr>
						<?php }; ?>
					</table>
					<table id="sales_items_total">
						<tr>
							<td class="left"><?php echo lang('sales_total'); ?>:</td>
							<td class="right"><?php echo to_currency($total); ?></td>
						</tr>
					</table>
				</div>
				
				<?php
				// Only show this part if there are Items already in the sale.
				if(count($cart) > 0){ ?>

					<div id="Payment_Types">
				
						<?php
						// Only show this part if there is at least one payment entered.
						if(count($payments) > 0)
						{
						?>
							<table id="register">
							<thead>
							<tr>
							<th id="pt_delete"></th>
							<th id="pt_type"><?php echo lang('sales_type'); ?></th>
							<th id="pt_amount"><?php echo lang('sales_amount'); ?></th>
				
				
							</tr>
							</thead>
							<tbody id="payment_contents">
							<?php
								foreach($payments as $payment_id=>$payment)
								{
								?>
								<tr>
								<td id="pt_delete"><?php echo anchor("sales/delete_payment/$payment_id",'['.lang('common_delete').']', array('class' => 'delete_payment'));?></td>
								<td id="pt_type"><?php echo $payment['payment_type']; ?> </td>
								<td id="pt_amount"><?php echo  to_currency($payment['payment_amount']); ?>  </td>
								</tr>
								<?php
								}
								?>
							</tbody>
							</table>
						<?php } ?>

						<table id="amount_due">
						<tr class="<?php if($payments_cover_total){ echo 'covered'; }?>">
							<td>
								<div class="float_left" style="font-size:.8em;"><?php echo lang('sales_amount_due'); ?>:</div>
							</td>
							<td style="text-align:right; ">
								<div class="float_left" style="text-align:right;font-weight:bold;"><?php echo to_currency($amount_due); ?></div>
							</td>
						</tr>
					</table>

						<div id="make_payment">
							<?php echo form_open("sales/add_payment",array('id'=>'add_payment_form')); ?>
							<table id="make_payment_table">
								<tr id="mpt_top">
									<td id="add_payment_text">
										<?php echo lang('sales_add_payment'); ?>:
									</td>
									<td>
										<?php echo form_dropdown('payment_type',$payment_options,$this->config->item('default_payment_type'), 'id="payment_types"');?>
									</td>
								</tr>
								<tr id="mpt_bottom">
									<td id="tender" colspan="2">
										<?php echo form_input(array('name'=>'amount_tendered','id'=>'amount_tendered','value'=>to_currency_no_money($amount_due),'size'=>'10', 'accesskey' => 'p'));	?>
									</td>
								</tr>
							</table>
							<div class='small_button' id='add_payment_button'>
								<span><?php echo lang('sales_add_payment'); ?></span>
							</div>
							</form>
						</div>
					</div>

					<?php
					if(!empty($customer_email))
					{
						echo '<div id="email_customer">';
						echo form_checkbox(array(
							'name'        => 'email_receipt',
							'id'          => 'email_receipt',
							'value'       => '1',
							'checked'     => (boolean)$email_receipt,
							)).' '.lang('sales_email_receipt').': <br /><b style="font-size:1.1em; padding-left: 17px;">'.character_limiter($customer_email, 25).'</b><br />';
						echo '</div>';
					}
					echo '<label id="comment_label" for="comment">';
							echo lang('common_comments');
							echo ':</label><br />';
							echo form_textarea(array('name'=>'comment', 'id' => 'comment', 'value'=>$comment,'rows'=>'1',  'accesskey' => 'o'));
							echo '<br />';
							echo '<label id="comment_label" for="show_comment_on_receipt">';
							echo lang('sales_comments_receipt');
							echo ':</label>  ';
							echo form_checkbox(array(
								'name'=>'show_comment_on_receipt',
								'id'=>'show_comment_on_receipt',
								'value'=>'1',
								'checked'=>(boolean)$show_comment_on_receipt)
							);
								
					// Only show this part if there is at least one payment entered.
					if((count($payments) > 0 && !is_sale_integrated_cc_processing()) || ($this->sale_lib->get_change_sale_id() && count($payments) > 0)){?>
						<div id="finish_sale">
							<?php echo form_open("sales/complete",array('id'=>'finish_sale_form')); ?>
							<?php							 
							if ($payments_cover_total)
							{
								echo "<div class='small_button' id='finish_sale_button' style='float:left;margin-top:5px;'><span>".lang('sales_complete_sale')."</span></div>";
							}
							?>
						</div>
					</form>
					<?php }elseif(count($payments) > 0)	{?>
						<div id="finish_sale">
							<?php echo form_open("sales/start_cc_processing",array('id'=>'finish_sale_form')); ?>
							<?php							 
							if ($payments_cover_total)
							{
								echo "<div class='small_button' id='finish_sale_button' style='float:left;margin-top:5px;'><span>".lang('sales_process_credit_card')."</span></div>";
								
								if (is_sale_integrated_cc_processing())
								{
									if (isset($customer) && $customer_cc_token && $customer_cc_preview)
									{
										echo '<label id="sales_use_saved_cc_label" for="use_saved_cc_info">';
										echo lang('sales_use_saved_cc_info'). ' '.$customer_cc_preview;
										echo ':</label>  ';
										echo form_checkbox(array(
											'name'=>'use_saved_cc_info',
											'id'=>'use_saved_cc_info',
											'value'=>'1',
											'checked'=>(boolean)$use_saved_cc_info)
										);
									}
									elseif(isset($customer))
									{
										echo '<label id="sales_save_credit_card_label" for="save_credit_card_info">';
										echo lang('sales_save_credit_card_info');
										echo ':</label>  ';
										echo form_checkbox(array(
											'name'=>'save_credit_card_info',
											'id'=>'save_credit_card_info',
											'value'=>'1',
											'checked'=>(boolean)$save_credit_card_info)
										);
									}
								}
							}
							?>
						</div>
					</form>
					<?php }
					 ?>
						<?php
						if($this->sale_lib->get_change_sale_id()) {
						echo '<br />';
						echo '<label id="comment_label" for="show_comment_on_receipt">';
						echo lang('sales_change_date');
						echo ':</label>  ';
						echo form_checkbox(array(
							'name'=>'change_sale_date_enable',
							'id'=>'change_sale_date_enable',
							'value'=>'1',
							'checked'=>(boolean)$change_sale_date_enable)
						);
						?>
						<div class="field_row clearfix" id="change_sale_input">
							<div class='form_field'>
								<?php echo form_input(array('name'=>'change_sale_date','value'=> (isset($change_sale_date) && $change_sale_date) ?  $change_sale_date : date(get_date_format()), 'id'=>'change_sale_date'));?>
							</div>
						</div>
				<?php 
					}
				 } ?>
			</div><!-- END OVERALL-->		
		</td>
	</tr>
</table>

<div id="feedback_bar"></div>

<script type="text/javascript">
<?php
if(isset($error))
{
	echo "set_feedback(".json_encode($error).",'error_message',false);";
}

if (isset($warning))
{
	echo "set_feedback(".json_encode($warning).",'warning_message',false);";
}

if (isset($success))
{
	echo "set_feedback(".json_encode($success).",'success_message',false);";
}
?>
</script>

<script type="text/javascript" language="javascript">
$(document).ready(function()
{
	var my_ar = new Array ("reg_item_total","reg_item_discount", "reg_item_qty", "reg_item_price", "reg_item_stock", "reg_item_number", "reg_item_name", "reg_item_del");
	for (i=0; i < my_ar.length; i++ ) 
	{
		my_th = $("th#" + my_ar[i]);
		my_td = $("td#" + my_ar[i]);
		my_td.each(function (i)
		{
			$(this).width(my_th.width());
		}); 
	}

 	$('a.thickbox, area.thickbox, input.thickbox').each(function(i) 
	{
		$(this).unbind('click');
    });

	tb_init('a.thickbox, area.thickbox, input.thickbox');
		
	$('#add_item_form, #mode_form, #select_customer_form, #add_payment_form').ajaxForm({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: salesSuccess});
	
	$("#cart_contents input").change(function()
	{
		var toFocusId = $(":input[type!=hidden]:eq("+($(":input[type!=hidden]").index(this) + 1) +")").attr('id');
		$(this.form).ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: function()
		{
			salesSuccess();
			setTimeout(function(){$('#item').focus();}, 10);
		}
		});
	});
	
	$( "#item" ).autocomplete({
		source: '<?php echo site_url("sales/item_search"); ?>',
		delay: 10,
		autoFocus: false,
		minLength: 0,
		select: function(event, ui)
		{
 			event.preventDefault();
 			$( "#item" ).val(ui.item.value);
			$('#add_item_form').ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: salesSuccess});
		},
		change: function(event, ui)
		{
			if ($(this).attr('value') != '' && $(this).attr('value') != <?php echo json_encode(lang('sales_start_typing_item_name')); ?>)
			{
				$("#add_item_form").ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: salesSuccess});
			}
	
    		$(this).attr('value',<?php echo json_encode(lang('sales_start_typing_item_name')); ?>);
		}
	});
	
	setTimeout(function(){$('#item').focus();}, 10);
	
	$('#item,#customer').click(function()
    {
    	$(this).attr('value','');
    });

	$( "#customer" ).autocomplete({
		source: '<?php echo site_url("sales/customer_search"); ?>',
		delay: 10,
		autoFocus: false,
		minLength: 0,
		select: function(event, ui)
		{
			$("#customer").val(ui.item.value);
			$('#select_customer_form').ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: salesSuccess});
		}
	});

    $('#customer').blur(function()
    {
    	$(this).attr('value',<?php echo json_encode(lang('sales_start_typing_customer_name')); ?>);
    });
	
	$('#change_sale_date').datePicker({startDate: '<?php echo get_js_start_of_time_date(); ?>'});
	$('#change_sale_date').change(function() 
	{
		$.post('<?php echo site_url("sales/set_change_sale_date");?>', {change_sale_date: $('#change_sale_date').val()});
	});
	
	$('#change_sale_date_enable').change(function() 
	{
		$.post('<?php echo site_url("sales/set_change_sale_date_enable");?>', {change_sale_date_enable: $('#change_sale_date_enable').is(':checked') ? '1' : '0'});
	});

	$('#comment').change(function() 
	{
		$.post('<?php echo site_url("sales/set_comment");?>', {comment: $('#comment').val()});
	});
	$('#show_comment_on_receipt').change(function() 
	{
		$.post('<?php echo site_url("sales/set_comment_on_receipt");?>', {show_comment_on_receipt:$('#show_comment_on_receipt').is(':checked') ? '1' : '0'});
	});
	
	$('#email_receipt').change(function() 
	{	
		$.post('<?php echo site_url("sales/set_email_receipt");?>', {email_receipt: $('#email_receipt').is(':checked') ? '1' : '0'});
	});
	
	$('#save_credit_card_info').change(function() 
	{
		$.post('<?php echo site_url("sales/set_save_credit_card_info");?>', {save_credit_card_info:$('#save_credit_card_info').is(':checked') ? '1' : '0'});
	});
	
	$('#change_sale_date_enable').is(':checked') ? $("#change_sale_input").show() : $("#change_sale_input").hide(); 
	
	$('#change_sale_date_enable').click(function() {
	    if( $(this).is(':checked')) {
	        $("#change_sale_input").show();
	    } else {
	        $("#change_sale_input").hide();
	    }
	});
	
	$('#use_saved_cc_info').change(function() 
	{
		$.post('<?php echo site_url("sales/set_use_saved_cc_info");?>', {use_saved_cc_info:$('#use_saved_cc_info').is(':checked') ? '1' : '0'});
	});
	
    $("#finish_sale_button").click(function()
    {
    	<?php if (!$this->config->item('disable_confirmation_sale')) { ?>
		if (confirm(<?php echo json_encode(lang("sales_confirm_finish_sale")); ?>))
    	{
		<?php } ?>
    		$('#finish_sale_form').submit();
			<?php if (!$this->config->item('disable_confirmation_sale')) { ?>
					}
		<?php } ?>
    });

	$("#suspend_sale_button").click(function()
	{
		if (confirm(<?php echo json_encode(lang("sales_confirm_suspend_sale")); ?>))
    	{
			$("#register_container").load('<?php echo site_url("sales/suspend"); ?>');
    	}
	});

    $("#cancel_sale_button").click(function()
    {
    	if (confirm(<?php echo json_encode(lang("sales_confirm_cancel_sale")); ?>))
    	{
			$('#cancel_sale_form').ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: salesSuccess});
    	}
    });

	$("#add_payment_button").click(function()
	{
		$('#add_payment_form').ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: salesSuccess});
    });

	$("#payment_types").change(checkPaymentTypeGiftcard).ready(checkPaymentTypeGiftcard);
	$('#mode').change(function()
	{
		$('#mode_form').ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: salesSuccess});
	});
	
	$('.delete_item, .delete_payment, #delete_customer').click(function(event)
	{
		event.preventDefault();
		$("#register_container").load($(this).attr('href'));	
	});
});

function post_item_form_submit(response)
{
	if(response.success)
	{
		$("#item").attr("value",response.item_id);
		$('#add_item_form').ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: salesSuccess});
		
	}
}

function post_giftcard_form_submit(response)
{
	if(response.success)
	{
		$("#item").attr("value",response.item_id);
		$('#add_item_form').ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: salesSuccess});
		
	}
}

function post_person_form_submit(response)
{
	if(response.success)
	{
		if ($("#select_customer_form").length == 1)
		{
			$("#customer").attr("value",response.person_id);
			$('#select_customer_form').ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: salesSuccess});
		}
		else
		{
			$("#register_container").load('<?php echo site_url("sales/reload"); ?>');
		}
	}
}

function checkPaymentTypeGiftcard()
{
	if ($("#payment_types").val() == <?php echo json_encode(lang('sales_giftcard')); ?>)
	{
		$("#amount_tendered_label").html(<?php echo json_encode(lang('sales_giftcard_number')); ?>);
		$("#amount_tendered").val('');
		$("#amount_tendered").focus();
	}
	else
	{
		$("#amount_tendered_label").html(<?php echo json_encode(lang('sales_amount_tendered')); ?>);		
	}
}

function salesBeforeSubmit(formData, jqForm, options)
{
	$("#add_payment_button").hide();
	$("#finish_sale_button").hide();
	$("#TB_load").show();
}

function salesSuccess(responseText, statusText, xhr, $form)
{
}

</script>