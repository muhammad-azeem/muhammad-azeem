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
<?php if (!hue_render_elementor_template('hue_header_template_id')) : ?>
<header class="hue-fallback-header">
  <div class="hue-wrap">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="hue-fallback-brand">Hospitality Uniforms &amp; Embroidery</a>
    <a href="<?php echo esc_url(home_url('/get-a-quote/')); ?>" class="hue-fallback-cta">Get a Free Quote</a>
  </div>
</header>
<?php endif; ?>
<main id="site-content">