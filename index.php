<?php 
session_start();
 if(isset($_SESSION['user_token'])||isset($_COOKIE['remember_token'])){
  require('bin/db.php');  
  $user_id = $_SESSION['user_token'] ?? $_COOKIE['remember_token'];

  $user_check = $pdo->prepare('SELECT remember_token FROM users WHERE remember_token=?');
  $user_check->execute([$user_id]);
  $user_check_result = $user_check->fetch(PDO::FETCH_ASSOC);

  if($user_id == $user_check_result['remember_token']){
    header("Location: http://websockets/chat.php");
  }
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <!-- Optional СSS -->
  <link rel="stylesheet" href="includes/css/style.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
  <div class="img_logo">
    <img src="img/chat-logo.png" alt="">
  </div>
  <div class="container">
    <form class="justify-content-center" id="login_form">
      <div class="alert alert-success" id="done_login" role="alert">

      </div>
      <div class="alert alert-danger" id="err_login_pass" role="alert">

      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" name="login_name" class="form-control" id="InputName" placeholder="Enter Name">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="login_pass" class="form-control" id="InputPassword" placeholder="Password">
      </div>
      <div class="form-group form-check">
        <input type="checkbox" name="login_checkbox" class="form-check-input" id="login_check">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" id="InputSubmit" class="btn btn-primary">Log in</button>

      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Sing Up
      </button>
    </form>
  </div>

  <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Sing Up</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="registr_form">
            <div class="form-group">
              <div class="alert alert-success" id="done_registr" role="alert">

              </div>
              <div class="alert alert-danger" id="err_registr_pass" role="alert">

              </div>
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" name="registr_name" id="exampleInputEmail1"
                aria-describedby="emailHelp">
              <small id="emailHelp" class="form-text text-muted">The chat participants will see this name</small>
            </div>
            <div class="alert alert-danger" id="err_registr_name" role="alert">

            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" name="registr_pass" id="exampleInputPassword1">
              <small id="passwordHelp" class="form-text text-muted">Don't use easy password</small>
            </div>
            <label for="exampleInputPassword1">Confirm password</label>
            <input type="password" class="form-control" name="confirm_pass">
        </div>
        <button type="submit" id="registr_submit" class="btn btn-primary">Sing Up</button>
        </form>
      </div>
    </div>
  </div>
  </div>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
  <script src="/includes/js/autorithe.js"></script>
</body>

</html>