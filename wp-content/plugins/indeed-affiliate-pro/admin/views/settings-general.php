<form action="" method="post">
<div class="uap-stuffbox">
	<h3 class="uap-h3"><?php _e('General Settings', 'uap');?></h3>
	<div class="inside">
		<div class="uap-inside-item">
			<div class="row">
				<div class="col-xs-6">
					<h3><?php _e('Redirect', 'uap');?></h3>
					<p><?php _e('Redirect Same Page Without URL parameters:', 'uap');?></p>
					<label class="uap_label_shiwtch" style="margin:10px 0 10px -10px;">
						<?php $checked = ($data['metas']['uap_redirect_without_param']) ? 'checked' : '';?>
						<input type="checkbox" class="uap-switch" onClick="uap_check_and_h(this, '#uap_redirect_without_param');" <?php echo $checked;?> />
						<div class="switch" style="display:inline-block;"></div>
					</label>
					<input type="hidden" name="uap_redirect_without_param" value="<?php echo $data['metas']['uap_redirect_without_param'];?>" id="uap_redirect_without_param" /> 	
				</div>
			</div>
		</div>		
		<div class="uap-line-break"></div>			
		<div class="uap-inside-item">
			<div class="row">
				<div class="col-xs-4">
				<h3><?php _e('Refferal Settings', 'uap');?></h3>
				<br/>
				<p><?php _e('Set the referral Variable name', 'uap');?></p>		
					<div class="form-group">
						<input type="text" class="form-control" value="<?php echo $data['metas']['uap_referral_variable'];?>" name="uap_referral_variable" />
					</div>
				</div>		
			</div>
		</div>		
		<div class="uap-inside-item">
			<div class="row">
				<div class="col-xs-4">				
				<p class="uap-labels-special"><?php _e('Referral Format:', 'uap');?></p>
				<select name="uap_default_ref_format" class="form-control m-bot15"><?php 
				$referral_format = array('id' => 'Referral ID', 'username'=>'UserName');
				foreach ($referral_format as $k=>$v){
					$selected = ($data['metas']['uap_default_ref_format']==$k) ? 'selected' : '';
					?>
					<option value="<?php echo $k;?>" <?php echo $selected;?> ><?php echo $v;?></option>
					<?php 
				}
				?></select>
			
				</div>		
			</div>
		</div>		
		<div class="uap-inside-item">
			<div class="row">
				<div class="col-xs-4">		
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1"><?php _e('Cookie Expiration:', 'uap');?></span>
					<input type="number" min="1" class="form-control" value="<?php echo $data['metas']['uap_cookie_expire'];?>" name="uap_cookie_expire"/>
					<div class="input-group-addon"> <?php _e("Days", 'uap');?></div>	
				</div>
				
				</div>		
			</div>
		</div>				
		<div class="uap-line-break"></div>		
		<div class="uap-inside-item">
			<div class="row">
				<div class="col-xs-4">
				<h3><?php _e('Campaign Settings', 'uap');?></h3>
				<br/>
				<p><?php _e('Set the Campaign Variable name', 'uap');?></p>		
					<div class="form-group">
						<input type="text" class="form-control" value="<?php echo $data['metas']['uap_campaign_variable'];?>" name="uap_campaign_variable"  />
					</div>
				</div>		
			</div>
		</div>								
		<div class="uap-line-break"></div>		
		<div class="uap-inside-item">
			<div class="row">
				<div class="col-xs-4">
					<h3><?php _e('Amount Value Settings', 'uap');?></h3>
					<div class="uap-form-line">
						<span class="uap-labels-special"><?php _e('Currency:', 'uap');?></span>
						<select name="uap_currency" class="form-control m-bot15">><?php 
							$currency = uap_get_currencies_list();
							foreach ($currency as $k=>$v){
								$selected = ($k==$data['metas']['uap_currency']) ? 'selected' : '';
								?>
								<option value="<?php echo $k;?>" <?php echo $selected;?> ><?php echo $v;?></option>
								<?php 
							}
						?></select>
					</div>	
					
					<div class="uap-form-line">
						<span class="uap-labels-special"><?php _e('On Referral Use:', 'uap');?></span>
						<select name="uap_referral_offer_type" class="form-control m-bot15"><?php 
							$types = array('lowest'=>__('Lowest Offer', 'uap'), 'biggest'=>__('Biggest Offer', 'uap'));
							foreach ($types as $key=>$value){
								$selected = ($key==$data['metas']['uap_referral_offer_type']) ? 'selected' : '';
								?>
								<option value="<?php echo $key?>" <?php echo $selected;?>><?php echo $value;?></option>
								<?php 
							}
						?></select>
					</div>
					
					<div class="uap-form-line">
						<span class="uap-labels-special"><?php _e('Exclude Shipping', 'uap');?></span>
						<label class="uap_label_shiwtch" style="margin:10px 0 10px -10px;">
							<?php $checked = ($data['metas']['uap_exclude_shipping']) ? 'checked' : '';?>
							<input type="checkbox" class="uap-switch" onClick="uap_check_and_h(this, '#uap_exclude_shipping');" <?php echo $checked;?> />
							<div class="switch" style="display:inline-block;"></div>
						</label>
						<input type="hidden" name="uap_exclude_shipping" value="<?php echo $data['metas']['uap_exclude_shipping'];?>" id="uap_exclude_shipping" /> 
					</div>
					
					<div class="uap-form-line">
						<span class="uap-labels-special"><?php _e('Exclude Tax', 'uap');?></span>
						<label class="uap_label_shiwtch" style="margin:10px 0 10px -10px;">
							<?php $checked = ($data['metas']['uap_exclude_tax']) ? 'checked' : '';?>
							<input type="checkbox" class="uap-switch" onClick="uap_check_and_h(this, '#uap_exclude_tax');" <?php echo $checked;?> />
							<div class="switch" style="display:inline-block;"></div>
						</label>
						<input type="hidden" name="uap_exclude_tax" value="<?php echo $data['metas']['uap_exclude_tax'];?>" id="uap_exclude_tax" /> 
					</div>																
					
				</div>		
			</div>
		</div>													

		<div class="uap-line-break"></div>	
			
		<div class="uap-inside-item">
			<div class="row">
				<div class="col-xs-6">
					<h3><?php _e('Automatically Affiliate', 'uap');?></h3>
					<p><?php _e('All new Users become Affiliates', 'uap');?></p>
					<label class="uap_label_shiwtch" style="margin:10px 0 10px -10px;">
						<?php $checked = ($data['metas']['uap_all_new_users_become_affiliates']) ? 'checked' : '';?>
						<input type="checkbox" class="uap-switch" onClick="uap_check_and_h(this, '#uap_all_new_users_become_affiliates');" <?php echo $checked;?> />
						<div class="switch" style="display:inline-block;"></div>
					</label>
					<input type="hidden" name="uap_all_new_users_become_affiliates" value="<?php echo $data['metas']['uap_all_new_users_become_affiliates'];?>" id="uap_all_new_users_become_affiliates" /> 	
				</div>
			</div>
		</div>		

		<div class="uap-line-break"></div>				
		<div class="uap-inside-item">
			<div class="row">
				<div class="col-xs-6">
					<h3><?php _e('Empty Referrals', 'uap');?></h3>
					<p><?php _e('Save Empty Referrals', 'uap');?></p>
					<label class="uap_label_shiwtch" style="margin:10px 0 10px -10px;">
						<?php $checked = ($data['metas']['uap_empty_referrals_enable']) ? 'checked' : '';?>
						<input type="checkbox" class="uap-switch" onClick="uap_check_and_h(this, '#uap_empty_referrals_enable');" <?php echo $checked;?> />
						<div class="switch" style="display:inline-block;"></div>
					</label>
					<input type="hidden" name="uap_empty_referrals_enable" value="<?php echo $data['metas']['uap_empty_referrals_enable'];?>" id="uap_empty_referrals_enable" /> 	
				</div>
			</div>
		</div>		
																									
		<div class="uap-submit-form">
			<input type="submit" value="<?php _e('Save', 'uap');?>" name="save" class="button button-primary button-large" />
		</div>	
	</div>
</div>	
</form>