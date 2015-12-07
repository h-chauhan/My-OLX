<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php include_layout_template('admin_header.php'); ?>

<?php
  // Find all the products
  $products = Product::find_by_userid($session->user_id);
?>
<div id="content">
	      <section class="mainContent">
			<table>
				<tr>
					<th>Picture</th>
					<th>Name</th>
					<th>Category</th>
				</tr>
      			<?php foreach($products as $product): ?>
				<tr>
					<td class="productInfo"><div><img src="../../<?php echo $product->image_path(); ?>"/></div></td>
					<td class="price"><?php echo $product->name; ?></td>	
					<td class="productContent"><?php
              			$cat = Category::find_by_id($product->cat_id);
              		echo $cat->get_name(); ?></td>
		    	</tr>
	  			<?php endforeach; ?>
			</table>
		</section>
</div>
	