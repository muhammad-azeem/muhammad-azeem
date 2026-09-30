<?php if (!defined('ABSPATH')) exit; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header" id="site-header">
  <div class="container header-inner">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Home">
      <?php if (has_custom_logo()) { the_custom_logo(); } else { ?>
        <span class="brand-mark" aria-hidden="true">♨</span>
        <span><strong>HOSPITALITY</strong><small>UNIFORMS &amp; EMBROIDERY</small></span>
      <?php } ?>
    </a>
    <button class="menu-toggle" aria-expanded="false" aria-controls="primary-nav"><span></span><span></span><span></span></button>
    <nav id="primary-nav" class="primary-nav" aria-label="Primary navigation">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <a href="<?php echo esc_url(hu_get_page_url('services')); ?>">Services</a>
      <a href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>">Hospitality Solutions</a>
      <a href="<?php echo esc_url(hu_get_page_url('about')); ?>">About</a>
      <a href="<?php echo esc_url(hu_get_page_url('get-a-quote')); ?>">Contact</a>
    </nav>
    <a class="button button-gold header-cta" href="<?php echo esc_url(hu_get_page_url('get-a-quote')); ?>">Get a Free Quote <span>→</span></a>
  </div>
</header>
<main id="main-content">