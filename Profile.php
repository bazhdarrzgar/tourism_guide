<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php
    $SearchQueryParameter = $_GET["username"];
    global   $ConnectingDB;
    $sql    =  "SELECT aname,aheadline,abio,aimage FROM admins WHERE username=:userName";
    $stmt   =  $ConnectingDB->prepare($sql);
    $stmt   -> bindValue(':userName', $SearchQueryParameter);
    $stmt   -> execute();
    $Result = $stmt->rowcount();
if( $Result==1 ){
  while ( $DataRows   = $stmt->fetch() ) {
    $ExistingName     = $DataRows["aname"];
    $ExistingBio      = $DataRows["abio"];
    $ExistingImage    = $DataRows["aimage"];
    $ExistingHeadline = $DataRows["aheadline"];
  }
} else {
  $_SESSION["ErrorMessage"]="Bad Request !!";
  Redirect_to("Blog.php?page=1");
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


  <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />

  <link rel="stylesheet" href="css_1/Styles.css">
  <title>Profile</title>
</head>
<body>

    <nav>
        <div class="container">
            <div class="menu-par">
                <div class="logo-par">
                     <ul>
                        <h1 style="font-size: 30px; color: #00ffff; border-right: 3px solid white; margin-right: 8px; min-width: 100px"><a href="index.html">Travel </a></h1>
                      </ul>  
                </div>
                <div class="nav">

                              
                  <ul style="font-size: 18px; margin-top: 10px; margin-left: 165px; font-size: 25px">

                        <li><a class="menu_hover" href="index.html">Home</a></li>
                        <li><a class="menu_hover" href="Blog.php?page=1">Live Blog</a></li> 
                  </ul>
                   <ul class="navbar-nav ml-auto">
                    <form class="form-inline d-none d-sm-block" action="Blog.php" style="margin-left: 30px">
                      <div class="form-group">
                      <input class="form-control mr-2" type="text" name="Search" placeholder="Search here"value="" style="margin-top: 17px">
                      <button  class="btn btn-primary" name="SearchButton">Go</button>
                      </div>
                    </form>
                  </ul>
                </div>
                <div class="toggle-btn">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </div>
    </nav>





    <div style="height:10px; background:#27aae1;"></div>

    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h1><i class="fas fa-user text-success mr-4" style="color:#27aae1; font-size: 60px"></i></h1>
            <h1><?php echo $ExistingName; ?></h1>
          <h2><?php echo $ExistingHeadline; ?></h3>
          </div>
        </div>
      </div>
    </header>


    <section class="container py-2 mb-4">
      <div class="row" style="margin-top: 200px">
        <div class="col-md-3">
          <img src="Images/<?php echo $ExistingImage; ?>" class="d-block img-fluid mb-3 rounded-circle" alt="">
        </div>
        <div class="col-md-9" style="min-height:400px; margin-top: 15px">
          <div class="card">
            <div class="card-body" style="margin-top: 20px">
              <p class="lead"> <?php echo $ExistingBio; ?> </p>
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

    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="js/extrenaljq.js"></script>

</body>
</html>
