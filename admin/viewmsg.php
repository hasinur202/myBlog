
<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

<?php
        $getmsgid  = mysqli_real_escape_string($db->link, $_GET['msgid']);
        if(!isset($getmsgid) && $getmsgid == 'NULL'){
            echo "<script>window.location = 'inbox.php'; </script>";
        }else{
            $id = $getmsgid;
        }

    ?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<script>window.location = 'inbox.php'; </script>";
} ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Message Details</h2>
         <div class="block"> 


    
         <form action="" method="post"">

                <?php
                    $query = "SELECT *from tbl_contact where id='$id'" ;
                    $getmsg = $db->select($query);
                    if($getmsg){
                        while($result = $getmsg->fetch_assoc()){     
                    ?>

            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input  type="text" readonly value="<?php echo $result['firstname'].' '.$result['lastname'];?>" class="medium" />
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
                        <label>Date</label>
                    </td>
                    <td>
                        <input  type="text" readonly value="<?php echo $result['date']; ?>" class="medium" />
                    </td>
                </tr>                
                <tr> <td>
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body" >
                            <?php echo $result['body']; ?>
                        </textarea>
                    </td>
                </tr>
                         
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="OK" />
                    </td>
                </tr>
            </table>
        <?php } } ?>
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


