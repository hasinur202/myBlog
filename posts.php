<?php include "inc/header.php"; ?>

	<?php
		$category  = mysqli_real_escape_string($db->link, $_GET['category']);
		if(!isset($category) || $category == NULL){
			header("Location: 404.php");
		}else{
			$id = $category;
		} ?>


	<div class="Contentsection templete clear">

	<div class="MainContent clear">
		<?php
			$query = "SELECT *from tbl_post where cat = '$id'";
			$post = $db->select($query);
			if($post){
				while ($result = $post->fetch_assoc()){
		?>

		<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $result['id'];?>"> <?php echo $result['title']; ?></a></h2>
			<h4><?php echo $fm->formateDate($result['date']); ?> By <a href="#"> <?php echo $result['author']; ?></a></h4>
			<a href="index.php"><img src="admin/<?php echo $result['image'];?>" alt="Post Image"></a>

			<?php echo $fm->textShorten($result['body']); ?>

			<div class="Readmore clear">
				<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
			</div>
			
		</div> <?php } } else{ ?>
				<h3>No Post Available in this Category..!</h3>

			<?php } ?>

	
</div>	
<?php include "inc/sidebar.php"; ?>
<?php include "inc/footer.php"; ?>


