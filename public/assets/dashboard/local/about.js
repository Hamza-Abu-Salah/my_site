let host = document.location;

let TableUrl = new URL('/admin/about', host.origin);
var table = $('#get_about').DataTable({
    processing: true,
    ajax: TableUrl,
    columns: [
        {data: "DT_RowIndex", name: "DT_RowIndex"},
        {data: "first_photo", name: "first_photo"},
        {data: "name_en", name: "name_en"},
        {data: "Mail", name: "Mail"},
        {data: "Phone", name: "Phone"},
        {data: "job_title_en", name: "job_title_en"},
        {data: "status", name: "status"},
        {data: "action", name: "action"},
    ]
});
//  view modal about
$(document).on('click', '#ShowModalAboutMe', function (e) {
    e.preventDefault();
    $('#modalAboutMeAdd').modal('show');
});

let AddUrl = new URL('admin/about', host.origin);
// category admin
$(document).on('click', '#addAbout', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formAboutAdd')[0]);
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
                $('#modalAboutMeAdd').modal('hide');
                $('#formAboutAdd')[0].reset();
                table.ajax.reload(null, false);
            }
        }
    });
});

let EditUrl = new URL('admin/about', host.origin);
// view modification data
$(document).on('click', '#showModalEditAboutMe', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#modalAboutMeUpdate').modal('show');
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
                $('#name_en').val(response.data.name_en);
                $('#Birthday').val(response.data.Birthday);
                $('#Mail').val(response.data.Mail);
                $('#Phone').val(response.data.Phone);
                $('#Address_en').val(response.data.Address_en);
                $('#Nationality_en').val(response.data.Nationality_en);
                $('#job_title_en').val(response.data.job_title_en);
                $('#job_description_en').val(response.data.job_description_en);
                $('#about_en').val(response.data.about_en);
                $("#status option[value='"+response.data.status+"']").prop("selected", true);
            }
        }
    });
});

let UpdateUrl = new URL('admin/about', host.origin);
$(document).on('click', '#updateAbout', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formAboutUpdate')[0]);
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
                $('#modalAboutMeUpdate').modal('hide');
                $('#formAboutUpdate')[0].reset();
                table.ajax.reload(null, false);
            }
        }
    });
});

let DeleteUrl = new URL('admin/about', host.origin);
$(document).on('click', '#showModalDeleteAboutMe', function (e) {
    e.preventDefault();
    $('#nameDetele').val($(this).data('name'));
    var id = $(this).data('id');
    $('#modalAboutMeDelete').modal('show');
    gg(id);
});
function gg(id) {
    $(document).off("click", "#deleteAbout").on("click", "#deleteAbout", function (e) {
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
                    $('#modalAboutMeDelete').modal('hide');
                    table.ajax.reload(null, false);
                }
            }
        });
    });
}

let statusUrl = new URL('admin/status/about', host.origin);
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
