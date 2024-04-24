<?php
	include 'includes/session.php';
        $pid=$_POST['pid'];
        $sid=$_POST['sid'];
        $bamm=$_POST['number'];
        $uid=$user['id'];
		$conn = $pdo->open();
			try{
                $stmt =$conn->prepare("INSERT INTO bid (product_id,seller_id,user_id,bid_ammount,active,sold_id,sold_ammount) VALUES (:p_id, :s_id,:u_id,:ba,:act,:sold_id,:sold_ammount)");
                $stmt->execute(['p_id'=>$pid, 's_id'=>$sid,'u_id'=>$uid, 'ba'=>$bamm ,'act'=>0,'sold_id'=>0,'sold_ammount'=>0]);
				$_SESSION['success'] = 'SUCESSFULLY ENTERED IN BID ';
            }
            catch(PDOException $e){
                echo "There is some problem in connection: " . $e->getMessage();
            }
		$pdo->close();
	header('location: result.php');	
?>
























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
                    $pid=$_POST['pid'];
                    $sid=$_POST['sid'];
                    $bamm=$_POST['number'];
                    $uid=$user['id'];
		       			
		       			$conn = $pdo->open();

		       			try{
                            $stmt =$conn->prepare("INSERT INTO bid (product_id,seller_id,user_id,bid_ammount,active) VALUES (:p_id, :s_id,:u_id,:ba,:act)");
                            $stmt->execute(['p_id'=>$pid, 's_id'=>$sid,'u_id'=>$uid, 'ba'=>$bamm ,'act'=>0]);
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
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php';?>
</body>
</html>