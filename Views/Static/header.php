<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>abdurrahim bulut</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>



<div class="container">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sepet Uygulaması</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="<?php echo url()?>">Anasayfa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('basket') ?>">Sepet  </a>
        </li>
        <?php if (App\Models\Customer::Authorization()) :?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('logout')?>">Çıkış yap</a>
        </li>
        <?php else:?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('login')?>">Giriş Yap</a>
        </li>
        <?php endif;?>

      </ul>
    </div>
  </div>
</nav>


</div>

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
