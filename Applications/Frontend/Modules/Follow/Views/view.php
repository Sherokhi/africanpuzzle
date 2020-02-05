<?php

	if ($user->isAuthenticated() && $boolVisible){

				?>
				
	<form id="view-follow" style="overflow-y: scroll; height:400px; name="follow" method="post">
	    <h5><?php echo ($follow->right()) ? '<i class="icon-lock"></i>' : ''; ?>
	    	Le <?php echo date_format($follow->add_date(), 'j F Y'); ?>
	        de <?php echo $follow->colleague_id();  ?>
	        <?php if($follow->mod_colleague_id() != ""):?>
	        modifié par <?php echo $follow->mod_colleague_id(); ?>
	    <?php endif ?>
	    </h5>
		<?php echo nl2br($follow->content()); ?>
	</form>
		
<?php

}
		else{
			$this->app->user()->setFlash('Vous n\'avez pas les autorisations nécessaire pour visualiser cette page', 'error');

		}
?>