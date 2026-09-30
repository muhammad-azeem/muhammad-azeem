<?php get_header(); ?>
<section class="section light-section generic-page"><div class="container prose"><h1><?php bloginfo('name'); ?></h1><?php if (have_posts()) { while (have_posts()) { the_post(); ?><article><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?></article><?php } } ?></div></section>
<?php get_footer(); ?>