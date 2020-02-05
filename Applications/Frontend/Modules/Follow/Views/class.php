<?php
//*********************************************************
// Societe: ETML
// Auteur : Lanz Romain
// Date : inconnue
// But : Afficher les suivis
//*********************************************************
// Modifications:
// Date : 20.05.2014
// Auteur : Lukyantsev  Vladislav
// Raison : Ajout du lien imprimer dans le menu option + ajouter la modalbox d'impression
//          ainsi que les class css "print-hidden" afin de masquer les elements non voulu lors d el'impression
//          Ajout de la gestion des droits dans le menu option
//*********************************************************

 if ($user->isAuthenticated()) { $right = $user->getAttribute('right'); 


//Création du menu option pour le controller student avec comme parametre l'id du student
//avec les options imprimer
$menu=array(
    "follow","","",@FOLLOW,$right,
    '<i class="icon-print"></i> Imprimer',"/class/print","","",@MODIFY
    );

echo $this->html()->optionmenu($menu);
} 

?>                                   
  <!-- 
Modal pour impression 
Cette modal box s'ouvrira lorsque l'utilisateur cliquera sur imprimer dans le menu option
-->
<div class="modal fade" id="PrintModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

 <!-- Titre de la modal box -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Impression</h4>
      </div>

      <div class="modal-body">
    
 <!-- Liste déroulante format police -->
        <div class="btn-group">
          <select id="tailleList" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" onchange="changeMediaStyle(document.getElementById('tailleList').value);">
            <option selected="selected">Format de texte</option>
            <option value="x-small">Très petit</option>
            <option value="small">Petit</option>
            <option value="medium">Moyen</option>
            <option value="large">Grand</option>
            <option value="x-large">Très Grand</option>
          </select>
        </div>

<!-- Liste déroulante police -->
        <div class="btn-group">
          <select id="policeList" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" onchange="changeMediaStyle(document.getElementById('policeList').value);">
            <option selected="selected">Police</option>
            <option value="TNR">Times New Roman</option>
            <option value="arial">Arial</option>  
            <option value="CenturyGothic">Century Gothic</option>
            <option value="EcoFont">EcoFont</option>   
          </select>
        </div>
<br/><br/>
<!-- Liste déroulante en-tete et pied de page -->
        <div class="btn-group">
          <select id="enteteList" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" onchange="changeMediaStyle(document.getElementById('enteteList').value);">
            <option selected="selected">En-tete</option>
            <option value="ETPPyes">oui</option>
            <option value="ETPPno">non</option>  
          </select>
        </div>


        <br/><br/>
      </div>
 <!-- Bouton modal box (fermer,imprimer) -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary" onclick="optionPrintPDF();">Enregistrer</button>
        <button type="button" class="btn btn-primary" onclick="optionPrint();">Imprimer</button>
      </div>

    </div>
  </div>
</div>

<!-- Fin de la modal box d'impression -->           

<div class="m10">
    <div class="widget-header"><i class="fa fa-heartbeat" aria-hidden="true"></i>
        <h5><?php echo $title; ?></h5>
		<h5 style="float:right;margin-right:10px;"><a onclick="toggleFilter();"><?php echo $this->h('Filtres '); ?><i class="fa fa-filter" aria-hidden="true"></i></a></h5>
    </div>

    <div class="widget-body clearfix">
        <table id="follow-table" class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo $this->h('Date'); ?></th>
                    <th><?php echo $this->h('Auteur'); ?></th>
                    <th><?php echo $this->h('Destinataire'); ?></th>
                    <th><?php echo $this->h('Classe'); ?></th>
                    <th><?php echo $this->h('Description'); ?></th>
                    <th><?php echo $this->h('Dernière modification'); ?></th>
                    <th class="print-hidden"></th>
                </tr>
            </thead>
            <tbody>



                <?php foreach($follows as $follow): ?>
                <tr>
                    <td><?php echo date_format($follow->add_date(), 'j F Y'); ?></td>
                    <td><a href="<?php echo $this->html()->url('colleague/'.$follow->colleague_id()); ?>"><?php echo $follow->colleague_first_name().' '.ucfirst(strtolower($follow->colleague_name())); ?></a></td>
                    <td><a href="<?php echo $this->html()->url('student/'.$follow->student_id()); ?>"><?php echo $follow->student_first_name().' '.$follow->student_name(); ?></a></td>
                    <td><a href="<?php echo $this->html()->url('class/'.$follow->student_class()); ?>"><?php echo $follow->student_class(); ?></a></td>
                    <td><?php echo $follow->content(); ?></td>
                    <td class="two-row"><?php if ($follow->mod_colleague_id()): ?>
                            <?php echo date_format($follow->mod_date(), 'j F Y'); ?><br/>
                            <a href="<?php echo $this->html()->url('colleague/'.$follow->mod_colleague_id()); ?>"><?php echo $follow->mod_colleague_first_name().' '.ucfirst(strtolower($follow->mod_colleague_name())); ?></a>
                        <?php else: ?>
                        -
                        <?php endif; ?>
                    </td>
                    <td class="print-hidden">
                        <a data-toggle="modal" href="<?php echo $this->html()->url('follow/'.$follow->id().'/edit'); ?>" data-target="#modFollow" class="btn mod"><i class="icon-pencil"></i></a>
                        <a href="<?php echo $this->html()->url('follow/'.$follow->id().'/delete'); ?>" class="btn mod" onclick="return confirm('Voulez vous vraiment supprimer ce suivi ?')"><i class="icon-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div id="modFollow" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Modification du suivi</h3>
        </div>
        <div class="modal-body follow"></div>
        <div class="modal-footer">
            <button id="btn-edit-follow" class="btn btn-primary" type="submit">Modifier</button>
        </div>
    </div>
</div>

<script>
var isFilterVisible = false;

function showFilters()
{
	var table_Props = {
		col_0: "none",
		col_1: "Select",
		col_2: "Select",
		col_3: "none",
		col_4: "none",
		col_5: "none",
		col_6: "none",
		col_7: "none",
		display_all_text: "[Tout]",
		sort_select: true,
		col_widths: [
            '100%', '100%', '100%',
            '100%', '100%', '100%',
            '100%', '100%'
		]
	};
	var tf2 = setFilterGrid("follow-table", table_Props);
	$('.fltrow').hide();
}

function toggleFilter(){
	if(isFilterVisible){
		$('.fltrow').slideUp( 0, "swing", function() {
			isFilterVisible = false;
		});
		
	}else{
		$('.fltrow').slideDown( 0, "swing", function() {
			isFilterVisible = true;
		});
	} 
}

window.onload = showFilters;
</script>
