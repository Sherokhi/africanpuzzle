<table class="table table-striped bootgrid-table" id="datatable-pupils" aria-busy="false">
    <thead>
    <tr>
        <th data-column-id="name">Filleul</th>
        <th data-column-id="parents">Parents</th>
        <th data-column-id="age">Age</th>
        <th data-column-id="birthdate">Date de naissance</th>
        <th data-column-id="commands"></th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach($pupils as $pupil) {
        ?>
        <!-- HTML CODE -->
        <tr data-row-id="<?= $pupil['idChild'] ?>">
            <td class="text-left">

                <div class="d-flex flex-wrap">
                    <?php
                    // photo par défaut si pas trouvée
                    $photo= IMAGES_FOLDER.'no_photo.png';

                    if (file_exists(WEBROOT.IMAGES_FOLDER.FOLDER_IMG_FILLEUL. $pupil['chiPicture']) and  $pupil['idChild']<>""){
                        $photo = IMAGES_FOLDER.FOLDER_IMG_FILLEUL. $pupil['chiPicture'];
                    }
                    ?>
                    <div class="mr-4"><img class="shadow-z5 thumb_user48 rounded" src="<?php echo $this->html()->url($photo); ?>" alt="pupil"></div>
                    <div>
                        <p class="my-1"><strong><?= strtoupper ($pupil['chiName']) ?></strong>&nbsp; <?= $pupil['chiFirstName'] ?></p>
                        <small><?= $pupil['chiAddress'] ?></small>
                    </div>
                </div>
            </td>
            <td class="text-left">
                <div class="d-flex flex-wrap ">
                    <?php $parents = explode(";",$pupil['chiParentsNames']) ?>
                    <?= $parents[0] ?> et <?= $parents[1] ?>
                </div>
            </td>

            <td class="text-left">
                <p class="my-1"><?= $pupil['chiAge'] ?></p>
            </td>

            <td class="text-left"><?= $pupil['chiBirthDate'] ?></td>

            <td class="text-left">

                <i class="far fa-comment width-30 height-30 f-s-20 text-center ico-crud" onclick="add_pupil_comment(<?= $pupil['idChild'] ?>,<?php echo $this->app->user()->getAttribute('user')->idUser(); ?>)"  title="Ajouter un commentaire" style="line-height: 30px"></i>
                <i class="fas fa-edit width-30 height-30 f-s-20 text-center ico-crud" onclick="edit_pupil(<?= $pupil['idChild'] ?>, 0)" title="Modifier" style="line-height: 30px"></i>
                <i class="far fa-trash-alt width-30 height-30 f-s-20 text-center ico-crud" onclick="delete_pupil(<?= $pupil['idChild'] ?>)" title="Supprimer"  style="line-height: 30px"></i>

            </td><!-- COMMANDS -->
        </tr>
        <?php
    } //Closing the foreach
    ?>
    </tbody>
</table>
<?php
/**
 * Created by PhpStorm.
 * User: jerperret
 * Date: 28.02.2020
 * Time: 14:20
 */