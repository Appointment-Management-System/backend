<?php
session_start();
$_SESSION['status'] = False;
$username = $_POST["username"];
$password = $_POST["user_password"];
	if($username == 'rtadmin' && $password == 'rtAdmin@1234'){
		$_SESSION['use']= 'admin';
		$_SESSION['username']= $username;
		$_SESSION['status'] = True;
		header('Location: temp.php');
	}
	else{
		echo '<script type ="text/javascript">alert("Your credential is not valid, Please try again"); location = "loginpage.html";</script>';
		
	}





//$mysqli = mysqli_connect( 'localhost', 'root', '', 'rtemployee');

/*if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit();
} 

    $query = "SELECT * FROM admin where emailid = '$email'";
    $data = mysqli_query($mysqli, $query);
    $count = mysqli_fetch_array($data);
    if(!$data)
    {
        printf("Error :%s\n", mysqli_error($mysqli));
        exit();
    }
    if($count>0)
    {
        session_start();
        $_SESSION['use']= 'admin';
        $_SESSION['email']= $email;
        
        header('Location: Adminlog.php');
    }
    else
    {
        echo '<script type ="text/javascript">alert("Your credential is not valid, Please try again"); location = "loginpage.html";</script>';
    }*/

?>