<table class="table table-striped bootgrid-table" id="datatable-users" aria-busy="false">
<thead>
    <tr>
        <th data-column-id="name">Nom</th>
        <th data-column-id="firstname">Localité</th>
        <th data-column-id="adress">Contact</th>            
        <th data-column-id="email">Email</th>            
        <th data-column-id="phone" data-sortable="false">Type</th>                                  
        <th data-column-id="commands" data-formatter="commands" data-sortable="false"></th>
    </tr>
</thead>

 <tbody>
        <?php 
            foreach($lstUsers as $user) {                   
        ?>
                <!-- HTML CODE -->
                <tr data-row-id="<?= $user->idUser() ?>">
                    <td class="text-left">
                    
                    <div class="d-flex flex-wrap">
                        <?php 
                        // photo par défaut si pas trouvée
                        $photo= IMAGES_FOLDER.'no_photo.png'; 
                                                                             
                        if (file_exists(WEBROOT.IMAGES_FOLDER.FOLDER_IMG_USER. $user->usePicture()) and  $user->usePicture()<>""){
                            $photo = IMAGES_FOLDER.FOLDER_IMG_USER. $user->usePicture(); 
                        }      
                        ?>
                        <div class="mr-4"><img class="shadow-z5 thumb_user48 rounded" src="<?php echo $this->html()->url($photo); ?>" alt="user"></div>
                        <div>
                            <p class="my-1 <?= (($user->is_comite())?'text-warning':''); ?>"><strong><?= strtoupper ($user->useName()) ?></strong>&nbsp; <?= $user->useFirstName() ?></p>
                            <small><?= $user->useAddress() ?></small>
                            
                        </div>
                    </div>
                        
                
                    </td>
                    <td class="text-left">
                        <div class="d-flex flex-wrap ">
                            <?= $user->usePstcode() ?>&nbsp;<?= $user->useLocality() ?>
                        </div>  
                    </td>
                    <td class="text-left">                                            
                        <p class="my-1"><?= $user->useMobilePhone() ?></p>
                        <p class="my-1"><?= $user->usePhone() ?></p>
                                                        
                    </td>
                    <td class="text-left"><?= $user->useEmail() ?></td>
                    <td class="text-left">
                    

                        <!-- Membre -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="check_M" disabled <?= (($user->useisMember())?'checked':''); ?>>
                            <label class="custom-control-label" for="check_M">M</label>
                        </div>

                        <!-- Parrain -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="check_P" disabled <?= (($user->is_godParent())?'checked':''); ?>>
                            <label class="custom-control-label" for="check_P">P-M</label>
                        </div>

                            <!-- Donateur -->
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="check_D" disabled <?= (($user->is_donateur())?'checked':''); ?>>
                            <label class="custom-control-label" for="check_D">D</label>
                        </div>

                    </td>
                        
                    <td class="text-left">
                        
                                <button type="button" class="btn btn-sm btn-info command-delete" data-row-id="10253" ><em class="ion-search"></em></button> &nbsp;
                            
                                <button type="button" class="btn btn-sm btn-info mr-2 command-edit" data-row-id="10253" onclick="edit_user('<?php echo($user->idUser());?>')"><em class="ion-edit"></em></button>
                             
                                <button type="button" class="btn btn-sm btn-danger command-delete" data-row-id="10253" onclick="delete_user('<?php echo($user->idUser());?>')"><em class="ion-trash-a"></em></button>
                               
                    </td><!-- COMMANDS -->
                </tr>
        <?php
            } //Closing the foreach 
        ?>
</tbody>
</table>