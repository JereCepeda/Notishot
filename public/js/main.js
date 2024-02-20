
    var url = 'http://pseudoinsta.com';
window.addEventListener("load",function(){
    $('.btn-like').css('cursor','pointer')
    $('.btn-dislike').css('cursor','pointer')

    $(document).on('click','.btn-like',function(){
        $(this).addClass('btn-dislike').removeClass('btn-like');
        $(this).attr('src', url+'/storage/img/heartred.png' );

        $.ajax({
            url: url +'/shot/add/like/'+$(this).data('id'),
            type: 'GET',
            success : function(response){
                console.log(response)

                if(response.like)
                    {console.log("Has dado like a la publicacion")}
                else{console.log('error')}}
        })
    })
    $(document).on('click','.btn-dislike',function(){
        $(this).addClass('btn-like')
        $(this).removeClass('btn-dislike');
        $(this).attr('src', url+'/storage/img/heartgray.png' );
        $.ajax({
            url: url +'/shot/dislike/'+$(this).data('id'),
            type: 'GET',
            success : function(response){
                console.log(response)
                if(response.dislike)
                    {console.log("Has dado dislike a la publicacion")}
                else{console.log('error')}
                }
        })

    })
})