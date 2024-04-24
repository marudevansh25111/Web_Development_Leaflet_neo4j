<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-yellow layout-top-nav">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>


        <div class="content-wrapper">
            <div class="container">

                <section class="content">
                    <div class="row">
                        <div class="col-sm-9">
                            <h1 class="page-header"></h1>
                            <?php include 'includes/comp.php'; ?>
                            <?php
		       			$conn = $pdo->open();
                        $uid=$user['id'];
		       			try{
                            $stmt = $conn->prepare("SELECT * FROM products RIGHT JOIN bid ON bid.product_id=products.id WHERE bid.user_id=$uid");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo1'])) ? 'images/'.$row['photo1'] : 'images/noimage.jpg';
                                if(!($row['active'])){
                                    echo "
                                <div class='box box-solid'>
                                <div class='box-body'>
                                    <div class='col-sm-3'>
                                        <img src='".$image."' width='100%'>
                                    </div>
                                    <div class='col-sm-9'>
                                        <div class='row'>
                                            <div class='col-sm-3'>
                                                <h4> Product Name:</h4>
                                                <h4>Your Bid : </h4>
                                                <h4>Status :</h4>
                                            </div>
                                            <div class='col-sm-9'>
                                                <h4> ".$row['name']."</h4>
                                                <h4> ".$row['bid_ammount']."</h4>
                                                <h4> Please wait... </h4>
                                                <h4> Bidding is ongoing </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ";
                                }
                                else{
                                    if($row['sold_id']==$uid)
                                    {
                                        echo "
                                        <div class='box box-solid'>
                                        <div class='box-body'>
                                        <h3>BID CLOSED</h3>
                                            <div class='col-sm-3'>
                                                <img src='".$image."' width='100%'>
                                            </div>
                                            <div class='col-sm-9'>
                                                <div class='row'>
                                                    <div class='col-sm-3'>
                                                        <h4> Product Name:</h4>
                                                        <h4>Your Bid : </h4>
                                                        <h4>Status :</h4>
                                                    </div>
                                                    <div class='col-sm-9'>
                                                        <h4> ".$row['name']."</h4>
                                                        <h4> ".$row['bid_ammount']."</h4>
                                                        <h4> Congratulations!! You won this bid </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                                    }
                                    else{
                                        echo "
                                        <div class='box box-solid'>
                                        <div class='box-body'>
                                        <h3>BID CLOSED</h3>
                                            <div class='col-sm-3'>
                                                <img src='".$image."' width='100%'>
                                            </div>
                                            <div class='col-sm-9'>
                                                <div class='row'>
                                                    <div class='col-sm-3'>
                                                         <h4> Product Name:</h4>
                                                        <h4>Your Bid : </h4>
                                                        <h4>Status :</h4>
                                                    </div>
                                                    <div class='col-sm-9'>
                                                        <h4> ".$row['name']."</h4>
                                                        <h4> ".$row['bid_ammount']."</h4>
                                                        <h4>This Item sold at ammount ".$row['sold_ammount']."</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                                    }
                                    
                                }
                                
                            }
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?>
                        </div>
                        <div class="col-sm-3">
                            <!-- <?php include 'includes/sidebar.php'; ?> -->
                        </div>
                    </div>
                </section>



            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>

    <?php include 'includes/scripts.php'; ?>
</body>

</html>