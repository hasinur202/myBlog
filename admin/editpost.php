<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>


    <?php
        $idpost  = mysqli_real_escape_string($db->link, $_GET['editpostid']);
        if(!isset($idpost) || $idpost == NULL){
            echo "<script>window.location = 'postlist.php'; </script>";
            
        }else{
            $postid = $idpost;
        }

    ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Post</h2>

         <div class="block"> 
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['submit']){
            $title  = mysqli_real_escape_string($db->link, $_POST['title']);
            $cat    = mysqli_real_escape_string($db->link, $_POST['cat']);
            $body   = mysqli_real_escape_string($db->link, $_POST['body']);
            $author = mysqli_real_escape_string($db->link, $_POST['author']);
            $tags   = mysqli_real_escape_string($db->link, $_POST['tags']);
            $userid   = mysqli_real_escape_string($db->link, $_POST['userid']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;

            $uploaded_image = "upload/".$unique_image; //path


            if($title == "" || $cat == "" || $body == "" || $author == "" || $tags == "" || $userid == ""){
                echo "<span class='error'>Field Must not be Empty! </span>";

            }else{

            if (!empty($file_name)) {

            if ($file_size >1048567) {
                echo "<span class='error'>Image Size should be less then 1MB! </span>";

            } elseif (in_array($file_ext, $permited) === false) {
                echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
            } else{

                $query="SELECT *from tbl_post where id = '".$postid."'";
                $getData = $db->select($query);
                if($getData){
                        while ($delimg = $getData->fetch_assoc()) {
                            $dellink = $delimg['image'];
                            unlink($dellink);
                        }
                    }

                move_uploaded_file($file_temp, $uploaded_image);

                $query = "UPDATE tbl_post
                SET
                cat     = '$cat',
                title   = '$title',
                body    = '$body',
                image   = '$uploaded_image',
                author  = '$author',
                tags    = '$tags',
                userid  = '$userid'
                WHERE id = '$postid'";

                $updated_row = $db->update($query);
                if ($updated_row) {



                    echo "<span class='success'>Data Updated Successfully. </span>";
                }else {
                    echo "<span class='error'>Data Not Updated !</span>";
                }
    }
    }else{

        $query = "UPDATE tbl_post
                SET
                cat     = '$cat',
                title   = '$title',
                body    = '$body',
                author  = '$author',
                tags    = '$tags',
                userid  = '$userid'
                WHERE id = '$postid'";

                $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span class='success'>Data Updated Successfully. </span>";
                }else {
                    echo "<span class='error'>Data Not Updated !</span>";
                }
            }
        }
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
                        <input  type="text" name="title" value="<?php echo $result['title']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="cat">

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
                        <label>Upload Image</label>
                    </td>
                    
                    <td>
                        <img src="<?php echo $result['image']; ?>" width="120px" height="80px"><br/>
                        <input  type="file" name="image"/>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            <?php echo $result['body']; ?>
                                
                            </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Author</label>
                    </td>
                    <td>
                        <input type="text" name="author" value="<?php echo $result['author']; ?>" class="medium" />
                        <input type="hidden" name="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Tags</label>
                    </td>
                    <td>
                        <input type="text" name="tags" value="<?php echo $result['tags']; ?>" class="medium" />
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


