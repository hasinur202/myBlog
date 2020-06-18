
<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

<style>
    .actiondel a{ border: 1px solid #ddd; color: #444;cursor: pointer;font-size: 20px; padding: 2px 10px;font-weight: normal; background: #f0f0f0; }
</style>

    <?php
        $idpages  = mysqli_real_escape_string($db->link, $_GET['pageid']);
        if(!isset($idpages) || $idpages == NULL){
            echo "<script>window.location = 'index.php'; </script>";
            //header("Loation: catlist.php");
        }else{
            $id = $idpages;

        }

    ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Page</h2>

         <div class="block"> 
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['submit']){
            
            $name  = mysqli_real_escape_string($db->link, $_POST['name']);
            $body    = mysqli_real_escape_string($db->link, $_POST['body']);
           

            if($name == "" || $body == ""){
                echo "<span class='error'>Field Must not be Empty! </span>";

            }else{
                $query = "UPDATE tbl_pages SET name = '$name', body = '$body' where id ='$id'";

                $inserted_row = $db->update($query);
                if ($inserted_row) {
                    echo "<span class='success'>Page Updated Successfully. </span>";
                }else {
                    echo "<span class='error'>Page Not Updated !</span>";
                }
    }
}

?>         
         <form action="" method="post"">
            <table class="form">
                <?php
                    $pagequery = "SELECT *from tbl_pages WHERE id = '$id'";
                    $pagedetails = $db->select($pagequery);

                    if($pagedetails){
                        while ($result = $pagedetails->fetch_assoc()) {
                ?>

                <tr>
                    <td>
                        <label>Page Name</label>
                    </td>
                    <td>
                        <input  type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                    </td>
                </tr>
           
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            <?php echo $result['body'];?>

                        </textarea>
                    </td>
                </tr>
        
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Update" />

                        <span class="actiondel" >
                            <a onclick="return confirm('Are you sure to Delete');" href="deletepage.php?delpage=<?php echo $result['id']?>">Delete</a>
                        </span>

                        
                    </td>
                   
                </tr>
            </table>
        <?php }}?>

            </form>
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


