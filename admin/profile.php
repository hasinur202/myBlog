<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

<?php
   $userid = Session::get('userId'); 
     
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>User profile</h2>

         <div class="block"> 
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['submit']){
            $name       = mysqli_real_escape_string($db->link, $_POST['name']);
            $username   = mysqli_real_escape_string($db->link, $_POST['username']);
            $email      = mysqli_real_escape_string($db->link, $_POST['email']);
            $details    = mysqli_real_escape_string($db->link, $_POST['details']);
           

        $query = "UPDATE tbl_user
                SET
                name     = '$name',
                username = '$username',
                email    = '$email',
                details  = '$details'
                
                WHERE id = '$userid'";

                $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span class='success'>Data Updated Successfully. </span>";
                }else {
                    echo "<span class='error'>Data Not Updated !</span>";
                }
            }
?>

          
<?php
    $query = "SELECT *from tbl_user WHERE id='".$userid."'";
    $post = $db->select($query);

    if($post){
    while($result = $post->fetch_assoc()){

?>

         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input  type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input  type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input  type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" />
                    </td>
                </tr>             
                <tr>
                    <td>
                        <label>Details</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="details">
                            <?php echo $result['details']; ?>
                        </textarea>
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
        <?php } } ?>
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


