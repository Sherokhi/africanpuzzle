<?php if ($user->isAuthenticated() && $boolEdit) { ?>


	<form id="update-follow" action="<?php echo $this->html()->url('follow/'.$id.'/edit'); ?>" name="follow" method="post">

		<label>Type de suivi</label>
		<div class="btn-group">
			<select id="followType" name="followType" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
				<?php
				foreach($followTypes as $followType):
					if($follow->follow_type() == $followType->follow_type()) { $selected = true; }
					else { $selected = false; }	?>

					<option <?php if($selected) echo "selected" ?> value="<?php echo $followType->follow_type()?>"><?php echo $followType->type_name() ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<textarea rows="9" class="input-block-level" name="content"><?php echo str_replace("\n", "", $follow->content()); ?></textarea>
	</form>
	<a id="deleteFollow" class="hidden" href="<?php echo $this->html()->url('follow/'.$id.'/delete'); ?>"></a>
	
	
    <?php

}
else{
    $this->app->user()->setFlash('Vous n\'avez pas les autorisations nécessaire pour visualiser cette page', 'error');

}
?>