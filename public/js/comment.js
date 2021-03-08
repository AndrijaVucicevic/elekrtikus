$('#submitComment').on('click',function (e) {
    var text=$('#addComment');
    $(this).prop('disabled',true);
    var reText=/^[\w\s\d\W]{1,1000}$/;

    var arrayUsername=$('.btn_username');

    var replyUsers=[];

    for (let i=0;i<arrayUsername.length;i++)
    {
        i==0 ? replyUsers.push($(arrayUsername[i]).val()) : replyUsers.push('_'+$(arrayUsername[i]).val())


    }

    if(!reText.test(text.val()))
    {
        text.addClass('borderError');
        text.append('<b>Tekst poruke nije u dozvoljenom formatu</b>');
    }
    else {

        $.ajax({
            url:base_Url+'sendComment',
            method:'post',
            data:{
                _token:csrf,
                text:text.val(),
                replies:replyUsers,
                send:true
            },
            success:function(data)
            {
                //OKK osvezi stranicu ili samo append komentar
                $(this).prop('disabled',false);
            },
            error:function(xhr,error,status)
            {

            }



        });


    }


});

$('.btn-reply').on('click',function () {

 var username=$(this).attr('data-value');
 var label=$('label[for="addComment"]');
 //provera ako ima jos neki sa tim korisnickim

 var arrayUsername=$('.btn_username');
 var check=0;
 for (let i=0;i<arrayUsername.length;i++)
 {
     if($(arrayUsername[i]).val()==username)
     {
         check=1;
         break;
     }
 }
 if (check==0)
 {
     label.append('&nbsp;<button class="btn-secondary btn_username" value="'+username+'">Username &times;</button>');

 }
 else{
    //nista
     return 1;
 }



});
$(document).on('click','.btn_username',function (e) {
    e.stopPropagation();
   $(this).remove();

});