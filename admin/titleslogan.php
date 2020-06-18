<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

    <style>
        .leftside{float: left; width: 80%;  }
        .rightside{float: right; width: 20%; }
        .rightside img{ height: 180px; width: 180px; }
    </style>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock"> 
 
       <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['submit']){

            $webtitle = $fm->validation($_POST['webtitle']);
            $description = $fm->validation($_POST['description']);

            $webtitle  = mysqli_real_escape_string($db->link, $webtitle);
            $description    = mysqli_real_escape_string($db->link, $description);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $same_image = 'logo'.'.'.$file_ext;
            $uploaded_image = "upload/".$same_image;


            if($webtitle == "" || $description == ""){
                echo "<span class='error'>Field Must not be Empty! </span>";
            }else{
                if (!empty($file_name)) {

                if ($file_size >1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB! </span>";

                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                } else{

                move_uploaded_file($file_temp, $uploaded_image);

                $query = "UPDATE tbl_webtitle SET webtitle = '$webtitle', description='$description', image   = '$uploaded_image'";
                $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span class='success'>Data Updated Successfully. </span>";
                }else {
                    echo "<span class='error'>Data Not Updated !</span>";
                    }
                }
            
            }else{
                $query = "UPDATE tbl_webtitle SET webtitle = '$webtitle', description='$description'";
                $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span class='success'>Data Updated Successfully. </span>";
                }else {
                    echo "<span class='error'>Data Not Updated !</span>";
                }
             }
        }
 } ?>
        
        <div class="leftside">


         <form action="" method="post" enctype="multipart/form-data">

           <?php
                $query = "SELECT *from tbl_webtitle";
                $webttl = $db->select($query);
                if($webttl){
                    while ($result = $webttl->fetch_assoc()){
            ?>

             <table class="form">					
                <tr>
                    <td>
                        <label>Website Title</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['webtitle'];?>"  name="webtitle" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Website Slogan</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['description'];?>" name="description" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Upload Logo</label>
                    </td>
                    
                    <td>
                        <input  type="file" name="image"/>
                    </td>
                </tr>
				 
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>

           
            </form>
            </div>
            <div class="rightside">
                    <img src="<?php echo $result['image']; ?>"><br/>
            </div>
 <?php } }?>

        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>