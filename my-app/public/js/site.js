
// Function Error Toast Message
function ErrorToast(msg) {
    toastr.options.positionClass = 'toast-bottom-center';
    toastr.error(msg);
}
// Function Success Toast Messsage
function SuccessToast(msg) {
    toastr.options.positionClass = 'toast-bottom-center';
    toastr.success(msg);
}

//Global Variable
var EmailRegx = /\S+@\S+\.\S+/;
var MobileRegx = /(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/;
var OnlyNumberRegx = /^\d+$/;
var OnlyLaterRegx = /^[A-Za-z\'\s\.\,\-\']+$/;
var BtnSpinner = "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing";
var Spinner = "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>";


// Window Session
function setMobileNumber(Mobile){
    sessionStorage.setItem("MobileNumber",Mobile);
}
function getMobileNumber(){
    return  sessionStorage.getItem("MobileNumber");
}

function setName(Name){
    sessionStorage.setItem("Name",Name);
}
function getName(){
    return sessionStorage.getItem("Name");
}
