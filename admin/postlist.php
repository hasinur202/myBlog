<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  


<?php
	//$deleteid  = mysqli_real_escape_string($db->link, $_GET['delid']);
	if(isset($_GET['delid'])){
			$delid = $_GET['delid'];

			$query="SELECT *from tbl_post where id = '".$delid."'";
			$getData = $db->select($query);
			if($getData){
						while ($delimg = $getData->fetch_assoc()) {
							$dellink = $delimg['image'];
							unlink($dellink);
						}
                    }

			$delquery="DELETE from tbl_post where id = '".$delid."'";
			$deletepost = $db->delete($delquery);
			if($deletepost){
						echo "<span class='success'>Data Deleted Successfully!</span>";
                    }else{
                        "<span class='error'>Data not deleted...!</span>";
                    }
		}
?>


            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="5%">No.</th>
					<th width="10%">Title</th>
					<th width="25%">Description</th>
					<th width="10%">Category</th>
					<th width="10%">Image</th>
					<th width="10%">Author</th>
					<th width="8%">Tags</th>
					<th width="12%">Date</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>		

				<tr class="odd gradeX">
				<?php
					$query = "SELECT tbl_post.*, tbl_category.name from tbl_post, tbl_category where tbl_post.cat = tbl_category.id ORDER BY tbl_post.title desc";

					$post = $db->select($query);
					if($post){
						$i = 0;
						while ($result = $post->fetch_assoc()) {
						$i++;	
				?>
					<td><?php echo $i ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><?php echo $fm->textShorten($result['body'], 70); ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" width="60px" height="40px"></td>
					<td><?php echo $result['author']; ?></td>
					<td><?php echo $result['tags']; ?></td>
					<td><?php echo $fm->formateDate($result['date']); ?></td>



					<td>
						<a href="viewpost.php?viewpostid=<?php echo $result['id']?>">View</a>


<?php

 	$query = "SELECT *from tbl_user where id = '$aaa'";
	$usrlog = $db->select($query);
		if($usrlog){
			while ($rresult = $usrlog->fetch_assoc()) {

					if(Session::get('userId') == $result['userid']){ ?>

					|| <a href="editpost.php?editpostid=<?php echo $result['id']?>">Edit</a>
					|| <a onclick="return confirm('Are you sure to Delete'); " href="?delid=<?php echo $result['id']?>">Delete</a>

					<?php } elseif($rresult['role'] == '1') {?>

    				 
					|| <a href="editpost.php?editpostid=<?php echo $result['id']?>">Edit</a>
					|| <a onclick="return confirm('Are you sure to Delete'); " href="?delid=<?php echo $result['id']?>">Delete</a>

    	<?php }} } 
 ?>

					


				</td>
				</tr>

			<?php } } ?>

			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
	setSidebarHeight();
        });
</script>
<?php include "inc/footer.php"; ?>