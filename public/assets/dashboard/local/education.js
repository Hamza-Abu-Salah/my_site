let host = document.location;

let TableUrl = new URL('/admin/education', host.origin);
var table = $('#get_education').DataTable({
    processing: true,
    ajax: TableUrl,
    columns: [
        {data: "DT_RowIndex", name: "DT_RowIndex"},
        {data: "title_en", name: "title_en"},
        {data: "Learn_resource_en", name: "Learn_resource_en"},
        {data: "description", name: "description"},
        {data: "year_range", name: "year_range"},
        {data: "status", name: "status"},
        {data: "action", name: "action"},
    ]
});
//  view modal education
$(document).on('click', '#ShowModalEducation', function (e) {
    e.preventDefault();
    $('#modalEducationAdd').modal('show');
});

let AddUrl = new URL('admin/education', host.origin);
// category admin
$(document).on('click', '#addEducation', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formEducationAdd')[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: AddUrl,
        data: formdata,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 400) {
                // errors
                $('#list_error_message').html("");
                $('#list_error_message').addClass("alert alert-danger");
                $('#list_error_message').text(response.message);
            } else {
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-success");
                $('#error_message').text(response.message);
                $('#modalEducationAdd').modal('hide');
                $('#formEducationAdd')[0].reset();
                table.ajax.reload(null, false);
            }
        }
    });
});

let EditUrl = new URL('admin/education', host.origin);
// view modification data
$(document).on('click', '#showModalEditEducation', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#modalEducationUpdate').modal('show');
    $.ajax({
        type: 'GET',
        url: EditUrl+'/' + id+'/edit',
        data: "",
        success: function (response) {
            if (response.status == 404) {
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-danger");
                $('#error_message').text(response.message);
            } else {
                $('#id').val(id);
                $('#title_en').val(response.data.title_en);
                $('#Learn_resource_en').val(response.data.Learn_resource_en);
                $('#year_range').val(response.data.year_range);
                $('#description_en').val(response.data.description_en);
                $("#status option[value='"+response.data.status+"']").prop("selected", true);
            }
        }
    });
});

let UpdateUrl = new URL('admin/education', host.origin);
$(document).on('click', '#updateEducation', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formEducationUpdate')[0]);
    var id = $('#id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: UpdateUrl+'/'+id,
        data: formdata,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 400) {
                // errors
                $('#list_error_message2').html("");
                $('#list_error_message2').addClass("alert alert-danger");
                $('#list_error_message2').text(response.message);
            } else {
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-success");
                $('#error_message').text(response.message);
                $('#modalEducationUpdate').modal('hide');
                $('#formEducationUpdate')[0].reset();
                table.ajax.reload(null, false);
            }
        }
    });
});

let DeleteUrl = new URL('admin/education', host.origin);
$(document).on('click', '#showModalDeleteEducation', function (e) {
    e.preventDefault();
    $('#nameDetele').val($(this).data('name'));
    var id = $(this).data('id');
    $('#modalEducationDelete').modal('show');
    gg(id);
});
function gg(id) {
    $(document).off("click", "#deleteEducation").on("click", "#deleteEducation", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: DeleteUrl+'/'+id,
            data: '',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 400) {
                    // errors
                    $('#list_error_message3').html("");
                    $('#list_error_message3').addClass("alert alert-danger");
                    $('#list_error_message3').text(response.message);
                } else {
                    $('#error_message').html("");
                    $('#error_message').addClass("alert alert-success");
                    $('#error_message').text(response.message);
                    $('#modalEducationDelete').modal('hide');
                    table.ajax.reload(null, false);
                }
            }
        });
    });
}

let statusUrl = new URL('admin/status/education', host.origin);
$(document).on('click', '#status', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'PUT',
        url: statusUrl+'/'+id,
        data: "",
        success: function (response) {
             if (response.status == 400) {
                    // errors
                    $('#list_error_message3').html("");
                    $('#list_error_message3').addClass("alert alert-danger");
                    $('#list_error_message3').text(response.message);
                } else {
                    $('#error_message').html("");
                    $('#error_message').addClass("alert alert-success");
                    $('#error_message').text(response.message);
                    table.ajax.reload(null, false);
                }
        }
    });
});
