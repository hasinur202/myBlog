<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>


<?php
    $getsliderid  = mysqli_real_escape_string($db->link, $_GET['viewslideid']);
    if(!isset($getsliderid) || $getsliderid == NULL){
        echo "<script>window.location = 'postlist.php'; </script>";
        
    }else{
        $slideid = $getsliderid;

    }
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>View Slider</h2>

         <div class="block"> 

<?php
       if ($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['submit']){
           echo "<script>window.location = 'sliderlist.php'; </script>";
    }

?>

          
<?php
    $query = "SELECT *from tbl_slider where id='$slideid'";
    $slider = $db->select($query);
    while($result = $slider->fetch_assoc()){

?>

         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input  type="text" readonly value="<?php echo $result['title']; ?>" class="medium" />
                    </td>
                </tr>
                                
                <tr>
                    <td>
                        <label>Image</label>
                    </td>
                    
                    <td>
                        <img src="<?php echo $result['image']; ?>" width="615px" height="200px"><br/>
                        
                    </td>
                </tr>
                
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Ok" />
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


