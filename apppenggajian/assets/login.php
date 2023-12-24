
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
    <style>
      html{
        position: relative;
        min-height: 100px;
      }
      body{
        background: url(img/latar2.jpeg) no-repeat center fixed;
        -webkit-background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        -o-background-size: 100% 100%;
        background-size: 100% 100%;
      }
      body > .container{
        margin-top: 150px;
        margin-left: auto;
        margin-right: auto;
      }
    </style>
  </head>

  <body>

    <div class="container">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-body">

              <?php
              $array = array('request_method' => 'POST');

              if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                  $user = isset($_POST['username']) ? $_POST['username'] : '';
                  $pass = isset($_POST['password']) ? $_POST['password'] : '';
                  $p    = md5($pass);

                  if ($user == '' || $pass == '') {
                      ?>
                      <div class="alert alert-warning"><b>Warning!</b> Form anda belum lengkap!</div>
                      <?php
                  } else {
                  include "koneksi.php";
                  $sqlLogin = mysqli_query($konek, "SELECT * FROM admin WHERE username='$user' AND password='$p'");
                  $jml = mysqli_num_rows($sqlLogin);
                  $d=mysqli_fetch_array($sqlLogin);

                  if($jml > 0){
                    session_start();
                    $_SESSION['login']        = TRUE;
                    $_SESSION['id']           = $d['idadmin'];
                    $_SESSION['username']     = $d['username'];
                    $_SESSION['namalengkap']  = $d['namalengkap'];

                    header('Location:./index.php');
                  }else{
                    ?>
                    <div class="alert alert-danger"><b>ERROR</b>Username dan Password anda salah!</div>
                    <?php
                  }
                }
              }
              ?>

              <form action="" method="post" role="form">
                <h2 class="form-signin-heading">Please Log in</h2>
                <label for="inputEmail" class="sr-only">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" >
                <br>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit" value="Logn in">Log in</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
