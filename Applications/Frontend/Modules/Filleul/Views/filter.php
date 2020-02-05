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
                <h3><?= $filiation ?></h3>
                <h3><li class="ion-arrow-right-c margin-left-right" data-pack="default"></li></h3>
                <h3><?= $cost ?></h3>
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
                                                <sup class="badge bg-danger"><?= $pupil['chiBirthDate'] ?></sup>
                                                <img class="shadow-z5 thumb48 rounded" src="img/pupils/logo-user.png" alt="header-user-image">
                                            </div>
                                            <div>
                                                <p class="my-1"><strong><?= $pupil['chiName'] . ' ' . $pupil['chiFirstName'] ?></strong></p><small><?= $pupil['chiAddress'] ?></small>
                                            </div>
                                            <div class="ml-auto mr-0 mt-0 mr-lg-auto ml-lg-0 mt-lg-4 ml-xl-auto mr-xl-0 mt-xl-0"><span class="budget p-2 badge badge-primary"><?= $pupil['traCost'] . ".-" ?></span><h3>
                                            <?php 
                                                // 0 -> private; 1 -> public
                                                if($pupil['buiState'] == 0) 
                                                {
                                                    echo "<li class=\"ion-university align-center\" data-pack=\"default\"></li>";
                                                }
                                                else 
                                                {
                                                    echo "<li class=\"ion-home align-center\" data-pack=\"default\"></li>";
                                                }
                                            ?>                                        
                                            </h3></div>
                                        </div>
                                    </div>
                                    <div class="cardbox-footer">
                                        <!-- START dropdown-->
                                        <div class="float-right">
                                            <h4>
                                                <button class="remove-button-style hover-pupil-icons" onclick="setPupil(<?= $pupil['idChild'] ?>, 2)"><li class="ion-chatbubble float-right padding-left" data-pack="default"></li></button>
                                                <button class="remove-button-style hover-pupil-icons" onclick="setPupil(<?= $pupil['idChild'] ?>, 0)"><li class="ion-compose float-right padding-left" data-pack="default"></li></button>
                                                <button class="remove-button-style hover-pupil-icons" onclick="setPupil(<?= $pupil['idChild'] ?>, 3)"><li class="ion-trash-a float-right padding-left" data-pack="default"></li></button>
                                            </h4>
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
