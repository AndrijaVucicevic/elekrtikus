const base_Url='http://localhost/elektrikus/public/';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


window.onload=function() {
    // alert("aaa");



    

    $.ajax({
        url: base_Url + "subcategory",
        method: 'POST',
        data: {
            _token: csrf,
            send: true
        },
        success: function (data) {

            //alert(data);

            var option = ' <select id="category_search>';

            for (var i = 0; i < data.length; i++) {
                if (i == 0) {
                    option += '<option value="all">Sve kategorije</option>'

                }
                option += '<option value="' + data[i].subcategory_name + '">' + data[i].subcategory_name + '</option>'


            }
            option += '</select>';
            $("#category_search_bar").append(option);

        }


    });



};




$("#myTab .nav-item a").on('click',function (e) {
    e.preventDefault();

    var href=$(this).attr('href');

    var string=href.split('_');



console.log(string[0]);

//alert(tab);
    //ajax change category trending

    $.ajax({
        url:base_Url+'change_trending',
        method:'POST',
        data:{
            _token: csrf,
            category:string[0],
            send:true
        },
        success:function (data) {
            //
            //alert('ok');
            if(data!=404) {

                if (string[1]=='second')
                {

                    $("#trending_change_second").html(data);
                }
                else{
                $("#trending_change").html(data);
 }
            }

//error
//
            if (data == 404) {
                $("#modalBody-alert").html('Doslo je do greske');

                $("#alertButtonModal").click();
            }
        }

    });


});

$("#btn-subscribe").on('click',function (e) {
    e.preventDefault();



    $('#btn-subscribe').prop('disabled', true);



    var email=$("#email-subscribe").val();

    var reEmail1= /^[\w]+[\.\_\-\w]*\@[\w]+([\.][\w]+)+$/;

    if(!reEmail1.test(email)){

        $("#modalBody-alert").html('Nedozvoljen format email adrese');

        $("#alertButtonModal").click();


    }

    else{

        //ajax upit baza

        $.ajax({
            url:base_Url+'email_subscribe',
            method:'POST',
            data:{
                _token: csrf,
                email:email,
                send:true
            },
            success:function (data) {

                if (data == 201) {
                    $("#email-subscribe").html('');

                    $("#modalBody-alert").html('Uspesna prijava');

                    $("#alertButtonModal").click();
                }
//error
                if (data == 404) {
                    $("#modalBody-alert").html('Doslo je do greske');

                    $("#alertButtonModal").click();
                }
            }
            ,
            error:function(xhr,error,status)
            {
                // alert(xhr.status);

                if(xhr.status==422)
                {
                    $("#modalBody-alert").html('Vec ste prijavljeni');

                    $("#alertButtonModal").click();
                }
            }

        });


    }

    $('#btn-subscribe').prop('disabled', false);






});

//$("#btnLogin").on('click',})
$("#btnLogin").on('click',function () {






   var name=$("#login_username").val();
   var password=$("#login_password").val();

    var rePassword=new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\.!@#\$%\^&\*])(?=.{8,})");
    var reUsername=/^[\w\.\_\d]{6,17}$/;
    var reEmail=/^[\w]+[\.\_\-\w]*\@[\w]+([\.][\w]+)+$/;

    var errors=[];


    if(!rePassword.test(password))
    {
        errors.push('password');
        $("#login_username").css('borderColor','red');
    }
    if(!reEmail.test(name))
    {
        if(!reUsername.test(name)) {
            errors.push('username');
            $("#login_username").css('borderColor', 'red');
        }
    }

    if (errors.length==0) {

        $("#myModal").css('cursor','progress');
        $.ajax({
            url:base_Url+'login',
            method:'post',
            data:{
                _token:csrf,
                name:name,
                password:password,
                send:true
            },
            success:function (data) {


                if($.isEmptyObject(data.error)){
                    $(".print-error-msg").hide();


                //alert("Login uspesno");
                   // $(".user_list").html('<i class="ti-user"></i>'+name);
                    //$(".login_list").html('<i class="ti-power-off"></i><a href="'+base_Url+'logout">Odjava</a></li>');


                    $("#myModal").css('display','none');
                    $("#closeLogin").click();
                  //  $('.modal-header1 .close').click();
                    // $(".modal-header1 .myClose").click();

// window.location.href=location.href;
location.reload();
                }
                else{

                   // printErrorMsg(data.error);

                    //console.log(error);

                    $(".modal-body1 #loginErrors").find("ul").html('');
                    $(".modal-body1 #loginErrors").css('display','');
                   // $(".modal-body1 #loginErrors").find("ul").append('<li>' +data.error + '</li>');


    $.each(data.error, function (key, value) {
        $(".modal-body1 #loginErrors").find("ul").append('<li>' + value + '</li>');
    });




                }

            }




        });


    }
    else{
        //greske
       // console.log(errors);
    }

});




$("#login_username").blur(function () {

    //greske
    var reUsername=/^[\w\.\_\d]{6-17}$/;
    var reEmail=/^[\w]+[\.\_\-\w]*\@[\w]+([\.][\w]+)+$/;
    if(!reUsername.test($(this).val())&&!reEmail.test($(this).val()))
    {
       //
        $(this).addClass('errors');
    }


});
$("#login_password").blur(function () {

    var rePassword=new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\.!@#\$%\^&\*])(?=.{8,})");

    if(!rePassword.test($(this).val()))
    {
        $(this).addClass('errors');
    }

});
$('#login_form .form-group1 input').focus(function () {
    $(this).removeClass('errors');
    //greske
});


$(".list-main").on('mouseover','.loginUser',function() {
  // alert("aa");
});
//get message
$(".sinlge-bar i").on('mouseover',function () {
   //console.log('messenger');

    let i_class=this.className;


    i_class=='fa fa-envelope-open-o' ? i_class='messages': i_class='likes';



    //console.log(i_class);
    $.ajax({
       url:base_Url+'user',
       method:'post',
        data:{
            _token:csrf,
           code:i_class,
           send:true,
        },
        success:function (data) {

        },
        error:function(xhr,error,status)
        {
            // alert(xhr.status);


        }



    });



});

$("#categoryShopList li").on('click',function (e) {
    e.stopPropagation();
    var content = $(this).find('ul')[0];



     window.location.href.includes('user') ? user_categories(content,this.id) :  other_categories(content,this.id);

    });
//category a href link
function other_categories(contentt,id)
{
    var content = contentt;
    var categoryId=id;
    if(content) {
        //console.log(content);
        if (content.style.display == 'block') {
            content.style.display = 'none';
        } else {
            content.style.display = 'block';
        }
    }
    else{
        //console.log(this);
        var category=categoryId.split("_");
        if(location.href!=category[1]) {

            //ispitivanje da li ima, da li da ucitava stranicu
            window.location.href = category[1];
        }



    }




}


//category user page sort filt
function user_categories(contentt,id)
{

        var content = contentt;
        var categoryId=id;
        if(content) {

            if (content.style.display == 'block') {
                content.style.display = 'none';
            } else {
                content.style.display = 'block';
            }
        }
        else {

            // console.log(active);
            var cat= categoryId.split("_");
            var active=categoryId;
            var code=location.href.split('=');
            $.ajax({
                url: base_Url + "changeUserCategory",
                method: 'post',
                data: {
                    _token:csrf,
                    category:cat[2],
                    code:code[2],
                    send: true
                },
                success: function (data) {

                    if (data != 404) {

                        $("#content_user").html(data);
                        $(".subcategory_list li").removeClass('activeCategory');
                        $("#"+active).addClass('activeCategory');
                        $(".shop-top .more_products").attr('data-value','more-products_1')
                        // this.id.addClass('activeCategory');
                        // console.log(active);
                    }
                    //error
                    if (data == 404) {
                        modalBody('Trenutno nemamo oglas iz trazene kategorije');

                        $("#alertButtonModal").click();
                    }
                }
                ,
                error: function (xhr, error, status) {
                    // alert(xhr.status);


                }


            });
        }








}


$('#sendMessageUser').on('click',function (e) {
   //open modal and send
  modalAlert('Posalji poruku');
  modalBody('<textarea id="modalPor" name="modalPor" placeholder="Unesite poruku"></textarea>');
  $('#exampleModal1 .btn-secondary').css('display','none');
  $('#exampleModal1 .modal-body').css('width','auto');
    $('#exampleModal1 .modal-body textarea').css('height', '150px');


    $('#exampleModal1 .modal-dialog .modal-content .modal-footer').append('<button type="button" id="alertModalSendMessage" class="btn btn-primary">Pošalji poruku</button>');

    $("#alertButtonModal").click();





});

$(document).on('click','#alertModalSendMessage',function (e) {


    var text=$('#exampleModal1 .modal-body textarea');
    var reDescription=/^[\w\s\d\W]{1,1000}$/;

    if(!reDescription.test(text.val()))
    {
        text.addClass('borderError');
        $('#exampleModal1 .modal-body').append('Tekst poruke nije u dozvoljenom formatu');
    }
    else{

        $.ajax({
           url:base_Url+'sendMessage',
           method:'post',
           data:{
               _token:csrf,
               text:text.val(),
               href:window.location.href,
               send:true
           },
            success:function (data) {

               //OK PORUKA POSLATA


            },
            error:function (xhr,error,status) {

            }




        });






    }


});




function modalAlert(value)
{
    $("#exampleModalLabel").html(value);
    //alert("alert");
}
function modalBody(value)
{
    $("#modalBody-alert").html(value);
    $("#alertModalSendMessage").remove();
}


//
function buttonDisabled(id){
    document.getElementById(id).disabled = true;
    setTimeout(function(){document.getElementById(id).disabled = false;},5000);
}
