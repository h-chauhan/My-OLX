<?php
  // Find all the products
  require_once("../../includes/initialize.php");
  $str = $_GET['q'];
  $products = Product::search($str); 
?>
<?php foreach($products as $product): ?>
        <article class="productInfo"><!-- Each individual product description -->
          <div><img src="../../<?php echo $product->image_path(); ?>"/></div>
          <p class="price"><?php echo $product->name; ?></p>
          <p class="productContent"><?php
              $cat = Category::find_by_id($product->cat_id);
              echo $cat->get_name(); ?></p>
          <p class="productContent"><?php
              $user = User::find_by_id($product->userid);
              echo $user->full_name(); ?></p>
		    </article>
<?php endforeach; ?>