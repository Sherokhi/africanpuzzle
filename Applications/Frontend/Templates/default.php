<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="description" content="African Puzzle" />
<meta name="keywords" content="charity,bénin,remorque,parrain,marraine,crowdfunding,nonprofit,orphan,Poor,funding,fundrising,ngo,children" />
<meta name="author" content="ThemeMascot" />

<!-- Page Title -->
<title>African Puzzle</title>

<!-- Favicon and Touch Icons -->
<link href="<?php echo $this->html()->url(IMAGES_FOLDER.'favicon.ico'); ?>" rel="shortcut icon" type="image/png">
<link href="<?php echo $this->html()->url(IMAGES_FOLDER.'apple-touch-icon.png'); ?>" rel="apple-touch-icon">
<link href="<?php echo $this->html()->url(IMAGES_FOLDER.'apple-touch-icon-72x72.png'); ?>" rel="apple-touch-icon" sizes="72x72">
<link href="<?php echo $this->html()->url(IMAGES_FOLDER.'apple-touch-icon-114x114.png'); ?>" rel="apple-touch-icon" sizes="114x114">
<link href="<?php echo $this->html()->url(IMAGES_FOLDER.'apple-touch-icon-144x144.png'); ?>" rel="apple-touch-icon" sizes="144x144">

<!-- Section: Stylesheet -->
<section id="stylesheet">
  
  <?php $this->html()->css('bootstrap.min.css',true); ?>
  <?php $this->html()->css('jquery-ui.min.css',true); ?>
  <?php $this->html()->css('animate.css',true); ?>
  <?php $this->html()->css('css-plugin-collections.css',true); ?>
  <!-- CSS | menuzord megamenu skins 
  <link id="menuzord-menu-skins" href="css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/> -->
  <?php $this->html()->css('menuzord-skins/menuzord-rounded-boxed.css',true); ?>
  <!-- CSS | Main style file -->
  <?php $this->html()->css('style-main.css',true); ?>
  <!-- CSS | Preloader Styles -->
  <?php $this->html()->css('preloader.css',true); ?>
  <!-- CSS | Custom Margin Padding Collection -->
  <?php $this->html()->css('custom-bootstrap-margin-padding.css',true); ?>
  <!-- CSS | Responsive media queries -->
  <?php $this->html()->css('responsive.css',true); ?>
   

  <!-- Revolution Slider 5.x CSS settings -->
  <?php $this->html()->css('revolution-slider/css/settings.css',true); ?>
  <?php $this->html()->css('revolution-slider/css/layers.css',true); ?>
  <?php $this->html()->css('revolution-slider/css/navigation.css',true); ?>


  <!-- CSS | Theme Color -->
  <?php $this->html()->css('colors/theme-skin-orange.css',true); ?>

  
  <!-- aafrican css -->
  <?php $this->html()->css('slywork.min.css'); ?>
  <?php $this->html()->css('style.css'); ?>

  <!-- Crée le code html pour insérer les CSS -->
  <?php $this->html()->display('css'); ?>

</section>

<!-- Section: external javascripts -->
<section id="extjavascript">

  <?php $this->html()->js('jquery-2.2.4.min.js'); ?>
  <?php $this->html()->js('jquery-ui.min.js'); ?>
  <?php $this->html()->js('bootstrap.min.js'); ?>
  <!-- JS | jquery plugin collection for this theme -->
  <?php $this->html()->js('jquery-plugin-collection.js'); ?>


  <!-- Revolution Slider 5.x SCRIPTS -->
  <?php $this->html()->js('revolution-slider/js/jquery.themepunch.tools.min.js',true); ?>
  <?php $this->html()->js('revolution-slider/js/jquery.themepunch.revolution.min.js',true); ?>
  
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Sweet Alert  https://lipis.github.io/bootstrap-sweetalert/   https://sweetalert.js.org/guides/-->
  <?php $this->html()->js('dasha_template/sweetalert/dist/sweetalert.min.js',true); ?>

  <?php $this->html()->js('custom.js'); ?>

  <!-- African script général -->
  <?php $this->html()->js('african.js'); ?>

  <!-- Crée le code html pour insérer les js -->
  <?php $this->html()->display('js'); ?>

</section>

</head>
<body class="boxed-layout pt-40 pb-40 pt-sm-0" data-bg-img="<?php echo $this->html()->url(IMAGES_FOLDER.'pattern/p27.png'); ?>">
  <div id="wrapper" class="clearfix">
    
    <!-- preloader -->
    <div id="preloader">
      <div id="spinner">
        <div class="preloader-dot-loading">
          <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
        </div>
      </div>
      <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
    </div>


<!-- Section: modal connection -->
<section id="mod_connection">
  <div class="container modal fade bs-connection-modal-sm" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="panel with-nav-tabs panel-info mb-0">

                <div class="panel-heading">
                  <ul class="nav nav-tabs">
                      <li class="active"><a href="#login" data-toggle="tab"> Conection </a></li>
                      <li><a href="#signup" data-toggle="tab"> S'inscrire </a></li>
                  </ul>
                </div>

                <div class="panel-body">
                  <div class="tab-content">
                      
                      <!-- Section: formulaire de connection -->
                      <div id="login" class="tab-pane fade in active register">
                        <form action="<?php echo $this->html()->url('login'); ?>" method="post">
                          <div class="container-fluid">
                              <div class="row">
                                <p>L'accès selon vos droits vous permet de visualiser des rubriques comme:</p>
                                <p>les galleries de photos ou des détails sur votre filleul.</p>
                                    <h2 class="text-center" style="color: #5cb85c;"> <strong> Login  </strong></h2><hr />

                                    <div class="row">
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                          <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                  <span class="glyphicon glyphicon-user"></span>
                                                </div>
                                                <input type="text" placeholder="Pseudo" name="login" class="form-control text" required>
                                            </div>
                                          </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                          <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                  <span class="glyphicon glyphicon-lock"></span>
                                                </div>
                                                <input type="password" placeholder="Mot de passe" name="password" class="form-control" required>
                                            </div>
                                          </div>
                                      </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                      <div class="col-xs-6 col-sm-6 col-md-6">                                      
                                          <div class="form-group mb-0">
                                              <div class="chiller_cb ml-10">
                                                <input id="myCheckbox2" type="checkbox" name="remember">
                                                <label for="myCheckbox2">Se souvenir de moi</label>
                                                <span></span>
                                              </div>
                                          </div>
                                      </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                          <div class="form-group mt-5">
                                            <a href="#forgot" data-toggle="modal"> J'ai oublié mon mot de passe </a>
                                          </div>
                                      </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group mb-0">
                                              <button type="submit" class="btn btn-lg btn-block btn-theme-colored"> SE CONNECTER</button>
                                        </div>
                                      </div>
                                    </div>

                              </div>
                          </div> 
                        </form>
                      </div>
                      
                      <!-- Section: formulaire d'enegistrement' -->
                      <div id="signup" class="tab-pane fade">
                        <form action="<?php echo $this->html()->url('signup'); ?>" method="post"> 
                          <div class="container-fluid">
                              <div class="row">
                                <p>Vous êtes membre, donateur, parrain ou marraine mais vous n'avez pas d'accès au site !</p>
                                <p>Vous êtes dans la bonne rubrique, demander un compte d'accès.</p>
                                    <h2 class="text-center" style="color: #f0ad4e;"> <Strong> S'enregistrer </Strong></h2> <hr />
                                      <div class="row">
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                  <div class="input-group-addon iga1">
                                                      <span class="glyphicon glyphicon-user"></span>
                                                  </div>
                                                  <input type="text" class="form-control" placeholder="Pseudo" name="signup_login" required>
                                                </div>
                                            </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                  <div class="input-group-addon iga1">
                                                      <span class="glyphicon glyphicon-envelope"></span>
                                                  </div>
                                                  <input type="email" class="form-control" placeholder="E-Mail" name="signup_mail" required>
                                                </div>
                                            </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                  <div class="input-group-addon iga1">
                                                      <span class="glyphicon glyphicon-lock"></span>
                                                  </div>
                                                  <input type="password" class="form-control" placeholder="Mot de passe" name="signup_password" required>
                                                </div>
                                            </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                  <div class="input-group-addon iga1">
                                                      <span class="glyphicon glyphicon-lock"></span>
                                                  </div>
                                                  <input type="password" class="form-control" placeholder="Confirmer votre mot de passe" name="signup_pass_confirm" required>
                                                </div>
                                            </div>
                                          </div>
                                      </div>

                                      
                                      <div class="row">
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-lg btn-block btn-theme-colored"> M'INSCRIRE</button>
                                            </div>
                                          </div>
                                      </div>
                              </div>
                          </div>
                          </form>
                      </div>
                    
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

    <!-- Header -->
    <header class="header">
      <div class="header-top bg-theme-colored sm-text-center p-0">
        <div class="container">
          
          <!-- Section: message d'alert -->         
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <?php
                if ($user->hasFlash()):
                    ?>
                    <!-- dans custom.js on peut regler le temps d'affichage de l'alert  ligne 3--> 
                    <div class="alert alert-<?php echo $user->getFlashType(); ?> fade in" role="alert">

                      <p class="font-weight-600"><?php echo $user->getFlashTitle(); ?></p>
                      <ul>
                          <?php foreach($user->getFlash() as $error): ?>
                            <li class="pl10"><?= $error; ?></li>
                          <?php endforeach; ?>
                      </ul>
                      
                    </div>


                <?php endif; ?>
            </div>  
          </div>
         
          <div class="row">
            <div class="col-md-8">
              <div class="widget no-border m-0 mt-10">
                <ul class="list-inline sm-text-center">
                  <li class="text-white">
                    Un espoir de scolarité pour tous ...
                  </li>
               </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="widget no-border m-0">

              <ul class="list-inline pull-right sm-pull-none sm-text-center mt-5 mt-sm-15">
                <!-- seul les membres du comité peuvent accéder à ce menu -->
                <?php  if ($user->isAuthenticated() and ($user->getAttribute('isInCD'))): ?>
                <li><a href="<?php echo $this->html()->url('gestion'); ?>" class="btn btn-border btn-theme-colored btn-sm"><i class="fa fa-cogs fa-spin "></i> Gestion</a></li>
                <?php endif; ?>
                <li><img class="pb-5" src="<?php echo $this->html()->url(IMAGES_FOLDER.'logo_simple.png'); ?>" width="40" alt=""></li>
              </ul>
             
              </div>
            </div>
          </div>
      </div>
  

      <div class="header-middle p-0 bg-lightest xs-text-center">
        <div class="container pt-0 pb-0">
          <div class="row">

            <div class="col-xs-8 col-sm-4 col-md-6">
              <div class="widget no-border m-0">
                <a class="menuzord-brand pull-left flip xs-pull-center mb-15" href="<?php echo $this->html()->url(); ?>"><img src="<?php echo $this->html()->url(IMAGES_FOLDER.'Logo_sansPuzzle.png'); ?>" alt=""></a>
              </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-2">
              <div class="widget no-border m-0">
                <div class="mt-10 mb-10 text-right flip sm-text-center">
                  <div class="font-15 text-black-333 mb-5 font-weight-600"><i class="fa fa-facebook text-theme-colored font-18"></i> Suivez nous</div>
                  <a class="font-12 text-gray" href="https://www.facebook.com/pages/category/Nonprofit-Organization/African-Puzzle-314404828603228/" target="_blank">Nos activités sur facebook</a>
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-2">
              <div class="widget no-border m-0">
                <div class="mt-10 mb-10 text-right flip sm-text-center">
                  <div class="font-15 text-black-333 mb-5 font-weight-600"><i class="fa fa-envelope text-theme-colored font-18"></i> Contactez nous</div>
                  <a class="font-12 text-gray" href="mailto:info@africanpuzzle.ch"> info@africanpuzzle.ch</a>
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-2">
              <div class="widget no-border m-0">
                <div class="mt-10 mb-10 text-right flip sm-text-center">
                  
                
                <?php 
                // photo par défaut si pas trouvée
                $photo= IMAGES_FOLDER.'no_photo.png'; 
                // Vérifie si l'utilisateur est connecté et s'il est connecté, affiche le bouton de déconnexion                
                if ($user->isAuthenticated()):  
                  
                  if (file_exists(WEBROOT.IMAGES_FOLDER.FOLDER_IMG_USER. $user->getAttribute('user')->usePicture())){
                      $photo = IMAGES_FOLDER.FOLDER_IMG_USER. $user->getAttribute('user')->usePicture(); 
                  }
                  
                  
                  ?>
                 <div class="font-12 text-gray mb-5">
                 <i class="fa fa-sign-out text-theme-colored font-18"></i> 
                  <a data-toggle="modal" class="font-15 text-black-333  font-weight-600" href="<?php echo $this->html()->url('logout'); ?>">Déconnection </a>
  
                </div>
                <img class="img-circle" width="20px" src="<?php echo $this->html()->url($photo); ?>">  
                <small> Bonjour <?php echo $user->getAttribute('user')->useFirstName(); ?></small>
         
                
                <?php  
                // Sinon, affiche le bouton de connexion
                else: ?>
                  <div class="font-12 text-gray mb-5"><i class="fa fa-sign-in text-theme-colored font-18"></i> 
                    <a data-toggle="modal" data-target=".bs-connection-modal-sm" class="font-15 text-black-333  font-weight-600" href="#">Se connecter</a>
                  </div>
                  <small></small>
                
                <?php endif; ?>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="header-nav">
        <div class="header-nav-wrapper navbar-scrolltofixed bg-light">
          <div class="container">
            <nav id="menuzord" class="menuzord default bg-light">
              <ul class="menuzord-menu onepage-nav">
                <li class="active"><a href="#home">Accueil</a></li>
                <li><a href="#about">Qui sommes nous</a></li>
                <li><a href="#causes">Nos activités</a></li>
                <li><a href="#team">Notre équipe</a></li>
                
       

                <li><a href="#gallery">Gallerie</a>
                <?php  if ($user->isAuthenticated()): ?>
                  <ul class="dropdown">
                    <li><a href="#">Filleuls</a></li>                            
                    <li><a href="#">Remorque</a></li>
                    <li><a href="#">Activités</a></li>
                  </ul>
                  <?php endif; ?>
                </li>

                <li><a href="#blog">Notre Blog</a></li>
                <!-- <li><a href="#shop">Notre boutique</a></li>  -->              

              </ul>
             
              <div class="pull-right flip hidden-sm hidden-xs mt-20 pt-5">
              <a class="btn btn-colored btn-flat btn-theme-colored ajaxload-popup" href="ajax-load/donation-form.html">Faites un don</a>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>
    
    <!-- Start main-content -->
    <div class="main-content">

        <?php  echo $content; ?>

    </div>
    <!-- end main-content -->
    
      
    <!-- Footer -->
    <footer id="footer" class="footer" data-bg-img="<?php echo $this->html()->url(IMAGES_FOLDER.'footer-bg.png'); ?>" data-bg-color="#25272e">
      <div class="container pt-70 pb-40">
        <div class="row border-bottom-black">
          <div class="col-sm-6 col-md-3">
            <div class="widget dark">
              <img class="mt-10 mb-20" alt="" src="<?=IMAGES_FOLDER.'logo-wide-white-footer.png'?>">
              <p>Siège à , Yverdon, Suisse.</p>
              <ul class="list-inline mt-5">
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-colored mr-5"></i> <a class="text-gray" href="#">123-456-789</a> </li>
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-colored mr-5"></i> <a class="text-gray" href="mailto:info@yafricanpuzzle.ch">info@africanpuzzle.ch</a> </li>
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-colored mr-5"></i> <a class="text-gray" href="#">www.africanpuzzle.ch</a> </li>
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-facebook text-theme-colored mr-5"></i> <a class="text-gray" href="https://www.facebook.com/pages/category/Nonprofit-Organization/African-Puzzle-314404828603228/" target="_blank">Notre blog</a> </li>
               </ul>
            </div>
          </div>

          <div class="col-sm-6 col-md-3">
            <div class="widget dark">
              <h5 class="widget-title line-bottom">Ne pas oublier</h5>
              <div class="latest-posts">
                <article class="post media-post clearfix pb-0 mb-10">
                  <a href="#" class="post-thumb"><img alt="" src="https://placehold.it/80x55"></a>
                  <div class="post-right">
                    <h5 class="post-title mt-0 mb-5"><a href="#">Souper de soutien</a></h5>
                    <p class="post-date mb-0 font-12">Mar 08, 2015</p>
                  </div>
                </article>
                <article class="post media-post clearfix pb-0 mb-10">
                  <a href="https://forms.gle/zfSKxCcBqD9VPrZv8" class="post-thumb"><img alt="" src="<?php echo $this->html()->url(IMAGES_FOLDER.'cal2020.png'); ?>"></a>
                  <div class="post-right">
                    <h5 class="post-title mt-0 mb-5"><a href="https://forms.gle/zfSKxCcBqD9VPrZv8">Calendrier</a></h5>
                    <p class="post-date mb-0 font-12">Nov 08, 2019</p>
                  </div>
                </article>
                 <!--
                <article class="post media-post clearfix pb-0 mb-10">
                  <a href="#" class="post-thumb"><img alt="" src="https://placehold.it/80x55"></a>
                  <div class="post-right">
                   
                    <h5 class="post-title mt-0 mb-5"><a href="#">Notre boutique</a></h5>
                    <p class="post-date mb-0 font-12">Mar 08, 2015</p>
                   
                  </div>
                </article>
               -->
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3">
            <div class="widget dark">
            <a href="https://fr.wikipedia.org/wiki/B%C3%A9nin" target="_blank" ><img class="mt-10 mb-20" alt="" src="<?php echo $this->html()->url(IMAGES_FOLDER.'benin.png'); ?>"></a>
            </div>
          </div>

          <div class="col-sm-6 col-md-3">
            <div class="widget dark">
              <h5 class="widget-title line-bottom">Le Bénin</h5>
              <div class="opening-hours">
              <ul class="list angle-double-right list-border">
                  <li>
                    <h5 class="texte_red_light mt-0 mb-0">Habitants</h5>
                    <p class="post-date mb-0 font-12">11,5 million (2018)</p>
                  </li>
                  <li>
                    <h5 class="texte_red_light mt-0 mb-0">Taux de mortalité infantile</h5>
                    <p class="post-date mb-0 font-12">68,1 ‰ (2013)</p>
                  </li>
                  <li>
                    <h5 class="texte_red_light mt-0 mb-0">Taux d'alphabétisation</h5>
                    <p class="post-date mb-0 font-12">52,55 % (2015)</p>
                  </li> 
                  <li>
                    <h5 class="texte_red_light mt-0 mb-0">PIB/habitant</h5>
                    <p class="post-date mb-0 font-12">842 $USD (2017)</p>
                  </li>                        
                </ul>
              </div>
            </div>
          </div>
        </div>
		
        <div class="row ">
		
          <div class="col-md-12">
            <div class="widget dark">
  
              <h5 class="widget-title line-bottom mb-10">Faire un don</h5>

              <div class="col-sm-6 col-md-3"></div>

              <div class="col-sm-6 col-md-3">
                 <!--
                <h5 class="texte_red_light">CCP</h5>
                <p class="post-date mb-0 font-12">1111 -1111-111</p>
                -->
              </div>   
              
              <div class="col-sm-6 col-md-3">
                <h5 class="texte_red_light">IBAN</h5>
                <p class="post-date mb-0 font-12"> Raiffeisen </p>
                <p class="post-date mb-0 font-12"> CH60 8047 2000 0059 4815 0</p>
              </div>
             
              <div class="col-sm-6 col-md-3">
              <!--  
                <h5 class="texte_red_light">Paypal</h5>
                <p class="post-date mb-0 font-12">1111 -1111-111</p>
              -->
            </div>
              

              

            </div>
          </div>
		  
          
		  
        </div>
      </div>
      
	    <div class="footer-bottom bg-black-333">
        <div class="container pt-15 pb-10">
          <div class="row">
            
            <div class="col-md-12  text-right">
              <p class="font-11 text-black-777 m-0">Copyright &copy;2019 AfricanPuzzle. All Rights Reserved</p>
            </div>

          </div>
        </div>
      </div>
	  
	  
    </footer>
 
    <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
  </div>
  <!-- end wrapper -->

  <!-- Footer Scripts -->


  <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
        (Load Extensions only on Local File Systems ! 
        The following part can be removed on Server for On Demand Loading) -->

        <?php $this->html()->js('revolution-slider/js/extensions/revolution.extension.actions.min.js',true); ?>
        <?php $this->html()->js('revolution-slider/js/extensions/revolution.extension.carousel.min.js',true); ?>
        <?php $this->html()->js('revolution-slider/js/extensions/revolution.extension.kenburn.min.js',true); ?>
        <?php $this->html()->js('revolution-slider/js/extensions/revolution.extension.layeranimation.min.js',true); ?>
        <?php $this->html()->js('revolution-slider/js/extensions/revolution.extension.migration.min.js',true); ?>
        <?php $this->html()->js('revolution-slider/js/extensions/revolution.extension.navigation.min.js',true); ?>
        <?php $this->html()->js('revolution-slider/js/extensions/revolution.extension.parallax.min.js',true); ?>
        <?php $this->html()->js('revolution-slider/js/extensions/revolution.extension.slideanims.min.js',true); ?>
        <?php $this->html()->js('revolution-slider/js/extensions/revolution.extension.video.min.js',true); ?>

        <!-- Crée le code html pour insérer les js -->
        <?php $this->html()->display('js'); ?>

</body>
</html>