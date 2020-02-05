<?php 
session_start();
 if(isset($_SESSION['user_token'])||isset($_COOKIE['remember_token'])){
  require('bin/db.php');  
  $user_id = $_SESSION['user_token'] ?? $_COOKIE['remember_token'];

  $user_check = $pdo->prepare('SELECT remember_token,name FROM users WHERE remember_token=?');
  $user_check->execute([$user_id]);
  $user_check_result = $user_check->fetch(PDO::FETCH_ASSOC);

  if($user_id != $user_check_result['remember_token']){
    header("Location: http://websockets/");
  }
 }else{
  header("Location: http://websockets/");
 }
?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="includes/css/style.css">
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" id="user_name"><?php echo $user_check_result['name'] ?></a>
    <form class="form-inline" action="includes/server/log_out.php">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button>
    </form>
  </nav>
  <div class="container">
    <div class="col jumbotron bg-dark p-3" id="dialog">
    
    </div>
    <div class="row bg-white">
      <div class="col">
        <textarea class="form-control" id="textarea_message" rows="3" placeholder="Введите сообщение..."></textarea>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col">
        <button type="submit" id="button_submit" class="btn btn-success btn-lg btn-block">Submit</button>
        <button type="clear" id="button_clear" class="btn btn-secondary btn-lg btn-block">Clear</button>
      </div>
    </div>
  </div>

  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="/includes/js/script.js"></script>
</body>

</html>