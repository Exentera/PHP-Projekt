<?php
  include ("fkt.php");

  generate_header('ACCOUNT<br>ANLEGEN');
  createaccount_html();
  createaccount();
  close_header();
  
  generate_navbar();
  
  echo  "<main></main>";
  generate_footer();

  close_html();
?>
