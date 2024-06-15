//I will make sure this code run on Script Load
$(document).ready(function(){
    $('.paspor-custom-number-only-input').keypress(function(evt){
        if (evt.which < 48 || evt.which > 57){
            evt.preventDefault();
        }
    });

});

//Numbers Formatter//
//TODO Inget Bikin Buat Nyempilin Comma
function pushBackString(params, toInsert) {
    let stringCount = params.length + 1;
    let word = params.split('');
    let newArray = [];
    newArray[0] = toInsert;
    for(let i = 0; i< stringCount; i++){
        newArray.push(word[i]);
    }

    return newArray.join("");
}

function formalNumberFormat(T, S) {
    "use strict";
    try {
        var number = Number(T);
    } catch (err) {
        console.log("Custom's Function: The Parameter is Not a Number!!!", 'background: #222; color: #bada55');
        return;
    }
    let wording = "";
    var count = 0;
    let toConvert = number.toString();
    for(let i = toConvert.length-1; i > -1; i--) {
        if(count == 0){
            wording += toConvert.charAt(i);
            count++;
            continue;
        }

        if(count % 3 == 0){
            wording = S===undefined ? pushBackString(wording, ",") : pushBackString(wording, S);
        }
        wording = pushBackString(wording, toConvert.charAt(i));
        count++;
    }

    return wording;
}

//Formal Numering. Dibawah angka 10, ditambahin '0' di depan
//Contoh: 09 ; 05 ; 01 ; 00
//Kalo diatas 9, dia langsung return angkanya
function lessTen(T){
    var number = T;
    if(number < 10) number = '0' + number;

    return number;
}

//Bikin tanggal jadi dmY
function parsedmY(T){
    date = new Date(T);

    year = date.getFullYear();
    month = date.getMonth()+1;
    dt = date.getDate();

    dt = lessTen(dt);
    month = lessTen(month);

    let ulu = dt+'-' + month + '-'+year;
    return ulu;
}

//INI KENAPA FORMATNYA BISA BERUBAH JINK
function parseFromdmY(T){
    string = T;
    substr_index = 0;

    for(let i = 0; i< string.length; i++){
        if(string.charAt(i) == ' '){
            substr_index = i;
            break;
        }
    }

    return string.substr(0, substr_index).trim();
}

//Bikin tanggal jadi dmY H:i:s
function parsedmYHi(T){
    date = new Date(T);
    year = date.getFullYear();
    month = date.getMonth()+1;
    dt = date.getDate();
    hh = date.getHours();
    ii = date.getMinutes();

    dt = lessTen(dt);
    month = lessTen(month);
    hh = lessTen(hh);
    ii = lessTen(ii);

    let ulu = dt+'-' + month + '-'+year+ " "+hh+":"+ii;
    return ulu;

}

function parseHi(T){
    date = new Date(T);

    hh = date.getHours();
    ii = date.getMinutes();

    hh = lessTen(hh);
    ii = lessTen(ii);

    let ulu = hh+":"+ii;
    return ulu;

}

//Check Duplicate Value in Array. isi itu value yang mau dicari, aray itu arraynya.
//Kalau return flag nya 1, berarti gaada duplicate
//Kalau return flagnya 0, berarti gaada valuenya
function checkDuplicate(isi, aray){
    var flag = 0;
    for(let i = 0; i< aray.length; i++){
        if(isi == aray[i]) flag++;
    }

    return flag;
}

//Check ini tanggal ada di masa lalu atau kaga
//If return true, berarti yes.
function checkPastTime(T){
    dateDestinate = Date.parse(T);
    dateNow = Date.now();

    if(dateDestinate < dateNow)
        return true;

    return false;
}

//Replace all spaces to Plus
function spaceToPlus(T){
    var str = T;
    var replaced = str.split(' ').join('+');

    return replaced;
}

//Make x seconds, minutes, hours, days, weeks, months, year ago
function makeAgo(T){
    dateDestinate = new Date(T).getTime()/1000;
    dateNow = Date.now()/1000;
    let stringReturn = "";
    let selisih = dateNow - dateDestinate;

    if(selisih < 60 && selisih >= 0) stringReturn = parseInt(selisih)+" second ago";
    if(selisih < 3600 && selisih >= 60) stringReturn = parseInt(selisih / 60)+" minute ago";
    if(selisih < 86400 && selisih >= 3600) stringReturn = parseInt(selisih / 3600)+" hour ago";
    if(selisih < 604800 && selisih >= 86400) stringReturn = parseInt(selisih / 86400)+" day ago";
    if(selisih < 2628000 && selisih >= 604800) stringReturn = parseInt(selisih / 604800)+" week ago";
    if(selisih < 31536000 && selisih >= 2628000) stringReturn = parseInt(selisih / 2628000)+" month ago";
    if(selisih >= 31536000) stringReturn = parseInt(selisih / 31536000)+" year ago";
    return stringReturn;
}

//Get Dates between https://stackoverflow.com/questions/4413590/javascript-get-array-of-dates-between-2-dates
function getDatesBetween(start, end) {
    start = new Date(start);
    end = new Date(end);
    for(var arr=[],dt=start; dt<=end; dt.setDate(dt.getDate()+1)){
        arr.push(parsedmY(new Date(dt)));
    }
    return arr;
}

//Get Epoch Time from Specific Date
function getEpochTime(T){
    x = Date.parse(T);

    return x;
}

// disable all key ( for loader )
function disableKeys() {
    document.onkeypress = function (e) {
        return false;
    };
    document.onkeydown = function (e) {
        return false;
    };
}

// enable all key ( for loader )
function enableKeys() {
    document.onkeypress = function (e)  {
        return true;
    };
    document.onkeydown = function (e)  {
        return true;
    };
}

// Currency Format
function formatCurrency(number, first = "Rp. ", last = ",-") {
    return first+formalNumberFormat(number, ".")+last;
}

// error alert
function showError(obj) {
    Swal.mixin({
        buttonsStyling: !1,
        customClass: {
            confirmButton: "btn btn-danger m-1",
            cancelButton: "btn btn-danger m-1",
            input: "form-control"
        },
        allowOutsideClick: false,
        confirmButtonText: "Close"
    }).fire(
        (obj.code===null || obj.code===undefined) ? "Error" : obj.code,
        (obj.message===null || obj.message===undefined) ? "There is an error when hit an action" : obj.message,
        "error"
    );
}

//Custom Swal Alert
function customSwal(title, message, type = "error"){
    Swal.mixin({
        buttonsStyling: !1,
        customClass: {
            confirmButton: "btn btn-danger m-1",
            cancelButton: "btn btn-danger m-1",
            input: "form-control"
        },
        allowOutsideClick: false,
        confirmButtonText: "Close"
    }).fire(
        title,
        message,
        type
    );
}

function uncloseableSwal(title, message){
    Swal.mixin({
        buttonsStyling: !1,
        showCancelButton: false,
        showConfirmButton: false ,
        allowOutsideClick: false
    }).fire(
        title,
        message,
        "error"
    );
}

// format all string to be number
function stringToNumber(num) {
    if(typeof num === 'string') return num.replace(/[^0-9]+/g, '')*1;
    else return typeof num === 'number' ? num : 0;
}

// get object in array by value of object
function getObjectByvalueInArray(arr, att, val) {
    var result;
    arr.forEach(function(value) {
        if(value[att] === val) result = value;
    });
    return result;
}

function indonesianRupiahFormatter(integer){
    var lang = integer.toString();
    idr = "";
    j = 1;

    for(i = lang.length-1; i > -1; i--){
        idr = lang.charAt(i) + idr;
        if(j%3 == 0 & i!= 0)
            idr = "." + idr;
        j++;
    }

    idr = "Rp. " + idr; 
    idr += ",00";

    return idr;
}
