<?php
    include "inc/header.php";
    include "inc/sidebar.php"; 


     $aaa = Session::get('userId');
?>

<?php
    $query = "SELECT *from tbl_user where id = '$aaa'";
    $usrlog = $db->select($query);
        if($usrlog){
            while ($result = $usrlog->fetch_assoc()) {
                if($result['role'] !== '1'){ 
                    echo "<script>window.location = 'index.php'; </script>";
    } } }  ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock"> 

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $username   = $fm->validation($_POST['username']);
                $password   = $fm->validation(md5($_POST['password']));
                $email       = $fm->validation($_POST['email']);
                $role       = $fm->validation($_POST['role']);

                $username   = mysqli_real_escape_string($db->link, $username);
                $password   = mysqli_real_escape_string($db->link, $password);
                $email       = mysqli_real_escape_string($db->link, $email);
                $role       = mysqli_real_escape_string($db->link, $role);

                if(empty($username) || empty($password) || empty($role) || empty($email)){
                     echo "<span class='error'>Field Must not be Empty!</span>";
               }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){

                     echo "<span class='error'>Invalid Email Address!</span>";
                    
                }else{

                    $emailquery = "SELECT *from tbl_user where email ='$email' limit 1";
                    $checkemail = $db->select($emailquery);
                    if($checkemail != false){
                        echo "<span class='error'>Email Address Already Exist!</span>";
                    }else{


                    $query = "INSERT into tbl_user(username, password, email, role) values ('".$username."', '".$password."', '".$email."', '".$role."')";

                        $useradd = $db->insert($query);
                        if($useradd){
                            echo "<span class='success'>User created Successfully!</span>";
                        }else{
                            "<span class='error'>User not created...!</span>";
                    }
                }
            } }
        ?>

         <form action = "" method="post">
            <table class="form">					
                <tr>
                    <td> <label>Username</label> </td>
                    <td>
                        <input class="medium" type="text" name="username" placeholder="Enter username" />
                    </td>
                </tr>
                <tr>
                    <td> <label>Email</label> </td>
                    <td>
                        <input class="medium" type="text" name="email" placeholder="Enter valid email address" />
                    </td>
                </tr>
                <tr>
                    <td> <label>User Password</label> </td>
                    <td>
                        <input class="medium" type="password" name="password" placeholder="Enter user password"/>
                    </td>
                </tr>
                <tr>
                    <td> <label>User Role</label> </td>
                    <td>
                        <select id="select" name="role">
                            <option>Select user role</option>
                            <option value="1">Admin</option>
                            <option value="2">Author</option>
                            <option value="3">Editor</option>
                        </select>
                    </td>
                </tr>

    			<tr> 
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Create" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>

<?php include "inc/footer.php"; ?>