<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('active');
		echo $this->Form->input('CourseClass');
		echo $this->Form->input('role_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<?php echo $this->Form->create('User', array('action' => 'changePassword'));?>
	<fieldset>
		<legend><?php echo __('Change password')?></legend>
		<?php 
		echo $this->Form->input('password', array('type' => 'password', 'value' => ''));
		echo $this->Form->input('password2', array('value' => '', 'type' => 'password'));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Change'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Artists'), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artist'), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Course Classes'), array('controller' => 'course_classes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course Class'), array('controller' => 'course_classes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Doctrine Versions'), array('controller' => 'doctrine_versions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Doctrine Version'), array('controller' => 'doctrine_versions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Doctrines'), array('controller' => 'doctrines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Doctrine'), array('controller' => 'doctrines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Records'), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Record'), array('controller' => 'records', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Songs'), array('controller' => 'songs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Song'), array('controller' => 'songs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Submissions'), array('controller' => 'submissions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Submission'), array('controller' => 'submissions', 'action' => 'add')); ?> </li>
	</ul>
</div>
