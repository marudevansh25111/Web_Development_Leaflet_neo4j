<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['signup'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		$telno=$_POST['telno'];

		$_SESSION['\
		
		\
		'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;
		if($_POST['sell']==3)
		{
			$type=2;
		}
		else{
			$type=0;
		}   

		if($password != $repassword){
			$_SESSION['error'] = 'Passwords did not match';
			header('location: signup.php');
		}
		else{
			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'Email already taken';
				header('location: signup.php');
			}
			else{
				$now = date('Y-m-d');
				$password = password_hash($password, PASSWORD_DEFAULT);

				//generate code
				$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code=substr(str_shuffle($set), 0, 12);

				try{
					$stmt = $conn->prepare("INSERT INTO users (email, password,type, firstname, lastname, status , activate_code, created_on,telno) VALUES (:email, :password,:type,:firstname, :lastname, 1 , :code, :now,:telno)");
					$stmt->execute(['email'=>$email, 'password'=>$password ,'type'=>$type , 'firstname'=>$firstname, 'lastname'=>$lastname, 'code'=>$code, 'now'=>$now ,'telno'=>$telno]);
					$userid = $conn->lastInsertId();

					$message = "
						<h2>Thank you for Registering.</h2>
						<p>Your Account:</p>
						<p>Email: ".$email."</p>
						<p>Password: ".$_POST['password']."</p>
						<p>Please click the link below to activate your account.</p>
						<a href='http://localhost/ecommerce/activate.php?code=".$code."&user=".$userid."'>Activate Account</a>
					";

					//Load phpmailer
		    		require 'vendor/autoload.php';

		    		$mail = new PHPMailer(true);                             
				    // try {
				    //     //Server settings
				    //     $mail->isSMTP();                                     
				    //     $mail->Host = 'smtp.gmail.com';                      
				    //     $mail->SMTPAuth = true;                               
				    //     $mail->Username = 'testsourcecodester@gmail.com';     
				    //     $mail->Password = 'mysourcepass';                    
				    //     $mail->SMTPOptions = array(
				    //         'ssl' => array(
				    //         'verify_peer' => false,
				    //         'verify_peer_name' => false,
				    //         'allow_self_signed' => true
				    //         )
				    //     );                         
				    //     $mail->SMTPSecure = 'ssl';                           
				    //     $mail->Port = 465;                                   

				    //     $mail->setFrom('testsourcecodester@gmail.com');
				        
				    //     //Recipients
				    //     $mail->addAddress($email);              
				    //     $mail->addReplyTo('testsourcecodester@gmail.com');
				       
				    //     //Content
				    //     $mail->isHTML(true);                                  
				    //     $mail->Subject = 'ECommerce Site Sign Up';
				    //     $mail->Body    = $message;

				    //     $mail->send();

				    //     unset($_SESSION['firstname']);
				    //     unset($_SESSION['lastname']);
				    //     unset($_SESSION['email']);

				    //     $_SESSION['success'] = 'Account created. Check your email to activate.';
				    //     header('location: signup.php');

				    // } 
				    // catch (Exception $e) {
				    //     $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				    //     header('location: signup.php');
				    // }
					header('location: login.php');

				}
				catch(PDOException $e){
					$_SESSION['error'] = $e->getMessage();
					header('location: login.php');
				}

				$pdo->close();

			}

		}

	}
	else{
		$_SESSION['error'] = 'Fill up signup form first';
		header('location: signup.php');
	}

?>