<!--********************************************************************************
 * Name:    modCommentPupil.php
 * Author:  Sam Pache
 * Date:    09.05.2019
 * Goal:    This page contains the modal to comment the profile of a pupil
 **********************************************************************************-->
<div id="pupilModalComment" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="pupilCommentModalHeaderLabel">Ajouter un commentaire</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="text-danger fa fa-times"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <!--<p class="text-intro">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>-->
                <div class="form-div">
                    <form method="post" id="commentPupil" >
                        <fieldset>
                            <div class="form-group row">                                
                                <div class="col-lg-12">
                                    <div class="note-area">
                                        <textarea class="form-control" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="float-right">
                            <button id="pupilCommentButtonSubmit" class="btn btn-info" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>