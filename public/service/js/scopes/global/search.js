function BuildReport() {
    var p = $('#sphones').val();
    var s = $('#dateFrom').val();
    var e = $('#dateTo').val();
    var d = $('#dispos').val();

    if (p != null && s != null && e != null && d != null) {
        $('.loading-div').show();
        GetTable(p, s, e, d);
    } else {
        sweetAlert("Error!", "Check filters and try again!", "error");
    }
}

function GetPhones(st, en) {
    $.ajax({
        type: 'POST',
        url: '/service/ajax/dashboard',
        data: {
            action: 'GetPhones',
            firday: st,
            laday: en
        },
        success: function (response) {
            $('#sphones').html(response);
            $('#sphones').multiselect('rebuild');
        }
    });
}

function GetTable(phs, fday, lday, dps) {
    $.ajax({
        type: 'POST',
        url: '/service/ajax/search',
        async: 'true',
        data: {
            action: 'GetRecordings',
            firday: fday,
            laday: lday,
            phones: phs,
            dispositions: dps
        },
        success: function (response) {
            $('#fdata').hide();
            $('#result').hide();

            $("#fdata").dataTable().fnDestroy();
            $('#result').html(response);
            $('#fdata').DataTable({
                responsive: true,
                "retrieve": true,
            });
            $('.loading-div').hide();
            $('#result').show();
            $('#fdata').show();

        },
        error: function () {
            $('.loading-div').hide();
            $('#fdata').show();
            $('#fdata').html('<h4>Data extracting error! Try again.</h4>');

        }
    })
}

function SearchbyPhone() {
    var phs32 = $('#searchbdest').val();
    $.ajax({
        type: 'POST',
        url: '/service/ajax/search',
        async: 'true',
        data: {
            action: 'CallbyDest',
            phone: phs32
        },
        success: function (response) {
            $('#fdata').hide();
            $("#fdata").dataTable().fnDestroy();
            $('#result').html(response);
            $('#fdata').DataTable({
                'responsive': true,
                "retrieve": true
            });
            $('.loading-div').hide();
            $('#fdata').show();

        },
        error: function () {
            $('.loading-div').hide();
            $('#fdata').show();
            $('#fdata').html('<h4>Data extracting error! Try again.</h4>');

        }
    })
}


function LoadExcel(argument) {
    // TODO: this function realisation
}

function LoadCalls(argument) {
    // TODO: this function realisation
}

function PlayRec(audiopath) {
    $('#jp_container_1').show();
    $("#jquery_jplayer_1").jPlayer("destroy");
    $('#jquery_jplayer_1').jPlayer({
        ready: function () {
            $(this).jPlayer("setMedia", {
                title: audiopath,
                mp3: audiopath,
            }).jPlayer("play");
        },
        cssSelectorAncestor: "#jp_container_1",
        swfPath: "/player/jplayer",
        supplied: "mp3,wav",
        useStateClassSkin: true,
        autoBlur: false,
        smoothPlayBar: true,
        remainingDuration: true,
        toggleDuration: true,
    });
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------
//document.ready block
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
$(document).ready(function () {
    setTimeout(CheckAuth(), 3000);
    /*Phones multiselector*/
    $('#sphones').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        disableIfEmpty: true,
        inheritClass: true
    });
    $('#dispos').multiselect({
        includeSelectAllOption: true,
        disableIfEmpty: true,
        inheritClass: true
    });
    $('#dateFromPicker')
        .datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd 00:00:01',
            startDate: '2015-01-01',
            endDate: 'today'
        });
    $('#dateToPicker')
        .datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd 23:59:59',
            startDate: '2015-01-01',
            endDate: 'today'
        });
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    today = yyyy + '-' + mm + '-' + dd;
    $('#dateFrom').val(today + ' 00:00:01');
    $('#dateTo').val(today + ' 23:59:59');
    var fst = $('#dateFrom').val();
    var fed = $('#dateTo').val();
    GetPhones(fst, fed);
    $('#dateFrom').change(function () {
        var sd = $('#dateFrom').val();
        var fd = $('#dateTo').val();
        GetPhones(sd, fd);
    });
    $('#dateTo').change(function () {
        var sd = $('#dateFrom').val();
        var fd = $('#dateTo').val();
        GetPhones(sd, fd);
    })
});
