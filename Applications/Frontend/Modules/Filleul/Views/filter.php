<?php
/********************************************************************************
 * Name:    filter.php
 * Author:  Sam Pache
 * Date:    22.05.2019
 * Goal:    This page allows the display of the pupils depending on the filter
 **********************************************************************************/

$counter = 0;
if(!empty($filiations))
{


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
                                            <i class="fas fa-edit width-30 height-30 f-s-20 text-center ico-crud" onclick="setPupil(<?= $pupil['idChild'] ?>, 0)" title="Modifier" style="line-height: 30px"></i>
                                            <i class="far fa-trash-alt width-30 height-30 f-s-20 text-center ico-crud" onclick="setPupil(<?= $pupil['idChild'] ?>, 3)" title="Supprimer"  style="line-height: 30px"></i>
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


}

?>
