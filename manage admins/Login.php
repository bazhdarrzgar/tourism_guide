<?php require_once("include/DB.php");?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/Sessions.php"); ?>

<?php
  if(isset($_POST["Submit"])) {
    $userName = mysqli_real_escape_string($connection, $_POST["Username"]);
    $password = mysqli_real_escape_string($connection, $_POST["Password"]);

    date_default_timezone_set("Asia/Dhaka");
    $currentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S", $currentTime);

    if(empty($userName) || empty($password)) {
      $_SESSION['ErrorMessage'] = "All fields must be required.";
      Redirect_to("Login.php");
      exit;
    } else {
      $foundAccount = Login_Attempt($userName, $password);
      if($foundAccount) {
        $_SESSION['User_Id'] = $foundAccount['id'];
        $_SESSION['username'] = $foundAccount['username'];
        $_SESSION['SuccessMessage'] = "Welcome ".$_SESSION['username'];
        Redirect_to("Admins.php");

      } else {
        $_SESSION['ErrorMessage'] = "Username/password not matched.";
        Redirect_to("Login.php");
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Admins</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/adminstyles.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <style media="screen">
      .fieldInfo {
        color: #218838;
        font-size: 18px;
      }

      body {
        background-color: #fff;
      }
    </style>
  </head>

  <body>

    <div style="height:10px; background:#27aae1;"></div>

    <style>
            .button {
              border: none;
              color: white;
              padding: 15px 32px;
              width: 200px;
              height:  60px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 20px;
              font-weight:  bold;
              margin: 4px 2px;
              cursor: pointer;
            }

            .button1 {background-color: #4CAF50;} /* Green */
            .button2 {background-color: #008CBA;} /* Blue */
          </style>

          <center>
            <button class="button button2"><a style="color: white" href="../index.html">Home</a></button>
          </center>
<br>

    <br>
<br>
<br>
<br><br>
<br>
<br>
<br><br>


    <div class="container-fluid">
      <div class="row">
        <div class="offset-sm-4 col-sm-4">
          <br/><br/>
          <h2>Login Page</h2>
          <div><?php echo Message(); echo SuccessMessage();?></div>
          <div>
            <form action="Login.php" method="post">
              <div class="form-group">
                <fieldset>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                    </div>

                    <input class="form-control" type="text" name="Username" id="Username" placeholder="Username"/>
                  </div>
                </fieldset>
              </div>

              <div class="form-group">
                <fieldset>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock-alt"></i></span>
                    </div>

                    <input class="form-control" type="password" name="Password" id="Password" placeholder="Password"/>
                  </div>
                </fieldset>
              </div>

              <input class="btn btn-success btn-block" type="submit" name="Submit" value="Login">
            </form>
          </div>
        </div>
      </div>
    </div> 


    <div class="footer fixed-bottom">
       <h1 id = "about us lsb" style="color: white; font-weight: bold; margin-top: 30px;"><center>ABOUT US</center></h1>
            <p class="copyright" style="font-size: 20px" >&copy; دیڤلۆپەرەکان: بەشدار و لەنیا و سیڤا<br>ئەم سایتە تەنها بۆ مەبەستی خوێندن بەکاردێت دیزاینکەرانی ئەم وێبسیاتە بەشدار و لەنیاو سیڤایە هەر کەسێک دیەوێت ئەم وێبسایتە بەکاربهێنێت ئەوە ئازادە لە بەکارهێنانی  </p>
    </div>
  </body>
</html>
