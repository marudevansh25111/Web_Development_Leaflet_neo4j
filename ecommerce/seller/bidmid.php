<?php include 'includes/session.php'; ?>

<?php
  $where = '';
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'WHERE category_id ='.$catid;
  }

?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <!-- <?php echo $seller['id'];?> -->
                    Bid Request for product
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Bid Result</li>
                    <li class="active">Product</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        <h1 class="page-header"></h1>
                        <?php
		       			$pid=$_GET['pid'];
		       			$conn = $pdo->open();

		       			try{
						    $stmt = $conn->prepare("SELECT * FROM products where id=$pid");
						    $stmt->execute();
                            foreach ($stmt as $row) {
						    	$image = (!empty($row['photo1'])) ? '../images/'.$row['photo1'] : '../images/noimage.jpg';
                                echo "
                                <div class='box box-solid'>
                                <div class='box-body'>
                                    <div class='col-sm-3'>
                                        <img src='".$image."' width='100%'>
                                    </div>
                                    <div class='col-sm-9'>
                                        <div class='row'>
                                            <div class='col-sm-3'>
                                                <h4>Product name:</h4>
                                                <h4>Expected Ammount:</h4>
                                                <h4>Description</h4>
                                            </div>
                                            <div class='col-sm-9'>
                                                <h4>".$row['name']."</h4>
                                                <h4>".$row['price']."</h4>
                                                <h4>".$row['description']."</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                ";
						}
                    }
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        <h1 class="page-header"></h1>
                        <?php
		       			$pid=$_GET['pid'];
		       			$conn = $pdo->open();

		       			try{
						    $stmt = $conn->prepare("SELECT * FROM products JOIN bid ON products.id=$pid AND bid.product_id=$pid JOIN users ON bid.user_id=users.id ORDER BY bid_ammount DESC;");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                                echo "
                                <div class='box box-solid'>
                                <div class='box-body'>
                                    <div class='col-sm-3'>
                                        <img src='".$image."' width='30%'>
                                    </div>
                                    <div class='col-sm-9'>
                                        <div class='row'>
                                            <div class='col-sm-3'>
                                                <h4>User name:</h4>
                                                <h4>Bid Amount:</h4>
                                                <h4>Email:</h4>
                                            </div>
                                            <div class='col-sm-3'>
                                                <h4>".$row['firstname']." ".$row['lastname']."</h4>
                                                <h4>".$row['bid_ammount']."</h4>
                                                <h4>".$row['email']."</h4>
                                            </div>
                                            <div class=' col-sm-3'>
                                                <form method='POST' action='mid.php'>
                                                    <input type='hidden' value='".$row['product_id']."' name='pid'>
                                                    <input type='hidden' value='".$row['user_id']."' name='uid'>
                                                    <input type='hidden' value='".$row['bid_ammount']."' name='bamm'>
                                                    <button class='btn btn-info btn-sm btn-flat ' >SOLD TO THIS</button>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                                ";
						    }
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?>
                    </div>
                </div>
            </section>
        </div>
        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/scripts.php'; ?>
    </div>

</body>

</html>