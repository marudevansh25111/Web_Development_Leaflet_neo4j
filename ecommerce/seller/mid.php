<?php
	include 'includes/session.php';
		$pid = $_POST['pid'];
        $uid = $_POST['uid'];
        $bamm= $_POST['bamm'];
		$conn = $pdo->open();

		try{

			try{
				$stmt = $conn->prepare("UPDATE bid SET active=1,sold_id=$uid,sold_ammount=$bamm WHERE product_id=$pid");
				$stmt->execute();
				$_SESSION['success'] = 'Sold item to USER ID '.$uid;

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	  header('location:products.php');
	
?>