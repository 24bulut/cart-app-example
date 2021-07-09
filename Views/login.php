<!doctype html>
<html lang="en">
  <head>
  <style >
    html,
    body {
      height: 100%;
    }

    body {
      display: -ms-flexbox;
      display: -webkit-box;
      display: flex;
      -ms-flex-align: center;
      -ms-flex-pack: center;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: center;
      justify-content: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }
    .form-signin .checkbox {
      font-weight: 400;
    }
    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
      
  </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Signin Template for Bootstrap</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>



  <body class="text-center">
    <form class="form-signin" action="" method="POST">
      <i class="fas fa-users" style="font-size: 35px;"></i>
      <h1 class="h3 mb-3 font-weight-normal">Giriş</h1>
      <?php 
        if (isset($params['messages'])) :
          foreach ($params['messages'] as $message):
      ?>
        <div class="alert alert-primary" role="alert">
          <?php echo $message?>
        </div>
      <?php 
          endforeach;
        endif;
      ?>

      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>
      <label for="inputPassword" class="sr-only" >Şifre</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Şifre" required>
      <a href="<?php echo url('register')?>">Hemen kayıt ol</a>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş yap</button>
    </form>
  </body>
</html>
