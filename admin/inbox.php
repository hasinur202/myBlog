<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>

        <?php
        	 //$idsend  = mysqli_real_escape_string($db->link, $_GET['seenid']);
        	if(isset($_GET['seenid'])){
        		$senid = $_GET['seenid'];

        		$query = "UPDATE tbl_contact SET status = '1' where id = '$senid'";
        		$updated_row = $db->update($query);
        		
                if($updated_row){
                        echo "<span class='success'>Message sent to the seen box!</span>";
                    }else{
                        "<span class='error'>Something wrong!</span>";
                    }
        	}
        ?>

        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "SELECT *from tbl_contact where status = '0' order by id desc";
					$mssg = $db->select($query);

					if($mssg){
						$i=0;
					while($result = $mssg->fetch_assoc()){
						$i++;

					?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?> </td>
					<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
					<td><?php echo $result['email']; ?> </td>
					<td><?php echo $fm->textShorten($result['body'], 30); ?></td>
					<td><?php echo $fm->formateDate($result['date']); ?></td>

					<td>
						<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> 
						|| <a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a>		
						|| <a onclick="return confirm('Are you sure to move the message');" href="?seenid=<?php echo $result['id']?>">Seen</a>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>


  <div class="box round first grid">
        <h2>Seen Message</h2>
	<?php
        	if(isset($_GET['deleteid'])){
        		$deleteid = $_GET['deleteid'];

        		$query = "DELETE from tbl_contact where id = '$deleteid'";
        		$deleted_row = $db->delete($query);
        		
                if($deleted_row){
                        echo "<span class='success'>Message deleted successfully!</span>";
                    }else{
                        "<span class='error'>Something wrong!</span>";
                    }
        	}
        ?>

        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "SELECT *from tbl_contact where status = '1' order by id desc";
					$mssg = $db->select($query);

					if($mssg){
						$i=0;
					while($result = $mssg->fetch_assoc()){
						$i++;

					?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?> </td>
					<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
					<td><?php echo $result['email']; ?> </td>
					<td><?php echo $fm->textShorten($result['body'], 30); ?></td>
					<td><?php echo $fm->formateDate($result['date']); ?></td>

					<td>
						<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> 
						|| 
						<a onclick="return confirm('Are you sure to Delete');" href="?deleteid=<?php echo $result['id']?>">Delete</a>
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