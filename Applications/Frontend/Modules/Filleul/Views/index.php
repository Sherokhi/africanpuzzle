<?php
/********************************************************************************
 * Name:    index.php
 * Author:  Sam Pache
 * Date:    08.05.2019
 * Goal:    This page allows the display of the pupils
 * 
 * Modif:   13.06.2019
 * Author:  Dimitrios Lymberis 
 * Reason:  Adaptation su site gestafrican puzzle
 **********************************************************************************/
?>

<!--  ------------------------------------------------------------------------------
     modal PoPup pour :
            - modification, ajout et suppression d'un filleul 
            voir les méthodes dans gestion.js
------------------------------------------------------------------------------------  -->
<div id="pupil-modal" class="modal fade " role="dialog" data-toggle="modal"></div>


<!--  ------------------------------------------------------------------------------
     modal PoPup pour : http://www.croppic.net/ ou https://foliotek.github.io/Croppie/
            - edition rognage de la photo d'utilisateur cette popup modal s'affiche lors 
            du click sur la photo dans la modal d'ajout d'utilisateur 
            voir les méthodes dans gestion.js
------------------------------------------------------------------------------------  -->
<div class="modal fade" id="cropImagePupil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="mt-0 modal-title">Editer la photo</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span>×</span></button>
          
      </div>
      <div class="modal-body">
      <div class="row">
		<div class="col-8">
            <div id="upload-pupil-photo" ></div>
        </div>
        <div class="col-4">
            <div class="cardbox">
                <div class="cardbox-heading">
                    <div>Rotation</div>
                </div>
                <div class="cardbox-body">
                    <div class="text-center">
                        <button class="btn btn-circle btn-secondary pupilPhoto-rotate" data-deg="90" type="button" title="rotation de -90"><i class="fas fa-undo"></i></button>
                        &nbsp;
                        <button class="btn btn-circle btn-secondary pupilPhoto-rotate" data-deg="-90" type="button" title="rotation de +90"><i class="fas fa-undo fa-flip-horizontal"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="button" id="cropImagePupil" class="btn btn-primary">Rogner</button>
      </div>
    </div>
  </div>
</div>

<!-- section: filtre utilisateur -->
<section class="section-filter-user">
    <div class="container-fluid pb-0">

        <div class="cardbox mb-0">

            <div class="cardbox-heading">
                
                <div class="row text-center">
					<div class="col-md-1">
						<div class="counter">
						  <i class="fas fa-graduation-cap fa-2x text-warning"></i>
                            <h3 class="timer count-title count-number" data-to="100" data-speed="1500"><span id="nbrPrimaire"><?= $totByFiliation[FIL_PRIMAIRE]["tot_by_filiation"] ?></span></h3>
						  <p class="count-text ">Primaire</p>
						</div>
                    </div>

                    <div class="col-md-1">
					   <div class="counter">
						  <i class="fas fa-user-graduate fa-2x text-warning"></i>
                           <h3 class="timer count-title count-number" data-to="1700" data-speed="1500"><span id="nbrSecondaire"><?= $totByFiliation[FIL_SECONDAIRE]["tot_by_filiation"] ?></span></h3>
						  <p class="count-text ">Secondaire</p>
						</div>
                    </div>
                    
                    <div class="col-md-1">
						<div class="counter">
						  <i class="fas fa-school fa-2x text-warning"></i>
                            <h3 class="timer count-title count-number" data-to="100" data-speed="1500"><span id="nbrPublic"><?= $buildings[FIL_PUBLIC] ?></span></h3>
						  <p class="count-text ">Public</p>
						</div>
                    </div>

                    <div class="col-md-1">
					   <div class="counter">
						  <i class="fas fa-university fa-2x text-warning"></i>
                           <h3 class="timer count-title count-number" data-to="1700" data-speed="1500"><span id="nbrPrive"><?= $buildings[FIL_PRIVE] ?></span></h3>
						  <p class="count-text ">Privé</p>
						</div>
					</div>
                    
                    <div class="col-md-4 text-center pt-2">
						<h2>Liste des filleuls</h2>
						<p>( xxx )</p>
                    </div>
                    
                    <div class="col-md-4 text-center">
                    <h2>Ajouter</h2>
                    <p><button type="button" class="btn btn-success" onclick="add_pupil()" >+</button></p>
                    </div> 
													  								
                </div>
               
            </div>

            <!-- Filtre-->
            <div class="cardbox-body">
                <form id="searchPupilForm">
                    <div class="row">
                        <div class="col-md-2 offset-md-1">
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="searchPupil" class="form-control" type="text" placeholder="Recherche ..." name="search" onchange="filter_Filleul(<?= date('Y') ?>, 1)">
                                    <span class="input-group-text" >
                                        <i class="ion-search" data-pack="default"></i>
                                    </span>
                                </div>
                            </div>                 
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">                                                               
                                <div class="input-group">
                                    <input id="agePupil" class="form-control" type="text" placeholder="Age ..." name="age" onchange="filter_Filleul(<?= date('Y') ?>, 1)">
                                    <span class="input-group-text" >
                                        <i class="ion-search" data-pack="default"></i>
                                    </span>
                                </div>
                            </div>                 
                        </div>
                            
                        <div class="col-md-2 offset-md-1">
                            <label class="switch switch-warning">
                                <input type="checkbox"  id="chk-is-prive" checked="checked" name="prive" onclick="filter_Filleul(<?= date('Y') ?>, 1)"><span></span>
                            </label>Privé                    
                        </div>  

                        <div class="col-md-2">
                            <label class="switch switch-warning">
                                <input type="checkbox" id="chk-is-public" checked="checked" name="public" onclick="filter_Filleul(<?= date('Y') ?>, 1)"><span></span>
                            </label>Public                    
                        </div>
                    </div>            
                </form>
            </div>
        </div>
    </div>
</section>

<div id="pupilContent" class="container-fluid pb-0">

<?php
$counter = 0;
foreach($filiations as $filiation => $cost)
{
?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <h3><strong>&nbsp;<?= $filiation ?>&nbsp;</strong><small><i class="far fa-hand-point-right" ></i>&nbsp;<strong style="color: #c3522e;"><?= $cost ?></strong></small></h3>
        </div>
    </div>
    <div>
        <div class="card-body">
            <!-- COUNTER new row each 3 objects -->
            <div class="row">
                <!-- OBJECT START -->
                <?php 
                foreach($pupils as $pupil)
                {
                    if($pupil['filName'] == $filiation) 
                    {                   
                ?>

                        <div class="col-3">
                            
                            <!-- pupil card -->
                            <div class="cardbox">
                                <div class="pb-1 bg-gradient-primary top-line"></div>

                                <div class="cardbox-body">
                                    <div class="d-flex flex-wrap">
                                        <div class="has-badge">
                                            <sup class="badge bg-warning"><?= $pupil['chiBirthDate'] ?></sup>
                                            <?php 
                                            // photo par défaut si pas trouvée
                                            $photo= IMAGES_FOLDER.'no_photo.png'; 
                                            
                                            if (file_exists(WEBROOT.IMAGES_FOLDER.FOLDER_IMG_FILLEUL. $pupil['chiPicture'])){
                                                $photo = IMAGES_FOLDER.FOLDER_IMG_FILLEUL. $pupil['chiPicture']; 
                                            }   
                                            ?>
                                            <img class="shadow-z5 filleul-thumb rounded" src="<?php echo $this->html()->url($photo); ?>" alt="header-user-image">
                                        </div>
                                        <div class="pl-3">
                                            <p class="my-1"><strong><?= $pupil['chiName'] . ' ' . $pupil['chiFirstName'] ?></strong></p><small><?= $pupil['chiAddress'] ?></small>
                                        </div>
                                        <div class="ml-auto mr-0 mt-0 mr-lg-auto ml-lg-0 mt-lg-4 ml-xl-auto mr-xl-0 mt-xl-0"><span class="budget p-2 badge badge-primary"><?= $pupil['traCost'] . ".-" ?></span><h3>
                                        <?php 
                                            // 0 -> private; 1 -> public
                                            if($pupil['buiState'] == 0) 
                                            {
                                                echo '<i class="fas fa-university  text-warning" title="Privé"></i>';
                                            }
                                            else 
                                            {
                                                echo '<i class="fas fa-school text-warning" title="Public"></i>';
                                            }
                                        ?>                                        
                                        </h3></div>
                                    </div>
                                </div>

                                <div class="cardbox-footer">
                                        <!-- START dropdown-->
                                        <div class="float-right dropdown">
                                            <i class="far fa-comment width-30 height-30 f-s-20 text-center ico-crud" onclick="setPupil(<?= $pupil['idChild'] ?>, 2)"  title="Ajouter un commentaire" style="line-height: 30px"></i>
                                            <i class="fas fa-edit width-30 height-30 f-s-20 text-center ico-crud" onclick="edit_pupil(<?= $pupil['idChild'] ?>, 0)" title="Modifier" style="line-height: 30px"></i>
                                            <i class="far fa-trash-alt width-30 height-30 f-s-20 text-center ico-crud" onclick="delete_pupil(<?= $pupil['idChild'] ?>)" title="Supprimer"  style="line-height: 30px"></i>
                                        </div> 
                                        <!-- END dropdown-->

                                    <p class="mb-0"><small><em class="ion-record text-danger mr-2"></em></small><small class="text-muted"><strong class="mr-2">
                                    <?php 
                                        // If the pupil has no sponsor
                                        if(empty($pupil['useName']) && empty($pupil['useFirstName'])) 
                                        {
                                            echo "Sans parrain";
                                        }
                                        else 
                                        {
                                            echo $pupil['useName'] . " " . $pupil['useFirstName']; 
                                        }
                                    ?>
                                    </strong></small></p>
                                </div>
                            
                            </div>
                            <!-- end of pupil card -->
                        </div>

                <?php
                    } // Closing the if statement (filiation)
                }
                ?>
            </div>
        </div>
    </div>  
</div>

<?php
}

?>

</div><!-- #pupilContent -->