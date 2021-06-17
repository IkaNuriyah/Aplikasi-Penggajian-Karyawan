<?php require '../config/config.php';

if (isset($_SESSION['user'])) {
    header("Location: " . urlAwal(''));
}

if (isset($_POST['login'])) {
  //cek username
  $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'") or die(mysqli_error($conn));
  if (mysqli_num_rows($result) >= 1) {
      $row = mysqli_fetch_assoc($result);

      $password = sha1($password);
      $result = mysqli_query($conn, "SELECT * FROM user WHERE password = '$password'");
      if (mysqli_num_rows($result) >= 1) {
          //set session
          $_SESSION['user'] = $username;
          header("Location: " . urlAwal());
          exit;
      }
  }
  if (isset($_GET['pesan'])) {
      $pesan = $_GET['pesan'];
  }
  $error = true;
  mysqli_free_result($result);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title> Login Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?= urlAwal('_asset/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <style>
      html{
          padding :0;
          margin : 0;       
    }
    .row{
        margin-top : 10px;
        height:600px;
        background : url('../_asset/img/work.png') -40px -10px  no-repeat;
    }
  </style>
</head>
<body>

  <div class="container">
  <div class="row">
    <div class="main col-sm-4 col-sm-offset-8" style="margin-top: 10%;">
        <div class="form-group">
              <form action="" method="post">

                  <div class="form-group" style="margin-bottom: 15%">
                      <label for="kode">Username</label>
                      <i class="glyphicon glyphicon-user"></i><input type="text" name="username" class="form-control" id="username" required autofocus autocomplete="off" placeholder="Masukkan username">
                  </div>
                  <div class="form-group">
                      <label for="password">Password</label>
                      <i class="glyphicon glyphicon-lock"></i><input type="password" name="password" class="form-control" id="password" required autofocus autocomplete="off" placeholder="Masukkan password">
                  </div>                                                              
                  <div class="form-group">
                      <center><input type="submit" name="login" value="LOGIN" class="btn btn-success">
                      </center>
                  </div>
              </form>          
        </div>
    </div>  
  </div>


  </div>
    <script src="<?= urlAwal('_asset/js/jquery.js'); ?>"></script>
    <script src="<?= urlAwal('_asset/js/bootstrap.min.js'); ?>"></script>
</body>
</html>