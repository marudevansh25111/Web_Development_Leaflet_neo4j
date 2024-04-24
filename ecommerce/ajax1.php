
<?php
if(!empty($_POST["id"])){
$cat=$_POST["cat"];
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
    $query = $db->query("SELECT COUNT(*) as num_rows FROM products WHERE id < ".$_POST['id']." AND category_id =$cat   ORDER BY id DESC");
    $row = $query->fetch_assoc();
    $totalRowCount = $row['num_rows'];
    
    $showLimit = 3;
    
    // Get records from the database
    $query = $db->query("SELECT * FROM products WHERE id < ".$_POST['id']." AND category_id =$cat ORDER BY id DESC LIMIT $showLimit");
echo "
<div class='row'>
<div class='col'>
";

    if($query->num_rows > 0){ 
        while($row = $query->fetch_assoc()){
            $postID = $row['id'];
            $image = (!empty($row['photo1'])) ? 'images/'.$row['photo1'] : 'images/noimage.jpg';
            
    ?>

<!-- 
            <div class="row">
                <div class="col-sm-9">
                    <h1 class="page-header"></h1> -->
                    <div class='col-sm-4'>
                        <div class='box box-solid'>
                            <div class='box-body prod-body'>
                                
                            <a href='product.php?product=<?php echo $row['slug']; ?>'> <img src='<?php echo $image; ?>' width='100%' height='230px' class='thumbnail'></a>
                                
                                <h5><a href='product.php?product=<?php echo $row['slug']; ?>'>
                                        <?php echo $row['name']; ?>
                                    </a></h5>
                            </div>
                            <div class='box-footer'>
                                <b>&#8377;
                                    <?php echo number_format($row['price'], 2); ?>
                                </b>
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