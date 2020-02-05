<?php

/********************************************************************************
 * Nom:    index.php
 * Auteur: Dimitrios Lymberis
 * Date:    28.05.2019
 * But:    Cette page permet d'afficher une liste des utilisateurs 
 *
 *      dans cette page on utilise un graphique à l'aide de la librairie chart.js
 *      pour comprendre son fonctionnement voir :
 *      https://www.sitepoint.com/introduction-chart-js-2-0-six-examples/
 *
 *
 **********************************************************************************/
?>


<!--  ------------------------------------------------------------------------------
     modal PoPup pour :
            - modification, ajout et suppression d'un utilisateur 
            voir les méthodes dans gestion.js
------------------------------------------------------------------------------------  -->
<div id="user-modal" class="modal fade " role="dialog" data-toggle="modal"></div>

<!--  ------------------------------------------------------------------------------
     modal PoPup pour : http://www.croppic.net/ ou https://foliotek.github.io/Croppie/
            - edition rognage de la photo d'utilisateur cette popup modal s'affiche lors 
            du click sur la photo dans la modal d'ajout d'utilisateur 
            voir les méthodes dans gestion.js
------------------------------------------------------------------------------------  -->
<div class="modal fade" id="cropImageUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="mt-0 modal-title">Editer la photo</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span>×</span></button>
          
      </div>
      <div class="modal-body">
      <div class="row">
		<div class="col-8">
            <div id="upload-user-photo" ></div>
        </div>
        <div class="col-4">
            <div class="cardbox">
                <div class="cardbox-heading">
                    <div>Rotation</div>
                </div>
                <div class="cardbox-body">
                    <div class="text-center">
                        <button class="btn btn-circle btn-secondary usrPhoto-rotate" data-deg="90" type="button" title="rotation de -90"><i class="fas fa-undo"></i></button>
                        &nbsp;
                        <button class="btn btn-circle btn-secondary usrPhoto-rotate" data-deg="-90" type="button" title="rotation de +90"><i class="fas fa-undo fa-flip-horizontal"></i></button>    
                    </div>
                </div>
            </div>
        </div>
    </div>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="button" id="cropImageBtn" class="btn btn-primary">Rogner</button>
      </div>
    </div>
  </div>
</div>

<div class="user_content"></div>
<div id="action_alert" title="Action"> </div>

<!-- section: filtre utilisateur -->
<section class="section-filter-user">
    <div class="container-fluid pb-0">

        <div class="cardbox mb-0">

            <div class="cardbox-heading">
                
                <div class="row text-center">
					<div class="col-md-2">
						<div class="counter">
						  <i class="fas fa-hand-holding-usd fa-2x text-warning"></i>
						  <h3 class="timer count-title count-number" data-to="100" data-speed="1500" ><span id="nbreMembre"><?=$nbreM; ?></span></h3>
						  <p class="count-text ">Membres</p>
						</div>
                    </div>

                    <div class="col-md-2">
					   <div class="counter">
						  <i class="fas fa-hands fa-2x text-warning"></i>
						  <h3 class="timer count-title count-number" data-to="1700" data-speed="1500" ><span id="nbreParrainage"><?=$nbrePM; ?></span></h3>
						  <p class="count-text ">Parrains - Marraines</p>
						</div>
					</div>
                    
                    <div class="col-md-4 text-center pt-2">
						<h2>Liste des utilisateurs</h2>
						<p>(membres - parrains - marraines - donateurs)</p>
                    </div>
                    
                    <div class="col-md-4 text-center">
                    <h2>Ajouter</h2>
                    <p><button type="button" class="btn btn-success" onclick="add_user()" >+</button></p>
                    </div> 
													  								
                </div>
               
            </div>
            
            <!-- Filtre-->
            <div id="userFilter"  class="cardbox-body tooltip-userFilter"  data-toggle="tooltip" data-title="Tous les utilisateurs actifs">
                <div class="row">
                    <div class="col-md-2 offset-md-1" >
                        <label class="switch switch-warning">
                            <input type="checkbox"  id="chk-is-member" onclick="filter_user()"><span></span>
                        </label>Membre                   
                    </div>

                    <div class="col-md-2">
                        <label class="switch switch-warning">
                            <input type="checkbox"  id="chk-is-godparent" onclick="filter_user()"><span></span>
                        </label>Parrain - Marraine                    
                    </div>
                        
                    <div class="col-md-2">
                        <label class="switch switch-warning">
                            <input type="checkbox"   id="chk-is-giver" onclick="filter_user()"><span></span>
                        </label>Donateur                    
                    </div>  

                    <div class="col-md-2">
                        <label class="switch switch-warning">
                            <input type="checkbox" id="chk-is-incommittee" onclick="filter_user()"><span></span>
                        </label>Comité                    
                    </div>

                    <div class="col-md-2">
                        <label class="switch switch-puple">
                            <input type="checkbox" checked="checked" id="chk-is-active" onclick="filter_user()"><span></span>
                         </label>Actif                      
                    </div>                                     
                </div>            
            </div>
        </div>
    </div>
</section>





<!-- section: Table , liste des  utilisateurs-->
<section class="section-liste-user">
    <div class="container-fluid">
        <div class="user_table_content"></div>

        <div class="cardbox">
            <div class="cardbox-heading">
                <div class="table-responsive bootgrid">
                    
                    <div class="overlay-user" style="display:none; font-size:36px; margin:5px; text-align:center;"><i class="fas fa-sync-alt fa-spin"></i></div>
                    <!-- insertion de la liste des utilisateurs voir méthode filter_user dans gestion.js-->
                    <div id="load-data-user"></div>
            
                </div>
            </div>
        </div>
    </div>
</section>


		