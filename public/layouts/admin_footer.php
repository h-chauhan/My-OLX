    <footer>Copyright <?php echo date("Y", time()); ?>, Himanshu Chauhan</footer>
   </div>
  </body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>