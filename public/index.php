<?php require_once("../includes/initialize.php"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>OLX</title>
<link href="stylesheets/main.css" rel="stylesheet" type="text/css">

<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
<script>
  function search(str) { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("productRow").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","search.php?q="+str,true);
        xmlhttp.send();

}
</script>
</head>

<body>
<div id="mainWrapper">
  <header> 
    <!-- This is the header content. It contains Logo and links -->
    <div id="logo"> <!-- <img src="logoImage.png" alt="sample logo"> --> 
      <!-- Company Logo text --> 
      OLX </div>
    <div id="headerLinks"><a href="admin/login.php" title="Login/Register">Login/Register</a></div>
  </header>
<?php

	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// 2. records per page ($per_page)
	$per_page = 6;

	// 3. total record count ($total_count)
	$total_count = Product::count_all();
	

	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	if(isset($_GET['category'])) {
    $sql = "SELECT * FROM products WHERE cat_id = ".$_GET['category'];
	  $sql .= " LIMIT {$per_page} ";
	  $sql .= "OFFSET {$pagination->offset()}";
	  $products = Product::find_by_sql($sql);
  } else {
    $sql = "SELECT * FROM products ";
	  $sql .= "LIMIT {$per_page} ";
	  $sql .= "OFFSET {$pagination->offset()}";
	  $products = Product::find_by_sql($sql);
  }
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	
?>
<div id="content">
    <section class="sidebar"> 
      <!-- This adds a sidebar with 1 searchbox,2 menusets, each with 4 links -->
      <input type="text"  id="search" placeholder="Search" onkeyup="search(this.value)" >
      <div id="txtHint"></div>
      <div id="menubar">
        <nav class="menu">
          <h2><!-- Title for menuset 1 -->Category </h2>
          <hr>
          <ul>
            <!-- List of links under menuset 1 -->
            <li><a href="index.php">Home</a></li>            
            <li><a href="index.php?category=1"  >Mobiles and Tablets</a></li>
            <li><a href="index.php?category=2"  >Computers and Laptops</a></li>
            <li><a href="index.php?category=3"  >Vehicles</a></li>
            <li><a href="index.php?category=4"  >Clothes and Accesories</a></li>
            <li><a href="index.php?category=5"  >Books and CDs</a></li>
            <li><a href="index.php?category=6"  >Otherss</a></li>
          </ul>
        </nav>
       </div>
      </section>
      
      <section class="mainContent">
      <div class="productRow" id="productRow">
      <?php foreach($products as $product): ?>
        <article class="productInfo"><!-- Each individual product description -->
          <div><img src="../<?php echo $product->image_path(); ?>"/></div>
          <p class="price"><?php echo $product->name; ?></p>
          <p class="productContent"><?php
              $cat = Category::find_by_id($product->cat_id);
              echo $cat->get_name(); ?></p>
          <p class="productContent"><?php
              $user = User::find_by_id($product->userid);
              echo $user->full_name(); ?></p>
		    </article>
	  <?php endforeach; ?>
      </div>
      <div id="pagination" style="clear: both;">
<?php
	if($pagination->total_pages() > 1) {
		
		if($pagination->has_previous_page()) { 
    	echo "<a href=\"index.php?page=";
      echo $pagination->previous_page();
      echo "\">&laquo; Previous</a> "; 
    }

		for($i=1; $i <= $pagination->total_pages(); $i++) {
			if($i == $page) {
				echo " <span class=\"selected\">{$i}</span> ";
			} else {
				echo " <a href=\"index.php?page={$i}\">{$i}</a> "; 
			}
		}

		if($pagination->has_next_page()) { 
			echo " <a href=\"index.php?page=";
			echo $pagination->next_page();
			echo "\">Next &raquo;</a> "; 
    }
		
	}

?>
</div>
      </section>
  </div>   
<?php include_layout_template('footer.php'); ?>
