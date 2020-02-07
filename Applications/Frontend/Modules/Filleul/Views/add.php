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
            <h4 class="modal-title" id="pupilModalHeaderLabel">Ajout d'un Filleul</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                    class="text-danger fa fa-times"></i></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="form-div">
                <form method="post" id="addPupil">
                    <input type="hidden" name="id" id="pupilAddUpdateModalId" value="">
                    <fieldset>
                        <!-- section: Photo -->
                        <div class="row">
                            <div class="col-4 offset-4">
                                <label class="cabinet center-block">
                                <figure>
                                    <img name="pupilPhoto-rotate" src="<?php echo $this->html()->url(IMAGES_FOLDER.'no_photo.png'); ?>" class="gambar img-responsive img-thumbnail" id="item-img-output" />
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
                                <input class="form-control" type="text" placeholder="Nom" name="name"
                                    id="pupilAddUpdateModalName">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Prénom</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" placeholder="Prénom" name="firstName"
                                    id="pupilAddUpdateModalFirstName">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Adresse</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" placeholder="Adresse" name="address"
                                    id="pupilAddUpdateModalAddress">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Père</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" placeholder="Père" name="dadsName"
                                    id="pupilAddUpdateModalDad">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Mère</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" placeholder="Mère" name="mothersName"
                                    id="pupilAddUpdateModalMother">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Date de naissance</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" placeholder="aaaa-mm-jj" name="birthDate"
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
                                        <option value="<?php echo($user->idUser()); ?>"><?php echo ($user->useName()." ".$user->useFirstName()); ?></option>

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
                                        <option value="<?php echo($building['idBuilding']); ?>"><?php echo ($building['buiName']); ?></option>
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
                                        <option value="<?php echo($filiation['idFiliation']); ?>"><?php echo ($filiation['filName']); ?></option>
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
                                        <option value="<?php echo($training['idTraining']); ?>"><?php echo ("Année ".$training['traYear'].' à '.$training['traCost']); ?></option>
                                    <?php } ?>
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