<table id="contents" style="width: 500px;">
	<tr>
		<td id="item_table">
			<table  id="suspended_sales_table">
				<tr>
					<th><?php echo lang('sales_suspended_sale_id'); ?></th>
					<th><?php echo lang('sales_date'); ?></th>
					<th><?php echo lang('sales_customer'); ?></th>
					<th><?php echo lang('sales_comments'); ?></th>
					<th><?php echo lang('sales_unsuspend'); ?></th>
					<th><?php echo lang('sales_receipt'); ?></th>
					<th><?php echo lang('common_delete'); ?></th>
				</tr>
				
				<?php
				foreach ($suspended_sales as $suspended_sale)
				{
				?>
					<tr>
						<td><?php echo $suspended_sale['sale_id'];?></td>
						<td><?php echo date(get_date_format(),strtotime($suspended_sale['sale_time']));?></td>
						<td>
							<?php
							if (isset($suspended_sale['customer_id']))
							{
								$customer = $this->Customer->get_info($suspended_sale['customer_id']);
								echo $customer->first_name. ' '. $customer->last_name;
							}
							else
							{
							?>
								&nbsp;
							<?php
							}
							?>
						</td>
						<td><?php echo $suspended_sale['comment'];?></td>
						<td>
							<?php 
							echo form_open('sales/unsuspend');
							echo form_hidden('suspended_sale_id', $suspended_sale['sale_id']);
							?>
							<input type="submit" name="submit" value="<?php echo lang('sales_unsuspend'); ?>" id="submit_unsuspend" class="submit_button float_right">
							</form>
						</td>
						<td>
							<?php 
							echo form_open('sales/receipt/'.$suspended_sale['sale_id'], array('method'=>'get', 'id' => 'form_receipt_suspended_sale'));
							?>
							<input type="submit" name="submit" value="<?php echo lang('sales_recp'); ?>" id="submit_receipt" class="submit_button float_right">
							</form>
						</td>
						<td>
							<?php 
							echo form_open('sales/delete_suspended_sale', array('id' => 'form_delete_suspended_sale'));
							echo form_hidden('suspended_sale_id', $suspended_sale['sale_id']);
							?>
							<input type="submit" name="submit" value="<?php echo lang('common_delete'); ?>" id="submit_delete" class="submit_button float_right">
							</form>
						</td>
					</tr>
				<?php
				}
				?>
			</table>
		</td>
	</tr>
</table>

<script type="text/javascript">
$(document).ready(function()
{
	$("#form_delete_suspended_sale").submit(function()
	{
		if (!confirm(<?php echo json_encode(lang("sales_delete_confirmation")); ?>))
		{
			return false;
		}
	});
});
</script>