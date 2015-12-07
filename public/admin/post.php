<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
	$max_file_size = 1048576;   // expressed in bytes
	                            //     10240 =  10 KB
	                            //    102400 = 100 KB
	                            //   1048576 =   1 MB
	                            //  10485760 =  10 MB

	$message = "";
	if(isset($_POST['submit'])) {
		$product = new Product();
		$product->name = $_POST['Name'];
		$product->cat_id = $_POST['category'];
		$product->attach_file($_FILES['file_upload']);
		if($product->save()) {
			// Success
      $message = "product uploaded successfully.";
		} else {
			// Failure
      $message = join("<br />", $product->errors);
		}
	}
	
?>

<?php include_layout_template('admin_header.php'); ?>
<div id="content">
  <section class="mainContent">
      <div id="form">
		  <?php echo output_message($message); ?>
 		  <form action="post.php" enctype="multipart/form-data" method="POST">
     	  	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
    	  	<p><input type="file" name="file_upload" /></p>
		  	<p>Name: <input type="text" name="Name" value="" /></p>
            <select name="category">
            	<option value="1">Mobiles and Tablets</option>
            	<option value="2">Computers and Laptops</option>
            	<option value="3">Vehicles</option>
            	<option value="4">Clothes and Accesories</option>
            	<option value="5">Books and CDs</option>
            	<option value="6">Others</option>                
            </select>
    	  <input type="submit" name="submit" value="Upload" />
  </form>
	  </div>
  </section>
</div>
	
  

<?php include_layout_template('admin_footer.php'); ?>
		
