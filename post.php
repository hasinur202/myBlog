<?php include "inc/header.php"; ?>

	
	<div class="Contentsection templete clear">

		<div class="MainContent clear">

	<?php
		$postid  = mysqli_real_escape_string($db->link, $_GET['id']);
		if(!isset($postid) || $postid == NULL){
			header("Location: 404.php");
		}else{
			$id = $postid;
		} ?>

			<div class="samepost clear">
				<?php
					$query = "SELECT *from tbl_post where id = '$id'";
					$post = $db->select($query);
					if($post){
					while ($result = $post->fetch_assoc()) {

				?>

			<h2><?php echo $result['title']; ?></h2>
			<h4><?php echo $fm->formateDate($result['date']); ?> By <a href="#"> <?php echo $result['author']; ?></a></h4>

			<img src="admin/<?php echo $result['image'];?>">
				
			<?php echo $result['body']; ?>

			<div class="relatedpost clear"> 
				<h2>Related Articles</h2>
			<?php
				$catid = $result['cat'];
				$querycat = "SELECT *from tbl_post where cat = '$catid' order by rand() limit 6";
				$relpost = $db->select($querycat);
				if($relpost){
				while ($rresult = $relpost->fetch_assoc()) {
			?>
				<a href="post.php?id=<?php echo $rresult['id'];?>"><img src="admin/<?php echo $rresult['image']; ?>" alt="Post Image"></a>

				<?php } } else{echo "Not Post Available"; }?>

			</div>

			<?php } }else{
			header("Location: 404.php");
		} ?>
</div>
</div>		

<?php include "inc/sidebar.php"; ?>
<?php include "inc/footer.php"; ?>


