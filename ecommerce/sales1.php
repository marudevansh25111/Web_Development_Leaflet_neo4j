<?php
	include 'includes/session.php';

	if(isset($_GET['pay'])){
		$pid1 = $_GET['pay'];
		$date = date('Y-m-d');
		$conn = $pdo->open();

		try{

			try{
				$stmt = $conn->prepare("SELECT * FROM wishlist LEFT JOIN products ON products.id=wishlist.product_id WHERE user_id=:user_id  AND product_id=:p_id");
				$stmt->execute(['user_id'=>$user['id'],'p_id'=>$pid1]);

				//  foreach($stmt as $row){
					
				//  }
				$stmt =$conn->prepare("INSERT INTO cart (user_id,product_id,quantity) VALUES (:user_id, :p_id, :quantity)");
				$stmt->execute(['user_id'=>$user['id'], 'p_id'=>$pid1, 'quantity'=>1]);
				
				$stmt = $conn->prepare("DELETE FROM wishlist WHERE user_id=:user_id AND product_id=:p_id ");
				$stmt->execute(['user_id'=>$user['id'],'p_id'=>$pid1]);

				$_SESSION['success'] = 'Inserted successfully in cart ';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	
	  header('location: wishlist_view.php');
	
?>