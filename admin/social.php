<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">
         <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['submit']){

            $fb         = $fm->validation($_POST['facebook']);
            $google     = $fm->validation($_POST['googleplus']);
            $twitter    = $fm->validation($_POST['twitter']);
            $youtube    = $fm->validation($_POST['youtube']);


            $fb         = mysqli_real_escape_string($db->link, $fb);
            $google     = mysqli_real_escape_string($db->link, $google);
            $twitter    = mysqli_real_escape_string($db->link, $twitter);
            $youtube    = mysqli_real_escape_string($db->link, $youtube);


            if($fb == "" || $google == "" || $twitter == "" || $youtube == ""){
                echo "<span class='error'>Field Must not be Empty! </span>";
            }else{

                $query = "UPDATE tbl_sociallink SET fb = '$fb', google = '$google', twitter = '$twitter', youtube = '$youtube'";

                $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span class='success'>Data Updated Successfully. </span>";
                }else {
                    echo "<span class='error'>Data Not Updated !</span>";
                }

            }

        } ?>


         <form action="" method="post" enctype="multipart/form-data">
            <?php
            $query = "SELECT *from tbl_sociallink";
            $social = $db->select($query);
            if($social){
                while ($result = $social->fetch_assoc()) {

        ?>

            <table class="form">					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="facebook" value="<?php echo $result['fb'];?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>GooglePlus</label>
                    </td>
                    <td>
                        <input type="text" name="googleplus" value="<?php echo $result['google'];?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="twitter" value="<?php echo $result['twitter'];?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Youtube </label>
                    </td>
                    <td>
                        <input type="text" name="youtube" value="<?php echo $result['youtube'];?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td></td>
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