<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';
}
if(isset($_POST['login']))
{
  

$email=$_POST['emailid'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password,StudentId,Status FROM tblstudents WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
 foreach ($results as $result) {
 $_SESSION['stdid']=$result->StudentId;
if($result->Status==1)
{
$_SESSION['login']=$_POST['emailid'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else {
echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";

}
}

} 

else{
echo "<script>alert('Invalid Details');</script>";
}
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Green Library  | </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">User Login Form</h4>
</div>
</div>
             
<!--LOGIN PANEL START-->           
<div class="row">
<div class="col-md-4" id="left" style="font-size: 20px">
			<ul>
				<li>Opening Time: 9:15 AM</li>
				<li>Closing Time: 7:30 PM</li>
				<li><b>Sunday off</b></li>
			</ul><br><br>
			
		</div>		
<div class="col-md-8" >
<div class="panel panel-info">
<div class="panel-heading">
 Login Form
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Enter Email </label>
<input class="form-control" type="text" name="emailid" required autocomplete="off" />
</div>
<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" required autocomplete="off"  />
<p class="help-block"><a href="user-forgot-password.php">Forgotten password?</a></p>
</div>

 

 <button type="submit" name="login" class="btn btn-info">Login </button>  <a href="signup.php">Create New Account</a>
</form>
 </div>
</div>
</div>
<div class="col-md-10" id="left">
			<ul style="margin-left:  20px">
				<h3 style="color: blue">Library Rules and Regulation</h3>
				<h4 style="color: green">Borrowing & Returning Library Items</h4>
				<li> All items must be checked out and returned to the circulation desk</li>
				<h4 style="color: purple">Fine system for due items</h4>
				<li> Fine will be imposed per day @ Tk. 5.00 (Taka five only) for each book and @ Tk. 10.00 (taka ten only) for each audio-visual item, if any member fails to return the item(s) within due date.</li>
				<li> In case of ‘confined copy’ and ‘reference book’ per day @ Tk. 50.00 (Taka fifty only) will be charged for each item if not returned on due time.</li>
				<h4 style="color: orange">Some Rules</h4>
				<li> Be reasonably quiet</li>
				<li> No loud disruptive behavior</li>
				<li> Food is not allowed in the library</li>
				<li> Group discussion is not allowed inside library</li>
				<li> Issued and personal books are not allowed inside library</li>
			</ul>
	</div>
</div>  



<!---LOGIN PABNEL END-->            
             
 
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
     <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
