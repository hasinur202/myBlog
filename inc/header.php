<?php
	include 'config/config.php';
	include "lib/Database.php";
	include "helpers/Format.php";
?>

<?php 
	$db = new Database();
	$fm = new Format();
?>


<!DOCTYPE html>
<html>
<head>


<?php
	include "scripts/meta.php";
	include "scripts/css.php";
	include "scripts/js.php";
?>


</head>

<body>
	<div class="headersection templete clear">
		<div class="logo">
			

	           <?php
	                $query = "SELECT *from tbl_webtitle";
	                $webttl = $db->select($query);
	                if($webttl){
	                    while ($result = $webttl->fetch_assoc()){
	            ?>

	            <a href="index.php"><img src="admin/<?php echo $result['image'];?>" alt="Logo"/></a>
				
					<h2><?php echo $result['webtitle']; ?></h2>
					<p><?php echo $result['description']; ?></p>

				<?php }} ?>

		</div>


		<?php
			$query = "SELECT *from tbl_sociallink";
			$social = $db->select($query);
			if($social){
				while ($result = $social->fetch_assoc()) {

		?>
		
		<div class="social clear">
			<a target="_blank" href="<?php echo $result['fb'];?>"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
			<a target="_blank" href="<?php echo $result['google'];?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
			<a target="_blank" href="<?php echo $result['twitter'];?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			<a target="_blank" href="<?php echo $result['youtube'];?>"><i class="fa fa-youtube" aria-hidden="true"></i></a>
		</div>
	<?php }}?>

		<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
		</div>
	</div>



	<div class="navsection templete">
	<?php
		$path = $_SERVER['SCRIPT_FILENAME'];
		$currentpage = basename($path, '.php');

	?>

		<ul>
			<li><a <?php if($currentpage == 'index'){echo 'id="active"'; }?> 
			href="index.php">Home</a></li>

				<?php
                    $query = "SELECT *from tbl_pages";
                    $page = $db->select($query);
                    if($page){
                        while ($result = $page->fetch_assoc()) {
                ?>

				<li><a
					<?php
						if(isset($_GET['pageid']) && $_GET['pageid'] == $result['id'] ){
							echo 'id = "active"';
						}
					?>

				href="page.php?pageid=<?php echo $result['id'];?>"><?php echo $result['name']; ?></a></li>

			<!-- 	<li><a href="contact.php">Contact</a>
					<ul>
						<li><a href="#">Address One</a></li>
						<li><a href="#">Address Two</a></li>
						<li><a href="#">Address Three</a></li>
						<li><a href="#">Address Four</a></li>
					</ul>
				</li> -->
<?php }}?>
	<li><a <?php if($currentpage == 'gallery'){echo 'id="active"'; }?> 
			href="gallery.php">Gallery</a></li>

	<li><a <?php if($currentpage == 'contact_us'){echo 'id="active"'; }?> 
			href="contact_us.php">Contact</a></li>
			
		</ul>

	
	</div>