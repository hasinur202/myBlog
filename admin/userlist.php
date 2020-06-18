<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 


     $aaa = Session::get('userId');
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <div class="block"> 

<?php
	//$getdeluser  = mysqli_real_escape_string($db->link, $_GET['deluser']);
	if(isset($_GET['deluser'])){
			$deluserid = $_GET['deluser'];

			$query="DELETE from tbl_user where id = '".$deluserid."'";
			$deletecat = $db->delete($query);
			if($deletecat){
                        echo "<span class='success'>Data Deleted Successfully!</span>";
                    }else{
                        "<span class='error'>Data not deleted...!</span>";
                    }
		}else{
			"<span class='error'>Something wrong...!</span>";
		}
	?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Details</th>
					<th>Role</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

 		<?php	
 		$query = "SELECT *from tbl_user order by id desc";
				$userlist = $db->select($query);

				if($userlist){
					$i=0;
				while($result = $userlist->fetch_assoc()){
					$i++;
			?>
     
				<tr class="odd gradeX">
					<td><?php echo $i; ?> </td>
					<td><?php echo $result['name']; ?></td>
					<td><?php echo $result['username']; ?></td>
					<td><?php echo $result['email'];?></td>
					<td><?php echo $fm->textShorten($result['details'], 30); ?></td>
					<td>
						<?php
							if($result['role']==1){
								echo 'Admin';
							}elseif($result['role']==2){
								echo 'Author';
							}elseif($result['role']==3){
								echo 'Editor';
							}
						 ?>
					</td>

				<td><a href="viewuser.php?viewuserid=<?php echo $result['id']?>">View</a>  
				<?php
				    $query = "SELECT *from tbl_user where id = '$aaa'";
				    $usrlog = $db->select($query);
				        if($usrlog){
				            while ($rresult = $usrlog->fetch_assoc()) {
				                if($rresult['role'] == '1'){ ?>

				    		|| <a onclick="return confirm('Are you sure to Delete'); " href="?deluser=<?php echo $result['id']?>">Delete</a>
    				<?php } } }  ?>

    			</td>
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
