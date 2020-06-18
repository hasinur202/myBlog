
</div>

<div class="footersection templete clear">
	<div class="footermenu clear">
			<ul>
			<li>
				<a id="active" href="index.php">Home</a>
				<a href="about.php">About</a>
				<a href="contact.php">Contact</a>
				<a href="#">Privacy</a>
			</li>
		</ul>
	</div>

	<?php
		$query = "SELECT *from tbl_copyright";
		$copyright = $db->select($query);
		if($copyright){
			while ($result = $copyright->fetch_assoc()) {
	?>
	<p>
		&copy; Copyright <a href="#"><?php echo $result['cpyrightname']; ?></a>. All Rights Reserved.
	</p>
<?php }}?>


</div>

<div class="fixedicon">

		
		<?php
			$query = "SELECT *from tbl_sociallink";
			$social = $db->select($query);
			if($social){
				while ($result = $social->fetch_assoc()) {

		?>


	<a href="<?php echo $result['fb'];?>"><img src="images/social/facebook.jpg" alt="Facebook"></a>
	<a href="<?php echo $result['google'];?>"><img src="images/social/google.jpg" alt="Google"></a>
	<a href="<?php echo $result['twitter'];?>"><img src="images/social/twitter.png" alt="twitter"></a>
	<a href="<?php echo $result['youtube'];?>"><img src="images/social/youtube.png" alt="Youtube"></a>

	<?php }}?>

</div>

</body>


<script type="text/javascript" src="http://arrow.scrolltotop.com/arrow52.js"></script>


</html>