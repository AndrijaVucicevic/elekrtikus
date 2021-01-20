$('.search_more').on('click',function (e) {
e.preventDefault();

    loadMoreProducts();
});

$('.more_products').on('click',function (e) {
    e.stopPropagation();

    loadMoreProducts();
});





function loadMoreProducts() {
    //
   // alert("aa");
    var start=$(".more_products").attr('data-value').split('_');



    var loc=location.href;
     var category=loc.split('=');
    // console.log(category);

    $.ajax({
       url:base_Url+'more_products',
        method:'post',
        data:{
            _token:csrf,
            category:category[2],
            start:parseInt(start[1]),
           send:true
        },
        success:function (data) {


           if(data!=404)
           {
               let now=parseInt(start[1])+1;
               $("#content_user").append(data);
               $('.more_products').attr('data-value','more-products_'+now);

           }

            if (data == 404) {
                //pagination--greska strana

                $("#modalBody-alert").html('Trenutno nema sponzorisanih oglase iz navedene kategorije');

                $("#alertButtonModal").click();


            }

        },
        error:function(xhr,error,status)
        {
            // alert(xhr.status);


        }


    });






}