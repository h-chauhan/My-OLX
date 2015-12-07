<!doctype html>
<?php require_once('../../includes/initialize.php'); ?>
<html>
<head>
<meta charset="utf-8">
<title>OLX</title>
<link href="../stylesheets/main.css" rel="stylesheet" type="text/css">

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

    <div id="headerLinks">
      <a href="index.php" title="All Products">All Products</a>
      <a href="my_products.php" title="My Products">My Products</a>
      <a href="post.php" title="Post An Ad">Post an Ad</a>
      <a href="logout.php" title="Logout">Logout</a>
    </div>
  </header>
 