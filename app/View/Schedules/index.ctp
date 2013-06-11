<fieldset>
	<legend>Filter</legend>

	<div style="float: left">
		<span><a href="?week=<?php echo $week-1?>&amp;year=<?php echo $year?>&amp;<?php echo $classId > 0 ? 'classId='.$classId : ""?>&amp;<?php echo $userId > 0 ? 'userId='.$userId : ''?>&amp;<?php echo $hallId > 0 ? 'hallId='.$hallId : ''?>&amp;<?php echo $courseId > 0 ? 'courseId='.$courseId : ''?>"><img src="<?php echo Router::Url('/img/b_prevpage.png')?>" /></a> Vecka <?php echo $week?> <?php echo $year?> <a href="?week=<?php echo $week+1?>&amp;year=<?php echo $year?>&amp;<?php echo $classId > 0 ? 'classId='.$classId : ""?>&amp;<?php echo $userId > 0 ? 'userId='.$userId : ''?>&amp;<?php echo $hallId > 0 ? 'hallId='.$hallId : ''?>&amp;<?php echo $courseId > 0 ? 'courseId='.$courseId : ''?>"><img src="<?php echo Router::Url('/img/b_nextpage.png')?>" /></a>
	</div>
	<div style="float:left"><?php echo $this->Form->input('courseId', array('selected' => $courseId, 'label' => __('Course'), 'id' => 'courseId', 'type' => 'select', 'options' => $courses));?></div>
	
	<div style="float:left"><?php echo $this->Form->input('userId', array('selected' => $userId,'label' => __('User'),'id' => 'userId', 'type' => 'select', 'options' => $users));?></div>
	
	<div style="float:left"><?php echo $this->Form->input('classId', array('selected' => $classId,'label' => __('Class'), 'id' => 'classId', 'type' => 'select', 'options' => $classes));?></div>
	
	<div style="float:left"><?php echo $this->Form->input('hallId', array('selected' => $hallId, 'label' => __('Hall'), 'id' => 'hallId', 'type' => 'select', 'options' => $halls));?></div>
	<script language="javascript">
		var week = "<?php echo $week?>";
		var year ="<?php echo $year?>";
		function bind(id) {
			document.getElementById(id).addEventListener('change', function () {
				var selectedValue =  document.getElementById(id).options[document.getElementById(id).selectedIndex].value;
				if(selectedValue > 0)
					self.location="<?php echo Router::Url('/schedules/')?>?" + id + "=" + selectedValue + "&week="+week+"&year="+year;
			});
		}
		window.addEventListener('load', function () {
			bind('classId');
			bind('userId');
			bind('courseId');
			bind('hallId');
			
		})
	</script>
</fieldset>
<iframe width="100%" height="800" id="schedule" name="schedule" frameborder="0" src="<?php echo $scheduleUrl?>"></iframe>