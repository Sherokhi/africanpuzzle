<!--********************************************************************************
 * Name:    add.php
 * Author:  Sam Pache
 * Date:    09.05.2019
 * Goal:    This page contains the modal to update or add a pupil
 **********************************************************************************-->
<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title" id="pupilModalHeaderLabel">Modification d'un Filleul</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                    class="text-danger fa fa-times"></i></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="form-div">
                <form method="post" id="addUpdatePupil">
                    <input type="hidden" name="id" id="pupilAddUpdateModalId" value="">
                    <fieldset>
                        <!-- section: Photo -->
                        <div class="row">
                            <div class="col-4 offset-4">
                                <label class="cabinet center-block">
                                <figure>
                                    <img name="pupilPhoto-rotate" src="<?php if($pupil['chiPicture'] !== 'x') { echo $this->html()->url(IMAGES_FOLDER.FOLDER_IMG_FILLEUL.$pupil['chiPicture']); } else { echo $this->html()->url(IMAGES_FOLDER.'no_photo.png'); } ?>" class="gambar img-responsive img-thumbnail" id="item-img-output" />
                                </figure>
                                <input type="file" class="item-img file center-block " name="uploadPupilPhoto" id="uploadPupilPhoto"/>
                                </label>
                            </div>        
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Nom</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" placeholder="Nom" name="name" value="<?php echo($pupil['chiName']); ?>"
                                    id="pupilAddUpdateModalName">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Prénom</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" placeholder="Prénom" name="firstName" value="<?php echo($pupil['chiFirstName']); ?>"
                                    id="pupilAddUpdateModalFirstName">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Adresse</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" placeholder="Adresse" name="address" value="<?php echo($pupil['chiAddress']); ?>"
                                    id="pupilAddUpdateModalAddress">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Père</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" placeholder="Père" name="dadsName" value="<?php  $parentsName = explode(';',$pupil['chiParentsNames']);  echo($parentsName[0]); ?>"
                                    id="pupilAddUpdateModalDad">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Mère</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" placeholder="Mère" name="mothersName" value="<?php  $parentsName = explode(';',$pupil['chiParentsNames']); echo($parentsName[1]); ?>"
                                    id="pupilAddUpdateModalMother">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Date de naissance</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" placeholder="aaaa-mm-jj" name="birthDate" value="<?php echo($pupil['chiBirthDate']); ?>"
                                    id="pupilAddUpdateModalBirthDate">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Parrain</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="sponsor" id="pupilAddUpdateModalSponsor">
                                    <option value="NULL">Aucun</option>
                                    <?php foreach($users as $user) {
                                        ?>
                                        <option value="<?php echo($user->idUser()); ?>" <?php if ($pupil['fkUser'] == $user->idUser()){ echo("selected"); } ?>><?php echo ($user->useName()." ".$user->useFirstName()); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Bâtiment</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="building" id="pupilAddUpdateModalBuilding">
                                    <option value="1">Public</option>
                                    <option value="2">Privé</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Filière</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="filiation" id="pupilAddUpdateModalFiliation">
                                    <option value="1">Primaire</option>
                                    <option value="2">Secondaire</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Formation</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="training" id="pupilAddUpdateModalTraining">
                                    <option value="1">Année 2019 à 60.-</option>
                                    <option value="3">Année 2019 à 75.-</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="float-right">
                        <input id="pupilButtonSubmit" class="btn btn-info" type="button" value="Enregistrer"
                            onclick="submit_add_pupil()"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>