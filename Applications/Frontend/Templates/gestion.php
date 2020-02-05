<?php
/****************************************************************************
Nom: 	gestion.php
Auteur: DLS
Date:	30.01.2019
But: 	Page par défaut du site de gestion d'african puzzle
 *****************************************************************************/
?>
<!DOCTYPE html>
<html lang="fr">
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
<link href="<?php echo $this->html()->url('images/favicon.ico'); ?>" rel="shortcut icon" type="image/png">
<link href="<?php echo $this->html()->url('images/apple-touch-icon.png'); ?>" rel="apple-touch-icon">
<link href="<?php echo $this->html()->url('images/apple-touch-icon-72x72.png'); ?>" rel="apple-touch-icon" sizes="72x72">
<link href="<?php echo $this->html()->url('images/apple-touch-icon-114x114.png'); ?>" rel="apple-touch-icon" sizes="114x114">
<link href="<?php echo $this->html()->url('images/apple-touch-icon-144x144.png'); ?>" rel="apple-touch-icon" sizes="144x144">

<!-- ----- Les fichiers CSS ----------- -->
<!-- ---------------------------------- -->
<!-- BOOTSTRAP  v4 -->
<?php $this->html()->css('dasha_template/bootstrap/dist/css/bootstrap.css',true); ?>


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">

<!-- Select2-->
<?php $this->html()->css('dasha_template/select2/dist/css/select2.css',true); ?>


<!-- Range Slider-->
<?php $this->html()->css('dasha_template/nouislider/distribute/nouislider.min.css',true); ?>


<!-- Animate.CSS-->
<?php $this->html()->css('dasha_template/animate.css/animate.css',true); ?>


<!-- Ionicons-->
<?php $this->html()->css('dasha_template/ionicons/dist/css/ionicons.css',true); ?>

<!-- Material Colors-->
<?php $this->html()->css('dasha_template/material-colors/dist/colors.css',true); ?>

<!-- Datatables -->
<?php $this->html()->css('dasha_template/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css',true); ?>
<?php $this->html()->css('dasha_template/datatables.net-keytable-bs/css/keyTable.bootstrap.min.css',true); ?>
<?php $this->html()->css('dasha_template/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css',true); ?>


<?php $this->html()->css('dasha_template/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css',true); ?>
<?php $this->html()->css('dasha_template/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css',true); ?>
<?php $this->html()->css('dasha_template/multiselect/css/multi-select.css',true); ?>

<?php $this->html()->css('sweetalert2/sweetalert2.css',true); ?>

<!-- retouche image upload Crop-->
<?php $this->html()->css('crop_image/croppie.css',true); ?>


<!-- Template Dasha styles-->
<?php $this->html()->css('dasha_template/dasha.css', true); ?>
<!-- Application styles-->
<?php $this->html()->css('slywork.min.css'); ?>
<?php $this->html()->css('style.css'); ?>
<!-- ---------------------------- -->
<!-- ----- FIN fichiers CSS ----- -->

<!-- Crée le code html pour insérer les CSS -->
<?php $this->html()->display('css'); ?>


<!-- ----- Les fichiers JS  ----------- -->
<!-- ---------------------------------- -->
<!-- doit s'initialiser avant bootstrap pour les tooltips-->
<?php $this->html()->js('dasha_template/popper.js/dist/umd/popper.min.js',true); ?>
<!-- Bootstrap-->
<?php $this->html()->js('dasha_template/bootstrap/dist/js/bootstrap.js',true); ?>


<!-- Range Slider-->
<?php $this->html()->js('dasha_template/nouislider/distribute/nouislider.js',true); ?>

<!-- utili pour slider -->
<?php $this->html()->js('dasha_template/bootstrap-datepicker/js/bootstrap-datepicker.js',true); ?>
    
<!-- Clockpicker-->
<?php $this->html()->js('dasha_template/clockpicker/dist/bootstrap-clockpicker.js',true); ?>

<!-- ColorPicker-->
<?php $this->html()->js('dasha_template/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js',true); ?>

<!-- Multiselect-->
<?php $this->html()->js('dasha_template/multiselect/js/jquery.multi-select.js',true); ?>

<!-- Select2-->
<?php $this->html()->js('dasha_template/select2/dist/js/select2.js',true); ?>

<!-- PaceJS-->
<?php $this->html()->js('dasha_template/pace-progress/pace.min.js',true); ?>

<!-- Material Colors-->
<?php $this->html()->js('dasha_template/material-colors/dist/colors.js',true); ?>

<!-- Screenfull-->
<?php $this->html()->js('dasha_template/screenfull/dist/screenfull.js',true); ?>

<!-- jQuery Localize-->
<?php $this->html()->js('dasha_template/jquery-localize/dist/jquery.localize.js',true); ?>


<!-- Datatables -->
<?php $this->html()->js('dasha_template/datatables.net/js/jquery.dataTables.js',true); ?>
<?php $this->html()->js('dasha_template/datatables.net-buttons/js/dataTables.buttons.min.js',true); ?>
<?php $this->html()->js('dasha_template/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js',true); ?>
<?php $this->html()->js('dasha_template/datatables.net-buttons/js/buttons.colVis.js',true); ?>
<?php $this->html()->js('dasha_template/datatables.net-buttons/js/buttons.flash.min.js',true); ?>

<?php $this->html()->js('datatables/extensions/Buttons/js/jszip.min.js',true); ?>
 <?php $this->html()->js('datatables/extensions/Buttons/js/pdfmake.min.js',true); ?>
 <?php $this->html()->js('datatables/extensions/Buttons/js/vfs_fonts.min.js',true); ?>
  
<?php $this->html()->js('dasha_template/datatables.net-buttons/js/buttons.html5.min.js',true); ?>
<?php $this->html()->js('dasha_template/datatables.net-buttons/js/buttons.print.min.js',true); ?>
<?php $this->html()->js('dasha_template/datatables.net-keytable/js/dataTables.keyTable.min.js',true); ?>
<?php $this->html()->js('dasha_template/datatables.net-responsive/js/dataTables.responsive.min.js',true); ?>
<?php $this->html()->js('dasha_template/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js',true); ?>

<!-- Flot charts-->
<?php $this->html()->js('dasha_template/flot/jquery.flot.js',true); ?>
<?php $this->html()->js('dasha_template/flot/jquery.flot.categories.js',true); ?>
<?php $this->html()->js('dasha_template/jquery.flot.spline/jquery.flot.spline.js',true); ?>
<?php $this->html()->js('dasha_template/jquery.flot.tooltip/js/jquery.flot.tooltip.js',true); ?>
<?php $this->html()->js('dasha_template/flot/jquery.flot.resize.js',true); ?>
<?php $this->html()->js('dasha_template/flot/jquery.flot.pie.js',true); ?>
<?php $this->html()->js('dasha_template/flot/jquery.flot.time.js',true); ?>
<?php $this->html()->js('dasha_template/sidebysideimproved/jquery.flot.orderBars.js',true); ?>

<!-- Sparkline-->
<?php $this->html()->js('dasha_template/jquery-sparkline/jquery.sparkline.js',true); ?>

<!-- jQuery Knob charts-->

<?php $this->html()->js('dasha_template/jquery-knob/js/jquery.knob.js',true); ?>

<!-- retouche image upload Crop-->
<?php $this->html()->js('dasha_template/modernizr/modernizr.custom.js',true); ?>

<!-- Sweet Alert https://sweetalert2.github.io/#download -->
<?php $this->html()->js('sweetalert2/sweetalert2.js',true); ?>

<!-- TOASTR-->
<?php $this->html()->js('dasha_template/toastr/build/toastr.min.js', true); ?>

<!-- retouche image upload Crop-->
<?php $this->html()->js('crop_image/croppie.js',true); ?>

<!-- Dasha script-->
<?php //$this->html()->js('dasha_template/dasha.js', true); ?>

<!-- African script général-->
<?php $this->html()->js('african.js'); ?>

<!-- African script pour la gestion-->
<?php $this->html()->js('gestion.js'); ?>



<!-- ---------------------------- -->
<!-- ----- FIN fichiers JS ----- -->


</head>

<body class="theme-default">

<?php if ($user->isAuthenticated()){  
  if(!$this->app->user()->getAttribute('isInCD')){
    
    $this->app->httpResponse()->redirect(WWW_ROOT);

} }?>

    <div class="layout-container">
      <!-- top navbar-->
      <header class="header-container">
        <nav>
          <ul class="d-lg-none">
            <li><a class="sidebar-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
          </ul>
          <ul class="d-none d-sm-block">
            <li><a class="covermode-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
          </ul>
          <img class="pl-5" src="<?php echo $this->html()->url(IMAGES_FOLDER.'Logo_sansPuzzle.png'); ?>" alt="" width="250px">     
          
          <ul class="float-right pr10">
      
              <img src="<?php echo $this->html()->url(IMAGES_FOLDER.'Logo_simple.png'); ?>" width="40" alt=""></img>
              <li class="text-warning pr10"><em>Un espoir de scolarité pour tous ...</em></li>
            </ul>

        </nav>
      </header>
      <!-- sidebar-->
      <aside class="sidebar-container">
        
        <div class="brand-header">
          <div class="float-left pt-4 text-muted sidebar-close"><em class="ion-arrow-left-c icon-lg"></em></div><a class="brand-header-logo" href="<?php echo $this->html()->url('gestion'); ?>">
              <!-- Logo Imageimg(src="img/logo.png", alt="logo")
              --><span class="brand-header-logo-text">GESTION</span></a>
          </div>

        <div class="sidebar-content">
          <div class="sidebar-toolbar">
            <div class="sidebar-toolbar-background"></div>    
            <div class="sidebar-toolbar-content text-center pt-0">

                <?php 
                // photo par défaut si pas trouvée
                $photo= IMAGES_FOLDER.'no_photo.png'; 
                // Vérifie si l'utilisateur est connecté et s'il est connecté, affiche le bouton de déconnexion                
                
                  
                  if (file_exists(WEBROOT.IMAGES_FOLDER.FOLDER_IMG_USER. $user->getAttribute('user')->usePicture())){
                      $photo = IMAGES_FOLDER.FOLDER_IMG_USER. $user->getAttribute('user')->usePicture(); 
                  }      
                  ?>

                <a href="#"><img class="rounded-circle" height="120px" src="<?php echo $this->html()->url($photo); ?>" alt="Profile"></a>
              <div class="mt-3">
                <div class="lead"><?php echo ucfirst(strtolower($user->getAttribute('user')->useFirstName())).' '.ucfirst(strtolower($user->getAttribute('user')->useName()));?></div>
                <div class="text-thin text-warning"><?php echo $user->getAttribute('user')->useGroupName(); ?></div>
              </div>
            </div>        
          </div>
          <nav class="sidebar-nav">
            <ul>
            <li><a href="<?php echo $this->html()->url();?>"><span class="float-right nav-label"></span><span class="nav-icon"><em class="ion-ios-speedometer-outline"></em></span><span>Accueil</span></a></li>
              <!-- gestion des entités de base-->
              <li><a href="<?php echo $this->html()->url('user');?>"><span class="nav-icon"><em class="ion-person-stalker"></em></span><span>Utilisateurs</span></a></li>
              <li><a href="<?= $this->html()->url('filleul') ?>"><span class="nav-icon"><em class="ion-university"></em></span><span>Filleuls</span></a></li>
              <li><a href="<?php echo $this->html()->url('user');?>"><span class="nav-icon"><em class="ion-social-usd"></em></span><span>Comptabilité</span></a></li>
            </ul>
          </nav>
        </div>
      </aside>
      <div class="sidebar-layout-obfuscator"></div>
      <!-- Main section-->
      <main class="main-container">
        <!-- Page content-->
        <section class="section-container">

          <!-- page content 
         ------------------- -->
          <?php echo $content; ?>
          <!-- /page content -->

        </section>
        <!-- Page footer-->
        <footer class="footer-container">
        </footer>
      </main>
    </div>
    
    

    <script src="plugins/dasha_template/jquery/dist/jquery.js"></script>
    <?php $this->html()->display('js'); ?>





</body>
</html>
