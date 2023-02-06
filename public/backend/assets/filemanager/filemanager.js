$(document).on('click', "a[data-toggle='image']", function(e) {
    var $element = $(this);
    var $popover = $element.data('bs.popover'); // element has bs popover?
    var target_id = $element.data('target-id');

    e.preventDefault();
    // destroy all image popovers
    //$('a[data-toggle="image"]').popover('destroy');
    $('a[data-toggle="image"]').popover('dispose');
    // remove flickering (do not re-add popover when clicking for removal)
    if ($popover) {
        return;
    }
    $element.popover({
        html: true,
        placement: 'right',
        trigger:'manual',
        content: function() {
            return '<a  type="button" data-target-id="'+target_id+'" id="button-image" class="button-image btn btn-info text-white"><i class="fe fe-edit"></i></a> <a href="javascript:;" type="button" data-target-id="'+target_id+'" id="button-clear" class="button-clear btn btn-danger text-white"><i class="fe fe-trash-2"></i></a>';
        }
    });

    $element.popover('show');

    $(document).on('click','.button-image',function(){
        var $button = $(this);
        var target_id = $button.data('target-id');
        var $icon   = $button.find('> i');
        $('#modal-image').remove();

        $.ajax({
            url: "/dashboard/filemanager",
            data:{target_id:target_id},
            dataType: 'html',
            beforeSend: function() {
                $button.prop('disabled', true);
                if ($icon.length) {
                    $icon.attr('class', 'fa fa-spinner fa-spin');
                }
            },
            complete: function() {
                $button.prop('disabled', false);
                if ($icon.length) {
                    $icon.attr('class', 'fa fa-edit');
                }
            },
            success: function(html) {
                $('body').append('<div id="modal-image" class="modal">' + html + '</div>');
                $('#modal-image').modal('show');
            }
        });
        //$element.popover('destroy');
        $element.popover('dispose');
    });
    $(document).on('click','.button-clear',function(){
        var $element = $(this);
        var target_id = $(this).data('target-id');
        $('#input-image-'+target_id).html('');
        $('#input-image-name-'+target_id).val('');
        //$element.popover('destroy');
        $element.popover('dispose');
    });
});

$(document).on('click','.button-image',function(){
    var $button = $(this);
    var target_id = $button.data('target-id');
    var $icon   = $button.find('> i');
    $('#modal-image').remove();
    $.ajax({
        url: "/dashboard/filemanager",
        data:{target_id:target_id},
        dataType: 'html',
        beforeSend: function() {
            $button.prop('disabled', true);
            if ($icon.length) {
                $icon.attr('class', 'fa fa-spinner fa-spin');
            }
        },
        complete: function() {
            $button.prop('disabled', false);
            if ($icon.length) {
                $icon.attr('class', 'fa fa-edit');
            }
        },
        success: function(html) {
            $('body').append('<div id="modal-image" class="modal">' + html + '</div>');
            $('#modal-image').modal('show');
        }
    });
    //$element.popover('destroy');
    $element.popover('dispose');
});

$(document).on('click','.button-clear', function() {
    var target_id = $(this).data('target-id');
    var url=window.location.host;
    var protocol=window.location.protocol;
    $('#input-image-'+target_id).html("<img src='"+protocol+"//"+url+"/backend/assets/img/default-img.jpg'>");
    $('#input-image-name-'+target_id).val('');
    $('.custom-image-'+target_id).removeClass('d-block');
    $('.custom-image-'+target_id).addClass('d-none')
    // $element.parent().find('#input-image-'+target_id).html('');
    // $element.parent().find('#input-image-name-'+target_id).val('');
    //$element.popover('destroy');
    // $element.popover('dispose');
});
