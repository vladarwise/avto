$(document).ready(function () {
    GetRoles();
    $('#activity').multiselect({
        includeSelectAllOption: true,
        inheritClass: true,
        allSelectedText: 'Все',
        selectAllText: 'Все',
        nonSelectedText: 'Ничего не выбрано'
    });

});
function GetAllStaff() {
    var act = $('#activity').val();
    var rls = $('#sortrole').val();
    $.ajax({
        type: 'POST',
        url: '/admin/staff/all',
        data: {action: 'GetAll', active: act, roles: rls, _token: $('input[name=_token]').val()}, success: function (response) {
            $('#usercontainer').html(response);
            // $('.widget-user-desc').append('<span class="pull-right"><i class="fa fa-angle-double-down"></i></span>');
            /*$('.widget-user-header span').each(function () {
             var trigger = $(this), state = false, el = trigger.parent().parent().parent().next('.box-footer');
             trigger.click(function () {
             state = !state;
             el.slideToggle();
             trigger.parent().parent().toggleClass('expanded');
             });
             });*/
        }, error: function () {
            toastr.error('Ошибка получения данных.', 'Ошибка!');
        }
    })
}
function GetRoles() {
    $.ajax({
        type: 'POST',
        url: '/admin/staff/roles',
        data: {action: 'GetRoles', _token: $('input[name=_token]').val()},
        success: function (response) {
            $('#sortrole').html(response).multiselect({
                includeSelectAllOption: true,
                enableFiltering: true,
                inheritClass: true,
                allSelectedText: 'Все',
                selectAllText: 'Все',
                nonSelectedText: 'Ничего не выбрано'
            });
            $('#nu_role').html(response);
        },
        error: function () {
            toastr.error('Ошибка получения данных. Перезагрузите, пожалуйста страницу', 'Ошибка!')
        }
    })
}
function ToggleNewUserForm() {
    $('.usrinput').val('');
    $('#newuesrmodal').modal('toggle');
}
function SaveNewUser() {
    $.ajax({
        type: 'POST',
        url: '/service/ajax/staff/staff',
        data: {
            action: 'NewUser',
            nu_login: $('#nu_login').val(),
            nu_password: $('#nu_password').val(),
            nu_fullname: $('#nu_fullname').val(),
            nu_sip: $('#nu_sip').val(),
            nu_sip_pass: $('#nu_sip_password').val(),
            nu_post: $('#nu_post').val(),
            nu_role: $('#nu_role').val()
        }
        ,
        success: function (response) {
            toastr.success('Пользователь ' + response + ' успешно добавлен', 'Сохранено.');
            ToggleNewUserForm();
            GetAllStaff();
        }
        ,
        error: function () {
            toastr.error('Произошла ошибка. Попробуйте позже.', 'Ошибка!');
        }
    })

}

function BlockUser(user) {
    $.ajax({
        type: 'POST',
        url: '/service/ajax/staff/staff',
        data: {action: "Block", usr: user},
        success: function (response) {
            toastr.success('Пользователь' + response + ' успешно заблокирован.');
            GetAllStaff();
        },
        error: function () {
            toastr.error('Произошла ошибка. Попробуйте позже.', 'Ошибка!')
        }
    })
}
function UnblockUser(user) {
    $.ajax({
        type: 'POST',
        url: '/service/ajax/staff/staff',
        data: {action: "Unblock", usr: user},
        success: function (response) {
            toastr.success('Пользователь' + response + ' успешно разблокирован.');
            GetAllStaff();
        },
        error: function () {
            toastr.error('Произошла ошибка. Попробуйте позже.', 'Ошибка!')
        }
    })
}