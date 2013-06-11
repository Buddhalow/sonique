<?php echo $this->Session->flash('email'); ?>
<?php echo $this->Form->create('User');?>
<fieldset>
	<legend>Forgot password</legend>
	<p>Enter your e-mail and an link to reset your password will be sent to you</p>
	<?php echo $this->Form->input('email');?>
	</legend>
</fieldset>
<?php echo $this->Form->end(__('Submit'))?>