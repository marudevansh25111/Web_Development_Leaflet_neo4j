
<?php
if(!empty($_POST["id"])){

    // Include the database configuration file
    
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "test";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

    
    // Count all records except already displayed
    $query = $db->query("SELECT COUNT(*) as num_rows FROM users WHERE id > ".$_POST['id']." AND type=2 ORDER BY id DESC");
    $row = $query->fetch_assoc();
    $totalRowCount = $row['num_rows'];
    
    $showLimit = 3;
    
    // Get records from the database
    $query = $db->query("SELECT * FROM users WHERE id > ".$_POST['id']." AND type=2 ORDER BY id DESC LIMIT $showLimit");
echo "
<div class='row'>
<div class='col'>
";

    if($query->num_rows > 0){ 
        while($row = $query->fetch_assoc()){
            $postID = $row['id'];
            $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
            
    ?>

<!-- 
            <div class="row">
                <div class="col-sm-9">
                    <h1 class="page-header"></h1> -->
                    <div class='box box-solid'>
                                <div class='box-body'>
                                    <div class='col-sm-3'>
                                        <img src=<?php echo $image ;?> width='100%'>
                                    </div>
                                    <div class='col-sm-9'>
                                        <div class='row'>
                                            <div class='col-sm-3'>
                                                <h4>Name:</h4>
                                                <h4>Address:</h4>
                                                <h4>Mobile no:</h4>
                                                <h4>Contact Info:</h4>
                                            </div>
                                            <div class='col-sm-9'>
                                                <?php 
                                                echo "
                                                <h4> ".$row['firstname']." ".$row['lastname']."</h4>
                                                <h4> ".$row['address']."</h4>
                                                <h4>".$row['telno']."</h4>
                                                <h4>".$row['contact_info']."</h4>
                                                ";
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <!-- </div>
            </div> -->
<?php }  
echo"</div>
</div>";
        
        ?>

<?php if($totalRowCount > $showLimit){ ?>
<div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
    <button id="<?php echo $postID; ?>" class="show_more" title="Load more posts">Show more...</button>
    <span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
</div>
<?php } ?>



<?php
    }
}
?>