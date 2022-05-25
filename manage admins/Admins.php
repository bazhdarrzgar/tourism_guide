<?php require_once("include/DB.php");?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php  Confirm_Login();?>

<?php
  if(isset($_POST["Submit"])) {
    $userName = mysqli_real_escape_string($connection, $_POST["Username"]);
    // $Name = mysqli_real_escape_string($connection, $_POST["Name"]);
    $password = mysqli_real_escape_string($connection, $_POST["Password"]);
    $confirmPassword = mysqli_real_escape_string($connection, $_POST["ConfirmPassword"]);

    date_default_timezone_set("Asia/Dhaka");
    $currentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S", $currentTime);

    if(empty($userName)) {
      $_SESSION['ErrorMessage'] = "Username cannot be empty.";
      Redirect_to("Admins.php");
      exit;
    } 
  //  elseif (CheckUserNameExistsOrNot($userName)) {
  //   $_SESSION["ErrorMessage"]= "Username Exists. Try Another One! ";
  //   Redirect_to("Admins.php");
  //   exit;
  // } 
  else if(strlen($userName) > 99) {
      $_SESSION['ErrorMessage'] = "Username is too long.";
      Redirect_to("Admins.php");
    } else if(empty($password)) {
      $_SESSION['ErrorMessage'] = "Password cannot be empty.";
      Redirect_to("Admins.php");
      exit;
    } 
  else if(strlen($password) < 4) {
      $_SESSION['ErrorMessage'] = "Atleast 4 characters for password.";
      Redirect_to("Admins.php");
      exit;
    } 
  else if($password !== $confirmPassword) {
      $_SESSION['ErrorMessage'] = "Password not matched";
      Redirect_to("Admins.php");
      exit;
    } 
  else {
      global $connection;
      $hashpassword = md5($password);
      $admin = $_SESSION['username'];
      $query = "INSERT into admins(datetime, username, password, aname, aheadline, abio, aimage, addedby) values('$DateTime', '$userName', '$hashpassword', 'Type your name', 'Type your headline', 'Type your bio', 'Add your image', '$admin')";
      $execute = mysqli_query($connection, $query);

      if($execute) {
        $_SESSION['SuccessMessage'] = "Admin added successfully";
        Redirect_to("Admins.php");
      } 
      else {
        $_SESSION['ErrorMessage'] = "Admin cannot be added. Please check your internet connection...";
        Redirect_to("Admins.php");
      }
    }
  }
  
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Admins</title>
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
    </style>  
  </head>

  <body>
    <div style="height:10px; background:#27aae1;"></div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-2">
          <h2>Menu Bar</h2>

          <ul id="SideMenu" class="nav flex-column nav-pills my_nav">


            <li class="nav-item">
              <a style="font-weight: bold"  class="nav-link" href="Logout.php"><i style="font-weight: bold" class="fa fa-sign-in"></i>Logout</a>
            </li>

          </ul>

        </div>

        <div class="col-sm-10">
          <h2>Add & Manage Admins Access</h2>
          <div><?php echo Message(); echo SuccessMessage();?></div>
          <div>
            <form action="Admins.php" method="post">
              <div class="form-group">
                <fieldset>
                  <label for="Username"><span class="fieldInfo">Username:</span></label>
                  <input class="form-control" type="text" name="Username" id="Username" placeholder="Username"/>
                </fieldset>
              </div>

              <div class="form-group">
                <fieldset>
                  <label for="Password"><span class="fieldInfo">Password:</span></label>
                  <input class="form-control" type="password" name="Password" id="Password" placeholder="Password"/>
                </fieldset>
              </div>

              <div class="form-group">
                <fieldset>
                  <label for="ConfirmPassword"><span class="fieldInfo">Confirm Password:</span></label>
                  <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Retype same password"/>
                </fieldset>
              </div>

              <input class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Admin">
            </form>
          </div>

          <div class="myTable table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>No.</th>
                  <th>Date & Time</th>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Added By</th>
                  <th>Action</th>
                </tr>
              </thead>

              <?php
                global $connection;

                $getCategory = "SELECT * FROM admins order by id desc";
                $execute = mysqli_query($connection, $getCategory);

                $cnt = 0;
                while($DataRows = mysqli_fetch_array($execute)) {
                  $AdminId = $DataRows["id"];
                  $DateTime = $DataRows["datetime"];
                  $AdminUsername = $DataRows["username"];
                  $AdminName= $DataRows["aname"];
                  $AddedBy = $DataRows["addedby"];
                  $cnt++;
              ?>

              <tbody>
                <tr>
                <td><?php echo htmlentities($cnt); ?></td>
                  <td><?php echo htmlentities($DateTime); ?></td>
                  <td><?php echo htmlentities($AdminUsername); ?></td>
                  <td><?php echo htmlentities($AdminName); ?></td>
                  <td><?php echo htmlentities($AddedBy); ?></td>
                 <td> <a href="DeleteAdmin.php?id=<?php echo $AdminId;?>" class="btn btn-danger">Delete</a>  </td>

                </tr>
              </tbody>
            <?php }?>
            </table>
          </div>
        </div> 
      </div> 
    </div> 



    <div class="footer">
            <h1 id = "about us lsb" style="color: white; font-weight: bold; margin-top: 30px;"><center>ABOUT US</center></h1>
            <p class="copyright" style="font-size: 20px" >&copy; دیڤلۆپەرەکان: بەشدار و لەنیا و سیڤا<br>ئەم سایتە تەنها بۆ مەبەستی خوێندن بەکاردێت دیزاینکەرانی ئەم وێبسیاتە بەشدار و لەنیاو سیڤایە هەر کەسێک دیەوێت ئەم وێبسایتە بەکاربهێنێت ئەوە ئازادە لە بەکارهێنانی  </p>
    </div>
    <div style="height:10px; background:#27aae1;"></div>
  </body>
</html>
