

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
 *
 * -------------------------------------------------------- */
function add_user(){
    $('#user-modal').html(null);
    $.ajax({
        url:'user/add',
        dataType:'html',
    }).done(function(html){
        $('#user-modal').append(html);
        $(".gambar").attr("src", "https://user.gadjian.com/static/images/personnel_boy.png");
        $('#user-modal').modal("show");
    });
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

function delete_user(id){
    $('#tea-modal').html(null)

    $.ajax({
        type:'GET',
        url:'tea/'+id+'/delete',
        dataType:'html',
    }).done(function(html){
        $('#tea-modal').append(html);
        $('#tea-modal').modal("show");
    });
}

function filter_user(){
    
    $('#load-data-user').html(null);
    $('.overlay-user').css('display','block');
   
    $.ajax({
        type:'POST',
        url:'/user/view',
        dataType:'html',
        data: {
            'view_all' : false,
            'view_actual' : $('#chk-is-active').prop("checked"),
            'view_incommittee' : $('#chk-is-incommittee').prop("checked"),
            'view_giver' : $('#chk-is-giver').prop("checked"),
            'view_godparent' : $('#chk-is-godparent').prop("checked"),
            'view_member' : $('#chk-is-member').prop("checked")
        }
    }).done(function(data){
        $('.overlay-user').css('display','none');
        $('#load-data-user').html(data);
        datatablesRefresh('#datatable-users');
    });
}

function submit_add_user(){
    //to do verif form

    var form = $('#form-add-tea').serializeArray();

    $.ajax({
        type:"POST",
        dataType:"html",
        url:"tea/submit_add",
        data : 
        {
            'form' : form
        },
    }).done(function(data){
    });
    $('#tea-modal').modal("hide");
    filter_tea();
}

function submit_edit_user(id){
    var form = $('#form-edit-tea').serializeArray();
    form[15] = {
        'name' : 'is_archived',
        'value' : $('#input-is-archived').prop('checked')
    };
    $.ajax({
        type:"POST",
        dataType:"html",
        url:"tea/"+id+"/submit_edit",
        data : 
        {
            'form' : form
        },
    }).done(function(data){
    });
    $('#tea-modal').modal("hide");
    filter_tea();
}

function submit_delete_user(id){
    $.ajax({
        type:"GET",
        dataType:"html",
        url:"tea/"+id+"/submit_delete",
    }).done(function(data){
    });
    $('#tea-modal').modal("hide");
    filter_tea();
}


$(document).ready(function(){

	$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });
  

  $("#user-modal").on('change', '#upload_image', function () {
    
    
    var reader = new FileReader();
    reader.onload = function (event) {
        $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
    
  });

/*
  $('#upload_image').on('change', function(){
      alert("change");
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });
*/
  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"upload.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#uploaded_image').html(data);
        }
      });
    })
  });

});  

// Start upload preview image
$(".gambar").attr("src", "https://user.gadjian.com/static/images/personnel_boy.png");
						var $uploadCrop,
						tempFilename,
						rawImg,
						imageId;
						function readFile(input) {
				 			if (input.files && input.files[0]) {
				              var reader = new FileReader();
					            reader.onload = function (e) {
									$('.upload-demo').addClass('ready');
									$('#cropImagePop').modal('show');
						            rawImg = e.target.result;
					            }
					            reader.readAsDataURL(input.files[0]);
					        }
					        else {
						        swal("Sorry - you're browser doesn't support the FileReader API");
						    }
						}

						$uploadCrop = $('#upload-demo').croppie({
							viewport: {
								width: 150,
								height: 200,
							},
							enforceBoundary: false,
							enableExif: true
						});
						$('#cropImagePop').on('shown.bs.modal', function(){
							// alert('Shown pop');
							$uploadCrop.croppie('bind', {
				        		url: rawImg
				        	}).then(function(){
				        		console.log('jQuery bind complete');
				        	});
						});

						$('.item-img').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
																										 $('#cancelCropBtn').data('id', imageId); readFile(this); });
						$('#cropImageBtn').on('click', function (ev) {
							$uploadCrop.croppie('result', {
								type: 'base64',
								format: 'jpeg',
								size: {width: 150, height: 200}
							}).then(function (resp) {
								$('#item-img-output').attr('src', resp);
								$('#cropImagePop').modal('hide');
							});
						});
				// End upload preview image