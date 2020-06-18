<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>


<?php
    $getviewid  = mysqli_real_escape_string($db->link, $_GET['viewpostid']);
    if(!isset($getviewid) || $getviewid == NULL){
        echo "<script>window.location = 'postlist.php'; </script>";
        
    }else{
        $postid = $getviewid;

    }
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Post</h2>

         <div class="block"> 

<?php
       if ($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['submit']){
           echo "<script>window.location = 'postlist.php'; </script>";
    }

?>

          
<?php
    $query = "SELECT *from tbl_post where id='$postid' ORDER BY id desc";
    $post = $db->select($query);
    while($result = $post->fetch_assoc()){

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
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" readonly>

                            <?php
                                $sql = "SELECT *from tbl_category";
                                $category = $db->select($sql);
                                if($category){
                                    while($catresult = $category->fetch_assoc()){ ?>
                                        <option 
                                            <?php
                                            if ($catresult['id'] == $result['cat']) { ?>

                                                selected = "selected"
                                           <?php } ?>
                                        value="<?php echo $catresult['id'];?>"><?php echo $catresult['name'];?>
                                         </option>
                               <?php } } ?>
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Image</label>
                    </td>
                    
                    <td>
                        <img src="<?php echo $result['image']; ?>" width="200px" height="140px"><br/>
                        
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" readonly>
                            <?php echo $result['body']; ?>
                                
                            </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Author</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $result['author']; ?>" class="medium" />
                       
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Tags</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $result['tags']; ?>" class="medium" />
                    </td>
                </tr>
                <!-- <tr>
                    <td>
                        <label>Date</label>
                    </td>
                    <td>
                        <input type="date" class="medium" />
                    </td>
                </tr> -->
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


