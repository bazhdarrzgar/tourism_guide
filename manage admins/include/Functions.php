<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php
function Redirect_to($New_Location){
    header("Location:".$New_Location);
	  exit;
}

// function CheckUserNameExistsOrNot($userName){
//   global $connection;
//   $query = "SELECT username FROM admins WHERE username=$userName";
//   $execute=mysqli_query($connection, $query);
//     if($execute = 1) {
//        return true;
//     } else {
//       return false;
//     }
//   }


function Login_Attempt($Username,$Password){
    global $connection;
    $query = "SELECT * from super_admin where username='$Username' and password='$Password'";
    $execute=mysqli_query($connection, $query);

    if($execute) {
      $admin=mysqli_fetch_assoc($execute);

      if($admin) {
  	     return $admin;
      } else {
        return null;
      }
    }
}

function Login(){
    if(isset($_SESSION["User_Id"])) {
	     return true;
    } 
    // else {
    //   return false;
    // }
}

function Confirm_Login(){
    if(!Login()){
	     $_SESSION["ErrorMessage"]="Login Required!";
	     Redirect_to("Login.php");
    }
 }
?>
