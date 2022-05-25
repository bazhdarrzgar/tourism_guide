<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
if(isset($_SESSION["UserId"])){
  Redirect_to("Dashboard.php");
}

if (isset($_POST["Submit"])) {
  $UserName = htmlentities(stripcslashes(trim(htmlspecialchars($_POST["Username"]))));
  $Password = htmlentities(stripcslashes(trim(htmlspecialchars(md5($_POST["Password"])))));
  if (empty($UserName)||empty($Password)) {
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("Login.php");
  } else {
    // code for checking username and password from Database

    // login attempt use for try to know if this password or this username is equal to this password that is in the server try to login basicly
    $Found_Account=Login_Attempt($UserName,$Password);
    if ($Found_Account) {
      $_SESSION["UserId"]=$Found_Account["id"];
      $_SESSION["UserName"]=$Found_Account["username"];
      $_SESSION["AdminName"]=$Found_Account["aname"];
      $_SESSION["SuccessMessage"]= "Wellcome ".$_SESSION["AdminName"]."!";
      // if user is referesh the page or page refereshed by browser the page is redirected for it self with some session
      // if the user login to the account first time it will go to the profile it self but if user logout to the account then login it will go to the dashboard
      if (isset($_SESSION["TrackingURL"])) {
        Redirect_to($_SESSION["TrackingURL"]);
      } else{
      Redirect_to("Dashboard.php");
    }
    } else {
      $_SESSION["ErrorMessage"]="Incorrect Username/Password";
      Redirect_to("Login.php");
    }
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="css_1/Styles.css">
  <title>Login</title>
</head>
<body>

  <div style="height:10px; background:#27aae1;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <ul>
        <h1 style="margin-top:  11px;font-size: 40px; ; min-width: 100px"><a href="index.html" style="color: #1DE6E6">Travel </a></h1>
      </ul>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>


    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          </div>
        </div>
      </div>
    </header>

<p style="margin-bottom: 50px"></p>
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
          <br><br><br>
          <?php
          // this is two function session
           echo ErrorMessage();
           echo SuccessMessage();
           ?>


          <br>
          <div class="card bg-secondary text-light">
            <div class="card-header">
              <h4>Welcome Back Admin Blog !</h4>
              </div>
              <div class="card-body bg-dark">
              <form class="" action="Login.php" method="post">
                <div class="form-group">
                  <label for="username"><span class="FieldInfo">Username</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-info"> <i class="fas fa-user"></i> </span>
                    </div>
                    <input type="text" class="form-control" name="Username" id="username" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password"><span class="FieldInfo">Password</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-info"> <i class="fas fa-lock"></i> </span>
                    </div>
                    <input type="password" class="form-control" name="Password" id="password" value="">
                  </div>
                </div>
                <input type="submit" name="Submit" class="btn btn-info btn-block" value="Login">
              </form>

            </div>

          </div>

        </div>

      </div>

    </section>

<p style="margin-bottom: 55px"></p>
    <footer style="background-color: #00ffff"><center>
        <div class="container">
            <br>
            <h1 id = "about us lsb" style="font-weight: bold; margin-top: 30px;"><center>ABOUT US</center></h1>
            <p class="copyright" style="font-size: 20px" >&copy; دیڤلۆپەرەکان: بەشدار و لەنیا و سیڤا<br>ئەم سایتە تەنها بۆ مەبەستی خوێندن بەکاردێت دیزاینکەرانی ئەم وێبسیاتە بەشدار و لەنیاو سیڤایە هەر کەسێک دیەوێت ئەم وێبسایتە بەکاربهێنێت ئەوە ئازادە لە بەکارهێنانی  </p>
            <br>
        </div>
    </center>
    </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
