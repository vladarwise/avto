$(document).ready(function () {
    $('#daterange').daterangepicker({
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
    $('#managers').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        disableIfEmpty: true,
        inheritClass: true,
        allSelectedText: 'Все',
        selectAllText: 'Все',
        nonSelectedText: 'Ничего'
    });
    BuildTable();
});
window.addEventListener("resize", function () {
    BuildTable();
});


function BuildTable() {
    $('#calltable').dataTable({
        "responsive": true,
        "retrieve": true,
        "language": {
            "decimal": "",
            "emptyTable": "Нет данных для отображения",
            "info": "Записи _START_ - _END_ из _TOTAL_ записей",
            "infoEmpty": "Записи 0 - 0 из 0",
            "infoFiltered": "(фильтровано из _MAX_ total записей)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Показать _MENU_ записей",
            "loadingRecords": "Загрузка...",
            "processing": "Обработка...",
            "search": "Поиск:",
            "zeroRecords": "Подходящих записей не найдено",
            "paginate": {
                "first": "Первая",
                "last": "Последняя",
                "next": "Следующая",
                "previous": "Предыдущая"
            }
        },
        "tableTools": {
            "sSwfPath": "/service/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
        }
    });

}
