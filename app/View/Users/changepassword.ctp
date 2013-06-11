<?php echo $this->fetch('flash')?>
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Change password')?></legend>
		<?php 
		echo $this->Form->input('password1', array('type' => 'password', 'value' => ''));
		echo $this->Form->input('password2', array('value' => '', 'type' => 'password'));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Change'));?>