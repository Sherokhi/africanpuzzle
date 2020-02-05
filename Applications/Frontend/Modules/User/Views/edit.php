

<div class="modal-dialog">
  <form method="post" id="form-edit-user" >
    <div class="modal-content" >
      
      <div class="modal-header">
        <h5 class="mt-0 modal-title"><strong>Modification d'un utilisateur</strong></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span>×</span></button>
      </div>

      <div class="modal-body">      

        <div id="modal-loader" style="display:none; text-align:center;">
          <i class="fa fa-spinner" style="font-size:48px;color:red"></i>
        </div>

        <div class="container">

        <!-- section: Photo --> 
        <div class="row">
          <div class="col-4 offset-4">
            <label class="cabinet center-block">
              <figure>
                <?php 
                  // photo par défaut si pas trouvée
                  $photo= IMAGES_FOLDER.'no_photo.png'; 
                  // Vérifie si l'utilisateur est connecté et s'il est connecté, affiche le bouton de déconnexion                               
                    
                    if (file_exists(WEBROOT.IMAGES_FOLDER.FOLDER_IMG_USER. $user->usePicture()) && $user->usePicture()<>""){
                        $photo = IMAGES_FOLDER.FOLDER_IMG_USER. $user->usePicture(); 
                    }      
                ?>
                <img name="useMemberPhoto" src="<?php echo $this->html()->url($photo); ?>" class="gambar img-responsive img-thumbnail" id="item-img-output" />
              </figure>
              <input type="file" class="item-img file center-block" name="uploadUserPhoto" id="uploadUserPhoto"/>
            </label>
          </div>        
        </div>
        
        <!-- section: Civilité et membre --> 
        <div class="row">
            
          <div class="col-5">
            <div class="form-group">
                <label for="useTitle"><strong>Civilité</strong></label> <label class="float-right" id="useTitleLabel" for="useTitle"></label>
                <select name="useTitle" class="form-control text-warning" id="useTitle">
                  <option class="text-secondary" value="null"></option>
                <!-- pour éviter trop de code -->
                <?php foreach($titles as $title) { ?>
                    <option class="text-secondary" value="<?php echo($title->idTitle());?>"
                    <?php 
                      if($title->idTitle() == $user->idTitle()){
                        echo(" selected");
                      }
                    ?>><?php echo($title->useTitle());?></option>
                    <?php } ?>

                </select>
              </div>    
          </div> 
          
          <div class="col-3 text-center">
            <div class="mx-auto w-50 p-3 text-center">
              <label class="switch switch-warning">
                <input name="useMembership" type="checkbox" id="useMembership" 
                  <?php 
                    if($user->useIsMember() == '1'){
                      echo(' checked=\"checked\"' );
                    }
                  ?>>
                <span></span></label>Membre       
            </div>
              
          </div> 

          <div class="col-3 text-center">
            <div class="mx-auto w-50 p-3 text-center">
              <label class="switch switch-info">
                <input name="useMemberActif" type="checkbox" id="useMemberActif" 
                  <?php 
                    if($user->useActif() == '1'){
                      echo(' checked=\"checked\"');
                    }
                  ?>>
                <span></span></label>Actif       
            </div>
              
          </div> 
          
        </div>    
          
        <!-- section: Nom prénom -->   
        <div class="row">               
          <div class="col-5">
            <div class="form-group">
                <label class="" id="useNameLabelInfo" for="useName"><strong>* Nom</strong></label><label class="float-right" id="useNameLabel" for="useName"></label>
                <input type="text" class="form-control text-warning" name="useName" id="useName" placeholder="Nom" required value="<?php echo($user->useName());?>">
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Champ obligatoire</div>
            </div>
          </div>

          <div class="col-7">
            <div class="form-group">
                <label id="useFirstNameLabelInfo" class="" for="useFirstName"><strong>* Prénom</strong></label><label class="float-right" id="useFirstNameLabel" for="useFirstName"></label>
                <input type="text" class="form-control text-warning" name="useFirstName" id="useFirstName" placeholder="Prénom" required value="<?php echo($user->useFirstName());?>">
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Champ obligatoire</div>
            </div>
          </div>
        </div>               

        <!-- section: Adresse -->
        <div class="row">
          <div class="col-5">
            <div class="form-group">
                <label id="useAddressLabelInfo" for="useAddress"><strong>Adresse</strong></label><label class="float-right" id="useAddressLabel" for="useAddress"></label>
                <input type="text" class="form-control text-warning" name="useAddress" id="useAddress" placeholder="Adresse" value="<?php echo($user->useAddress());?>">
            </div>
          </div>

          <div class="col-2 pr0">
            <div class="form-group">
                <label id="useNpaLabelInfo" for="useNpa"><strong>NPA</strong></label><label class="float-right" id="useNpaLabel" for="useNpa"></label>
                <input type="text" class="form-control text-warning" name="useNpa" id="useNpa" placeholder="Npa" value="<?php echo($user->usePstcode());?>">
            </div>
          </div>
      
          <div class="col-5">
            <div class="form-group">
                <label id="useLocaliteLabelInfo" for="useLocalite"><strong>Localité</strong></label><label class="float-right" id="useLocaliteLabel" for="useLocalite"></label>
                <input type="text" class="form-control text-warning" name="useLocalite" id="useLocalite" placeholder="Localité" value="<?php echo($user->useLocality());?>">
            </div>
          </div>
        </div>
        
         <!-- section: E-mail -->   
        <div class="row">               
          <div class="col-12">
            <div class="form-group">
                <label class="" id="useNameLabelInfo" for="useName"><strong>* E-mail</strong></label><label class="float-right" id="useMailLabel" for="useMail"></label>
                <input type="mail" class="form-control text-warning" name="useMail" id="useMail" placeholder="E-mail" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo($user->useEmail());?>">
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Champ obligatoire</div>
            </div>
          </div>
        </div>

        <!-- section: téléphonne et groupe -->
        <div class="row">
          <div class="col-4">
            <div class="form-group">
                <label id="useTel1LabelInfo" class="" for="useTel1"><strong>* Tél.  (principal)</strong></label><label class="float-right" id="useTel1Label" for="useTel1"></label>
                <input type="text" class="form-control text-warning" name="useTel1" id="useTel1" placeholder="Natel" value="<?php echo($user->useMobilePhone());?>">
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Champ obligatoire</div>
            </div>
          </div>

          <div class="col-4">
            <div class="form-group">
                <label id="useTel2LabelInfo" for="useTel2"><strong>Tél.  (secondaire)</strong></label><label class="float-right" id="useTel2Label" for="useTel2"></label>
                <input type="text" class="form-control text-warning" name="useTel2" id="useTel2" placeholder="Fixe" value="<?php echo($user->usePhone());?>">
            </div>
          </div>
      
          <div class="col-4">
            <div class="form-group">
              <label for="useGroup"><strong>Groupe</strong></label> <label class="float-right" id="useGroupLabel" for="useGroup"></label>
              <select name="useGroup" class="form-control text-warning" id="useGroup">
                <option class="text-warning" value="null"></option>
                   <!-- pour éviter trop de code -->
                    <?php 
                      $i=0;
                      foreach($groups as $group) { 
                        $i++;
                        if ($i<5){
                          echo ('<option class="text-secondary" value="'.$group->fkGroup().'"');

                          if($group->fkGroup() == $user->fkGroup()){
                            echo(" selected");
                          }
                          echo('>'.$group->useGroupName().'</option>');
                       } 
                      } 
                    ?>
                 
              </select>
            </div>
          </div>
        </div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary" id="edit_user"  onclick="submit_edit_user('<?= $user->idUser(); ?>')">modifier</button>
      </div>
    </div>
  </form>
</div>




