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

$("#categoryShopList li").on('click',function (e) {
    e.stopPropagation();
    var content = $(this).find('ul')[0];

    if(content) {

        if (content.style.display == 'block') {
            content.style.display = 'none';
        } else {
            content.style.display = 'block';
        }
    }
    else {

       // console.log(active);
        var cat= this.id.split("_");
        var active=this.id;
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





});

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

$('#content_user').on('click','.fa-edit',function (e) {
   //get data about product, put in modall

    //but first how to insert



});






function modalAlert(value)
{
    $("#exampleModalLabel").html(value);
    //alert("alert");
}
function modalBody(value)
{
    $("#modalBody-alert").html(value);
}
// PICTURE FORM INSERT UPDATE PRODUCT

$(document).on('change','.slikaBlock', function () {

    var id=this.id;
    //alert(id);
    var str =id;
    var res = str.charAt(4);
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imgshow'+res).attr('src', e.target.result);

        }
        reader.readAsDataURL(this.files[0]);



    }
});

$('form #section_fourthStep input[type=text]').on('focus',function () {
   //console.log(this);
    $(this).next().css('display','none');
});

$('form #section_fourthStep input[type=text]').on('blur',function () {
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
//update insert
$(".btnUpdateInsert").on('click',function (e) {
    e.preventDefault();

    $(".btnUpdateInsert").prop('disabled',true);
//console.log('aa');
    var errors=[];


    var ppk_first= $("#ppk_ddl").next().find('ul');

  /*  if(ppk.==0)
    {
        errors.push('Kategorija proizvoda nije odabrana');
        ppk.addClass('borderError');

    }
*/
    var ppk_second=ppk_first.find('.selected');

    var ppk=ppk_second.html();
    //console.log(ppk);


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

        $("ch_currency").addClass('outlineError');
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

          $(".ch_Fixed").addClass('outlineError');

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
            promotion = parseInt(promotion_one)+parseInt(promotion_two);
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

    if($("#ch_terms").is(':checked')) {
        terms=1;
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

  if(document.getElementById("file"+i).files.length === 0)
  {
      //nista
  }
  else{

      var files = $('#file'+i)[0].files[0];
      fd.append('file'+counter,files);
      counter++;
  }

}

if (counter==0)
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

       //console.log(fd);

        $.ajax({
            url: base_Url + 'insert_product_user',
            method: 'post',
            data:fd,
            contentType: false,
            processData: false,
            success: function (data) {

                if (data == 201) {

                //uspesno
//alert('uspesno');
                    modalBody('Vaš oglas je uspešno unet');

                    $("#alertButtonModal").click();
                    //next videcemo
                }
                //error
                if (data !=201) {


                        printError(data.error);
                    $(".btnUpdateInsert").prop('disabled',false);

                }
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
        return 201;
}

$(document).on('click','.nice-select ul li',function(e){

    if (this.getAttribute('data-value')!=0) {

        let string = this.getAttribute('data-value').split('_');
        //console.log(string[1]);


        if (string[0] == 'c') {
            //category

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


                },
                error: function (xhr, error, status) {
                    //

                }


            });


        }
        if (string[0] == 's') {
            //subcategory

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
    }



});
$('#click_sponsored').on('click',function (e) {
    e.stopPropagation();

$('.promotion_new').removeClass('promotion_none');

});
$('#chStandard').on('click',function (e) {
    e.stopPropagation();

    $('.promotion_new').addClass('promotion_none');





});

