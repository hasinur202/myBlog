
<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Page</h2>

         <div class="block"> 
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['submit']){
            $name  = mysqli_real_escape_string($db->link, $_POST['name']);
            $body    = mysqli_real_escape_string($db->link, $_POST['body']);
           

            if($name == "" || $body == ""){
                echo "<span class='error'>Field Must not be Empty! </span>";

            }else{
                $query = "INSERT INTO tbl_pages(name, body) VALUES('$name', '$body')";

                $inserted_row = $db->insert($query);
                if ($inserted_row) {
                    echo "<span class='success'>Page Created Successfully. </span>";
                }else {
                    echo "<span class='error'>Page Not Created !</span>";
                }
    }
}

?>         
         <form action="" method="post"">
            <table class="form">
                <tr>
                    <td>
                        <label>Page Name</label>
                    </td>
                    <td>
                        <input  type="text" name="name" placeholder="Enter Page name..." class="medium" />
                    </td>
                </tr>
           
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body" ></textarea>
                    </td>
                </tr>
        
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Create" />
                    </td>
                </tr>
            </table>
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


