<?php
	include 'includes/session.php';

	$conn = $pdo->open();

	$output = array('error'=>false);

	$id = $_POST['id'];
	$qty = $_POST['qty'];

	if(isset($_SESSION['user'])){
		try{
			$stmt = $conn->prepare("UPDATE wishlist SET quantity=:quantity WHERE id=:id");
			$stmt->execute(['quantity'=>$qty, 'id'=>$id]);
			$output['message'] = 'Updated';
		}
		catch(PDOException $e){
			$output['message'] = $e->getMessage();
		}
	}
	else{
		foreach($_SESSION['wishlist'] as $key => $row){
			if($row['productid'] == $id){
				$_SESSION['wishlist'][$key]['quantity'] = $qty;
				$output['message'] = 'Updated';
			}
		}
	}

	$pdo->close();
	echo json_encode($output);

?>