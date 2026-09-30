<?php get_header(); ?>
<section class="section light-section generic-page"><div class="container prose"><?php while (have_posts()) { the_post(); ?><h1><?php the_title(); ?></h1><?php the_content(); ?><?php } ?></div></section>
<?php get_footer(); ?>