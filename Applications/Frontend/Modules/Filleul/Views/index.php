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
<div id="pupil-modal" class="modal fade" role="dialog" data-toggle="modal"></div>


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
                        <!-- WIP total of pupils -->
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
                        <div class="col-md-2">
                            <div class="form-group">                                                               
                                <div class="input-group">
                                    <input id="agePupil" class="form-control" type="text" placeholder="Age ..." name="age" oninput="filter_Filleul(<?= date('Y') ?>, 1)">
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

                        <div class="col-md-2 offset-md-1">
                            <label class="switch switch-warning">
                                <input type="checkbox"  id="chk-is-primaire" checked="checked" name="primaire" onclick="filter_Filleul(<?= date('Y') ?>, 1)"><span></span>
                            </label>Primaire
                        </div>

                        <div class="col-md-2">
                            <label class="switch switch-warning">
                                <input type="checkbox" id="chk-is-secondaire" checked="checked" name="secondaire" onclick="filter_Filleul(<?= date('Y') ?>, 1)"><span></span>
                            </label>Secondaire
                        </div>
                    </div>            
                </form>
            </div>
        </div>
    </div>
</section>
<div id="pupilViewContent">
    <section class="section-liste-pupil">
        <div class="container-fluid">
            <div class="pupil_table_content"></div>

            <div class="cardbox">
                <div class="cardbox-heading">
                    <div class="table-responsive bootgrid">

                        <div class="overlay-pupil" style="display:none; font-size:36px; margin:5px; text-align:center;"><i class="fas fa-sync-alt fa-spin"></i></div>
                        <!-- insertion de la liste des filleuls voir méthode filter_pupil dans gestion.js-->
                        <div id="load-data-pupil"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- section: Table , liste des filleuls-->