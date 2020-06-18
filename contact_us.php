<?php include "inc/header.php"; ?>


<?php 
$db = new Database();
$fm = new Format();
?>
	
	<div class="Contentsection templete clear">

		<?php

		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
			$fname = $fm->validation($_POST['firstname']);
			$lname = $fm->validation($_POST['lastname']);
			$email = $fm->validation($_POST['email']);
			$body = $fm->validation($_POST['body']);

			$fname = mysqli_real_escape_string($db->link, $fname);
			$lname = mysqli_real_escape_string($db->link, $lname);
			$email = mysqli_real_escape_string($db->link, $email);
			$body = mysqli_real_escape_string($db->link, $body);

			$error = "";
			if(empty($fname)){
				$error = "First name must not be empty!";

			}elseif(empty($lname)){
				$error = "Last name must not be empty!";

			}elseif(empty($email)){
				$error = "Email field must not be empty!";

			}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error = "Invalid Email Address";

			}elseif(empty($body)){
				$error = "Message Field must not be empty!";

			}else{
				$query = "INSERT INTO tbl_contact(firstname, lastname, email, body) VALUES('$fname', '$lname', '$email', '$body')";

           		$inserted_rows = $db->insert($query);
            	if ($inserted_rows) {
                	$msg = "Message Sent Successfully.";
            	}else {
                	$error = "Message Not Sent!";
            	}
			}
		}
?>

		<div class="MainContent clear">
			<div class="about">
				<h2>Contact us</h2>
			<?php
				if(isset($error)){
					echo "<span style = 'color:red; font-size: 18px; font-weight: bold'> $error </span>";
				}
				if(isset($msg)){
					echo "<span style = 'color:green; font-size: 18px; font-weight: bold'> $msg </span>";
				}

			?>

				<form action="" method="post">
					<table>
					<tr>
						<td>Your First Name:</td>
						<td>
							<input type="text" name="firstname" placeholder="Enter first name"/>
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<input type="text" name="lastname" placeholder="Enter Last name" />
						</td>
					</tr>
					
					<tr>
						<td>Your Email Address:</td>
						<td>
							<input type="text" name="email" placeholder="Enter Email Address" />
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<textarea name="body"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Send"/>
						</td>
					</tr>
					</table>
				<form>				
			</div>

		</div>


	<?php include "inc/sidebar.php"; ?>

		
<?php include "inc/footer.php"; ?>

<!-- <script src="http://maps.google.com/maps/api/js"></script>
  <script src="js/gmaps.js"></script>

 <script type="text/javascript">
    var map;
    $(document).ready(function(){
      var map = new GMaps({
        el: '#map',
        lat: 23.7808875,
        lng: 90.2792374
      });
 

      GMaps.geolocate({
        success: function(position){
          map.setCenter(position.coords.latitude, position.coords.longitude);
        },
        error: function(error){
          alert('Geolocation failed: '+error.message);
        },
        not_supported: function(){
          alert("Your browser does not support geolocation");
        },
        always: function(){
          alert("Done!");
        }
      });
    });
  </script> -->

