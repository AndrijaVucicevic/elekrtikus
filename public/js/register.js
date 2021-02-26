$("#signup-form .form-row .form-group input").on('focus',function()
    {

      //var input=this;
     //console.log(input.value);
        $(this).removeClass('errors');
        var re=$(this).attr('id');
        if(re=='password'||re=='password_confirmation' || re=='old_password' || re=='password_change')
        {
            if(re=='password')
            {
                $("#toggle_password").next().remove();
            }
            if(re=='password_confirmation'){
                $("#toggleRePassword").next().remove();
            }
            if(re=='old_password')
        {
            $("#toggle_old_password").next().remove();
        }
            if(re=='password_change')
            {//

                $("#toggle_password_change").next().remove();
            }

        }
        else {
            $(this).next().remove();
        }

    });

$(document).on('click','.fa-eye',function (e) {

    var reId=this.id;

    if(reId=='toggle_password')
    {
        $('#password').attr('type', 'text');

    }
    if(reId=='toggleRePassword'){
        $('#password_confirmation').attr('type', 'text');
    }
    if(reId=='toggle_old_password')
    {
        $('#old_password').attr('type', 'text');
    }
    if(reId=='toggle_password_change')
    {
        $('#password_change').attr('type', 'text');
    }
    $(this).toggleClass('fa-eye fa-eye-slash');

});
$(document).on('click','.fa-eye-slash',function (e) {

    var reId=this.id;

    if(reId=='toggle_password')
    {
        $('#password').attr('type', 'password');

    }
    if(reId=='toggleRePassword'){
        $('#password_confirmation').attr('type', 'password');
    }
    if(reId=='toggle_old_password')
    {
        $('#old_password').attr('type', 'password');
    }
    if(reId=='toggle_password_change')
    {
        $('#password_change').attr('type', 'password');
    }
    $(this).toggleClass('fa-eye-slash fa-eye');

});


$("#first_name").focusout(function () {

    var reName=/^[A-ZČĆŠŽĐ][a-zčćšđž]{2,12}(\s[A-ZČĆŠŽĐ][a-zčćšđž]{2,12})*$/;
    if(!reName.test($(this).val()))
    {
       //after prikaz
        $(this).after('<label class="errors">Ime nije u redu</label>');

    }


});
$("#last_name").blur(function () {


    var reName=/^[A-ZČĆŠŽĐ][a-zčćšđž]{2,12}(\s[A-ZČĆŠŽĐ][a-zčćšđž]{2,12})*$/;
    if(!reName.test($(this).val()))
    {
        //after prikaz
        $(this).after('<label class="errors">Prezime nije u redu</label>');

    }


});
$("#email").blur(function () {


    var reEmail=/^[\w]+[\.\_\-\w]*\@[\w]+([\.][\w]+)+$/;
    if(!reEmail.test($(this).val()))
    {
        //after prikaz
        $(this).after('<label class="errors">Email</label>');

    }


});
$("#username").focusout(function () {
//alert('aa');
    var reUsername=/^[\w\.\_\d]{6,17}$/;
    if(!reUsername.test($(this).val()))
    {
        //after prikaz
        $(this).after('<label class="errors">Username</label>');

    }


});
$('.pass').blur(function () {

    var rePassword=new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\.!@#\$%\^&\*])(?=.{8,})");

    if(!rePassword.test($(this).val()))
    {
        //console.log(this.id);
        //after prikaz
        $("#toggle_"+this.id).after('<label class="errors">Obavezno[A-Z][. ili _][0-9]6-17 karaktera</label>');

    }


});


$("#password_confirmation").blur(function () {


    if($(this).val()!==$("#password").val())
    {
        //after prikaz
        $("#toggleRePassword").after('<label class="errors">Sifre se ne poklapaju</label>');
    }


});





$("#submitForm").on('click',function (e) {

    e.preventDefault();

    var name=$("#first_name").val();
    var lastName=$("#last_name").val();
    var email=$("#email").val();
    var password=$("#password").val();
    var repeatPassword=$("#password_confirmation").val();
    var username=$("#username").val();

    var reName=/^[A-ZČĆŠŽĐ][a-zčćšđž]{2,12}(\s[A-ZČĆŠŽĐ][a-zčćšđž]{2,12})*$/;
    var rePassword=new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\.!@#\$%\^&\*])(?=.{8,})");
    var reUsername=/^[\w\.\_\d]{6,17}$/;
    var reEmail=/^[\w]+[\.\_\-\w]*\@[\w]+([\.][\w]+)+$/;

    var errors=[];

    if(!reName.test(name))
    {
        errors.push('Ime');

    }
    else{
        $("#first_name").css("borderColor","");

    }

    if(!reName.test(lastName))
    {
        errors.push('Prezime');
    }
    else{
        $("#last_name").css("borderColor","");


    }
    if (!reUsername.test(username))
    {
        errors.push('Username');
        $("#username").css('borderColor',"red");

    }
    else{
       $("#username").css('borderColor',"");
    }

    if (!rePassword.test(password))
    {
        errors.push('Password');
    }
    else{
        $("#password").css("borderColor","");
    }
    if (repeatPassword!==password)
    {
        errors.push('Re_password')
    }
    else{
        $("#password_confirmation").css('borderColor',"");
    }





    if(!reEmail.test(email)){
        errors.push("Email");

    }
    else{

        $("#email").css("borderColor","");
    }

console.log(errors);
    if(errors.length==0)
    {
       // console.log('ajakx');
        $.ajax({
          url:base_Url+'register',
            method:'post',
            data:{
              _token:csrf,
                first_name:name,
                lastName:lastName,
                email:email,
                username:username,
                password:password,
                password_confirmation :$("#password_confirmation").val(),
              send:true
            },
            success:function (data) {


                if($.isEmptyObject(data.error)){
                    $(".print-error-msg").hide();

                    $("#sign_up").css('display','block');

                    $("#sign_up").html("<strong>Uspesna registracija!Proverite vas mejl radi verifikacije</strong>");

                    $("#signup-form").hide();
                }
                else{

                    printErrorMsg(data.error);
                }

            }




        });




    }


});


function printErrorMsg (msg) {
    //  alert("Aaa");
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', '');
    $.each(msg, function (key, value) {
        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
    });


}
function printError (msg) {
    /// alert("Aaa");
    //check the way
    $("#displayErrors").html('');

    $("#displayBlockError").css('display', 'block');

    $.each(msg, function (key, value) {
        $("#displayErrors").append('<li>' + value + '</li>');
    });


}
