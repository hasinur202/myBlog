<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <div class="block"> 

<?php
	//$deleteid  = mysqli_real_escape_string($db->link, $_GET['delid']);
	if(isset($_GET['delid'])){
			$delid = $_GET['delid'];

			$query="DELETE from tbl_category where id = '".$delid."'";
			$deletecat = $db->delete($query);
			if($deletecat){
                        echo "<span class='success'>Data Deleted Successfully!</span>";
                    }else{
                        "<span class='error'>Data not deleted...!</span>";
                    }
		}
	?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
 		<?php	
 		$query = "SELECT *from tbl_category order by id desc";
				$category = $db->select($query);

				if($category){
					$i=0;
				while($result = $category->fetch_assoc()){
					$i++;
			?>
     
				<tr class="odd gradeX">
					<td><?php echo $i; ?> </td>
					<td><?php echo $result['name']; ?></td>
					<td><a href="editcat.php?catid=<?php echo $result['id']?>">Edit</a>
					|| <a onclick="return confirm('Are you sure to Delete'); " href="?delid=<?php echo $result['id']?>">Delete</a></td>
				</tr>
				<?php }}?>
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
