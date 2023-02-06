$(function(e) {

    //______Basic Data Table
    $('#basic-datatable').DataTable({
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        }
    });


    //______Basic Data Table
    $('#responsive-datatable').DataTable({
        language: {
            searchPlaceholder: 'Search...',
            scrollX: "100%",
            sSearch: '',
        }
    });

    //______File-Export Data Table
    var table = $('#file-datatable').DataTable({
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        language: {
            searchPlaceholder: 'Search...',
            scrollX: "100%",
            sSearch: '',
        }
    });
    table.buttons().container()
        .appendTo('#file-datatable_wrapper .col-md-6:eq(0)');

    //______Delete Data Table
    var table = $('#delete-datatable').DataTable({
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        }
    });
    $('#delete-datatable tbody').on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#button').click(function() {
        table.row('.selected').remove().draw(false);
    });

    $('table').on('draw.dt', function() {
        $('.select2').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Choose one'
        });
    });

    //______Select2 
    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });

});