<?php
  include ("fkt.php");

  generate_header('LOGIN');
  login_html();
  verifylogin();
  close_header();
  
  generate_navbar();

  echo  "<main></main>";
  generate_footer();
  
  close_html();
?>


