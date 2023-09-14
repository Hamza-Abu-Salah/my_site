let host = document.location;

let TableUrl = new URL('/admin/testimonial', host.origin);
var table = $('#get_testimonial').DataTable({
    processing: true,
    ajax: TableUrl,
    columns: [
        {data: "DT_RowIndex", name: "DT_RowIndex"},
        {data: "avatar", name: "avatar"},
        {data: "name", name: "name"},
        {data: "job_title", name: "job_title"},
        {data: "message", name: "message"},
        {data: "status", name: "status"},
        {data: "action", name: "action"},
    ]
});
//  view modal testimonial
$(document).on('click', '#ShowModalTestimonial', function (e) {
    e.preventDefault();
    $('#modalTestimonialAdd').modal('show');
});

let AddUrl = new URL('admin/testimonial', host.origin);
// category admin
$(document).on('click', '#addTestimonial', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formTestimonialAdd')[0]);
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
                $('#modalTestimonialAdd').modal('hide');
                $('#formTestimonialAdd')[0].reset();
                table.ajax.reload(null, false);
            }
        }
    });
});

let EditUrl = new URL('admin/testimonial', host.origin);
// view modification data
$(document).on('click', '#showModalEditTestimonial', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#modalTestimonialUpdate').modal('show');
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
                $('#name').val(response.data.name);
                $('#job_title').val(response.data.job_title);
                $('#message').val(response.data.message);
                $("#status option[value='"+response.data.status+"']").prop("selected", true);
            }
        }
    });
});

let UpdateUrl = new URL('admin/testimonial', host.origin);
$(document).on('click', '#updateTestimonial', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formTestimonialUpdate')[0]);
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
                $('#modalTestimonialUpdate').modal('hide');
                $('#formTestimonialUpdate')[0].reset();
                table.ajax.reload(null, false);
            }
        }
    });
});

let DeleteUrl = new URL('admin/testimonial', host.origin);
$(document).on('click', '#showModalDeleteTestimonial', function (e) {
    e.preventDefault();
    $('#nameDetele').val($(this).data('name'));
    var id = $(this).data('id');
    $('#modalTestimonialDelete').modal('show');
    gg(id);
});
function gg(id) {
    $(document).off("click", "#deleteTestimonial").on("click", "#deleteTestimonial", function (e) {
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
                    $('#modalTestimonialDelete').modal('hide');
                    table.ajax.reload(null, false);
                }
            }
        });
    });
}

let statusUrl = new URL('admin/status/testimonial', host.origin);
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
