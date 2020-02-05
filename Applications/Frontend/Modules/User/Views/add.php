<div class="modal-dialog">
  <form id="form-add-user" role="form" novalidate="" method="post"  >
    <div class="modal-content" >
      
      <div class="modal-header">
        <h5 class="mt-0 modal-title"><strong>Ajout d'un utilisateur</strong></h5>
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
                <img name="useMemberPhoto" src="<?php echo $this->html()->url(IMAGES_FOLDER.'no_photo.png'); ?>" class="gambar img-responsive img-thumbnail" id="item-img-output" />
              </figure>
              <input type="file" class="item-img file center-block " name="uploadUserPhoto" id="uploadUserPhoto"/>
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
                    <option class="text-secondary" value="1">Monsieur</option>
                    <option class="text-secondary" value="2">Madame</option>
                    <option class="text-secondary" value="3">Famille</option>
                </select>
              </div>    
          </div> 
          
          <!-- section: Membre -->   
          <div class="col-7 text-center">
            <div class="mx-auto w-50 p-3 text-center">
              <label class="switch switch-warning">
                <input class="form-control" name="useMembership" type="checkbox" id="useMembership" ><span></span></label><strong>Membre</strong>      
            </div>
              
          </div> 
          
        </div>    
          
        <!-- section: Nom prénom -->   
        <div class="row">               
          <div class="col-5">
            <div class="form-group">
                <label  class="" id="useNameLabelInfo" for="useName"><strong>* Nom</strong></label>
                <label class="float-right text-warning" id="useNameLabel" for="useName"></label>
                <input type="text" class="form-control text-warning" name="useName" id="useName" placeholder="" required>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Champ obligatoire</div>
            </div>
          </div>

          <div class="col-7">
            <div class="form-group">
                <label class=""  id="useFirstNameLabelInfo" for="useFirstName"><strong>* Prénom</strong></label>
                <label class="float-right text-warning" id="useFirstNameLabel" for="useFirstName"></label>
                <input type="text" class="form-control text-warning" name="useFirstName" id="useFirstName" placeholder="" required>               
                <div class="invalid-feedback">Champ obligatoire</div>
            </div>
          </div>
        </div>               

        <!-- section: Adresse -->
        <div class="row">
          <div class="col-5">
            <div class="form-group">
                <label id="useAddressLabelInfo" for="useAddress"><strong>Adresse</strong></label>
                <label class="float-right" id="useAddressLabel" for="useAddress"></label>
                <input type="text" class="form-control text-warning" name="useAddress" id="useAddress" placeholder="">
            </div>
          </div>

          <div class="col-2 pr0">
            <div class="form-group">
                <label id="useNpaLabelInfo" for="useNpa"><strong>NPA</strong></label>
                <input type="text" class="form-control text-warning" name="useNpa" id="useNpa" placeholder="">
            </div>
          </div>
      
          <div class="col-5">
            <div class="form-group">
                <label id="useLocaliteLabelInfo" for="useLocalite"><strong>Localité</strong></label><label class="float-right" id="useLocaliteLabel" for="useLocalite"></label>
                <input type="text" class="form-control text-warning" name="useLocalite" id="useLocalite" placeholder="">
            </div>
          </div>
        </div>
        
         <!-- section: E-mail -->   
        <div class="row">               
          <div class="col-12">
            <div class="form-group">
                <label class=""  id="useMailLabelInfo" for="useMail"><strong>* E-mail</strong></label>
                <input type="mail" class="form-control text-warning" name="useMail" id="useMail" placeholder="" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">              
                <div class="invalid-feedback">Champ obligatoire ou mal renseigné</div>
            </div>
          </div>
        </div>

        <!-- section: téléphonne et groupe -->
        <div class="row">
          <div class="col-4">
            <div class="form-group">
                <label class="" id="useAddressLabelInfo" for="useAddress"><strong>* Tél.  (principal)</strong></label>
                <input type="text" class="form-control text-warning" name="useMobilePhone" id="useMobilePhone" placeholder="" required>              
                <div class="invalid-feedback">Champ obligatoire</div>
            </div>
          </div>

          <div class="col-4">
            <div class="form-group">
                <label id="usePhoneLabelInfo" for="usePhone"><strong>Tél.  (secondaire)</strong></label>
                <input type="text" class="form-control text-warning" name="usePhone" id="usePhone" placeholder="">
            </div>
          </div>
      
          <div class="col-4">
            <div class="form-group">
              <label for="useGroup"><strong>Comité - Groupe</strong></label> 
              <select name="useGroup" class="form-control text-warning" id="useGroup">
                  <option class="text-secondary" value="null"></option>
                  <option class="text-secondary" value="1">Direction</option>
                  <option class="text-secondary" value="2">Secrétariat</option>
                  <option class="text-secondary" value="3">Comptable</option>
                  <option class="text-secondary" value="4">Suppléant</option>
              </select>
            </div>
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <!-- fonction cancel_add_user() et submit_add_user() dans gestion.js -->
        <button type="button" class="btn btn-secondary" onclick="" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary" id="btnAdd_user" onclick="submit_add_user()" >Ajouter</button>
      </div>
    </div>
  </form>
</div>




