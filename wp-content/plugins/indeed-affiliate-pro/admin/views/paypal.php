<form action="" method="post">
	<div class="uap-stuffbox">
		<h3 class="uap-h3"><?php _e('PayPal - Payouts', 'uap');?></h3>
		<div class="inside">
			<?php if ((float)$phpversion>=5.4):?>	
				<div class="row">
						<div class="col-xs-7">
							<h3><?php _e('Activate/Hold PayPal Gateway', 'uap');?></h3>
							<p><?php _e('Once is activated you can proceed payments to your Affiliate users via PayPal directly from Affiliate System', 'uap');?></p>
							<label class="uap_label_shiwtch" style="margin:10px 0 10px -10px;">
							<?php $checked = ($data['metas']['uap_paypal_enable']) ? 'checked' : '';?>
								<input type="checkbox" class="uap-switch" onClick="uap_check_and_h(this, '#uap_paypal_enable');" <?php echo $checked;?> />
								<div class="switch" style="display:inline-block;"></div>
							</label>
							<input type="hidden" name="uap_paypal_enable" value="<?php echo $data['metas']['uap_paypal_enable'];?>" id="uap_paypal_enable" /> 
						</div>
						</div>
				<div class="uap-line-break"></div>		
				<div class="row">
					<div class="col-xs-4">
						<h4><?php _e('Sandbox', 'uap');?></h4>
						<label class="uap_label_shiwtch" style="margin:10px 0 10px -10px;">
						<?php $checked = ($data['metas']['uap_paypal_sandbox']) ? 'checked' : '';?>
						<input type="checkbox" class="uap-switch" onClick="uap_check_and_h(this, '#uap_paypal_sandbox');" <?php echo $checked;?> />
						<div class="switch" style="display:inline-block;"></div>
						</label>
						<input type="hidden" name="uap_paypal_sandbox" value="<?php echo $data['metas']['uap_paypal_sandbox'];?>" id="uap_paypal_sandbox" /> 	
					</div>
				</div>		
				<div class="uap-line-break"></div>		
				<div class="row">
					<div class="col-xs-6">	
						<div class="uap-form-line">
							<label class="uap-label"><?php _e('Sandbox Client ID', 'uap');?></label>
							<input type="text" name="uap_paypal_sandbox_client_id" value="<?php echo $data['metas']['uap_paypal_sandbox_client_id'];?>" />
						</div>
						<div class="uap-form-line">
							<label class="uap-label"><?php _e('Sandbox Client Secret', 'uap');?></label>
							<input type="text" name="uap_paypal_sandbox_client_secret" value="<?php echo $data['metas']['uap_paypal_sandbox_client_secret'];?>" />
						</div>								
						<div class="uap-form-line">
							<label class="uap-label"><?php _e('Client ID', 'uap');?></label>
							<input type="text" name="uap_paypal_client_id" value="<?php echo $data['metas']['uap_paypal_client_id'];?>" />
						</div>
						<div class="uap-form-line">
							<label class="uap-label"><?php _e('Client Secret', 'uap');?></label>
							<input type="text" name="uap_paypal_client_secret" value="<?php echo $data['metas']['uap_paypal_client_secret'];?>" />
						</div>	
				</div>
				</div>			
				<div class="uap-submit-form"> 
					<input type="submit" value="<?php _e('Save', 'uap');?>" name="save" class="button button-primary button-large" />
				</div>
			<?php else : ?>	
				<div style="color: red;font-weight: bold;">
					<?php echo __("Your current version of PHP is ", 'uap') . $phpversion . __('. To use this feature You need >= PHP 5.4.', 'uap');?>
				</div>
			<?php endif;?>	
		</div>
	</div>
</form>
