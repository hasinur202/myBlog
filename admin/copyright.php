<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

<div class="grid_10">
 
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock"> 
           
                <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['submit']){
                    $copyright = mysqli_real_escape_string($db->link, $_POST['copyright']);

                    if($copyright == ""){
                        echo "<span class = 'error'>Field must not be empty..!</span>";
                    }else{
                        $query = "UPDATE tbl_copyright SET cpyrightname = '$copyright'";
                        $updated_row = $db->update($query);
                        if($updated_row){
                            echo "<span class = 'success'>Data updated successfully..!</span>";
                        }else{
                            echo "<span class = 'error'>Data not updated..!</span>";
                        }
                    }
                }  ?>

        <form action="" method="post" enctype="multipart/form-data">
                <?php
                    $query = "SELECT *from tbl_copyright";
                    $copyright = $db->select($query);
                    if($copyright){
                        while ($result = $copyright->fetch_assoc()) {
                ?>
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result['cpyrightname']; ?>" name="copyright" class="large" />
                    </td>
                </tr>
				
				 <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
                <?php }}?>
        </form>
        </div>
    </div>
</div>

<?php include "inc/footer.php"; ?>