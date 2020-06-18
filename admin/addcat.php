<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name = $_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);

                if(empty($name)){
                     echo "<span class='error'>Field Must not be Empty!</span>";
                }else{
                    $query = "INSERT into tbl_category(name) values ('".$name."')";
                    $catinsert = $db->insert($query);
                    if($catinsert){
                        echo "<span class='success'>Data Inserted Successfully!</span>";
                    }else{
                        "<span class='error'>Data not Inserted...!</span>";
                    }
                }
            }
        ?>

         <form action = "" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input class="medium" type="text" name="name" placeholder="Enter Category Name..."  />
                    </td>
                </tr>
    			<tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>

<?php include "inc/footer.php"; ?>