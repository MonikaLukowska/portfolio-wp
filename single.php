<?php
get_header(); ?>
<main>
<div class="post">
  <div class="container">
  <?php 
    if(have_posts()):
        while(have_posts() ) the_post();
    

          the_content(); ?> 
    </div>
  </div>
</main>

   <?php
get_footer();
?>