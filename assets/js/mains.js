// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//
//         reader.onload = function (e) {
//             $('#imageResult')
//                 .attr('src', e.target.result);
//         };
//         reader.readAsDataURL(input.files[0]);
//     }
// }
//
// $(function () {
//     $('#avatar').on('change', function () {
//         readURL(input);
//     });
// });
//
// var input = document.getElementById('upload');
// var infoArea = document.getElementById('upload-label');
//
// input.addEventListener('change', showFileName);
//
// function showFileName(event) {
//     var input = event.srcElement;
//     var fileName = input.files[0].name;
//     infoArea.textContent = 'File name: ' + fileName;
// }

/*Check username*/
$('#username').on('keypress', function (event) {
    var regex = new RegExp('^[a-zA-Z0-9+$]');
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

/*Check fullname*/
$('#fullname').on('keypress', function (event) {
    var charCode = (event.which) ? event.which : window.event.keyCode;

    if (charCode <= 13) {
        return true;
    } else {
        var keyChar = String.fromCharCode(charCode);
        var re = /^[a-zA-Z ]+$/
        return re.test(keyChar);
    }
});

/*Check birthday*/
$(function () {
    $("#birthday").datepicker({
        dateFormat: 'dd/mm/yy',
        closeText: 'Đóng',
        prevText: 'Trước',
        nextText: 'Sau',
        currentText: 'Hôm nay',
        monthNames: ['Tháng một', 'Tháng hai', 'Tháng ba', 'Tháng tư', 'Tháng năm', 'Tháng sáu', 'Tháng bảy', 'Tháng tám', 'Tháng chín', 'Tháng mười', 'Tháng mười một', 'Tháng mười hai'],
        monthNamesShort: ['Một', 'Hai', 'Ba', 'Bốn', 'Năm', 'Sáu', 'Bảy', 'Tám', 'Chín', 'Mười', 'Mười một', 'Mười hai'],
        dayNames: ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'],
        dayNamesShort: ['CN', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy'],
        dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
        weekHeader: 'Tuần',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: "",
        changeMonth: true,
        changeYear: true,
        currentDay: true,
        showButtonPanel: true,
        autoclose: true,
        yearRange: '1900:+0',
    });

    $.datepicker._gotoToday = function (id) {
        var target = $(id);
        var inst = this._getInst(target[0]);

        var date = new Date();

        this._setDate(inst, date);
        this._hideDatepicker();
    }

    $('#birthday').keypress(function (event) {
        event.preventDefault();
    });
});

/*Check email*/
var checkValidEmail = function (value) {
    var emailPatten = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return emailPatten.test((value));
}

$('#email').keyup(function () {
    var value = $(this).val();
    var valid = checkValidEmail(value);

    if (!valid) {
        $(this).css('color', 'indianred');
    } else {
        $(this).css('color', '#000');
    }
});

/*Check phone*/
$('#phone').on('keypress', function (event) {
    var regex = new RegExp('^[0-9+$]');
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

/*Check password*/
$('#password').on('keypress', function (event) {
    var regex = new RegExp('^[a-zA-Z0-9+$]');
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

/*Confirm password*/
$('#confirm_password').on('keypress', function (event) {
    var regex = new RegExp('^[a-zA-Z0-9+$]');
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

// $('html').on("contextmenu", function () {
//     return false;
// });
//
// document.addEventListener('contextmenu', function (event) {
//     event.preventDefault();
// });

document.onkeypress = function (event) {
    event = (event || window.event);
    if (event.keyCode == 123) return false;
}

document.onmousedown = function (event) {
    event = (event || window.event);
    if (event.keyCode == 123) return false;
}

document.onkeydown = function (event) {
    event = (event || window.event);
    if (event.keyCode == 123) return false;
}