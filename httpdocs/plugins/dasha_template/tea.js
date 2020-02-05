function add_tea(){
    $('#tea-modal').html(null);
    $.ajax({
        url:'tea/add',
        dataType:'html',
    }).done(function(html){
        $('#tea-modal').append(html);
        $('#tea-modal').modal("show");
    });
}

function edit_tea(id){
    $('#tea-modal').html(null);

    $.ajax({
        type:'GET',
        url:'tea/'+id+'/edit',
        dataType:'html',
    }).done(function(html){
        $('#tea-modal').append(html);
        $('#tea-modal').modal("show");
    });
}

function delete_tea(id){
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

function filter_tea(){
    $('#load-data-tea').html(null);
    $('.overlay-tea').css('display','block');

    $.ajax({
        type:'POST',
        url:'/tea/view',
        dataType:'html',
        data: {
            'view_all' : false,
            'fk_type' : $('#index-form-type').val(),
            'fk_variety': $('#index-form-variety').val(),
            'low_price' : $('#ui-slider-value-lower_3').text(),
            'high_price' : $('#ui-slider-value-upper_3').text(),
            'low_purchase_year' : $('#ui-slider-value-lower').text(),
            'high_purchase_year' : $('#ui-slider-value-upper').text(),
            'low_harvest_year' : $('#ui-slider-value-lower_2').text(),
            'high_harvest_year' : $('#ui-slider-value-upper_2').text(),
            'view_archived' : $('#index-is-archived').prop("checked"),
            'view_actual' : $('#index-is-actual').prop("checked")
        }
    }).done(function(html){
        $('.overlay-tea').css('display','none');
        $('#load-data-tea').append(html);
    });
}

function submit_add_tea(){
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

function submit_edit_tea(id){
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

function submit_delete_tea(id){
    $.ajax({
        type:"GET",
        dataType:"html",
        url:"tea/"+id+"/submit_delete",
    }).done(function(data){
    });
    $('#tea-modal').modal("hide");
    filter_tea();
}