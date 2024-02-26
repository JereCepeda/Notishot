    $(document).on('click','.btn-like',function(){
        $(this).addClass('btn-dislike').removeClass('btn-like');
        console.log( $(this).data('env')+'/shot/add/like/'+$(this).data('id'))
        $.ajax({
            url:  $(this).data('env')+'/shot/add/like/'+$(this).data('id'),
            type: 'GET',
            success : function(response){
                if(response.like)
                    {console.log("Has dado like a la publicacion")}
                else{console.log('error')}}
        })
    })
    $(document).on('click','.btn-dislike',function(){
        $(this).addClass('btn-like')
        $(this).removeClass('btn-dislike');
        $.ajax({
            url: $(this).data('env') +'/shot/dislike/'+$(this).data('id'),
            type: 'GET',
            success : function(response){
                if(response.dislike)
                    {console.log("Has dado dislike a la publicacion")}
                else{console.log('error')}
                }
        })

    })