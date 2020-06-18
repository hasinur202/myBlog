<?php
	include "../lib/Session.php";
	include "../config/config.php";
	include "../lib/Database.php";
	include "../helpers/Format.php";
	Session::checkLogin();
?>

<?php 
$db = new Database();
$fm = new Format();

?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send'])){
			$email = $fm->validation($_POST['email']);
			$email = mysqli_real_escape_string($db->link, $email);

			if(empty($email)){
				echo "<span style = 'color: red; font-size = 18px;'>Field Must not be Empty!</span>";

       		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       			echo "<span style = 'color: red; font-size = 18px;'>Invalid Email Address!</span>";
            
        	}else{

            	$emailquery = "SELECT *from tbl_user where email ='$email' limit 1";
                $checkemail = $db->select($emailquery);

                if($checkemail != false){
                	while ($value = $checkemail->fetch_assoc()) {
                		$userid 	= $value['id'];
                		$username 	= $value['username'];
                	}

	                $text 		= substr($email, 0, 3);
	                $rand 		= rand(10000, 99999);
	                $newpass 	= "$text$rand";
	                $password 	= md5($newpass);

	                $updatequery = "UPDATE tbl_user 
	                				SET 
	                				password = '".$password."' 
	                				WHERE id = '".$userid."'";
	                $mailupdate = $db->update($updatequery);

	                $to 		= 	"$email";
	                $from 		= 	"hasinur202@gmail.com";
	                $headers 	= 	"From: $from\n";
	                $headers 	.= 	'MIME-Version: 1.0' . "\r\n";
	                $headers 	.= 	'Content_type: text/html; charset=iso-8859-1' . "\r\n";

	                $subject 	= 	"Your Password";
	                $message 	= 	"Your username is ".$username." and Password is ".$newpass." Please Visit 				Website to Login.";

	                $sendmail 	= 	mail($to, $subject, $message, $headers);

	                if($sendmail){
	                	echo "<span style = 'color: green; font-size = 18px;'>Please check your email for new password. </span>";
	                }else{
						echo "<span style = 'color: red; font-size = 18px;'>Email Not sent... </span>";
	                }

				}else{
					echo "<span style = 'color: red; font-size = 18px;'>Email Not exist... </span>";
				}
			}
 		}
	?>

		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter a valid email" name="email"/>
			</div>
			<div>
				<input type="submit" name="send" value="Send Mail" />
			</div>
		</form><!-- form -->

		<div class="button">
			<a href="login.php">login!</a>
		</div>

		<div class="button">
			<a href="#">My Project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>