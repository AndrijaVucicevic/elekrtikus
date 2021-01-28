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