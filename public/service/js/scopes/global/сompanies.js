$('document').ready(function () {
    $('#filter_self').iCheck({
        checkboxClass: 'icheckbox_square-green'
    });
    $('#filter_dates').daterangepicker({
        "autoApply": true,
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Применить",
            "cancelLabel": "Сбросить",
            "fromLabel": "От ",
            "toLabel": "До",
            "customRangeLabel": "Другой диапазон",
            "daysOfWeek": [
                "Вс",
                "Пн",
                "Вт",
                "Ср",
                "Чт",
                "Пт",
                "Сб"
            ],
            "monthNames": [
                "Январь",
                "Февраль",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь"
            ],
            "firstDay": 1
        },
        ranges: {
            'Сегодня': [moment(), moment()],
            'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
            'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
            'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
            'Последний месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }

    });

    $('#filter_contact_dates').daterangepicker({
        "autoApply": true,
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Применить",
            "cancelLabel": "Сбросить",
            "fromLabel": "От ",
            "toLabel": "До",
            "customRangeLabel": "Другой диапазон",
            "daysOfWeek": [
                "Вс",
                "Пн",
                "Вт",
                "Ср",
                "Чт",
                "Пт",
                "Сб"
            ],
            "monthNames": [
                "Январь",
                "Февраль",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь"
            ],
            "firstDay": 1
        },
        ranges: {
            'Сегодня': [moment(), moment()],
            'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
            'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
            'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
            'Последний месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }

    });
    GetStaff();
});


function GetStaff() {
    $.ajax({
            type: 'POST',
            url: '/service/ajax/staff/staff',
            data: {action: 'getselect'},
            success: function (response) {
                $('#filter_managers').html(response).multiselect({
                    includeSelectAllOption: true,
                    enableFiltering: true,
                    disableIfEmpty: true,
                    inheritClass: true,
                    allSelectedText: 'Все',
                    selectAllText: 'Все',
                    nonSelectedText: 'Никто не выбран'
                });
            },
            error: function () {
                toastr.error('Ошибка загрузки')
            }

        }
    )
}