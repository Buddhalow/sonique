<?php echo $this->fetch('flash')?>
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Change password')?></legend>
		<?php 
		echo $this->Form->input('password', array('type' => 'password', 'value' => ''));
		echo $this->Form->input('password_confirm', array('value' => '', 'type' => 'password'));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Change'));?>