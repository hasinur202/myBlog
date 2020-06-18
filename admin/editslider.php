<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>


    <?php
        $idslider  = mysqli_real_escape_string($db->link, $_GET['sliderid']);
        if(!isset($idslider) || $idslider == NULL){
            echo "<script>window.location = 'sliderlist.php'; </script>";
            
        }else{
            $sliderid = $idslider;
        }

    ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Slider</h2>

         <div class="block"> 
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['submit']){
            $title  = mysqli_real_escape_string($db->link, $_POST['title']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;

            $uploaded_image = "upload/slider/".$unique_image; //path


            if($title == ""){
                echo "<span class='error'>Field Must not be Empty! </span>";

            }else{

            if (!empty($file_name)) {

            if ($file_size >1048567) {
                echo "<span class='error'>Image Size should be less then 1MB! </span>";

            } elseif (in_array($file_ext, $permited) === false) {
                echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
            } else{

                $query="SELECT *from tbl_slider where id = '".$sliderid."'";
                $getData = $db->select($query);
                if($getData){
                        while ($delimg = $getData->fetch_assoc()) {
                            $dellink = $delimg['image'];
                            unlink($dellink);
                        }
                    }

                move_uploaded_file($file_temp, $uploaded_image);

                $query = "UPDATE tbl_slider
                SET
                title   = '$title',
                image   = '$uploaded_image'
                WHERE id = '$sliderid'";

                $updated_row = $db->update($query);
                if ($updated_row) {

                    echo "<span class='success'>Slider Updated Successfully. </span>";
                }else {
                    echo "<span class='error'>Slider Not Updated !</span>";
                }
    }
    }else{

        $query = "UPDATE tbl_slider
                SET
                title   = '$title'
                WHERE id = '$sliderid'";

                $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span class='success'>Slider Updated Successfully. </span>";
                }else {
                    echo "<span class='error'>Slider Not Updated !</span>";
                }
            }
        }
    }

?>

          
<?php
    $query = "SELECT *from tbl_slider where id='$sliderid'";
    $sliders = $db->select($query);
    while($result = $sliders->fetch_assoc()){

?>

         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input  type="text" name="title" value="<?php echo $result['title']; ?>" class="medium" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    
                    <td>
                        <img src="<?php echo $result['image']; ?>" width="560px" height="200px"><br/>
                        <input  type="file" name="image"/>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php } ?>
        </div>
    </div>
</div>

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
   <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>

<?php include "inc/footer.php"; ?>


