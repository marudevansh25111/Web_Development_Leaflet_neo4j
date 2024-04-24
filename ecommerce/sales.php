<?php
	include 'includes/session.php';

	if(isset($_GET['pay'])){
		$payid = $_GET['pay'];
		$date = date('Y-m-d');

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("SELECT * FROM sales order by id desc");
			$stmt->execute();
			$row = $stmt->fetch();
			// $stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date) VALUES (:user_id, :pay_id, :sales_date)");
			// $stmt->execute(['user_id'=>$user['id'], 'pay_id'=>$payid, 'sales_date'=>$date]);
			$salesid = $row['id']+1;
			
			try{
				$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				foreach($stmt as $row){
					// $curqty=$row['qty'];
					if($row['qty'] < $row['quantity'] )
					{
						$_SESSION['error'] = $row['name'].' Out of stock';
					}
					else{
						$stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity) VALUES (:sales_id, :product_id, :quantity)");
						$stmt->execute(['sales_id'=>$salesid, 'product_id'=>$row['product_id'], 'quantity'=>$row['quantity']]);

						$finalqty= $row['qty'] - $row['quantity'];
						$stmt = $conn->prepare("UPDATE products SET qty=$finalqty WHERE id=:product_id");
						$stmt->execute(['product_id'=>$row['product_id']]);

						$stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id AND product_id=:product_id");
						$stmt->execute(['product_id'=>$row['product_id'],'user_id'=>$user['id']]);
						$check=1;
					}
				}
				if($check)
				{
					$_SESSION['success'] = 'Transaction successful. Thank you.';
					$stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date) VALUES (:user_id, :pay_id, :sales_date)");
					$stmt->execute(['user_id'=>$user['id'], 'pay_id'=>$payid, 'sales_date'=>$date]);
				}
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
	
	header('location: profile.php');
	
?>