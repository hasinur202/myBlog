
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

<div class="grid_10">
    <div class="box round first grid">
        <h2>Message Details</h2>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $to         = $fm->validation($_POST['toEmail']);
            $from       = $fm->validation($_POST['fromEmail']);
            $subject    = $fm->validation($_POST['subject']);
            $message    = $fm->validation($_POST['message']);

            $from       = mysqli_real_escape_string($db->link, $from);
            $subject    = mysqli_real_escape_string($db->link, $subject);
            $message    = mysqli_real_escape_string($db->link, $message);

         
            if(empty($from)){
                echo "<span class='error'>Field must not be empty! </span>";

            }elseif(!filter_var($from, FILTER_VALIDATE_EMAIL)){
                 echo "<span class='error'>Your email address invalid! </span>";

            }elseif(empty($subject)){
               echo "<span class='error'>Subject field must not be empty! </span>";

            }elseif(empty($message)){
                 echo "<span class='error'>Message field must not be empty! </span>";

            }else{
                $sendmail = mail($to, $subject, $message, $from);
                if($sendmail){
                    echo "<span class='success'>Message Send Successfully! </span>";
                }else{
                     echo "<span class='success'>Message Not Send! </span>";
                }

            }
} ?>

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
                        <label>To</label>
                    </td>
                    <td>
                        <input  type="text" readonly name="toEmail" value="<?php echo $result['email']; ?>" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>From</label>
                    </td>
                    <td>
                        <input  type="text" name="fromEmail" placeholder="Enter your email address" class="medium" />
                    </td>
                </tr>     
                <tr>
                    <td>
                        <label>Subject</label>
                    </td>
                    <td>
                        <input  type="text" name="subject" placeholder="Enter subject" class="medium" />
                    </td>
                </tr>                
                <tr> <td>
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="message"> </textarea>
                    </td>
                </tr>
                         
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Send" />
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


