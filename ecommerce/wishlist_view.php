<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-black layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<h1 class="page-header">YOUR WISHLIST</h1>
	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<table class="table table-bordered">
		        			<thead>
		        				<th></th>
		        				<th>Photo</th>
		        				<th>Name</th>
		        				<th>Price</th>
		        				<th width="20%">Quantity</th>
		        				<th>Subtotal</th>
								<th>Cart</th>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>
						<form class="form-inline" id="productForm1">
		            			<div class="form-group">
			            			<div class="input-group col-sm-5">
							          	<input type="hidden" name="quantity" id="quantity" class="form-control input-lg" value="1">
							            <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
							        </div>
									
			            		</div>
		            		</form>
	        			</div>
	        		</div>
					 <?php 
					if(isset($_SESSION['user'])){
						//  echo "<button class='btn btn-warning btn-lg btn-flat' onClick='myFunction()'><i class='fa fa-shopping-cart '></i></button>";
					}
					else{
						echo "
							<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
						";
					}
					?> 
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
var total = 0;
$(function(){
	$(document).on('click', '.wishlist_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'wishlist_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getwishlist();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'wishlist_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getwishlist();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'wishlist_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getwishlist();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'wishlist_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getwishlist();
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'wishlist_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
</script>
<!-- <script>
	function myFunction(){
		uniq_id = Date.now()
		// window.location = 'sales1.php?pay='+uniq_id;
	} -->
</script>
</body>
</html>