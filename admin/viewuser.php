<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

<?php
    $getuserid  = mysqli_real_escape_string($db->link, $_GET['viewuserid']);
    if(!isset($getuserid) || $getuserid == NULL){
        echo "<script>window.location = 'userlist.php'; </script>";
        
    }else{
        $id = $getuserid;

    }
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>User Details</h2>

         <div class="block"> 

<?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['submit']){
             echo "<script>window.location = 'userlist.php'; </script>";
            
            }
?>

          
<?php
    $query = "SELECT *from tbl_user WHERE id='".$id."'";
    $viewus = $db->select($query);

    if($viewus){
    while($result = $viewus->fetch_assoc()){

?>

         <form action="" method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input  type="text" readonly value="<?php echo $result['name']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input  type="text" readonly value="<?php echo $result['username']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input  type="text" readonly value="<?php echo $result['email']; ?>" class="medium" />
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
                        <input type="submit" name="submit" value="Ok" />
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


