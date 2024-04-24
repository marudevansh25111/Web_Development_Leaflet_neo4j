<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "test";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>


<script src="./bower_components/jquery/dist/jquery.min.js"></script>




<script type="text/javascript">
	$(document).ready(function () {
		$(document).on('click', '.show_more', function () {
			var ID = $(this).attr('id');
			var idx = document.getElementById("memai").innerText;
			$('.show_more').hide();
			$('.loding').show();
			$.ajax({
				type: 'POST',
				url: 'ajax1.php',
				data: 'id=' + ID +'&cat=' + idx,
				success: function (html) {
					$('#show_more_main' + ID).remove();
					$('.postList').append(html);
				}
			});
		});
	});
</script>


<div id="show_more_main<?php echo $postID; ?>">
								<button id="<?php echo $postID; ?>"  class="show_more" title="Load more posts">Show more...</button>
								<span style="display:none" id="memai"><?php echo $cat;?></span>
								<span class="loding" style="display: none;"><span
										class="loding_txt">Loading...</span></span>
</div>

<div class="postList">
						<?php
    // Get records from the database
    // $query = $db->query("SELECT * FROM products ORDER BY id DESC LIMIT 2");
    
    // if($query->num_rows > 0){ 
    //     while($row = $query->fetch_assoc()){ 
    //         $postID = $row['id'];
    ?>
						<!-- <div class="list_item"><?
						// php echo $row['name']; 
						?></div> -->
						<?php 
					// } 
					?>

						<?php 
					// }
					 ?>
					</div>