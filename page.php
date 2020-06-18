<?php include "inc/header.php"; ?>


<?php
        $pgeid  = mysqli_real_escape_string($db->link, $_GET['pageid']);
        if(!isset($pgeid) || $pgeid == NULL){
            header("Location: 404.php");
        }else{
            $id = $pgeid;
        }
    ?>

    <?php
        $query = "SELECT *from tbl_pages WHERE id = '$id'";
        $page = $db->select($query);

        if($page){
             while ($result = $page->fetch_assoc()) {
         ?>

<div class="Contentsection templete clear">
	<div class="MainContent clear">
		<div class="samepost clear">		
		  <h2><?php echo $result['name'];?></h2>
		  <a href="#"><img src="images/idiot.png" alt="Post Image" title="Sazzad, Hasin, Ghani"></a>
			
		 <p><?php echo $result['body'];?></p> 

		</div>
	</div>
<?php } } else {
     header("Location: 404.php");
} ?>

<?php include "inc/sidebar.php"; ?>
<?php include "inc/footer.php"; ?>