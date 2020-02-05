function load_collection(){
    $('#load-data-collection').html(null);
    $('.overlay-collection').css('display','block');

    $.ajax({
        type:'POST',
        url:'collection/view',
        dataType:'html',
    }).done(function(html){
        $('.overlay-collection').css('display','none');
        $('#load-data-collection').append(html);
    });
}

function add_collection(){
    $('#collection-modal').html(null);
    $.ajax({
        url:'collection/add',
        dataType:'html',
    }).done(function(html){
        $('#collection-modal').append(html);
        $('#collection-modal').modal("show");
    });
}

function edit_collection(id){
    $('#collection-modal').html(null);
    $.ajax({
        url:'collection/'+id+'/edit',
        dataType:'html',
    }).done(function(html){
        $('#collection-modal').append(html);
        $('#collection-modal').modal("show");
    });
}

function submit_add_collection(){
    var form = $('#form-add-collection').serializeArray();

    $.ajax({
        type: "POST",
        url:'collection/submit_add',
        dataType:'html',
        data:{
            'form' : form
        }
    }).done(function(html){
    });
    $('#collection-modal').modal("hide");
}

function submit_edit_collection(id){
    var form = $('#form-edit-collection').serializeArray();

    $.ajax({
        type: "POST",
        dataType:'html',
        url:'collection/'+id+'/submit_edit',
        data:{
            'form' : form
        }
    }).done(function(html){
        $('#collection-modal').modal("hide");
        load_collection();
    });
}

function collectionCardboxShow(id){
    element = $('#'+id);
    if($(element).find('.box-body').css('display') == 'none'){
        $(element).find('.box-body').css('display','block');
    }else{
        $(element).find('.box-body').css('display','none');
    }
}