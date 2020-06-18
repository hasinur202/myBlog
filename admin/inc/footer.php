    <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">

    <?php
        $query = "SELECT *from tbl_copyright";
        $copyright = $db->select($query);
        if($copyright){
            while ($result = $copyright->fetch_assoc()) {
    ?>
    <p>
        &copy; Copyright <a href="#"><?php echo $result['cpyrightname']; ?></a>. All Rights Reserved.
    </p>
<?php }}?>

    </div>
</body>
</html>
