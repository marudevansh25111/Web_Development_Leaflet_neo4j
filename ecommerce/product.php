<?php include 'includes/session.php'; ?>
<?php
	$conn = $pdo->open();

	$slug = $_GET['product'];

	try{
		 		
	    $stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id WHERE slug = :slug");
	    $stmt->execute(['slug' => $slug]);
	    $product = $stmt->fetch();
		
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	//page view
	$now = date('Y-m-d');
	if($product['date_view'] == $now){
		$stmt = $conn->prepare("UPDATE products SET counter=counter+1 WHERE id=:id");
		$stmt->execute(['id'=>$product['prodid']]);
	}
	else{
		$stmt = $conn->prepare("UPDATE products SET counter=1, date_view=:now WHERE id=:id");
		$stmt->execute(['id'=>$product['prodid'], 'now'=>$now]);
	}
?>
<?php include 'includes/header.php'; ?>

<head>
	<link rel="stylesheet" href="dist/css/slide.css">
</head>

<body class="hold-transition skin-yellow layout-top-nav">
	<div class="wrapper">

		<?php include 'includes/navbar.php'; ?>

		<div class="content-wrapper">
			<div class="container">
				</br>
				<?php include 'includes/comp.php'; ?>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-sm-9">
							<div class="callout" id="callout" style="display:none">
								<button type="button" class="close"><span aria-hidden="true">&times</span></button>
								<span class="message"></span>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<!-- <img src="<?php echo (!empty($product['photo1'])) ? 'images/'.$product['photo1'] : 'images/noimage.jpg'; ?>" width="100%" class="zoom" data-magnify-src="images/large-<?php echo $product['photo1']; ?>"> -->
									<br><br>
									<div class="slideshow-container">

										<div class="mySlides ">
											<!-- <div class="numbertext">1 / 3</div> -->
											<img src="<?php echo (!empty($product['photo1'])) ? 'images/'.$product['photo1'] : 'images/noimage.jpg'; ?>"
												style="width:100%">
											<!-- <div class="text">Caption Text</div> -->
										</div>

										<div class="mySlides ">
											<!-- <div class="numbertext">2 / 3</div> -->
											<img src="<?php echo (!empty($product['photo2'])) ? 'images/'.$product['photo2'] : 'images/noimage.jpg'; ?>"
												style="width:100%">
											<!-- <div class="text">Caption Two</div> -->
										</div>

										<div class="mySlides ">
											<!-- <div class="numbertext">3 / 3</div> -->
											<img src="<?php echo (!empty($product['photo1'])) ? 'images/'.$product['photo1'] : 'images/noimage.jpg'; ?>"
												style="width:100%">
											<!-- <div class="text">Caption Three</div> -->
										</div>

										<a class="prev" style="color:black;" onclick="plusSlides(-1)">❮</a>
										<a class="next" style="color:black;" onclick="plusSlides(1)">❯</a>

									</div>
									<br>
									<!-- <div style="text-align:center">
								<span class="dot" onclick="currentSlide(1)"></span> 
								<span class="dot" onclick="currentSlide(2)"></span> 
								<span class="dot" onclick="currentSlide(3)"></span> 
								</div> -->
									<form class="form-inline" id="productForm">
										<div class="form-group">
											<div class="input-group col-sm-5">

												<span class="input-group-btn">
													<button type="button" id="minus"
														class="btn btn-default btn-flat btn-lg"><i
															class="fa fa-minus"></i></button>
												</span>
												<input type="text" name="quantity" id="quantity"
													class="form-control input-lg" value="1">
												<span class="input-group-btn">
													<button type="button" id="add"
														class="btn btn-default btn-flat btn-lg"><i
															class="fa fa-plus"></i>
													</button>
												</span>
												<input type="hidden" value="<?php echo $product['prodid']; ?>"
													name="id">
											</div>
											<button type="submit" class="btn btn-warning btn-lg btn-flat"><i
													class="fa fa-shopping-cart"></i> Add to Cart</button>
										</div>
									</form>
									<form class="form-inline" id="productForm1">
										<div class="form-group">
											<div class="input-group col-sm-5">
												<input type="hidden" name="quantity" id="quantity"
													class="form-control input-lg" value="1">
												<input type="hidden" value="<?php echo $product['prodid']; ?>"
													name="id">
											</div>
											<button type="submit" class="btn btn-warning btn-lg btn-flat"><i
													class="fa fa-heart-o"></i> Add to wishlist</button>
										</div>
									</form>
									</br>
									<form class="form-inline" action="bidmid.php" method="POST">
										<div class="form-group">
											<div class="input-group col-sm-5">
												<input type="number" name="number" class="form-control input-lg"
													value="1">
												<input type="hidden" value="<?php echo $product['prodid']; ?>"
													name="pid">
												<input type="hidden" value="<?php echo $product['s_id']; ?>" name="sid">
											</div>
											<button type="submit" class="btn btn-warning btn-lg btn-flat">BID HERE
											</button>
										</div>
									</form>

									</br>

								</div>
								<div class="col-sm-6">
									<h1 class="page-header">
										<?php echo $product['prodname']; ?>
									</h1>
									<h3><b>Expected price:
											<?php echo number_format($product['price'], 2); ?>
										</b></h3>
									<p><b>Category:</b> <a
											href="category.php?category=<?php echo $product['cat_slug']; ?>">
											<?php echo $product['catname']; ?>
										</a></p>
									<p><b>Description:</b></p>
									<p>
										<?php echo $product['description']; ?>
									</p>
								</div>

							</div>
							<br>
							<div class="fb-comments"
								data-href="http://localhost/ecommerce/product.php?product=<?php echo $slug; ?>"
								data-numposts="10" width="100%"></div>
						</div>
						<div class="col-sm-3">
							<?php include 'includes/sidebar.php'; ?>
						</div>
					</div>
				</section>

			</div>
		</div>
		<?php $pdo->close(); ?>
		<?php include 'includes/footer.php'; ?>
	</div>

	<?php include 'includes/scripts.php'; ?>
	<script>
		$(function () {
			$('#add').click(function (e) {
				e.preventDefault();
				var quantity = $('#quantity').val();
				quantity++;
				$('#quantity').val(quantity);
			});
			$('#minus').click(function (e) {
				e.preventDefault();
				var quantity = $('#quantity').val();
				if (quantity > 1) {
					quantity--;
				}
				$('#quantity').val(quantity);
			});

		});
	</script>
	<script>
		let slideIndex = 1;
		showSlides(slideIndex);

		function plusSlides(n) {
			showSlides(slideIndex += n);
		}

		function currentSlide(n) {
			showSlides(slideIndex = n);
		}

		function showSlides(n) {
			let i;
			let slides = document.getElementsByClassName("mySlides");
			let dots = document.getElementsByClassName("dot");
			if (n > slides.length) { slideIndex = 1 }
			if (n < 1) { slideIndex = slides.length }
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active", "");
			}
			slides[slideIndex - 1].style.display = "block";
			dots[slideIndex - 1].className += " active";
		}
	</script>
</body>

</html>