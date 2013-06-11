<?php echo $this->Form->create('User');?>
<fieldset>
	<legend>Forgot password</legend>
	<?php echo $this->Form->input('password');?>
	<?php echo $this->Form->input('password2');?>
	</legend>
</fieldset>
<?php echo $this->Form->end(__('Submit'))?>