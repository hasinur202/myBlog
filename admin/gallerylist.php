<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 

    $aaa = Session::get('userId');
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  


<?php
	//$getsliderid  = mysqli_real_escape_string($db->link, $_GET['delslider']);
	if(isset($_GET['delslider'])){
			$delid = $_GET['delslider'];

			$query="SELECT *from tbl_slider where id = '".$delid."'";
			$getData = $db->select($query);
			if($getData){
						while ($delimg = $getData->fetch_assoc()) {
							$dellink = $delimg['image'];
							unlink($dellink);
						}
                    }

			$delquery="DELETE from tbl_slider where id = '".$delid."'";
			$deleteslider = $db->delete($delquery);
			if($deleteslider){
						echo "<span class='success'>Slider Deleted Successfully!</span>";
                    }else{
                        "<span class='error'>Slider not deleted...!</span>";
                    }
		}
?>


            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>		

				<tr class="odd gradeX">
				<?php
					$query = "SELECT *from tbl_slider";

					$slider = $db->select($query);
					if($slider){
						$i = 0;
						while ($result = $slider->fetch_assoc()) {
						$i++;	
				?>
					<td><?php echo $i ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" width="60px" height="40px"></td>


					<td>
						<a href="viewslider.php?viewslideid=<?php echo $result['id']?>">View</a>


<?php

 	$query = "SELECT *from tbl_user where id = '$aaa'";
	$usrlog = $db->select($query);
		if($usrlog){
			while ($rresult = $usrlog->fetch_assoc()) {
					if($rresult['role'] == '1') {?>

					|| <a href="editslider.php?sliderid=<?php echo $result['id']?>">Edit</a>
					|| <a onclick="return confirm('Are you sure to Delete'); " href="?delslider=<?php echo $result['id']?>">Delete</a>

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