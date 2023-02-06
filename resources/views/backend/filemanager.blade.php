<div id="filemanager" class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="modal-title" style="width: 120px;float: left;">File Manager</h4>
                        </div>
                        <div class="col-sm-6">
                            <!-- search -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="fe fe-x-circle" aria-hidden="true"></i></button>
                    <button type="button" data-toggle="tooltip" title="permanent delete" id="permanent-button-delete" class="btn btn-danger"><i class="fe fe-trash-2"></i></button>
                    <button type="button" data-toggle="tooltip" title="delete" id="button-delete" class="btn btn-warning"><i class="fe fe-trash-2"></i></button>
                    <button type="button" data-target-id="{{$target_id}}" data-toggle="tooltip" title="upload" id="button-upload" class="btn btn-primary"><i class="fe fe-upload"></i></button>
                    <a style="float: right;margin-bottom: 0;margin-right: 0;border-radius: 0;border-bottom: 0;" href="{{url('/dashboard/filemanager')}}" data-toggle="tooltip" title="upload" id="button-refresh" class="btn btn-success"><i class="fe fe-repeat"></i></a>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <!-- <div id="style-1" style="max-height: 400px;overflow-y: scroll;overflow-x: hidden;padding: 0 10px;"> -->
            <div>
                <div class="row">
                    @if($media_files['images'])
                        @for ($i = 0; $i < count($media_files['images']); $i++)

                            @if($media_files['images'][$i]['type'] == 'image')
                                <?php $ext = pathinfo($media_files['images'][$i]['name'], PATHINFO_EXTENSION); ?>
                                <div class="col-sm-2 col-xs-6 text-center">
                                    <div class="upload-img-items">
                                        <a href="javascript:void(0)" class="thumbnail">
                                            @if($ext == 'pdf')
                                                <img data-toggle="tooltip" class="img-responsive" alt="" src="{{url('/uploads/document.png') }}" />
                                            @else
                                                <img data-toggle="tooltip" class="img-responsive" alt="" src="{{$media_files['images'][$i]['href'] }}" />
                                            @endif
                                        </a>
                                        <label>
                                            <input type="hidden" class="image-name" name="image_name" value="{{$media_files['images'][$i]['name']}}" />
                                            @if($ext == 'pdf')
                                                <input type="hidden" class="image-path" name="image_path" value="{{url('/uploads/document.png') }}" />
                                            @else
                                                <input type="hidden" class="image-href" name="image_href" value="{{$media_files['images'][$i]['href'] }}" />
                                                <input type="hidden" class="image-path" name="image_path" value="{{$media_files['images'][$i]['image_path'] }}" />
                                            @endif
                                            <input type="checkbox" name="path[]" value="{{ $media_files['images'][$i]['name'] }}" />
                                            {{ $media_files['images'][$i]['title'] }}
                                        </label>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    @else
                        <div class="col-md-12">
                            <p>Not found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <?php
        if($total_data > $limit){
        ?>
        <div class="modal-footer">
            <div class="pagination">
                <?php
                $pages = ceil( $total_data/$limit);
                echo PaginationLinks::create($page, $pages, 2);
                ?>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<script type="text/javascript">
    $('a.thumbnail').on('click', function(e) {
        e.preventDefault();
        var target_id = "{{Session::get('target_id')}}";
        var file_name = $(this).parent().find('input.image-name').val();

        var file_href = $(this).parent().find('input.image-href').val();
        var file = $(this).parent().find('input.image-path').val();
        $('#input-image-name-'+target_id).val(file);
        $('#input-image-'+target_id).html("<img src='"+file_href+"'> ");
        $('.custom-image-'+target_id).removeClass('d-none');
        $('.custom-image-'+target_id).addClass('d-block');
        $('.custom-image-'+target_id).html("<a href='javascript:;' class=\"position-absolute button-clear\" data-target-id='"+target_id+"' style='left: 20px; top:10px;' id='button-clear'><i class='fe fe-trash-2 position-absolute text-danger'></i></a>\n");
        $('#modal-image').modal('hide');
    });

    $('#button-refresh').on('click', function(e) {
        e.preventDefault();
        $('#button-refresh i').replaceWith('<i class="fas fa-spinner fa-spin"></i>');
        $('#modal-image').load($(this).attr('href'));
    });

    $('a.directory').on('click', function(e) {
        alert($(this).attr('href'));
        e.preventDefault();
        $('#modal-image').load($(this).attr('href'));
    });
    $('.pagination a').on('click', function(e) {
        e.preventDefault();
        var base_url = "{{url('/')}}";
        var page = $(this).data('page');
        var target_id = "{{$target_id}}";
        var target_url = base_url+"/dashboard/filemanager?page="+encodeURIComponent(page)+"&target_id="+encodeURIComponent(target_id);
        $('#filemanager').append('<div id="loader"></div>');
        $('#modal-image').load(target_url);
    });
    // upload file
    $('#button-upload').on('click', function() {

        var target_id = $(this).data('target-id');
        $('#form-upload').remove();
        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;">{{ csrf_field() }} <input type="hidden" name="target_id" value="'+target_id+'" /> <input type="file" name="file_name[]" value="" multiple="multiple" /></form>');
        $('#form-upload input[name=\'file_name[]\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }
        timer = setInterval(function() {
            if ($('#form-upload input[name=\'file_name[]\']').val() != '') {
                clearInterval(timer);
                $.ajax({
                    url: "{{url('/dashboard/filemanager/upload')}}",
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#button-upload i').replaceWith('<i class="fa fa-spinner fa-spin"></i>');
                        $('#button-upload').prop('disabled', true);
                    },
                    complete: function() {
                        $('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
                        $('#button-upload').prop('disabled', false);
                    },
                    success: function(json) {

                        if (json['error']) {
                            notify('error',json['error']);
                        }
                        if (json['success']) {
                            notify('success',json['success']);
                            $('#button-refresh').trigger('click');
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });
    // create folder
    $('#button-folder').popover({
        html: true,
        placement: 'bottom',
        trigger: 'click',
        content: function() {
            html  = '<div class="input-group">';
            html += '  <input type="text" name="folder" value="" placeholder="Folder Name" class="form-control">';
            html += '  <span class="input-group-btn"><button type="button"  id="button-create" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></span>';
            html += '</div>';

            return html;
        }
    });
    $('#button-folder').on('shown.bs.popover', function() {
        $('#button-create').on('click', function() {
            var token = "{{csrf_token()}}";
            $.ajax({
                url:"{{url('/dashboard/filemanager/folder')}}",
                type: 'post',
                dataType: 'json',
                data: '_token='+token+'&folder=' + encodeURIComponent( $('input[name=\'folder\']').val() ),
                beforeSend: function() {
                    $('#button-create').prop('disabled', true);
                },
                complete: function() {
                    $('#button-create').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        notify('error',json['error']);

                    }
                    if (json['success']) {
                        notify('success',json['success']);
                        $('#button-refresh').trigger('click');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });
    });

    $('#modal-image #button-delete').on('click', function(e) {
        if (confirm('Are you sure ?')) {

            var token = "{{csrf_token()}}";
            var val = [];
            $(':checkbox:checked').each(function(i){
                val[i] = $(this).val();
            });
            if(val.length < 1){
                confirm('Check atleast one.')
                return false;
            }

            $.ajax({
                url: "{{url('/dashboard/filemanager/delete')}}",
                type: 'post',
                dataType: 'json',
                data: $('input[name^=\'path\']:checked'),
                data: '_token='+token+'&path=' + encodeURIComponent( val ),

                beforeSend: function() {
                    $('#button-delete').prop('disabled', true);
                },
                complete: function() {
                    $('#button-delete').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        notify('error',json['error']);
                    }
                    if (json['success']) {
                        notify('success',json['success']);

                        $('#button-refresh').trigger('click');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    });


    $('#modal-image #permanent-button-delete').on('click', function(e) {
        if (confirm('Are you sure, you want to delete permanently ?')) {

            var token = "{{csrf_token()}}";
            var val = [];
            $(':checkbox:checked').each(function(i){
                val[i] = $(this).val();
            });
            if(val.length < 1){
                confirm('Check atleast one.')
                return false;
            }

            $.ajax({
                url: "{{url('/dashboard/filemanager/permanent-delete')}}",
                type: 'post',
                dataType: 'json',
                data: $('input[name^=\'path\']:checked'),
                data: '_token='+token+'&path=' + encodeURIComponent( val ),

                beforeSend: function() {
                    $('#button-delete').prop('disabled', true);
                },
                complete: function() {
                    $('#button-delete').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        notify('error',json['error']);
                    }
                    if (json['success']) {
                        notify('success',json['success']);

                        $('#button-refresh').trigger('click');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    });

</script>
