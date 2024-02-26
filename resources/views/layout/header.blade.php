<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <style>
      .collapse.show{
        display: flex !important;
        justify-content: end !important; }
      .dropdown-menu{
        position:absolute !important;
      }
      .nav-item{
        display: flex !important;
        justify-content: end !important; 
        padding-top: 2%;
        margin-left: 10px;
      }
      .nav-link{
        padding: 0 !important;
      }
      body {
    margin: 0;
    height: 100%;
    background: no-repeat;
    background-image: url('https://storage.googleapis.com/uploadsimg/public/storage/img/backgroundNotishot.png');
    background-attachment: fixed;
    width: 100%;
    background-size: cover;
    }

      html {
        height: 100%;
      }
     
    </style>
  <body>          