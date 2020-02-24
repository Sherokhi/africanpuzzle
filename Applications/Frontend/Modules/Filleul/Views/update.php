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
                <form method="post" id="updatePupil">
                    <fieldset>
                        <!-- section: Photo -->
                        <div class="row">
                            <div class="col-4 offset-4">
                                <label class="cabinet center-block">
                                <figure>
                                    <img name="pupilPhoto-rotate" src="<?php if($pupil['chiPicture'] !== 'x') { echo $this->html()->url(IMAGES_FOLDER.FOLDER_IMG_FILLEUL.$pupil['chiPicture']); } else { echo $this->html()->url(IMAGES_FOLDER.'no_photo.png'); } ?>" class="gambar img-responsive img-thumbnail" id="item-img-output" />
                                </figure>
                                <input type="file" class="item-img file center-block" name="uploadPupilPhoto" id="uploadPupilPhoto" value="<?php if($pupil['chiPicture'] !== 'x') { echo $this->html()->url(IMAGES_FOLDER.FOLDER_IMG_FILLEUL.$pupil['chiPicture']); } else { echo "x"; } ?>"/>
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
                                    <?php foreach($buildings as $building) {
                                        ?>
                                        <option value="<?php echo($building['idBuilding']); ?>" <?php if ($pupil['fkBuilding'] == $building['idBuilding']){ echo("selected"); } ?>><?php echo ($building['buiName']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Filière</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="filiation" id="pupilAddUpdateModalFiliation">
                                    <?php foreach($filiations as $filiation) {
                                        ?>
                                        <option value="<?php echo($filiation['idFiliation']); ?>" <?php if ($pupil['fkFiliation'] == $filiation['idFiliation']){ echo("selected"); } ?>><?php echo ($filiation['filName']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Formation</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="training" id="pupilAddUpdateModalTraining">
                                    <?php foreach($trainings as $training) {
                                        ?>
                                        <option value="<?php echo($training['idTraining']); ?>" <?php if ($pupil['fkTraining'] == $training['idTraining']){ echo("selected"); } ?>><?php echo ("Année ".$training['traYear'].' à '.$training['traCost']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="float-right">
                        <input id="pupilButtonSubmit" class="btn btn-info" type="button" value="Enregistrer"
                            onclick="submit_edit_pupil(<?php echo($pupil['idChild']); ?>)"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>