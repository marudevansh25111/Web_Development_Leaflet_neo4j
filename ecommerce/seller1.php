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

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM users WHERE type=2 LIMIT 2");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
                                echo "
                                <div class='box box-solid'>
                                <div class='box-body'>
                                    <div class='col-sm-3'>
                                        <img src='".$image."' width='100%'>
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
                                                <h4> ".$row['firstname']." ".$row['lastname']."</h4>
                                                <h4> ".$row['address']."</h4>
                                                <h4>".$row['telno']."</h4>
                                                <h4>".$row['contact_info']."</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                ";
	       						if($inc == 3) echo "</div>";
						    }
							$postID=$row['id'];
							?>
							<?php include 'includes/loadmore2.php'; ?>
							<?php
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
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