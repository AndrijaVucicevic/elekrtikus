$('.search_more').on('click',function (e) {
e.preventDefault();

   var code1= $(".shop-top .more_products").attr('data-max');
    var code2=$(".shop-top").attr('data-max');

    if(code1==1||code2==1)
    {
        modalBody('Trenutno nemao vise oglase za navedene parametre');

        $("#alertButtonModal").click();
    }
    else {
        loadMoreProducts('app');
    }
});


$('.more_products').on('click',function (e) {
    e.stopPropagation();

    var code1= $(".shop-top .more_products").attr('data-max');
    var code2=$(".shop-top").attr('data-max');

    if(code1==1||code2==1)
    {

        modalBody('Trenutno nemamo oglas iz trazene kategorije');
        modalAlert('Alert');

        $("#alertButtonModal").click();
    }
    else {
        loadMoreProducts('app');
    }
});





function loadMoreProducts(htm) {
    //
   //alert("aa");
    var start=$(".more_products").attr('data-value').split('_');

//console.log(start);

    let loc=location.href;
     let code=loc.split('=');
    // console.log(category);
    var cat=null;
    var check=$(".subcategory_list .activeCategory").attr('id');
    //console.log(check);
    if(check!=null)
    {
        var category = check.split('_');
         cat=category[2];
    }

    $.ajax({
       url:base_Url+'more_products',
        method:'post',
        data:{
            _token:csrf,
            code:code[2],
            category:cat,
            start:parseInt(start[1]),
           send:true
        },
        success:function (data) {


           if(data!=404)
           {
               let now=parseInt(start[1])+1;
               htm=='app'?
               $("#content_user").append(data): $("#content_user").html(data);
               $('.more_products').attr('data-value','more-products_'+now);

           }

            if (data == 404) {
                //pagination--greska strana


                modalBody('Trenutno nemao vise oglase za navedene parametre');



                modalAlert('Alert');

                $("#alertButtonModal").click();

                $(".shop-top .more_products").attr('data-max','1');
                $(".shop-top").attr('data-max','1');
                //disable button
            }

        },
        error:function(xhr,error,status)
        {
            // alert(xhr.status);


        }


    });


}


function oop() {


    console.log('aa');
    var product = $(".btnUserAction").attr('data-value');
    var pass = $("#userActionCheck").val();
    if (product != null && product != undefined) {
        $.ajax({
            url: base_Url + 'delete_product_user',
            method: 'post',
            data: {
                _token: csrf,
                id: product,
                pass: pass,
                send: true
            },
            success: function (data) {

                if (data == 201) {

                    let more = $(".more_products").attr('data-value').split('_');
                    let next = parseInt(more[1]) - 1;
                    $(".more_products").attr('data-value', 'more-products_' + next);
                    console.log($(".more_products").attr('data-value'));


                    $("#user_check_body").html('<h4>Uspešno ste izbrisali proizvod</h4>');


                    setTimeout(function () {
                            $("#user_check .close").click();
                            loadMoreProducts('delete');
                        }
                        , 5000);


                }
                //error
                if (data != 201) {


                    if (data == 404) {
                        modalBody('Doslo je do greske prilikom brisanja');
                    }
                    if (data == 419) {
                        modalBody('Šifra se ne poklapa unesite ponovo šifru');
                    }


                }
            }
            ,
            error: function (xhr, error, status) {
                // alert(xhr.status);


            }


        });


    }

}






$('#content_user').on('click','.fa-trash-o',function (e) {


   /* $(".btn-secondary").attr('id','btnUserAction');
    $("#btnUserAction").attr('data-value',this.id);
    $("#btnUserAction").removeAttr('data-dismiss');
    $("#btnUserAction").html('Izvrši');

*/

    var html='  <h4>Brisanje oglasa</h4><br><span>Za izabranu akciju, potrebno je da unesete Vašu šifru </span>'+
        '<input type="password" id="userActionCheck"/>';

$("#user_check_body").html(html);
//$("#user-modal-footer").html('<button id="btnUserAction" class="btn" data-value="'+this.id+'" onclick="opp()">Izvrši</button>');
$(".modal-footer .btnUserAction").attr('data-value',this.id);

    $("#user_change_check").modal('show');

//delete

});











// PICTURE FORM INSERT UPDATE PRODUCT

$(document).on('change','.pictureBlock', function () {

    var id=this.id;
    //alert(id);
    var str =id;
    var res = str.charAt(4);
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imgshow'+res).attr('src', e.target.result);

            if($('#imgshow'+res).hasClass('deletePicture'))
            {
                $('#imgshow'+res).removeClass('deletePicture');
            }
        }
        reader.readAsDataURL(this.files[0]);



    }
});
$('form #section_secondStep textarea').on('focus',function () {
    $(this).removeClass('borderError');
});
$('form #section_secondStep textarea').on('blur',function () {

    var reDescription=/^[\w\s\d\W]{1,2000}$/;

    if(!reDescription.test($(this).val()))
    {
        $(this).addClass('borderError');
    }
    else{
        $(this).removeClass('borderError');
    }

});


$('form #section_secondStep input [type=text]').on('focus',function(){
   $(this).removeClass('borderError');


});
$('form #section_secondStep input [type=text]').on('blur',function(){

    var reNameProduct=/^[\w\s./,/]{1,60}$/;

    var rePrice=/^[1-9][0-9]+$/;

    if(this.id=='price_new')
    {
        if(!rePrice.test($(this).val()))
        {
            $(this).addClass('borderError');
        }
        else{
            $(this).removeClass('borderError');
        }
    }
    else{
        if(!reNameProduct.test($(this).val()))
        {
            $(this).addClass('borderError');
        }
        else{
            $(this).removeClass('borderError');
        }
    }

});

$('form #section_fourthStep input[type=text]').on('focus',function () {
   //console.log(this);
    $(this).next().css('display','none');
});

$(document).on('blur','form #section_fourthStep input[type=text]',function () {
   $(this).next().css('display','initial');

  // console.log(this.id);

    switch (this.id) {
        case 'user_name':
          let user_name=checkName(this);
          var data='Ime:';
          var color='black';
          if(user_name!=201)
          {
            data='[Prvo veliko slovo][ostatak imena][razmak][drugo ime ako imate]';
            color='red';
          }

            $(this).next().html(data);
            $(this).next().css('color',color);

            break;
        case 'user_lastName':
            let user_lastName=checkLastName(this);
            var data='Prezime:';
            var color='black';
            if(user_lastName!=201)
            {
                data='[Prvo veliko slovo][ostatak prezimena][razmak][drugo prezime ako imate]';
                color='red';
            }

            $(this).next().html(data);
            $(this).next().css('color',color);

            break;
        case 'user_phone':
            let user_phone=checkPhone(this);
            var data='Prezime:';
            var color='black';
            if(user_phone!=201)
            {
                data='[+381 ili 06][ostatak Vašeg broja, 6-7 cifara]';
                color='red';
            }

            $(this).next().html(data);
            $(this).next().css('color',color);
            break;

        case 'user_place':
            let user_place=checkPlace(this);
            var data='Mesto:';
            var color='black';
            if(user_place!=201)
            {
                data=' Npr: [Gornji Milanovac] %nbsp; [Beograd]';
                color='red';
            }

            $(this).next().html(data);
            $(this).next().css('color',color);
            break;
        case 'user_street':
            let user_street=checkStreet(this);
            var data='Ulica:';
            var color='black';
            if(user_street!=201)
            {
                data=' Npr: [kralja Petra 6-6] %nbsp; [Mosorska 6-6]';
                color='red';
            }

            $(this).next().html(data);
            $(this).next().css('color',color);
            break;
        case 'user_jmbg':
            let user_jmbg=checkJMBG(this);
            var data='JMBG:';
            var color='black';
            if(user_jmbg!=201)
            {
                data='[Unesite Vaš jedinstveni matični broj gradjanina]';
                color='red';
            }

            $(this).next().html(data);
            $(this).next().css('color',color);
            break;
        case 'user_IDcard':
            let user_IDcard=checkIDcard(this);
            var data='Lična karta:';
            var color='black';
            if(user_IDcard!=201)
            {
                data='[Unesite Vaš broj lične karte]';
                color='red';
            }

            $(this).next().html(data);
            $(this).next().css('color',color);
            break;


    }




});
$('.chCurrency').on('click',function (e) {

    //alert('ee');

    $('.chCurrency').removeClass('outlineError')

});
$(document).on('click','.chFixed',function (e) {

   // alert('ee');

   if (this.id=='ch_Fixed1')
   {
       $('.chFixed').removeClass('outlineError');
       $('.ch_Fixed').prop('checked',false);
   }
   else{
       $('#ch_Fixed1').prop('checked',false);

       if(!$('#ch_Fixed2').is(':checked'))
       {
           if(!$('#ch_Fixed3').is(':checked'))
           {
               $('.chFixed').addClass('outlineError');
           }
           else{
               $('.chFixed').removeClass('outlineError');
           }

       }
       else{
           $('.chFixed').removeClass('outlineError');
       }

   }

});
$('.ch_accept').on('click',function () {
    //alert("e2");
    if (!$(this).is(':checked'))
    {
        $(this).addClass('outlineError');
    //alert("e1");
    }

    else{
        $(this).removeClass('outlineError');
       // alert("e2");
    }

});


//update insert
$(document).on('click','.btnUpdateInsert',function (e) {
    e.preventDefault();



    $('.btnUpdateInsert').prop('disabled',true);

    var btnAction=$(this).attr('data-value').split('#');


    console.log(btnAction[1]);
     var   idUpdate=null;
     var   changePicture='';

     if(btnAction[1]=='user')
     {
         //console.log('aa');
         let result=changeUser();

         if(result==201)
             return;
     }

    if (btnAction[1]==2)
    {
        idUpdate=$('#user_lastName').attr('data-bind');
         var classList=$('.deletePicture');
       if(classList.length>0)
       {
           for (let i=0;i<classList.length;i++) {
               if ((i + 1) == classList.length) {
                   changePicture += $(classList[i]).attr('id');
               } else {
                   changePicture += $(classList[i]).attr('id') + '#';
               }

           }
       }


    }

//console.log('aa');
    var errors=[];

    var cat_first= $("#category_ddl").next().find('ul');

    var cat_second=cat_first.find('.selected');

    var cat=cat_second.html();

    if(cat=='Kategorija:')
    {
        //nice-select

       $("#category_ddl").next().addClass('borderError');
        //console.log(catError);
     //   $(catError).addClass('borderError');
    }




    var sub_first= $("#subcategory_ddl").next().find('ul');

    var sub_second=sub_first.find('.selected');

    var sub=sub_second.html();
//console.log(sub);
    if(sub.includes("kategoriju"))
    {
     $("#subcategory_ddl").next().addClass('borderError');


    }


    var ppk_first= $("#ppk_ddl").next().find('ul');

    var ppk_second=ppk_first.find('.selected');

    var ppk=ppk_second.html();

    if (ppk.includes('kategoriju'))
    {
       $("#ppk_ddl").next().addClass('borderError');


    }


    var condition=$("#conditionStatus");


    var nameProduct=$("#text_name");
    var price=$("#price_new");
    var desciption=$("#description_new");
    //reqExp
    var reNameProduct=/^[\w\s./,/]{1,60}$/;
    var reDescription=/^[\w\s\d\W]{1,2000}$/;
    var rePrice=/^[1-9][0-9]+$/;

//maybe change price, permission first number can be 0

    if (!reNameProduct.test(nameProduct.val()))
    {
        errors.push('Naziv proizvoda je neodgovarajući');
        nameProduct.addClass('borderError');
    }
    if (!reDescription.test(desciption.val()))
    {
        if(desciption.val().length>2000)
        {
            errors.push('Dozvoljena dužina teksta je 2000 karaktera');
        }
        else{
            errors.push('Opis proizvoda je u neodgovarajućem formatu');
        }

        desciption.addClass('borderError');
    }
    if (!rePrice.test(price.val()))
    {
        errors.push('Za cenu koristite brojeve');
        price.addClass('borderError');
    }


    var currency=$('input[name=ch_currency]:checked', '#formInsert_update').val();
    if (currency==null)
    {
        errors.push('Označite uslove vezane za cenu');

        $(".chCurrency").addClass('outlineError');
    }
    var priceStatus=null;

    var con_replacement=null;
    var deal=null;
   if($("#ch_Fixed1").is(':checked')) {

       priceStatus=parseInt($("#ch_Fixed1").val());
   }
   else {
       if($("#ch_Fixed2").is(':checked')) {
            deal = $("#ch_Fixed2").val();
       }
       if($("#ch_Fixed3").is(':checked')) {
           con_replacement = $("#ch_Fixed3").val();
       }
       if (con_replacement==null && deal==null)
       {
           errors.push('Označite uslove vezane za cenu');


          $(".chFixed").addClass('outlineError');

       }
       else
       {
           priceStatus=parseInt(con_replacement)+ parseInt(deal);
       }
   }

//PROMOTION
var promotion=null;
var promotion_one=null;
var promotion_two=null;


    if($("#chStandard").is(':checked')) {
      promotion=0;
    }
    else {
        if ($("#chProm1").is(':checked')) {
            promotion_one = 1;
        }
        if ($("#chProm2").is(':checked')) {
            promotion_two = 2;
        }

        if(promotion_one==null && promotion_two==null)
        {
            promotion=0;
        }
        else{
            if(promotion_one==null && promotion_two!=null)
            {
                promotion=parseInt(promotion_two);
            }
            if(promotion_one!=null && promotion_two==null)
            {
                promotion=parseInt(promotion_one);
            }
            if(promotion_one!=null && promotion_two!=null)
            {
                promotion = parseInt(promotion_one)+parseInt(promotion_two);
            }


        }

    }
    // personal information

   let personName=checkName($('#user_name'));
    if (personName!=201)
    {
        errors.push("Ime nije u dozvoljenom formatu");
    }
    let personLastName=checkLastName($('#user_lastName'));
    if (personLastName!=201)
    {
        errors.push("Prezime nije u dozvoljenom formatu");
    }
    let personPhone=checkPhone($('#user_phone'));
    if (personPhone!=201)
    {
        errors.push("Telefon nije u dozvoljenom formatu");
    }
    let personPlace=checkPlace($('#user_place'));
    if (personPlace!=201)
    {
        errors.push("Mesto-grad nije u dozvoljenom formatu");
    }
    let personStreet=checkStreet($('#user_street'));
    if (personStreet!=201)
    {
        errors.push("Ulica nije u dozvoljenom formatu");
    }
    let personJMBG=checkJMBG($('#user_jmbg'));
    if (personJMBG!=201)
    {
        errors.push("JMBG nije u dozvoljenom formatu");
    }
    let personIDcard=checkIDcard($('#user_IDcard'));
    if (personIDcard!=201)
    {
        errors.push("Lična karta nije u dozvoljenom formatu");
    }
   //accepted terms

    var accuracy=null;
    var terms=null;
    if($("#ch_accuracy").is(':checked')) {
        accuracy=1;
    }
    else{
        $('#ch_accuracy').addClass('outlineError');
    }

    if($("#ch_terms").is(':checked')) {
        terms=1;
    }
    else{
        $('#ch_terms').addClass('outlineError');
    }


if (terms==null)
{
    //uslovi
    errors.push('Niste prihvatili uslove korišćenja')
}
if (accuracy==null)
{
    //tacnost
    errors.push('Morate garantovati za tačnost unetih podataka');
}


var counter=0;

var fd=new FormData();


for(let i=0;i<10;i++) {

    if(idUpdate!=null)
    {
        var files = $('#file' + i)[0].files[0];
        fd.append('file' + i, files);

    }
    else {
        if (document.getElementById("file" + i).files.length === 0) {
            //nista
        } else {

            var files = $('#file' + i)[0].files[0];
            fd.append('file' + counter, files);
            counter++;
        }
    }

}

if (counter==0 && idUpdate==null)
{
    errors.push('Morate uneti sliku proizvoda');
}


//console.log(errors);
    
    if (errors.length==0)
    {
        //ide ajaks poziv i upis



        fd.append('nameProduct',nameProduct.val());
        fd.append('ppk',ppk);
        fd.append('price',price.val());
        fd.append('currency',currency);
        fd.append('condition',condition.val());
        fd.append('priceStatus',priceStatus);
        fd.append('description',desciption.val());
        fd.append('promotion',promotion);
        fd.append('personName',$('#user_name').val());
        fd.append('personLastName',$('#user_lastName').val());
        fd.append('personPhone',$('#user_phone').val());
        fd.append('personPlace',$('#user_place').val());
        fd.append('personStreet',$('#user_street').val());
        fd.append('personJMBG',$('#user_jmbg').val());
        fd.append('personIDcard',$('#user_IDcard').val());
        fd.append('ch_accuracy',accuracy);
        fd.append('ch_terms',terms);
        fd.append('counter',counter);
        fd.append('token',csrf);
        fd.append('idUpdate',idUpdate);
        if (changePicture != '') {
            fd.append('changePicture',changePicture);
        }

       //console.log(fd);

        $.ajax({
            url: base_Url + 'insert_update_product_user',
            method: 'post',
            data:fd,
            contentType: false,
            processData: false,
            success: function (data) {
//change or delete
//console.log(data);
                var text='Proverite promovisanost Vašeg oglasa na stranici moji oglasi.';
                var text1='Na Vasem računu nema dovoljno sredstava za izabranu promociju.';

                if(idUpdate!=null)
                {
                    //nacin za ispis gresaka kad je update u pitanju...
                }

                if(idUpdate!=null && idUpdate!='')
                {
                    $("#user_change").modal('hide');

                }
                switch (data) {

                    case '201':
                        modalBody('Uspešno!!');
                        $("#alertButtonModal").click();
                        break;
                    case '1':
                        modalBody(text);
                        $("#alertButtonModal").click();
                        break;
                    case 2:
                        modalBody(text);
                        $("#alertButtonModal").click();
                        break;
                    case 12:
                        modalBody(text);
                        $("#alertButtonModal").click();
                        break;
                    case 404:
                        modalBody("Vaš oglas nije unet. Greška prilikom unosa slika");
                        $("#alertButtonModal").click();
                        break;
                    case 422:
                        modalBody(text1);
                        $("#alertButtonModal").click();
                        break;
                    case 500:
                        modalBody("Došlo je do greške proverite uspešnost unosa Vašeg oglasa!");
                        $("#alertButtonModal").click();
                        break;
                    default:
                        //console.log(data.error);
                        modalBody("Došlo je do greške proverite uspešnost izmene Vašeg oglasa!");
                        $("#alertButtonModal").click();
                      //  $(".btnUpdateInsert").prop('disabled',false);
                        break;
                }

                $('.btnUpdateInsert').prop('disabled',false);
            }
            ,
            error: function (xhr, error, status) {
                // alert(xhr.status);


            }



        });


    }
    else{

        $(".btnUpdateInsert").prop('disabled',false);

    }


});


function checkName(name) {
    var person_name=name;
    let reName=/^[A-ZČĆŽĐŠ][a-zčćžđš]+(\s[A-ZČĆŽĐŠ][a-zčćžđš]+)*$/;
    if(!reName.test($(person_name).val()))
    {

        $(person_name).addClass('borderError');
        return 422;
    }
    else
        $(person_name).removeClass('borderError');
        return 201;

}
function checkLastName(last_name) {

    var person_lastName=last_name;
    let reLastName=/^[A-ZČĆĐŽŠ][a-zčćšđž]+(([',. -][a-zčćšđžA-ZČĆĐŽŠ ])?[a-zčćšđžA-ZČĆĐŽŠ]*)*$/;
    if(!reLastName.test($(person_lastName).val()))
    {

        $(person_lastName).addClass('borderError');
        return 422;
    }
    else
        $(person_lastName).removeClass('borderError');
        return 201;


}
function checkPhone(phone) {


    var person_phone=phone;
    let rePhone=/^(\+3816|06)[01234569]{1}[0-9]{6,7}$/;

    if(!rePhone.test($(person_phone).val()))
    {
        //errors.push("Telefon nije u dozvoljenom formatu");
        $(person_phone).addClass('borderError');
        return 422;
    }
    else
        $(person_phone).removeClass('borderError');
        return 201;
}
function checkPlace(place) {

    var person_place=place;
    let rePlace=/^[A-z]+([\s][A-z]+)*$/;
    if(!rePlace.test($(person_place).val()))
    {
        // errors.push("Mesto/grad nije u dozvoljenom formatu");
        $(person_place).addClass('borderError');
        return 422;
    }
    else
        $(person_place).removeClass('borderError');
        return 201;

}
function checkStreet(street) {

    var person_street=street
    let reStreet=/^[A-z]*\s([A-z]+\s)*[\d]([\d]{1,2}|[-/\d]{2,4})?$/;
    if(!reStreet.test($(person_street).val()))
    {
        //errors.push("Ulica nije u dozvoljenom formatu");
        $(person_street).addClass('borderError');
        return 422;
    }
    else
        $(person_street).removeClass('borderError');
        return 201;


}
function checkJMBG(jmbg) {


    var person_jmbg=jmbg;
    let reJMBG=/^([0-9][1-9]|([1-9][0-9])){2}(([0]{2}[0-2])|([9][2-9][0-9]))[0-9]{6}$/;
    if(!reJMBG.test($(person_jmbg).val()))
    {
       // errors.push("JMBG nije u dozvoljenom formatu");
        $(person_jmbg).addClass('borderError');
        return 422;
    }
    else
        $(person_jmbg).removeClass('borderError');
        return 201;
}
function checkIDcard(idCard) {

    var person_idCard=idCard;
    let reIDcard=/^[0-9]{9}$/;
    if(!reIDcard.test($(person_idCard).val()))
    {
       // errors.push("Lična karta nije u dozvoljenom formatu");
        $(person_idCard).addClass('borderError');
        return 422;
    }
    else
        $(person_idCard).removeClass('borderError');
        return 201;
}

$(document).on('click','.nice-select ul li',function(e){

    if (this.getAttribute('data-value')!=0) {

        let string = this.getAttribute('data-value').split('_');
        //console.log(string[1]);


        if (string[0] == 'c') {
            //category
            $('#category_ddl').next().removeClass('borderError');

            $.ajax({
                url: base_Url + 'get_subcategory',
                method: 'post',
                data: {
                    _token: csrf,
                    cat: string[2],
                    send: true
                },
                success: function (data) {

                    var html = '';
                    var html2 = '';
                    for (let i = 0; i < data.length; i++) {

                        if(i==0)
                        {

                            html = '<option value="' + data[i].id_subcategory + '">' + data[i].subcategory_name + '</option>';


                            html2 = '<li class="option selected" data-value="s_' + data[i].subcategory_name + '_' + data[i].id_subcategory + '">' + data[i].subcategory_name + '</li>';

                            $("#subcategory_ddl").next().find('span').html(data[i].subcategory_name);
                        }

                        else {
                            html+= '<option value="' + data[i].id_subcategory + '">' + data[i].subcategory_name + '</option>';


                            html2+= '<li class="option" data-value="s_' + data[i].subcategory_name + '_' + data[i].id_subcategory + '">' + data[i].subcategory_name + '</li>';
                        }
                    }

                    $("#subcategory_ddl").html(html);
                    $("#subcategory_ddl").next().find('ul').html(html2);
                    html2='<li class="option selected" data-value="0">Izaberite kategoriju levo...</li>';

                    $("#ppk_ddl").next().find('ul').html(html2);
                    $("#ppk_ddl").next().find('span').html('Izaberite kategoriju levo...');
                },
                error: function (xhr, error, status) {
                    //

                }


            });


        }
        if (string[0] == 's') {
            //subcategory

            $('#subcategory_ddl').next().removeClass('borderError');
            $.ajax({
                url: base_Url + 'get_ppk',
                method: 'post',
                data: {
                    _token: csrf,
                    cat: string[2],
                    send: true
                },
                success: function (data) {


//ppk_ddl
                    var html = '';
                    var html2 = '';
                    for (let i = 0; i < data.length; i++) {

                        if(i==0)
                        {
                            html = '<option value="' + data[i].id_ppk + '">' + data[i].name_ppk + '</option>';
                            html2 = '<li class="option selected" data-value="p_' + data[i].name_ppk + '_' + data[i].id_ppk + '">' + data[i].name_ppk + '</li>';
                            $("#ppk_ddl").next().find('span').html(data[i].name_ppk);

                        }
                        else {
                            html+= '<option value="' + data[i].id_ppk + '">' + data[i].name_ppk + '</option>';


                            html2+= '<li class="option" data-value="p_' + data[i].name_ppk + '_' + data[i].id_ppk + '">' + data[i].name_ppk + '</li>';
                        }
                    }
                    $("#ppk_ddl").html(html);
                    $("#ppk_ddl").next().find('ul').html(html2);

                },
                error: function (xhr, error, status) {
                    //

                }


            });


        }
        if (string[0] == 'p') {
            //ppk nothing
            $('#ppk_ddl').next().removeClass('borderError');
        }

    }

    else{
        var html='<option value="0">' +
            '    Izaberite kategoriju levo...' +
            '</option>';
       var html2='<li class="option selected" data-value="0">Izaberite kategoriju levo...</li>';
        $("#subcategory_ddl").html(html);
        $("#subcategory_ddl").next().find('ul').html(html2);
        $("#subcategory_ddl").next().find('span').html('Izaberite kategoriju levo...');
        $("#ppk_ddl").html(html);
        $("#ppk_ddl").next().find('ul').html(html2);
        $("#ppk_ddl").next().find('span').html('Izaberite kategoriju levo...');
        $('#category_ddl').next().addClass('borderError');
        $('#subcategory_ddl').next().addClass('borderError');
        $('#ppk_ddl').next().addClass('borderError');


    }



});
$(document).on('click','#click_sponsored',function (e) {
    e.stopPropagation();

$('.promotion_new').removeClass('promotion_none');

});
$(document).on('click','#chStandard',function (e) {
    e.stopPropagation();

    $('.promotion_new').addClass('promotion_none');





});

//change add
//user_change
$('#content_user').on('click','.fa-edit',function (e) {
    //get data about product, put in modall


//ajax get information
     $.ajax({
        url:base_Url+'change_product_user',
         method:'post',
         data:{
            _toke:csrf,
             id:this.id,
             send:true
         },
         success:function (data) {


         var product=[];
         product=data.products;
         //console.log(product[0].name);
         var category=[];
         category=data.categories;
         var subcategory=[];
         subcategory=data.subcategory;
         var ppk=[];
         ppk=data.ppk;
         var sponsored=[];
         sponsored=data.sponsored;


         var cat_html= '<option value="' + product[0].id_category + '">' + product[0].name_category + '</option>';
         var cat_html2= '<li class="option selected" data-value="c_' + product[0].name_category + '_' + product[0].id_category + '">' + product[0].name_category + '</li>';

             $("#category_ddl").next().find('span').html(product[0].name_category);
             for (let i = 0; i < category.length; i++) {

                     if (category[i].id_category != product[0].id_category) {

                         cat_html += '<option value="' + category[i].id_category + '">' + category[i].name_category + '</option>';


                         cat_html2 += '<li class="option" data-value="c_' + category[i].name_category + '_' + category[i].id_category + '">' + category[i].name_category + '</li>';
                     }
                 }

             $("#category_ddl").html(cat_html);
             $("#category_ddl").next().find('ul').html(cat_html2);

var html='<option value="' + product[0].id_subcategory + '">' + product[0].subcategory_name + '</option>';
var html2='<li class="option selected" data-value="s_' + product[0].subcategory_name + '_' + product[0].id_subcategory + '">' + product[0].subcategory_name + '</li>';
             $("#subcategory_ddl").next().find('span').html(product[0].subcategory_name);
             for (let i = 0; i < subcategory.length; i++) {

       if (subcategory[i].id_subcategory != product[0].id_subcategory) {

           html += '<option value="' + subcategory[i].id_subcategory + '">' + subcategory[i].subcategory_name + '</option>';


           html2 += '<li class="option" data-value="s_' + subcategory[i].subcategory_name + '_' + subcategory[i].id_subcategory + '">' + subcategory[i].subcategory_name + '</li>';


                     }

                 }


             $("#subcategory_ddl").html(html);
             $("#subcategory_ddl").next().find('ul').html(html2);

       var html_ppk='<option value="' + product[0].id_ppk + '">' + product[0].name_ppk + '</option>';
       var html2_ppk='<li class="option selected" data-value="p_' + product[0].name_ppk + '_' + product[0].id_ppk + '">' + product[0].name_ppk + '</li>';

             $("#ppk_ddl").next().find('span').html(product[0].name_ppk);
             for (let i = 0; i < ppk.length; i++) {

                 if(ppk[i].id_ppk!=product[0].id_ppk)
                 {
                     html_ppk += '<option value="' + ppk[i].id_ppk + '">' + ppk[i].name_ppk + '</option>';
                     html2_ppk += '<li class="option" data-value="p_' + ppk[i].name_ppk + '_' + ppk[i].id_ppk + '">' + ppk[i].name_ppk + '</li>';


                 }

             }
             $("#ppk_ddl").html(html_ppk);
             $("#ppk_ddl").next().find('ul').html(html2_ppk);

           //conditionStatus

             var html_cs='';
             var html2_cs='';
           switch (product[0].condition_status) {

               case 1:
                   html_cs += '<option value="1">Novo</option>'+
                       '<option value="2">Kao novo</option>'+
               '<option value="3">Polovno</option>';
                   html2_cs += '<li class="option selected" data-value="1">Novo</li>'+
                    '<li class="option" data-value="2">Kao novo</li>'+
                   '<li class="option" data-value="3">Polovno</li>';
                   break;
                case 2:
                    html_cs += '<option value="2">Kao novo</option>'+
                        '<option value="1">Novo</option>'+
                        '<option value="3">Polovno</option>';
                    html2_cs += '<li class="option selected" data-value="2">Kao novo</li>'+
                    '<li class="option" data-value="1">Novo</li>'+
                    '<li class="option" data-value="3">Polovno</li>';
                       break;
               case 3:
                   html_cs += '<option value="3">Polovno</option>'+
                       '<option value="1">Novo</option>'+
                       '<option value="2">Kao novo</option>';
                   html2_cs += '<li class="option selected" data-value="3">Polovno</li>'+
                       '<li class="option" data-value="1">Novo</li>'+
                       '<li class="option" data-value="2">Kao novo</li>';
                   break;

           }
             $("#conditionStatus").html(html_cs);
             $("#conditionStatus").next().find('ul').html(html2_cs);

             $('#text_name').val(product[0].name);
             $('#price_new').val(product[0].price);
             $('#description_new').val(product[0].description);
             $('#user_name').val(product[0].firstName);
             $('#user_lastName').val(product[0].lastName);
             $('#user_lastName').attr('data-bind',product[0].id_oglas);
             $('#user_phone').val(product[0].phone_number);
             $('#user_place').val(product[0].city);
             $('#user_street').val(product[0].address);
             $('#user_jmbg').val(product[0].JMBG);
             $('#user_IDcard').val(product[0].ID_card);


if(product[0].currency==1)
{
    $('#chCurrency1').prop('checked',true);
}
else{
    $('#chCurrency2').prop('checked',true);
}

if(product[0].price_status==1)
{
    $('#ch_Fixed1').prop('checked',true);
}
else if (product[0].price_status==2)
{
    $('#ch_Fixed2').prop('checked',true);
}
else if (product[0].price_status==3)
{
    $('#ch_Fixed3').prop('checked',true);
}
else{
    $('#ch_Fixed2').prop('checked',true);
    $('#ch_Fixed3').prop('checked',true);

}

//img picture
var picture='';
  for (let i=0;i<product.length;i++)
  {
      picture+='<li><label class="pictureLabel changePictureLabel">Izmeni sliku<input type="file" id="file'+i+'" class="pictureBlock" name="file'+i+'"/></label>' +

          '<img src="'+product[i].src+'" id="imgshow'+i+'" class="imgShowModal" align="left" style="width:140px!important; height:130px!important;" alt="'+product[i].name+'" title="'+product[i].name+'"/></li>';

  }
if (product.length<10)
{
    for (let i=product.length;i<10;i++)
    {
        picture+='<li><label class="pictureLabel">Unesi sliku<input type="file" id="file'+i+'" class="pictureBlock" name="file'+i+'"/></label>' +

            '<img src="#" id="imgshow'+i+'" class="imgShowModal" align="left" style="width:140px!important; height:130px!important;" alt="#" title="#"/></li>';

    }



}

//console.log(sponsored);
if(sponsored!=[] && sponsored!=null)
{
    //alert('aa');
    //
    //console.log(sponsored.end_one);
    $('ul #podrazumevano').remove();
    $('ul #click_sponsored').remove();
    $('.promotion_new').removeClass('promotion_none');

    if(sponsored.end_one>0)
{

    changePromotion('chProm1',sponsored.end_one*1000);

}
    if(sponsored.end_two>0)
    {
        changePromotion('chProm2',sponsored.end_two*1000);

    }






}


$('#listPicture').html(picture);

            $('#change_title').html('Izmena oglasa-'+product[0].name);



          //  $('form #section_fourthStep div label').css('position','initial');
            $('form .clip_list').css('margin-left','15px');
            $('form #section_fourthStep div label').css('left','35px');
            $('#update_insert').remove();
            $('form').css('width','auto');
            $('form .nice-select').css('clear','unset');
            //F7941D
             $('#user_change').modal('show');


         },
         error:function (xhr,error,status) {
             //error
         }




     });







});
// recovery picture delete change

$(document).on('click','.changePictureLabel',function(e){

    e.stopPropagation();
   e.preventDefault();

 var input=$(this).find('input');
 input.prop('disabled',true);
 var string_id=input.attr('id');
 //console.log(string_id);
var res=string_id.substring(4);

    var src=$('#imgshow'+res).attr('src');
$('#imgshow'+res).attr('src',base_Url+'images/refresh.png');
$('#imgshow'+res).attr('title','Vrati sliku');
$('#imgshow'+res).addClass('backupPicture');

$('#imgshow'+res).addClass('deletePicture');




$('#imgshow'+res).attr('alt',src);
    $(this).html('Unesi sliku <input type="file" id="file'+res+'" class="pictureBlock" name="file'+res+'"/>');

$(this).removeClass('changePictureLabel');

    //input.prop('disabled',false);
    setTimeout(reloadFile(input),3000);

});
$(document).on('click','.backupPicture',function (e) {
    e.stopPropagation();

    //alert('ooo');

    var src=$(this).attr('alt');
    $(this).attr('src',src);
   var string_id=$(this).attr('id');
    var resImg=string_id.substring(7);
    $(this).removeClass('backupPicture');
    var label=$(this).closest('li').find('label');
    //console.log(a);
    label.html('Izmeni sliku <input type="file" id="file'+resImg+'" class="pictureBlock" name="file'+resImg+'"/>');
    label.addClass('changePictureLabel');

    if($('#imgshow'+resImg).hasClass('deletePicture')) {
        $('#imgshow' + resImg).removeClass('deletePicture');
    }
    var res=$('#change_title').text().split('Izmena oglasa-');
    $(this).attr('title',res[1]);


});


function reloadFile(input)
{

    //input.preventDefault();
    input.prop('disabled',false);


}
function changePromotion(id,data)
{
    $('#'+id).prop('checked',true);
    $('#'+id).attr('type','radio');
    $('#'+id).parent().removeClass('promotion_new');
    var promotion='';
    id=='chProm1' ?  promotion='promotion_one':promotion='promotion_two';

    var d=new Date(data);
    $('#'+promotion+' p:first').html('Promocija ističe <b>'+d.getDate()+'.'+(d.getMonth()+1)+'.'+d.getFullYear()+'.</b> U <b>'+d.getHours()+':'+d.getMinutes()+'</b>');

}
$('.fa-pencil').on('click',function () {


    var user=$('.user');

   // console.log();
    $('#change_title').html('Izmena podataka korisnik');

    $('#first_name').val($(user[0]).text());
    $('#last_name').val($(user[1]).text());
    $('#email').val($(user[2]).text());
    $('#username').val($(user[3]).text());


    $('.btnUpdateInsert').attr('data-value','insert_change#user');

    $("#user_change").modal('show');


});
function changeUser() {
    //alert('aaa');





    if($('#password').val()=='')
    {
        if($('#toggle_password').next().is('label'))
        {
            $('#toggle_password').next().remove();
        }

    }
    if($('#password_confirmation').val()=='')
    {
        if($('#toggleRePassword').next().is('label'))
        {
            $('#toggleRePassword').next().remove();
        }
    }

    var countErrors=$('.errors');
    console.log(countErrors.length);
    var rePassword=new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\.!@#\$%\^&\*])(?=.{8,})");
   var code=201;
    if(!rePassword.test($('#password_change').val()))
    {
        //console.log(this.id);
        //after prikaz
        if(!$('#toggle_password').next().is('label')) {
            $("#toggle_password_change").after('<label class="errors">Obavezno[A-Z][. ili _][0-9]6-17 karaktera</label>');

        }
        code = 422;
    }

   //console.log(countErrors);

    if (countErrors.length==0 && code==201) {



        $.ajax({
            url: base_Url + 'user_change_pi',
            method: 'post',
            data: {
                _token: csrf,
                name: $('#first_name').val(),
                lastName: $('#last_name').val(),
                username: $('#username').val(),
                email: $('#email').val(),
                old_pass: $('#old_password').val(),
                password_confirmation: $('#password_confirmation').val(),
                password_change: $('#password_change').val(),
                send: true
            },
            success: function (data) {

                console.log(data);
                if(data==201)
                {
                    //uspesnoo

                    $("#user_change").modal('hide');
                    modalBody('Uspešno!!');
                    $("#alertButtonModal").click();

                    setTimeout(function () {
                            location.reload();
                        }
                        , 5000);


                }
                if(data==419)
                {
                    $('.print-error-msg').html('<ul></ul><li>Korisničko ime i šifra se ne poklapaju</li></ul>');
                   // $('.print-error-msg').append('<li>Korisničko ime i šifra se ne poklapaju</li>');
                    $(".print-error-msg").css('display', 'block');


                }
                if(data==422)
                {
                    $('.print-error-msg').html('<ul></ul><li>Došlo je do greške proverite da li su podaci izmenjeni</li></ul>');
                    $(".print-error-msg").css('display', 'block');

                }
                else{
                    printErrorMsg(data.error);
                }

            },
            error: function (xhr, status, erros) {
                //error
            }


        });

    }

    $('.btnUserAction').prop('disabled',false);

    return 201;
}

$(document).on('click','.closeModal',function (e) {
//alert('aa');
//seti se sta hoces


});
$(document).on('click','.user_picture_change',function(e)
{

    $.ajax({
       url:base_Url+'user_picture',
        method:'post',
        data:{
           _token:csrf,
            picture:null,
            send:true
        },
        success:function (data) {

            if (data == 201) {

                var img = $('.data-img img');

                $('.user_P_change').html('<form><label class="pictureLabel">Unesi sliku<input type="file" id="fileUser" class="" name="fileUser"/></label></form>');
                img.attr('alt', img.attr('src'));
                img.attr('title', 'Vrati sliku');
                img.attr('src', base_Url + 'images/refresh.png');
                img.addClass('returnPicture');
            }
            if(data!=201)
            {
                modalBody('Došlo je do greške, proverite da li je slika promenjena');

                $("#alertButtonModal").click();
            }


        },
        error:function (xhr,error,status) {
            //error
        }

    });

});

$(document).on('change','#fileUser',function (e) {
    e.stopPropagation();

//alert('aa');
    var fd = new FormData();
    //nista
    var files = $('#fileUser')[0].files[0];
    fd.append('fileUser', files);
    fd.append('picture', 'update');
    $.ajax({
        url: base_Url + 'user_picture',
        method: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {


            if (data.code == 201) {


                var img = $('.data-img img');
                $('.user_P_change').html('<label class="pictureLabel user_picture_change">Izmeni sliku</label>');
                img.attr('alt','Korisnik');
                img.attr('title', 'Korisnik');
                img.attr('src',base_Url+'images/'+data.src);

                $('.data-img img').removeClass('returnPicture');
            }
            if (data.code != 201) {



                modalBody('Došlo je do greške, proverite da li je slika promenjena');

                $("#alertButtonModal").click();


            }


        },
        error: function (xhr, error, status) {
            //error
        }

    });


});

$(document).on('click','.data-img img',function (){


    if($(this).hasClass('returnPicture')) {
        var img = $('.data-img img');
        $('.user_P_change').html('<label class="pictureLabel">Izmeni sliku</label>');
        img.attr('src', img.attr('alt'));
        img.attr('alt', 'Korisnik');
        img.attr('title', 'Korisnik');

    }

});

