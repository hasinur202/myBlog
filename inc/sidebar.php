<div class="Sidebar clear">
			
	
		<div class="samesidebar clear">
			<h2> Latest Articles </h2>

			<?php
				$query = "SELECT *from tbl_category";
				$category = $db->select($query);

				if($category){
				while($result = $category->fetch_assoc()){

			?>

			<ul>
				<li><a href="posts.php?category=<?php echo $result['id']; ?>"> <?php echo $result['name']; ?> </a></li>
			</ul>

			<?php }} else{ ?>
				<li> No Available Articles </li>
			<?php 	} ?>
			
		</div>

		
		<div class="articlebar clear">
			
			<h2> Popular Articles </h2>
			<div class="popular clear">
				<?php 
				$querypost = "SELECT *from tbl_post limit 5";
				$post = $db->select($querypost);

				if($post){
					while ($result = $post->fetch_assoc()) {
				?>
				<h3><a href="post.php?id=<?php echo $result['id'];?>"> <?php echo $result['title']; ?></a></h3>

				<a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="Post Image"></a>

				<?php echo $fm->textShorten($result['body'], 120); ?>

			<?php }} ?>
			</div>
			</div>

	

		</div>