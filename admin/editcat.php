<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

	<?php
        $idcate  = mysqli_real_escape_string($db->link, $_GET['catid']);
		if(!isset($idcate) || $idcate == NULL){
			echo "<script>window.location = 'catlist.php'; </script>";
			//header("Loation: catlist.php");
		}else{
			$id = $idcate;

		}

	?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock"> 

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name = $_POST['name'];
               
                $name = mysqli_real_escape_string($db->link, $name);

                if(empty($name)){
                     echo "<span class='error'>Field Must not be Empty!</span>";
                }else{
                    $query = "UPDATE tbl_category SET name = '".$name."' WHERE id = '".$id."' ";
                    $catupdate = $db->update($query);
                    if($catupdate){
                        echo "<span class='success'>Data Updated Successfully!</span>";
                    }else{
                        "<span class='error'>Data not Updated...!</span>";
                    }
                }
            }
        ?>


<?php
	$query = "SELECT *from tbl_category where id = '".$id."' order by id desc";
	$category = $db->select($query);
	while($result = $category->fetch_assoc()){

?>
         <form action = "" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input class="medium" type="text" name="name" value="<?php echo $result['name']; ?>"  />
                    </td>
                </tr>
    			<tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php }?>
        </div>
    </div>
</div>

<?php include "inc/footer.php"; ?>