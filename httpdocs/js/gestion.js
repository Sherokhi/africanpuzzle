/*
$('#btnAdd_user').click(function(event) {

    // Fetch form to apply custom Bootstrap validation
    var form = $("#form-add-user");

    if (form[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    }
    
    form.addClass('was-validated');
    // Perform ajax submit here...
    
});
*/
/***
 --------------------------------------------------------
* *** 						filterPupil						***
* --------------------------------------------------------
*
* ETML
* Author 		: Sam Pache
* Date 		    : 20.05.2019
* Sumary 	    : Allows the user to filter the pupils
*
* @param year 		    --> current year
* @param filtered       --> filtered or not
                            0 --> false
                            1 --> true
* ---------------------------------------------------------
*/
function filter_Filleul(year, filtered)
{
    if(filtered == 0)
    {
        // Set all pupil query
        var birthYear = "";
        var buiState = '0 OR 1';
        var filName = "primaire OR t_filiation.filName = secondaire";
        // var buiState = "0 OR 1";

        $.ajax({
            type : "POST",
            dataType : "html",
            url : "filleul/view",
            data :
                {
                    "birthYear" : birthYear,
                    "buiState" : buiState,
                    "filName" : filName
                }
        }).done(function(data){
            $("#load-data-pupil").html(data);
            datatablesRefresh('#datatable-pupils');
        });
    }
    else if (filtered == 1)
    {
        // Get the filter data
        var filter = $('#searchPupilForm').serializeArray();

        var age = Number(filter[0].value);
        var birthYear = year - age;
        var buiState = undefined;
        var filName = undefined;
        var buiFilters = [];
        var filFilters = [];
        for (item in filter) {
            if(filter[item].name == 'prive' || filter[item].name == 'public'){
                buiFilters.push(filter[item].name);
            }
            if(filter[item].name == 'primaire' || filter[item].name == 'secondaire'){
                filFilters.push(filter[item].name);
            }
        }

        if(buiFilters.length == 2){
            buiState = 2;
        }
        else {
            switch(buiFilters[0])
            {
                case "prive" :
                    buiState = "0";
                    break;
                case "public" :
                    buiState = "1";
                    break;
                default :
                    buiState = undefined;
                    break;
            }
        }
        if(filFilters.length == 2){
            filName = filFilters[0]+' OR t_filiation.filName ='+filFilters[1];
        }
        else {
            filName = filFilters[0];
        }
        // Check types and values of the filters
        // Set null to wrong filters

        // If birthYear is not defined, the age hasn't been entered or the value is not a number
        if(typeof birthYear == 'undefined' || birthYear == year || isNaN(age))
        {
            birthYear = null;
        }
        
        if(typeof buiState == 'undefined')
        {
            buiState = null;
        }
        else if(buiState == 2)
        {
            buiState = "0 OR 1";
        }


        if(typeof filName == 'undefined')
        {
            filName = null;
        }
        $.ajax({
            type : "POST",
            dataType : "html",
            url : "filleul/view",
            data :
                {
                    "birthYear" : birthYear,
                    "buiState" : buiState,
                    "filName" : filName
                }
        }).done(function(data){
            $("#load-data-pupil").html(data);
            datatablesRefresh('#datatable-pupils');

        });
    }
}


(function() {
    'use strict';

    $(viewUsers);

    /* --------------------------------------------------------------------- */
    /* --------------------Liste des utilisateurs -------------------------- */
    /* --------------------------------------------------------------------- */
    function viewUsers(){
        $('#load-data-user').html(null);
        $('.overlay-user').css('display','block');
    
        $.ajax({
            type:'POST',
            url:'user/view',
            dataType:'html',
            data: 'view_all=true'
        }).done(function(data){
            $('.overlay-user').css('display','none');
            $('#load-data-user').append(data);
            datatablesRefresh('#datatable-users');
        });
    }

})();

(function() {
    'use strict';

    $(viewPupils);

    /* --------------------------------------------------------------------- */
    /* --------------------Liste des filleuls -------------------------- */
    /* --------------------------------------------------------------------- */
    function viewPupils(){
        $('#load-data-pupil').html(null);
        $('.overlay-pupil').css('display','block');
        $.ajax({
            type:'POST',
            url:'filleul/view',
            data : 'html'
        }).done(function(data){
            $('.overlay-pupil').css('display','none');
            $('#load-data-pupil').append(data);
            datatablesRefresh('#datatable-pupils');
        });
    }

})();

/* ------------------------------------------------------------------- */
/* --------------------Formate la datatable  ------------------------- */
/* ------------------------------------------------------------------- */
function datatablesRefresh(idTableToRefrech) {

    if (!$.fn.dataTable) return;       

    // Filter
    $(idTableToRefrech).DataTable({
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
            'paging': true, // Table pagination
            'ordering': true, // Column ordering
            'info': true, // Bottom left status text
            // Text translation options
            // Note the required keywords between underscores (e.g _MENU_)
            oLanguage: {"sProcessing":     "Traitement en cours...",
                "sSearch":         "Rechercher&nbsp;:",
                "sLengthMenu":     "Afficher&nbsp;  _MENU_ &eacute;l&eacute;ments &nbsp;",
                "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst":      "Premier",
                    "sPrevious":   "Pr&eacute;c&eacute;dent",
                    "sNext":       "Suivant",
                    "sLast":       "Dernier"
                },
                "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                },
                "select": {
                        "rows": {
                            _: " %d lignes séléctionnées",
                            0: " Aucune ligne séléctionnée",
                            1: " 1 ligne séléctionnée"
                        } 
                }
            },
            "iDisplayLength": 5,
            "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Tous"]],
            // Datatable Buttons setup
            dom: 'lBfrtip',
            buttons: [
                { extend: 'copy', className: 'btn-info' },
                { extend: 'csv', className: 'btn-info' },
                { extend: 'excel', className: 'btn-info', title: 'XLS-File' },
                { extend: 'pdf', className: 'btn-info', title: $('title').text() }
            ]
        });       
}


/* --------------------------------------------------------
 * *** 					add_user        		    	 ***
 * ---------------------------------------------------------
 * ETML
 * Auteur 		    : Dimitrios Lymberis
 * Date 		    : 02.06.2019
 * Description 		: Ajout d'un utilisateur
 *                    le contenu html de la page add.php 
 *                    du module user s'insère dans 
 *                    la modal popup d'ajout
 * -------------------------------------------------------- */
function add_user(){
    $('#user-modal').html(null);
    $.ajax({
        url:'user/add',
        dataType:'html',
    }).done(function(html){
        $('#user-modal').append(html);
        $('#user-modal').modal("show");
    });
}



/* ---------------------------------------------------------
 * *** 			  submit_add_user        		    	 ***
 * ---------------------------------------------------------
 * ETML
 * Auteur 		    : Dimitrios Lymberis
 * Date 		    : 02.06.2019
 * Description 		: s'enclenche depuis le bouton d'ajout
 *                    de la modal popup ajout d'un utilisateur
 * -------------------------------------------------------- */
function submit_add_user(){

// Fetch form to apply custom Bootstrap validation
var form = $("#form-add-user");

if (form[0].checkValidity() === false) {
  event.preventDefault();
  event.stopPropagation();
  form.addClass('was-validated');
}
else{


        // on récupère les données du formulaire d'ajout
        var userFormData = $('#form-add-user').serializeArray();

        // on ajoute la valeur de  useIsMember (si il a pas checker il n'est pas récupéreé !)
        userFormData[userFormData.length] = {
            'name' : 'useIsMember',
            'value' : $('#useMembership').prop('checked') | 0  // POUR TRANSFORMER LES FALSE EN 0 ET TRUE EN 1
        };
        var userData = {};

        //on transforme les données du formulaire en un tableau associatif (json)
        userFormData.forEach(function(element) {
            userData[element.name]=element.value;
        });

        // on récupère la photo au format "binaire"  
        var userPhoto =$('#item-img-output').attr('src');   

        $.ajax({
            type:"POST",
            url:"user/submit_add",
            dataType:'json',
            data : 
            {
                'userData' : JSON.stringify(userData),
                'userPhoto' : userPhoto
            },
        }).done(function(data){

        

            // on vérifie qu'il n'y a pas d'erreurs
            if ((!data.msgErr == ''))
                {
                    Swal.fire(data.msgTitle, data.msgErr, 'error');
                    
                    return;
                }
                else{
                    
                    $('#user-modal').modal("hide");
                    filter_user(false);
                    Swal.fire('Ajout!', "<p> L'utilisateur <em><strong class='text-warning'>"+ userData['useFirstName']  + " " + userData['useName'] + "</strong></em> a bien été ajouté !</p>", 'success');
  
                    update_count(data.nbreParrainage,data.nbreMembre);
                    
                }
                
            
        }).fail(function (jqXHR, textStatus) {
            Swal.fire('ERREUR!', textStatus, 'error');
        });  

    }

}


function edit_user(id){
    $('#user-modal').html(null);

    $.ajax({
        type:'GET',
        url:'user/'+id+'/edit',
        dataType:'html',
    }).done(function(html){
        $('#user-modal').append(html);
        $('#user-modal').modal("show");
    });
}


/* *
* ---------------------------------------------------------
 * *** 			  submit_edit_user        		    	 ***
 * ---------------------------------------------------------
 * ETML
 * Auteur 		    : Dimitrios Lymberis
 * Date 		    : 02.06.2019
 * Description 		: -
 * -------------------------------------------------------- */
function submit_edit_user(id){

    var form = $("#form-edit-user");

if (form[0].checkValidity() === false) {
  event.preventDefault();
  event.stopPropagation();
  form.addClass('was-validated');
}
else{
    // on récupère les données du formulaire d'ajout
    var userFormData = $('#form-edit-user').serializeArray();

    
    // on ajoute la valeur de  useIsMember (si il a pas checker il n'est pas récupéreé !)
    userFormData[userFormData.length] = {
        'name' : 'useIsMember',
        'value' : $('#useMembership').prop('checked') | 0
        
    };

    userFormData[userFormData.length] = {
        'name' : 'useIsActif',
        'value' : $('#useMemberActif').prop('checked') | 0
        
    };
    
    var userData = {};

    //on transforme les données du formulaire en un tableau associatif (json)
    userFormData.forEach(function(element) {
        userData[element.name]=element.value;
    });

    // on récupère la photo au format "binaire"  
    var userPhoto =$('#item-img-output').attr('src');   

    $.ajax({
        type:"POST",
        url:"user/submit_edit",
        dataType:'json',
        data : 
        {
            'userData' : JSON.stringify(userData),
            'userPhoto' : userPhoto,
            'idUser' : id
        },
    }).done(function(data){
        // on vérifie qu'il n'y a pas d'erreurs
        if ((!data.msgErr == ''))
			{
                Swal.fire(data.msgTitle, data.msgErr, 'error');
				
				return;
            }
            else{
                filter_user(false);
                Swal.fire('Edition!', "<p> L'utilisateur <em><strong class='text-warning'>"+ userData['useFirstName']  + " " + userData['useName'] + "</strong></em> a bien été modifié !</p>", 'success'); 
                $('#user-modal').modal("hide");
                
                update_count(data.nbreParrainage,data.nbreMembre);
            }
              
        
    }).fail(function (jqXHR, textStatus) {
        Swal.fire('ERREUR!', textStatus, 'error');
   });  
}
   
}



/* ---------------------------------------------------------
 * *** 			  delete_user        		    	     ***
 * ---------------------------------------------------------
 * ETML
 * @author 		    : Dimitrios Lymberis
 * Date 		    : 18.01.2020
 * @description		: supprime un utilisateur
 * @param           : id --> identifiant de l'utilisateur
 * -------------------------------------------------------- */
function delete_user(id){
    $('#user-modal').html(null)

    $.ajax({
        type:'GET',
        url:'user/'+id+'/delete',
        dataType:'html',
    }).done(function(html){
        $('#user-modal').append(html);
        $('#user-modal').modal("show");
    });
}

/* ---------------------------------------------------------
 * *** 			  submit_delete_user        		     ***
 * ---------------------------------------------------------
 * ETML
 * Auteur 		    : Dimitrios Lymberis
 * Date 		    : 17.01.2020
 * Description 		: supprime un utilisateur
 * Paramètre        : id --> identifiant de l'utilisateur
 * -------------------------------------------------------- */
function submit_delete_user(id){
    $.ajax({
        type:"GET",
        dataType:"html",
        url:"user/"+id+"/submit_delete",
    }).done(function(data){

        result = JSON.parse(data);
        Swal.fire('Suppression!', "L'utilisateur <em><strong class='text-warning'>"+ result.user + "</strong></em> a bien été supprimé !", 'success');
        
        $('#user-modal').modal("hide");

        // pour éviter que le tooltip du filtre sur les utilisateurs s'enclenche (aléatoire)
        $('#userFilter').tooltip('dispose').tooltip('hide');

        
        filter_user(false);
        update_count(result.nbreParrainage,result.nbreMembre);
       
    });
    
}

/* --------------------------------------------------------
 * *** 					add_pupil        		    	 ***
 * ---------------------------------------------------------
 * ETML
 * Auteur 		    : Jérémie Perret
 * Date 		    : 06.02.2020
 * Description 		: Ajout d'un filleul
 *                    le contenu html de la page add.php 
 *                    du module user s'insère dans 
 *                    la modal popup d'ajout
 * -------------------------------------------------------- */
function add_pupil(){

    $('#pupil-modal').html(null);
    $.ajax({
        url:'filleul/add',
        dataType:'html',
    }).done(function(html){
        $('#pupil-modal').append(html);
        $('#pupil-modal').modal("show");
    });
}

/* ---------------------------------------------------------
 * *** 			  submit_add_pupil        		    	 ***
 * ---------------------------------------------------------
 * ETML
 * Auteur 		    : Jérémie Perret
 * Date 		    : 06.02.2020
 * Description 		: s'enclenche depuis le bouton d'ajout
 *                    de la modal popup ajout d'un utilisateur
 * -------------------------------------------------------- */
function submit_add_pupil(){

    // Fetch form to apply custom Bootstrap validation
    var form = $("#addPupil");
            // on récupère les données du formulaire d'ajout
            var pupilFormData = form.serializeArray();
    
            var pupilData = {};
    
            //on transforme les données du formulaire en un tableau associatif (json)
            pupilFormData.forEach(function(element) {
                pupilData[element.name]=element.value;
            });
    
            // on récupère la photo au format "binaire"  
            var pupilPhoto =$('#item-img-output').attr('src');
            $.ajax({
                type:"POST",
                url:"filleul/submit_add",
                dataType:'json',
                data : 
                {
                    'pupilData' : JSON.stringify(pupilData),
                    'pupilPhoto' : pupilPhoto
                },
            }).done(function(data){
                // on vérifie qu'il n'y a pas d'erreurs
                if ((!data.msgErr == ''))
                    {
                        Swal.fire(data.msgTitle, data.msgErr, 'error');
                        
                        return;
                    }
                    else{
                        $('#pupil-modal').modal("hide");
                        var today = new Date();
                        filter_Filleul(today.getFullYear(), 1);
                        Swal.fire('Ajout!', "<p> Le filleul <em><strong class='text-warning'>"+ pupilData['name']  + " " + pupilData['firstName'] + "</strong></em> a bien été ajouté !</p>", 'success');
                        update_count_pupil(data.totByFiliation[0]['tot_by_filiation'], data.totByFiliation[1]['tot_by_filiation'], data.totByBuilding[0], data.totByBuilding[1])
                }
                    
                
            }).fail(function (jqXHR, textStatus) {
                Swal.fire('ERREUR!', textStatus, 'error');
            });  
    
        // }
    
    }


/* --------------------------------------------------------
 * *** 					add_pupil_comment  		    	 ***
 * ---------------------------------------------------------
 * ETML
 * Auteur 		    : Jérémie Perret
 * Date 		    : 27.02.2020
 * Description 		: Ajout d'un commentaire pour un filleul
 *                    le contenu html de la page addComment.php
 *                    du module user s'insère dans
 *                    la modal popup d'ajout
 * -------------------------------------------------------- */
function add_pupil_comment(idChild){

    $('#pupil-modal').html(null);
    $.ajax({
        url:'filleul/'+idChild+'/comment/add',
        dataType:'html',
    }).done(function(html){
        $('#pupil-modal').append(html);
        $('#pupil-modal').modal("show");
    });
}

/* --------------------------------------------------------
 * *** 				submit_add_pupil_comment	    	 ***
 * ---------------------------------------------------------
 * ETML
 * Auteur 		    : Jérémie Perret
 * Date 		    : 27.02.2020
 * Description 		: Ajout d'un commentaire pour un filleul
 *                    le contenu html de la page addComment.php
 *                    du module user s'insère dans
 *                    la modal popup d'ajout
 * -------------------------------------------------------- */
function submit_add_pupil_comment(idChild){
    // Fetch form to apply custom Bootstrap validation
    formData = $('#commentPupil').serialize();

    $.ajax({
        type:"POST",
        url:"filleul/"+idChild+"/comment/add_submit",
        dataType:'json',
        data : formData
    }).done(function(data){
        // on vérifie qu'il n'y a pas d'erreurs
        if ((!data.msgErr == ''))
        {
            Swal.fire(data.msgTitle, data.msgErr, 'error');

            return;
        }
        else{
            $('#pupil-modal').modal("hide");
            var today = new Date();
            filter_Filleul(today.getFullYear(), 1);
            // Swal.fire('Ajout!', "Ouuuuuuaaaaaiiis", 'success');
            Swal.fire('Ajout!', "<p> Le commentaire pour <em><strong class='text-warning'>"+ data.pupil + "</strong></em> a bien été ajouté !</p>", 'success');
        }


    }).fail(function (jqXHR, textStatus) {
        Swal.fire('ERREUR!', textStatus, 'error');
    });

}

/* *
 * ---------------------------------------------------------
 * *** 			      edit_pupil        		    	 ***
 * ---------------------------------------------------------
 * ETML
 * Auteur 		    : Jérémie Perret
 * Date 		    : 02.07.2020
 * Description 		: -
 * -------------------------------------------------------- */
function edit_pupil(id){
    $('#pupil-modal').html(null);

    $.ajax({
        type:'GET',
        url:'filleul/'+id+'/edit',
        dataType:'html',
    }).done(function(html){
        $('#pupil-modal').append(html);
        $('#pupil-modal').modal("show");
    });
}

/* *
 * ---------------------------------------------------------
 * *** 			  submit_edit_pupil        		    	 ***
 * ---------------------------------------------------------
 * ETML
 * Auteur 		    : Jérémie Perret
 * Date 		    : 07.02.2020
 * Description 		: -
 * -------------------------------------------------------- */
function submit_edit_pupil(id){

    var form = $("#updatePupil");

    if (form[0].checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
        form.addClass('was-validated');
    }
    else{
        // on récupère les données du formulaire d'ajout
        var pupilFormData = $('#updatePupil').serializeArray();

        var pupilData = {};

        //on transforme les données du formulaire en un tableau associatif (json)
        pupilFormData.forEach(function(element) {
            pupilData[element.name]=element.value;
        });

        // on récupère la photo au format "binaire"
        var pupilPhoto =$('#item-img-output').attr('src');
        $.ajax({
            type:"POST",
            url:"/filleul/"+id+"/submit_edit",
            dataType:'json',
            data :
                {
                    'pupilData' : JSON.stringify(pupilData),
                    'pupilPhoto' : pupilPhoto,
                    'idPupil' : id
                },
        }).done(function(data){
            // on vérifie qu'il n'y a pas d'erreurs
            if ((!data.msgErr == ''))
            {
                Swal.fire(data.msgTitle, data.msgErr, 'error');

                return;
            }
            else{
                var today = new Date();
                filter_Filleul(today.getFullYear(), 1);
                Swal.fire('Edition!', "<p> Le filleul <em><strong class='text-warning'>"+ pupilData.firstName  + " " + pupilData.name + "</strong></em> a bien été modifié !</p>", 'success');
                $('#pupil-modal').modal("hide");
                update_count_pupil(data.totByFiliation[0]['tot_by_filiation'], data.totByFiliation[1]['tot_by_filiation'], data.totByBuilding[0], data.totByBuilding[1])
            }


        }).fail(function (jqXHR, textStatus) {
            Swal.fire('ERREUR!', textStatus, 'error');
        });
    }

}

/* ---------------------------------------------------------
 * *** 			  delete_pupil        		    	     ***
 * ---------------------------------------------------------
 * ETML
 * @author 		    : Jérémie Perret
 * Date 		    : 12.02.2020
 * @description		: supprime un filleul
 * @param           : id --> identifiant du filleul
 * -------------------------------------------------------- */
function delete_pupil(id){
    $('#pupil-modal').html(null);

    $.ajax({
        type:'GET',
        url:'filleul/'+id+'/delete',
        dataType:'html',
    }).done(function(html){
        $('#pupil-modal').append(html);
        $('#pupil-modal').modal("show");
    });
}

/* ---------------------------------------------------------
 * *** 			  submit_delete_pupil        		     ***
 * ---------------------------------------------------------
 * ETML
 * Auteur 		    : Jérémie Perret
 * Date 		    : 12.02.2020
 * Description 		: supprime un filleul
 * Paramètre        : id --> identifiant du filleul
 * -------------------------------------------------------- */
function submit_delete_pupil(id){
    $.ajax({
        type:"GET",
        dataType:"html",
        url:"filleul/"+id+"/submit_delete",
    }).done(function(data){

        result = JSON.parse(data);
        Swal.fire('Suppression!', "Le filleul <em><strong class='text-warning'>"+ result.pupil + "</strong></em> a bien été supprimé !", 'success');

        $('#pupil-modal').modal("hide");

        var today = new Date();
        filter_Filleul(today.getFullYear(), 1);
        update_count_pupil(result.totByFiliation[0]['tot_by_filiation'], result.totByFiliation[1]['tot_by_filiation'], result.totByBuilding[0], result.totByBuilding[1])
    });
}

function filter_user(tooltipShow=true){
    
    $('#load-data-user').html(null);
    $('.overlay-user').css('display','block');
   
    // on récupère les infos du filtre
    view_actual=$('#chk-is-active').prop("checked");
    view_incommittee=$('#chk-is-incommittee').prop("checked");
    view_giver=$('#chk-is-giver').prop("checked");
    view_godparent=$('#chk-is-godparent').prop("checked");
    view_member=$('#chk-is-member').prop("checked");
    
    //texte filtre de base
    msgUsrFilter="Tous les utilisateurs";

    $.ajax({
        type:'POST',
        url:'/user/view',
        dataType:'html',
        data: {
            'view_all' : false,
            'view_actual' : view_actual,
            'view_incommittee' : view_incommittee,
            'view_giver' : view_giver,
            'view_godparent' : view_godparent,
            'view_member' : view_member
        }
    }).done(function(data){
        $('.overlay-user').css('display','none');
        $('#load-data-user').html(data);
        datatablesRefresh('#datatable-users');
        labelUserFilterRefresh();
    });

    function labelUserFilterRefresh(){

        if (view_actual){
            msgUsrFilter+=" actifs";
        }else{
            msgUsrFilter+=" non actifs";
        }

        if (view_incommittee){
            msgUsrFilter+=" du comité";
        }

        if (view_giver){
            msgUsrFilter+=" qui sont à la fois donateurs";
        }

        if (view_godparent){
            if (view_giver){
            msgUsrFilter+=", parrains ou marraines";
            }else{
                msgUsrFilter+=" qui sont à la fois parrains ou marraines";
            }
        }

        if (view_member){
            msgUsrFilter+=" et membres de l'association";
        }

        // petite astuce pour ne pas voir s'afficher le tooltip après un ajout, edition et suppression 
        if (tooltipShow){
            $('#userFilter').tooltip('dispose').tooltip({title: msgUsrFilter}).tooltip('show');
        }else{
            $('#userFilter').tooltip('dispose').tooltip({title: msgUsrFilter}).tooltip('hide');
        }       
    }
}


function update_count(nbreParrainage,nbreMembre){
    
    document.getElementById("nbreParrainage").innerHTML=nbreParrainage;
    document.getElementById("nbreMembre").innerHTML=nbreMembre;

}

function update_count_pupil(nbrPrimaire,nbrSecondaire,nbrPublic,nbrPrive){
    document.getElementById("nbrPrimaire").innerHTML=nbrPrimaire;
    document.getElementById("nbrSecondaire").innerHTML=nbrSecondaire;
    document.getElementById("nbrPublic").innerHTML=nbrPublic;
    document.getElementById("nbrPrive").innerHTML=nbrPrive;
}

//User picture
var $uploadCrop,
tempFilename,
rawImg,
imageId;

function readFile_user(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.upload-user-photo').addClass('ready');
            $('#cropImageUser').modal('show');
            $("#user-modal").modal('hide');
            rawImg = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
    else {
        Swal.fire("Sorry - you're browser doesn't support the FileReader API");
    }
};

$uploadCrop = $('#upload-user-photo').croppie({
    viewport: {
        width: 150,
        height: 200,
    },
    boundary: {
        width: 300,
        height: 300
    },
    enforceBoundary: false,
    enableOrientation: true
});

$("#user-modal").on('change', '.item-img', function () {
    imageId = $(this).data('id'); 
    tempFilename = $(this).val();
    $('#cancelCropBtn').data('id', imageId); readFile_user(this);
});

$('#cropImageUser').on('shown.bs.modal', function(){

    $uploadCrop.croppie('bind', {
        url: rawImg
    }).then(function(){
        console.log('jQuery bind complete');
    });
});

$('#cropImageBtn').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'base64',
        format: 'jpeg',
        size: {width: 150, height: 200}
    }).then(function (resp) {
        $('#item-img-output').attr('src', resp);
        $('#cropImageUser').modal('hide');
        $("#user-modal").modal('show');
    });
});

/* permet la rotation de l'image */
$('.usrPhoto-rotate').on('click', function(ev) {
    console.log(parseInt($(this).data('deg')));
    $uploadCrop.croppie('rotate', parseInt($(this).data('deg')));
});

//Pupil picture
var $uploadCropPupil,
tempFilenamePupil,
rawImgPupil,
imageIdPupil;

function readFile_pupil(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.upload-pupil-photo').addClass('ready');
            $('#cropImagePupil').modal('show');
            $("#pupil-modal").modal('hide');
            rawImgPupil = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
    else {
        Swal.fire("Sorry - you're browser doesn't support the FileReader API");
    }
};

$uploadCropPupil = $('#upload-pupil-photo').croppie({
    viewport: {
        width: 150,
        height: 200,
    },
    boundary: {
        width: 300,
        height: 300
    },
    enforceBoundary: false,
    enableOrientation: true
});

$("#pupil-modal").on('change', '.item-img', function () {
    imageIdPupil = $(this).data('id'); 
    tempFilenamePupil = $(this).val();
    $('#cancelCropBtn').data('id', imageIdPupil); readFile_pupil(this);
});

$('#cropImagePupil').on('shown.bs.modal', function(){

    $uploadCropPupil.croppie('bind', {
        url: rawImgPupil
    }).then(function(){
        console.log('jQuery bind complete');
    });
});

$('#cropImagePupil').on('click', function (ev) {
    $uploadCropPupil.croppie('result', {
        type: 'base64',
        format: 'jpeg',
        size: {width: 150, height: 200}
    }).then(function (resp) {
        $('#item-img-output').attr('src', resp);
        $('#cropImagePupil').modal('hide');
        $("#pupil-modal").modal('show');
    });
});

/* permet la rotation de l'image */
$('.pupilPhoto-rotate').on('click', function(ev) {
    console.log(parseInt($(this).data('deg')));
    $uploadCropPupil.croppie('rotate', parseInt($(this).data('deg')));
});