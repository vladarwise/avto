toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 4000
};
$(function () {
    $.ajaxSetup({
        type: 'POST',
        async: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        statusCode: {
            200: function (response) {
                console.info('ok response, continue.');
            },
            500: function () {
                console.error('Server error.');
            },
            404: function () {
                console.error('Link error. Handler not found. ');
            },
            403: function () {
                console.error('Can`t access handler file.');
            }
        }
    });
});

function Logout() {
    $.ajax({
        type: 'POST',
        url: '/logout',
        success: function (response) {
            window.location = '/';
        }
    })
};

function Alive() {
    $.ajax({
        type: 'POST',
        url: '/alive',
    });
}
