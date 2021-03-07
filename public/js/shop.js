
$("input[type=number]").on("focus", function() {
    $(this).on("keydown", function(event) {
        if (event.keyCode === 38 || event.keyCode === 40) {
            event.preventDefault();
        }
    });
});


//sort
$(document).on('click','.nice-select ul li',function(e)
{

let string=this.getAttribute('data-value').split('_');
var page=0;

    string[0]=='s' ?   page=0 :   page=$("#pagination_view .active_page").val();
    let route='new_page';

    //console.log(page);
    string[0]=='s'? getAds(route,page,this.getAttribute('data-value'),'take'):getAds(route,page,'sort',this.getAttribute('data-value'));


});

//show on page


$("#min_price_filter").on('blur',function (e) {
    var min=this.value;
    var reMin=/^[1-9][0-9]+$/;
    if(!reMin.test(min))
    {
      this.value=1;
    }

});
$("#max_price_filter").on('blur',function (e) {
    var max=this.value;
    var reMin=/^[1-9][0-9]+$/;
    if(!reMin.test(max))
    {
        this.value=1000000;
    }

});

//category




/*
//price filter
$("#min_price_filter").on('keyup',function () {

//alert('min');
    changePriceSlider();
});
$("#max_price_filter").on('keyup',function () {
//alert('max');
    changePriceSlider();
});

function changePriceSlider() {

    var max=parseInt($("#max_price_filter").val());
    var min=parseInt($("#min_price_filter").val());
//filt_new
    var href=location.href;

    var category=href.split('=');
  //  console.log(category[1]);
    if(min<max && min>=0 && max>0 && min!=null && max!=null && min!='' && max!='') {

 var check=checkbox_filt();

 //console.log(check);

        $.ajax({
            url: base_Url + 'change_price_filter',
            method: 'post',
            data: {
                _token: csrf,
                min: min,
                max: max,
                cat:category[1],
                condition:check[0],
                price_status:check[1],
                currency:check[2],
                send: true
            },
            success: function (data) {

if (data==404)
{
    var output = document.getElementById("demo");
    output.innerHTML = '</br>Nije pronadjen nijedan proizvod';
    output.style.color='red';

}
if(data!=404)
{
    var output = document.getElementById("demo");
    output.innerHTML = data; // Display the default slider value
    output.style.color='green';
}




            },
            error: function (xhr, status, error) {
                //error
            }


        });


    }
}
*/
// sort price
$("#filt-btn").on('click',function (e) {

    e.preventDefault();

    //alert('a');

        let route='price_filter_shop';
        let page=0;
        getAds(route,page,'sort','take');

});
//pagination new page
$(document).on('click','.pagination_click',function (e) {
    e.preventDefault();
//alert(this.value);

var route='new_page';
let page=this.value;
getAds(route,page,'sort','take');


});
//get ads
function getAds(route,page,sortt,takee) {

    var rout=route;

    var start=parseInt(page);

    var new_page=parseInt(page);

    var checkCondition=getCheckCondition();
//console.log(checkCondition[0].min);



if(sortt!='sort')
{
    var sort=sortt.split('_');
    checkCondition[0].sort=sort[1];
}

if(takee!='take')
{
    var take=takee.split('_');
    checkCondition[0].take=take[1];
}





    if(start!=-1)
    {
        start=start*parseInt(checkCondition[0].take);
    }
    //console.log(start);




    //alert('a');
    $.ajax({
        url: base_Url + rout,
        method: 'post',
        data: {
            _token: csrf,
            min: checkCondition[0].min,
            max: checkCondition[0].max,
            cat: checkCondition[0].category,
            start:start,
            take:checkCondition[0].take,
            sort:checkCondition[0].sort,
            condition:checkCondition[0].condition,
            price_status:checkCondition[0].price_status,
            currency:checkCondition[0].currency,
            send: true
        },
        success: function (data) {

            if (data != 404) {

                //console.log(data);
                getPagination(new_page);

                $(".fa-bullhorn").removeClass('active_page');
                $("#products_rowShop").html(data);

            }
//error
            if (data == 404) {
                //pagination--greska strana

                $("#modalBody-alert").html('Trenutno nemamo oglase za navedene kriterijume');

                $("#alertButtonModal").click();


            }


        },
        error: function (xhr, status, error) {
            //error
        }


    });



}
function getPagination(new_page)
{
  var checkCondition=getCheckCondition();


  //console.log(checkCondition);
    var strr=parseInt(new_page);

  //  console.log(new_page);

    $.ajax({
        url: base_Url + 'pagination',
        method: 'post',
        data: {
            _token: csrf,
            min: checkCondition[0].min,
            max: checkCondition[0].max,
            cat:checkCondition[0].category,
            take:checkCondition[0].take,
            sort:checkCondition[0].sort,
            condition:checkCondition[0].condition,
            price_status:checkCondition[0].price_status,
            currency:checkCondition[0].currency,
            send: true
        },
        success: function (data1) {


            if (data1!=404) {

                $('.pagination_click').removeClass('active_page');

                var novaPaginacinja='<li><span class="previous">Page: </span></li>';



                if (data1>6)
                {
                    if (strr==-1)
                    {

                        novaPaginacinja+='<li value="0" class="pagination_click"    >1</li>';
                        novaPaginacinja+='<li value="1" class="pagination_click"    >2</li>';
                        novaPaginacinja+='<li value="2" class="pagination_click"    >3</li>';
                        novaPaginacinja+='<li>&nbsp&nbsp...&nbsp&nbsp</li>';
                        novaPaginacinja+='<li value="'+(data1-1)+'" class="pagination_click"    >'+data1+'</li>';
                    }



                    if (strr==0)
                    {
                        // alert("1")
                        novaPaginacinja+='<li class="active_page pagination_click" value="0">1</li>';
                        for (let str=2;str<=(strr+3);str++)
                        {
                            novaPaginacinja+='<li value="'+(str-1)+'" class="pagination_click"    >'+str+'</li>';

                        }
                        novaPaginacinja+='<li>&nbsp&nbsp...&nbsp&nbsp</li>';
                        novaPaginacinja+='<li value="'+(data1-1)+'" class="pagination_click"    >'+data1+'</li>';

                    }

                    if (strr==1)

                    {
                        //alert("2");
                        novaPaginacinja+='<li value="0" class="pagination_click"    >1</li>';
                        novaPaginacinja+='<li class="active_page pagination_click" value="1">2</li>';
                        for (let str=3;str<5;str++)
                        {
                            novaPaginacinja+='<li value="'+(str-1)+'" class="pagination_click"    >'+str+'</li>';

                        }
                        novaPaginacinja+='<li>&nbsp&nbsp...&nbsp&nbsp</li>';
                        novaPaginacinja+='<li value="'+(data1-1)+'" class="pagination_click"    >'+data1+'</li>';

                    }
                    if (strr==(data1-2))
                    {
                        //alert("data-1")
                        //alert(stranica)
                        novaPaginacinja+='<li value="0" class="pagination_click"    >1</li>';
                        novaPaginacinja+='<li>&nbsp&nbsp...&nbsp&nbsp</li>';
                        novaPaginacinja+='<li value="'+(strr -2)+'" class="pagination_click"    >'+(strr-1)+'</li>';
                        novaPaginacinja+='<li value="'+(strr-1)+'" class="pagination_click"    >'+strr+'</li>';
                        novaPaginacinja+='<li class="active_page pagination_click" value="'+(data1-2)+'">'+(data1-1)+'</li>';
                        novaPaginacinja+='<li value="'+(data1-1)+'" class="pagination_click"    >'+data1+'</li>';




                    }
                    if (strr==data1-1)
                    {
                        //alert("data1")
                        novaPaginacinja+='<li value="0" class="pagination_click"    >1</li>'+
                            '<li>&nbsp&nbsp...&nbsp&nbsp</li>'+ '<li value="'+(data1-3)+'" class="pagination_click"    >'+(data1-2)+'</li>'+
                            '<li value="'+(data1-2)+'" class="pagination_click"    >'+(data1-1)+'</li>'+
                            '<li class="active_page pagination_click" value="'+(data1-1)+'"     >'+data1+'</li>';

                    }

                    if (strr==2)
                    {
                        novaPaginacinja+='<li value="0" class="pagination_click"    >1</li>'+
                            '<li value="1" class="pagination_click">2</li>'+
                            '<li class="active_page pagination_click" value="2">3</li>'+
                            '<li value="3" class="pagination_click"    >4</li>'+
                            '<li value="4" class="pagination_click"    >5</li>'+
                            '<li>&nbsp&nbsp...&nbsp&nbsp</li>'+
                            '<li value="'+(data1-1)+'" class="pagination_click"    >'+data1+'</li>';

                    }

                    if (strr==(data1-3) )
                    {
                        novaPaginacinja+='<li value="0" class="pagination_click"    >1</li>'+
                            '<li>&nbsp&nbsp...&nbsp&nbsp</li>'+
                            '<li  value="'+(strr-2)+'" class="pagination_click">'+(strr-1)+'</li>'+
                            '<li  value="'+(strr-1)+'" class="pagination_click">'+strr+'</li>'+
                            '<li class="active_page pagination_click" value="'+strr+'">'+(strr+1)+'</li>'+
                            '<li value="'+(strr+1)+'" class="pagination_click"    >'+(strr+2)+'</li>'+

                            '<li value="'+(data1-1)+'" class="pagination_click"    >'+data1+'</li>';


                    }



                    if(strr!=-1 && strr!=0 && strr!=1 &&strr!=2  &&strr!=data1-3 && strr!=data1-2 && strr!=data1-1) {

                        //alert("nista"+stranica);
                        novaPaginacinja+= '<li value="0" class="pagination_click">1</li>';

                        if (strr-2!=1) {
                            novaPaginacinja += '<li>&nbsp&nbsp...&nbsp&nbsp</li>';
                        }

                        for (let str=(strr-2);str<strr;str++)
                        {

                            novaPaginacinja+='<li value="'+str+'" class="pagination_click"    >'+(str+1)+'</li>';

                        }


                        novaPaginacinja+= '<li class="active_page pagination_click" value="'+strr+'">'+(strr+1)+'</li>';
                        novaPaginacinja+='<li value="'+(strr+1)+'" class="pagination_click"    >'+(strr+2)+'</li>'+
                            '<li value="'+(strr+2)+'" class="pagination_click"    >'+(strr+3)+'</li>';

                        if(data1-4!=strr){
                            novaPaginacinja+='<li>&nbsp&nbsp...&nbsp&nbsp</li>';}
                        novaPaginacinja+= '<li value="'+(data1-1)+'" class="pagination_click"    >'+data1+'</li>';





                    }
                }





                if(data1<=6)
                {

                    //console.log(strr);
                    for (let pg=0;pg<data1;pg++)
                    {

                        if (strr==pg)
                        {
//console.log(strr);
                            novaPaginacinja+='<li class="pagination_click active_page" value="'+pg+'">'+(pg+1)+'</li>';
                        }
                        else
                            novaPaginacinja+='<li value="'+pg+'" class="pagination_click"    >'+(pg+1)+'</li>';



                    }


                }
                if(strr!=(data1-1))
                {
                    novaPaginacinja+='<li value="'+(strr+1)+'" class="pagination_click" >Next</li>';

                }

$("#pagination_view").html(novaPaginacinja);

            }
//error
            if(data1==404)
            {
             //if ()

//greska paginacija

            }



        },
        error: function (xhr, status, error) {
            //error
        }


    });



}
//sponsored click
$(".fa-bullhorn").on('click',function(e){
   e.preventDefault();

    var href=location.href;

    var category=href.split('=');

    $.ajax({
       url:base_Url+'sponsored_category',
        method:'post',
        data:{
           category:category[1],
           send:true
        },
        success:function (data) {

            if (data != 404) {

                //console.log(data);

                  $(".fa-bullhorn").addClass('active_page');
                  $(".pagination_click").removeClass('active_page');
                $("#products_rowShop").html(data);

            }
//error
            if (data == 404) {
                //pagination--greska strana

                $("#modalBody-alert").html('Trenutno nema sponzorisanih oglase iz navedene kategorije');

                $("#alertButtonModal").click();


            }


        },
        error: function (xhr, status, error) {
            //error
        }



    });



});

//condition for filt and sort


function getCheckCondition()
{
    var checkArray=[];
    var condition_array=$('.checkbox-inline .condition-filter');
    var condition=0;
    for (let i=0;i<condition_array.length;i++)
    {
        if(condition_array[i].checked)
        {
            condition+=parseInt(condition_array[i].value);
        }

    }
    var price_array=$('.checkbox-inline .price-filter');
    var price_status=0;
    for (let i=0;i<price_array.length;i++)
    {
        if(price_array[i].checked)
        {
            price_status+=parseInt(price_array[i].value);
        }

    }
    var currency_array=$('.checkbox-inline .price-currency');
    var currency=0;
    for (let i=0;i<currency_array.length;i++)
    {
        if(currency_array[i].checked)
        {
            currency+=parseInt(currency_array[i].value);
        }

    }
    var max=parseInt($("#max_price_filter").val());
    var min=parseInt($("#min_price_filter").val());

    var href=location.href;

    var category=href.split('=');



    var take = document.getElementById("ddl_take").value.split('_');
    var sort = document.getElementById("ddl_sort").value.split('_');


    checkArray.push({"max":max,"min":min,"category":category[1],"take":take[1],"sort":sort[1],"condition":condition,"price_status":price_status,"currency":currency});

    return checkArray;

}