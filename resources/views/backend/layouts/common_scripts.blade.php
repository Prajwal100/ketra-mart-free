<script>
    /*-------------------------------------
          Date Picker
      -------------------------------------*/
    if ($.fn.datepicker !== undefined) {
        $('.air-datepicker').datepicker({
            language: {
                days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                today: 'Today',
                clear: 'Clear',
                dateFormat: 'yyyy-mm-dd',
                firstDay: 0
            }
        });
    }
</script>
<!-- Plugin used-->
{{--<script>--}}
{{--    $('#lang-change a').each(function () {--}}
{{--        $(this).on('click',function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var locale=$(this).data('lang');--}}
{{--            var url='{{route('language.change')}}';--}}
{{--            var token="{{csrf_token()}}";--}}
{{--            $.post(--}}
{{--                url,--}}
{{--                {--}}
{{--                    _token:token,--}}
{{--                    locale:locale,--}}
{{--                },--}}
{{--                function (response) {--}}
{{--                    location.reload();--}}
{{--                }--}}
{{--            );--}}
{{--        });--}}
{{--    })--}}
{{--</script>--}}
<!-- menu search function -->
<script>
    function menuSearch() {
        var filter, item;
        filter = $("#menu-search").val().toUpperCase();
        items = $("#main-menu").find("a");
        items = items.filter(function(i,item){
            if($(item).find(".side-menu__label")[0].innerText.toUpperCase().indexOf(filter) > -1 && $(item).attr('href') !== '#'){
                return item;
            }
        });

        if(filter !== ''){
            $("#main-menu").addClass('d-none');
            $("#search-menu").html('')
            if(items.length > 0){
                for (i = 0; i < items.length; i++) {
                    const text = $(items[i]).find(".side-menu__label")[0].innerText;
                    const link = $(items[i]).attr('href');
                    $("#search-menu").append(`<li class="slide"><a href="${link}" class="side-menu__item"><i class="fas fa-ellipsis-h"></i><span>${text}</span></a></li>`);
                }
            }else{
                $("#search-menu").html(`<li class="slide"><a  class="side-menu__item">Nothing Found</a></li>`);
            }
        }else{
            $("#main-menu").removeClass('d-none');
            $("#search-menu").html('')
        }
    }
</script>

<script>
    //name to slug convert
    $("#title").focusout(function(e){
        var title = $("#title").val();
        var createdSlug = convertToSlug(title.trim());
        var slug = $("#slug").val(createdSlug);
    });

    function convertToSlug(Text){
        return Text
            .toLowerCase()
            .replace(/[^\w ]+/g,'')
            .replace(/ +/g,'-')
            ;
    }

    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }else{
                    swal({
                        title:"Your data is safe!",
                        icon:'info',
                    })
                }
            });
    });
</script>

{{--Bulk download--}}
<script>
    $(document).ready(function() {
        $('#check_box').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".check_item").prop('checked', true);
            } else {
                $(".check_item").prop('checked', false);
            }
        });

        $('.delete_all').on('click', function(e) {
            var allVals = [];
            $(".check_item:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            e.preventDefault();
            if (allVals.length <= 0) {
                notify('error','Please select at least one row', {
                    closeButton: true,
                    progressBar: false,
                });
            } else {
                swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var join_selected_values = allVals.join(",");
                            $.ajax({
                                url: $(this).data('url'),
                                type: "DELETE",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    ids: join_selected_values,
                                },
                                beforeSend: function() {
                                    $("#loading").show();
                                },
                                complete: function() {
                                    $("#loading").hide();
                                },
                                success: function(response) {
                                    if (response.status) {
                                        $(".check_item:checked").each(function() {
                                            $(this).parents("tr").remove();
                                        });
                                        notify('success',response.msg,{
                                            closeButton: true,
                                            progressBar: false,
                                        });
                                    } else {
                                        notify('error','Oops!, Something went wrong!!',
                                            'Error', {
                                                closeButton: true,
                                                progressBar: false,
                                            });
                                    }

                                },
                                error: function(response) {
                                    notify('error',response.responseText, {
                                        closeButton: true,
                                        progressBar: false,
                                    });
                                }
                            });
                            $.each(allVals, function(index, value) {
                                $('table tr').filter("[data-row-id='" + value + "']")
                                    .remove();
                            });
                        } else {
                            swal({
                                title: "Your data is safe!",
                                icon: 'info',
                            })
                        }
                    });
            }
        })
    })
</script>
