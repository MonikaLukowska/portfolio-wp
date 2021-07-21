<?php
get_header(); ?>
<main>
<div class="post">
  <div class="container container--post">
  <?php 
    if(have_posts()):
        while(have_posts() ) the_post();
        $alt = get_post_meta ( $image_id, '_wp_attachment_image_alt', true );
        ?>
        <h2 class="heading heading--large"><?php the_title();?></h2>
        <p class="post__date"><?php echo get_the_date('d F Y')?></p>
        <!--<div class="post__featured">
        <?php the_post_thumbnail('medium_large')?>
        </div>-->

      <?php the_content(); ?>
      <div class="post__navigation t-center"><span class="post__navigation__archives"><a class="btn" href="<?php echo esc_url( get_permalink(pll_get_post(129)) ); ?>"><span class="post__navigation__icon post__navigation__icon--prev"></span><?php pll_e( 'Wróć do wszystkich wpisów', 'Drim Robotics' )?></a></span>
      <?php if (strlen(get_previous_post()->post_title) > 0) { ?>
        <span class="btn btn--post post__navigation__next"><?php previous_post_link('%link',pll__( 'Przejdź do następnego wpisu', 'Drim obotics' )); ?><span class="post__navigation__icon post__navigation__icon--next"></span></span>
<?php } ?></div>
  <?php  
  endif ?>
   </div>
   <div class="post__recent">
        <h2 class="heading heading--large center"><?php pll_e( 'Inne wpisy', 'Drim Robotics' ); ?></h2>
        <div class="recent-posts__list recent-posts__list--wide">
        <?php 
        $params = array(
          'posts_per_page' => 2,
          'post_type'     => 'post',
          'orderby'       => 'rand'
        );
        $archives = new WP_Query($params);
        ?>
        <?php if ($archives->have_posts()) :
				while ($archives->have_posts()) :
				$archives->the_post();
				get_template_part( 'template-parts/excerpt' );
				?>
				<?php endwhile;
				endif;
				wp_reset_postdata();?>
			</div>
    </div>
  </div>
  <!--<iframe width="100%" height="400px" src="<?php echo get_field('file')?>"></iframe>-->
</main>

   <?php
get_footer();
?>