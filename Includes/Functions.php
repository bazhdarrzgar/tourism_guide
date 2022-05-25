<?php require_once("Includes/DB.php"); ?>

<?php

function Redirect_to($New_Location){
  header("Location:".$New_Location);
  exit;
}

// function CheckUserNameExistsOrNot($UserName){
//   global $ConnectingDB;
//   // If there are a large number of tuples satisfying the query conditions, it might be resourceful to view only a handful of them at a time.
//   // The LIMIT clause is used to set an upper limit on the number of tuples returned by SQL.
//   $sql    = "SELECT username FROM admins WHERE username=:userName";
//   $stmt   = $ConnectingDB->prepare($sql);
  
//   // bindValue() function is an inbuilt function in PHP that is used to bind a value to a parameter. This function binds a value to the 
//   // corresponding named or question mark placeholder in the SQL which is used to prepare the statement.

//   $stmt->bindValue(':userName',$UserName);
//   $stmt->execute();
//   $Result = $stmt->rowcount();
//   if ($Result==1) {
//     return true;
//   }else {
//     return false;
//   }
// }

function Login_Attempt($UserName,$Password){
  global $ConnectingDB;
  $sql = "SELECT * FROM admins WHERE username=:userName AND password=:passWord LIMIT 1";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':userName',$UserName);
  $stmt->bindValue(':passWord',$Password);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return $Found_Account=$stmt->fetch();
  }else {
    return null;
  }
}

function Confirm_Login(){
if (isset($_SESSION["UserId"])) {
  return true;
}  else {
  $_SESSION["ErrorMessage"]="Login Required !";
  Redirect_to("Login.php");
}
}

function TotalPosts(){
  global $ConnectingDB;
  $sql = "SELECT COUNT(*) FROM posts";
  $stmt = $ConnectingDB->query($sql);
  $TotalRows= $stmt->fetch();
  // array_shift() shifts the first value of the array off and returns it, shortening the array by one element and moving 
  // everything down. All numerical array keys will be modified to start counting from zero while literal keys won't be affected.
  $TotalPosts=array_shift($TotalRows);
  echo $TotalPosts;
}

function TotalCategories(){
  global $ConnectingDB;
  $sql = "SELECT COUNT(*) FROM category";
  $stmt = $ConnectingDB->query($sql);
  $TotalRows= $stmt->fetch();
  $TotalCategories=array_shift($TotalRows);
  echo $TotalCategories;
}

function TotalAdmins(){
  global $ConnectingDB;
  $sql = "SELECT COUNT(*) FROM admins";
  $stmt = $ConnectingDB->query($sql);
  $TotalRows= $stmt->fetch();
  $TotalAdmins=array_shift($TotalRows);
  echo $TotalAdmins;

}

function TotalComments(){
  global $ConnectingDB;
  $sql = "SELECT COUNT(*) FROM comments";
  $stmt = $ConnectingDB->query($sql);
  $TotalRows= $stmt->fetch();
  $TotalComments=array_shift($TotalRows);
  echo $TotalComments;
}

// status = ON we use it in sql query when admin approve the comment in the post then it will be connected and send to the database
function ApproveCommentsAccordingtoPost($PostId){
  global $ConnectingDB;
  $sqlApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='ON'";
  $stmtApprove =$ConnectingDB->query($sqlApprove);
  $RowsTotal = $stmtApprove->fetch();
  $Total = array_shift($RowsTotal);
  return $Total;
}

// status = ON we use it in sql query when admin not approve the comment in the post then it will be disconnected not send to the database
function DisApproveCommentsAccordingtoPost($PostId){
  global $ConnectingDB;
  $sqlDisApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='OFF'";
  $stmtDisApprove =$ConnectingDB->query($sqlDisApprove);
  $RowsTotal = $stmtDisApprove->fetch();
  $Total = array_shift($RowsTotal);
  return $Total;
}
 ?>