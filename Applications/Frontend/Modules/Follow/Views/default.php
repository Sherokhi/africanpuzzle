<?php
/****************************************************************************
Nom: 	default.php
Auteur: ?
Date:	??.??.??
But: 	Page par défaut du site de gestion des élèves de l'ETML
*****************************************************************************
Modifications
Date  : 09.01.2014
Auteur: Ludovic Delafontaine - MIN3 2011-2015
Raison: - Ajout de cet entête
		- Activation de la fonction de déconnexion en mode tablette/téléphone
		- Suppression d'un code double concernant le bouton de navigation en mode tablette/téléphone
		- Amélioration du code HTML/PHP
A faire: Amélioration du code HTML/PHP
*****************************************************************************
Modifications
Date  : 10.01.2014
Auteur: Ludovic Delafontaine - MIN3 2011-2015
Raison: - Amélioration du code HTML/PHP
A faire: -
****************************************************************************
*****************************************************************************
Modifications
Date  : 14.05.2014
Auteur: Lukyantsev Vladislav
Raison: - Ajout du js "print.js"
****************************************************************************
*****************************************************************************
Modifications
Date  : 22.05.2014
Auteur: Lukyantsev Vladislav
Raison: - Ajout des entete d'impression
****************************************************************************/
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php echo isset($title) ? $title.' &middot ' : null?>ETML</title>
        <meta http-equiv="Content-Type"       content="text/html; charset=UTF-8">

        <meta http-equiv="Content-Style-Type" content="text/css">
        <meta http-equiv="Content-Language"   content="fr">

        <meta name="author"                   content="Cotza Andrea, Dupuy Eliott, Lanz Romain, Potterat Thierry, Lukyantsev Vladislav, Alexis Gonzalez, Teklehaimanot Robel, Valisari Karim, Roland Alexandre, Hermann Jonathan, Doran Kayoumi, Antoine Dessauges, Jérémy Perriraz, Volkan Sutcu">
        <meta name="description"              content="<?php echo isset($description) ? $description : null ?>">
        <meta name="keywords"   lang="fr"     content="etml, intranet, gestion<?php echo isset($keywords) ? ', '.$keywords : null ?>">
        <meta name="language"                 content="fr">

        <?php $this->html()->css('twitter/bootstrap/bootstrap.css'); ?>
        <?php $this->html()->css('twitter/bootstrap/bootstrap-responsive.css'); ?>
        <?php $this->html()->css('font/font-awesome.min.css'); ?>
        <?php $this->html()->css('styles.css'); ?>
        <?php $this->html()->css('slywork.min.css'); ?>
        <?php $this->html()->display('css'); ?>

        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
        <![endif]-->

        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>

        <?php $this->html()->js('twitter/bootstrap/bootstrap.js'); ?>
        <?php $this->html()->js('jquery.dataTables.min.js'); ?>
        <?php $this->html()->js('bootstrap.min.js'); ?>
        <?php $this->html()->js('jquery.slimscroll.min.js'); ?>
        <?php $this->html()->js('jquery.knob.js'); ?>
        <?php $this->html()->js('custom.js'); ?>
        <?php $this->html()->js('print.js'); ?>
        <?php $this->html()->js('jspdf.debug.js'); ?>

        <!-- TOASTR-->
        <?php $this->html()->js('dasha_template/toastr/build/toastr.min.js', true); ?>
        

        <script type="text/javascript" src="<?php echo $this->html()->url('js/jquery.min.js'); ?>"></script>
    </head>
    <body>
   
<!-- en tete d'impression -->
 <div class="header-print">ETML - - Imprimé par : <?php
 //verifie si l'utilisateur est connecté -> defini son nom dans entete
if ($user->isAuthenticated()) {
  echo ucfirst(strtolower($user->getAttribute('user')->first_name())).' '.ucfirst(strtolower($user->getAttribute('user')->name())) ;
  
}
?> le <?php  echo date("d-m-Y");?> à <?php  echo date("H:i"); ?> </div>
<!-- fin en tete d'impression -->

        <div id="wrap" class="print-hidden">
		
            <div class="navbar navbar-fixed-top">
			
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <div class="logo">
                            <a href="<?php echo $this->html()->url(); ?>"><?php echo $this->h('ETML - Gestion Elèves'); ?></a>
                        </div>
						<?php // Bouton en haut à droit de l'écran ?>
                        <a class="btn btn-navbar visible-phone visible-tablet" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
							<?php
								// Vérifie si l'utilisateur est connecté et s'il est connecté, affiche le bouton de déconnexion
								if ($user->isAuthenticated()):
							?>
  
                            <li>

								<a href="<?php echo $this->html()->url('logout'); ?>">
									<i class="icon-off icon-white"></i>
									<?php echo $this->h('Déconnexion'); ?>
								</a>
							</li>
							<?php
								// Sinon, affiche le bouton de connexion
								else:
							?>
							<?php // Petite fenêtre de connection ?>
                           
							<li class="dropdown">
								<a class="dropdown-toggle connect" data-toggle="dropdown" href="#">
									<i class="icon-off icon-white"></i>
									<?php echo $this->h('Connexion'); ?>
								</a>
								<ul class="dropdown-menu p10">
									<form action="<?php echo $this->html()->url('login'); ?>" method="post">
										<div class="input-prepend">
											<span class="add-on">
												<i class="icon-user"></i>
											</span>
											<input name="login" type="text" placeholder="Entrer votre login"/>
										</div>
										<div class="input-prepend">
											<span class="add-on">
												<i class="icon-key"></i>
											</span>
											<input name="password" type="password" placeholder="Entrer votre mot de passe"/>
										</div>
										<input class="btn btn-small btn-primary right" type="submit" value="Connexion" />
									</form>
								</ul>
							</li>
							<?php endif; ?>
						</ul>
                    </div>
				</div>
            </div>
			
        </div>
		<?php // Menu de navigation ?>
        <div class="container-fluid">
            <div id="sidebar" class="sidebar-nav nav-collapse collapse">
                <?php
					if ($user->isAuthenticated()) {
						$right = $user->getAttribute('right');
				?>
				<?php // Nom du collègue et photo ?>
				<div class="user_side clearfix">
				<?php

                    $role = $user->getAttribute('role');

                    if ($role == 7) 
                    {
                        $MyDirectory = opendir(WEBROOT."/img/students/") or die('Erreur');
                        
                        while($Entry = @readdir($MyDirectory)) 
                        {
                            if($Entry != '.' && $Entry != '..' && !(strstr($Entry, "index"))) 
                            {
                                if (file_exists(WEBROOT."/img/students/".$Entry."/".$user->getAttribute('user')->id().".jpg")) 
                                {
                                    $photo = "/img/students/".$Entry."/".$user->getAttribute('user')->id().".jpg";
                                }
                            }
                        }
                        
                        closedir($MyDirectory);

                    }
                    else
                    {
                       $photo = '/img/colleagues/'.$user->getAttribute('user')->id().'.jpg'; 
                    }

					
					if (file_exists(WEBROOT.$photo)) 
                    {
				?>
					<img src="<?php echo $this->html()->url($photo); ?>" alt="<?php echo ucfirst(strtolower($user->getAttribute('user')->first_name())).' '.ucfirst(strtolower($user->getAttribute('user')->name()));?>">
				<?php
					} // end (file_exists(WEBROOT.$photo))
					else {
				?>
					<img src="<?php echo $this->html()->url('/img/nophoto.jpg'); ?>" alt="No photo">
				<?php
					} // end else
				?>
					<h4><?php echo strtolower($user->getAttribute('user')->id()) ?></h4>
                    <a href="
                            <?php

                                $role = $user->getAttribute('role');

                                if ($role == 7) 
                                {
                                    echo $this->html()->url('student/'.$user->getAttribute('user')->id()); 
                                }
                                else
                                {
                                    echo $this->html()->url('colleague/'.$user->getAttribute('user')->id()); 
                                }
                                 
                            ?>
                        ">
                        <?php echo ucfirst(strtolower($user->getAttribute('user')->first_name())).' '.ucfirst(strtolower($user->getAttribute('user')->name())) ?>
                    </a>
				</div>
                <?php
					} // if ($user->isAuthenticated())
				?>
				
				<?php // Début des accordéons (menus déroulants) ?>

                 <div class="accordion" id="accordion2">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="<?php echo $this->html()->url(); ?>">
                                <i class="icon-dashboard icon-white"></i>
                                <span>&nbsp;<?php echo $this->h('Page d\'accueil'); ?></span>
                            </a>
                        </div>
                    </div>

                    <?php 
                    //Verifie si l'utilisateur est connecté afin de savoir si l'on doit ou pas donner l'accès à l'horaire
                    /*if($user->isAuthenticated())
                    {?>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="<?php echo $this->html()->url('calendar'); ?>">
                                <i class="icon-calendar icon-white"></i>
                                <span>&nbsp;<?php echo $this->h('Horaire'); ?></span>
                            </a>
                        </div>
                    </div>
					<?php }*/ ?>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse1">
                                <i class="icon-reorder icon-white"></i>
                                <span>&nbsp;<?php echo $this->h('Etudiants'); ?></span>
                            </a>
                        </div>

                        <div id="collapse1" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <a class="accordion-toggle" href="<?php echo $this->html()->url('student'); ?>">
                                    <i class="icon-list-alt icon-white"></i>&nbsp;<?php echo $this->h('Liste étudiants'); ?>
                                </a>

                                 <?php if (@$right[STUDENT] & ADD): ?>
                                <a class="accordion-toggle" href="<?php echo $this->html()->url('student/add'); ?>">
                                    <i class="icon-plus icon-white"></i>&nbsp;<?php echo $this->h('Ajouter étudiant'); ?>
                                </a>
                                <?php endif; ?>

                                
                                <?php if (@$right[STUDENT] & ADD): ?>
                                <a class="accordion-toggle" href="<?php echo $this->html()->url('student/import'); ?>">
                                    <i class="icon-plus icon-white"></i>&nbsp;<?php echo $this->h('Importer étudiant'); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
<!--<div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="<?php echo $this->html()->url('schedule'); ?>">
                                <i class="icon-calendar icon-white"></i>
                                <span>&nbsp;<?php echo $this->h('Horaire'); ?></span>
                            </a>
                        </div>
                    </div>-->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse2"><i class="icon-reorder icon-white"></i>
                                <span>&nbsp;<?php echo $this->h('Classes'); ?></span>
                            </a>
                        </div>
                        <div id="collapse2" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <a class="accordion-toggle" href="<?php echo $this->html()->url('class'); ?>">
                                    <i class="icon-list-alt icon-white"></i>&nbsp;<?php echo $this->h('Liste classes'); ?>
                                </a>
                                
                                <?php if (@$right[FOLLOW] & MODIFY): ?>
                                <a class="accordion-toggle" href="<?php echo $this->html()->url('class/myclass/'.$user->getAttribute('user')->id()); ?>">
                                    <i class="icon-list-alt  icon-white"></i>&nbsp;<?php echo $this->h('Mes classes'); ?>
                                </a>
                                <?php endif; ?>

                                <!--
                                <?php if (@$right[SCHOOLCLASS] & ADD): ?>
                                <a class="accordion-toggle" href="<?php echo $this->html()->url('class/add'); ?>">
                                    <i class="icon-plus icon-white"></i>&nbsp;<?php echo $this->h('Ajouter classe'); ?>
                                </a>
                                <?php endif; ?>
                                -->

                            </div>
                        </div>
                    </div>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse3"><i class="icon-reorder icon-white"></i>
                                <span>&nbsp;<?php echo $this->h('Collaborateurs'); ?></span>
                            </a>
                        </div>
                        <div id="collapse3" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <a class="accordion-toggle" href="<?php echo $this->html()->url('colleague'); ?>">
                                    <i class="icon-list-alt icon-white"></i>&nbsp;<?php echo $this->h('Liste collaborateurs'); ?>
                                </a>

                                <?php if (@$right[COLLEAGUE] & ADD): ?>
                                <a class="accordion-toggle" href="<?php echo $this->html()->url('colleague/add'); ?>">
                                    <i class="icon-plus icon-white"></i>&nbsp;<?php echo $this->h('Ajouter collaborateur'); ?>
                                </a>
                                <?php endif; ?>
                                
                                 <?php if (@$right[COLLEAGUE] & ADD): ?>
                                
                                <a class="accordion-toggle" href="<?php echo $this->html()->url('colleague/import'); ?>" >
                                    <i class="icon-plus icon-white" ></i>&nbsp;<?php echo $this->h('Importer collaborateur'); ?>
                                </a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                    <!--Profession-->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse5"><i class="icon-reorder icon-white"></i>
                                <span>&nbsp;<?php echo $this->h('Sections'); ?></span>
                            </a>
                        </div>
                        <div id="collapse5" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <a class="accordion-toggle" href="<?php echo $this->html()->url('profession'); ?>">
                                    <i class="icon-list-alt icon-white"></i>&nbsp;<?php echo $this->h('Liste sections'); ?>
                                </a> 
                            </div>
                        </div>
                    </div>

                    <?php if (@$right[FOLLOW] & ADD): ?>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse4"><i class="icon-reorder icon-white"></i>
                                <span>&nbsp;<?php echo $this->h('Suivis'); ?></span>
                            </a>
                        </div>
                        <div id="collapse4" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <a class="accordion-toggle" href="<?php echo $this->html()->url('follow'); ?>">
                                    <i class="icon-list-alt icon-white"></i>&nbsp;<?php echo $this->h('Mes suivis'); ?>
                                </a>

                                <?php if (@$right[FOLLOW] & MODIFY): ?>
                                <a class="accordion-toggle" href="<?php echo $this->html()->url('follow/class'); ?>">
                                    <i class="icon-list-alt icon-white"></i>&nbsp;<?php echo $this->h('Les suivis de ma classe'); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
<div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="<?php echo $this->html()->url('news'); ?>">
                                <i class="icon-tag icon-white"></i>
                                <span>&nbsp;<?php echo $this->h('News'); ?></span>
                            </a>
                        </div>
                    </div>
                    
                    <?php if (@$right[EVENT] & VIEW_ALL): ?>
                    <!--<div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="<?php echo $this->html()->url('event'); ?>">
                                <i class="icon-tasks icon-white"></i>
                                <span>&nbsp;<?php echo $this->h('Evénements'); ?></span>
                            </a>
                        </div>
                    </div>-->
                    <?php endif; ?>

                    <?php if (@$right[DOCUMENT] & MODIFY): ?>
                    <!--<div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="<?php echo $this->html()->url('document'); ?>">
                                <i class="icon-folder-close icon-white"></i>
                                <span>&nbsp;<?php echo $this->h('Documents'); ?></span>
                            </a>
                        </div>
                    </div>-->
					<?php endif; ?>
                    
                    <?php if (@$right[HISTORIC] & VIEW_ALL): ?>
                    <!--<div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="<?php echo $this->html()->url('historic'); ?>">
                                <i class="icon-calendar icon-white"></i>
                                <span>&nbsp;<?php echo $this->h('Historique'); ?></span>
                            </a>
                        </div>
                    </div>-->
                    <?php endif; ?>
                </div>
            </div>

			<?php // Contenu de la page ?>
            <div class="main_container">
                <div class="row-fluid">
                    <?php
						if ($user->hasFlash()):
					?>
                    <div class="alert alert-<?php echo $user->getFlashType(); ?>">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $user->getFlash(); ?>
                    </div>
                    <?php endif; ?>
                    <?php echo $content; ?>
                </div><!--/row-->
                <footer>
                        <small>
							<span id="dev">
								<?php echo $this->h('Développeurs'); ?>
							</span>
							<span id="name">: Lukyantsev Vladislav, Alexis Gonzalez, Robel Teklehaimanot , Alexandre Roland, Jonathan Hermann, Karim Valisari, Cotza Andrea, Dupuy Eliott, Lanz Romain, Potterat Thierry et Dimitrios Lymberis</span> &copy; <?php echo date('Y'); ?> @ Ecole technique - Ecole des métiers Lausanne<span> <!--Page générée en <?php echo $generateTime; ?> seconde(s)</span> --></small>
                </footer>
            </div><!--/span-->
             

        </div> <!-- /container -->
        <?php $this->html()->display('js'); ?>
    </body>
</html>
