
<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 
?>

    <?php
    $pageid  = mysqli_real_escape_string($db->link, $_GET['delpage']);
    if(isset($pageid)){
            $pagdelid = $pageid;
            $query="DELETE from tbl_pages where id = '".$pagdelid."'";
            $deletepage = $db->delete($query);
            if($deletepage){
                        echo "<script>alert('Page Deleted Successfully!');</script> ";
                        echo "<script>window.location = 'index.php'; </script>";
                        
                    }else{
                        echo "<script>alert('Page Not Deleted!');</script> ";
                        echo "<script>window.location = 'index.php'; </script>";
                    }
        }
?>


