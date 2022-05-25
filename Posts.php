<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
//echo $_SESSION["TrackingURL"];
Confirm_Login(); ?>
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
  <title>Posts</title>
</head>
<body>
    <nav>
            <div style="margin-right: 20px" class="menu-par">
                <div class="logo-par">

                </div>
                <div class="nav">

                              
                   <ul style="margin-top: 15px; margin-left: 140px; font-size: 20px">

                        <li><a class="menu_hover" href="index.html">Home</a></li>
                        <li><a class="menu_hover" href="Dashboard.php">Dashboard</a></li>
                        <li><a class="menu_hover" href="Posts.php">Posts</a></li>
                        <li><a class="menu_hover" href="Categories.php">Categories</a></li>
                        <li><a class="menu_hover" href="manage admins/Admins.php">Manage Admins</a></li>
                        <li><a class="menu_hover" href="Comments.php">Comments</a></li>
                        <li><a class="menu_hover" href="Blog.php?page=1">Live Blog</a></li> 
                         <li><a style=" color: red; font-weight: bold; font-size: 25px" class="menu_hover" href="Logout.php">Logout<img style="margin-left: 10px" src="Images/logout.jpg" width="23px" height="23px"></a></li>
                        <li><a style=" color: green; font-weight: bold; font-size: 25px" class="menu_hover" href="MyProfile.php">My Profile <img style="margin-left: 10px" src="Images/my-profile.png" width="23px" height="23px"></a></li>

                    </ul>
                  <div>

                       <ul class="navbar-nav ml-auto">            
                            <form class="form-inline" action="Blog.php" style="margin-right: 360px; margin-left: 5px">

                             </form>
                      </ul>
                  </div>

                </div>
                <div class="toggle-btn">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
    </nav>

    <header style="height: 300px" class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h1><i class="fas fa-blog" style="color:#15F0F3; margin-bottom: 30px; margin-top: 150px; "></i> Blog Posts</h1>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="AddNewPost.php" class="btn btn-primary btn-block">
              <i class="fas fa-edit"></i> Add New Post
            </a>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="Categories.php" class="btn btn-info btn-block">
              <i class="fas fa-folder-plus"></i> Add New Category
            </a>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="manage admins/Admins.php" class="btn btn-warning btn-block">
              <i class="fas fa-user-plus"></i> Add New Admin
            </a>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="Comments.php" class="btn btn-success btn-block">
              <i class="fas fa-check"></i> Approve Comments
            </a>
          </div>

        </div>
      </div>
    </header>

    <section class="container py-2 mb-4">
      <div class="row">
        <div class="col-lg-12">
          <?php
           echo ErrorMessage();
           echo SuccessMessage();
           ?>
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Category</th>
              <th>Date&Time</th>
              <th>Author</th>
              <th>Banner</th>
              <th>Comments</th>
              <th>Action</th>
              <th>Live Preview</th>
            </tr>
            </thead>
                    <?php
                    global $ConnectingDB;
                    $sql  = "SELECT * FROM posts ORDER BY id desc";
                    $stmt = $ConnectingDB->query($sql);
                    $Sr = 0;
                    while ($DataRows = $stmt->fetch()) {
                      $Id        = $DataRows["id"];
                      $DateTime  = $DataRows["datetime"];
                      $PostTitle = $DataRows["title"];
                      $Category  = $DataRows["category"];
                      $Admin     = $DataRows["author"];
                      $Image     = $DataRows["image"];
                      $PostText  = $DataRows["post"];
                      $Sr++;
                    ?>
  <tbody>
        <tr>
          <td>
              <?php echo $Sr; ?>
          </td>
          <td>
              <?php
                  if(strlen($PostTitle)>20){$PostTitle= substr($PostTitle,0,18).'..';}
                   echo $PostTitle;
               ?>
           </td>
           <td>
              <?php
                  if(strlen($Category)>8){$Category= substr($Category,0,8).'..';}
                   echo $Category ;
               ?>
           </td>
           <td>
              <?php
                  if(strlen($DateTime)>11){$DateTime= substr($DateTime,0,11).'..';}
                     echo $DateTime ;
              ?>
          </td>
          <td>
              <?php
                  if(strlen($Admin)>6){$Admin= substr($Admin,0,6).'..';}
                     echo $Admin ;
               ?>
          </td>
              <td><img src="Uploads/<?php echo $Image ; ?>" width="170px;" height="50px"</td>
              <td>
                  <?php $Total = ApproveCommentsAccordingtoPost($Id);
                  if ($Total>0) {
                    ?>
                    <span class="badge badge-success">
                      <?php
                    echo $Total; ?>
                    </span>
                      <?php  }  ?>
                <?php $Total = DisApproveCommentsAccordingtoPost($Id);
                if ($Total>0) {
                                ?>
                  <span class="badge badge-danger">
                    <?php
                  echo $Total;  ?>
                  </span>
                    <?php  }    ?>
              </td>
              <td>
                <a href="EditPost.php?id=<?php echo $Id; ?>"><span class="btn btn-warning">Edit</span></a>
                <a href="DeletePost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a>
              </td>
              <td>
                <a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a>
              </td>
                </tr>
                </tbody>
        <?php } ?>   
          </table>
        </div>
      </div>
    </section>

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

    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="js/extrenaljq.js"></script>

</body>
</html>
