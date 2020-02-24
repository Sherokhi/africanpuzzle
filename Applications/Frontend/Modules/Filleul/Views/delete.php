<div class="modal-dialog modal-dialog-centered">
  <form method="post" id="form-edit-user" >
    <div class="modal-content" >
      
      <div class="modal-header">
        <h5 class="mt-0 modal-title"><strong>Suppression d'un filleul</strong></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span>×</span></button>
      </div>

      <div class="modal-body">      

        <div id="modal-loader" style="display:none; text-align:center;">
          <i class="fa fa-spinner" style="font-size:48px;color:red"></i>
        </div>

        <div class="container">
            <div class="row text-center">
                <div class="col-md-12 text-center pt-2">
                    <h2>Êtes-vous sure de vouloir supprimer le filleul</h2>
                    <p><?php echo $pupil['chiName']," ",$pupil['chiFirstName']; ?></p>
                </div>
            </div>

            <div class="row text-center">
                <div class="col-sm-12 form-group">
                    <span class="font-italic text-danger"><strong>Toutes les infos en relation avec le filleul seront supprimées totalement du site et vous ne pourrez pas les récupérer !</strong></span>
                </div>
            </div>
  
        </div>

       
      </div>

      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" id="add_user"  onclick="submit_delete_pupil('<?php echo($pupil['idChild']);?>')">Supprimer</button>
      </div>
    </div>
  </form>
</div>




