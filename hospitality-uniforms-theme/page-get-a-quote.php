<?php get_header(); ?>
<?php if(hu_elementor_ready_content()){while(have_posts()){the_post();the_content();}get_footer();return;} ?>
<section class="page-hero quote-hero">
  <div class="container"><span class="eyebrow">CONTACT / GET A QUOTE</span><h1>Request a <em>Free Quote</em></h1><p>Tell us about your hospitality team’s uniform needs and we’ll respond quickly with a clear quote.</p></div>
</section>
<section class="section light-section">
  <div class="container quote-layout">
    <aside class="quote-side reveal">
      <span class="eyebrow dark">HIGHEST-PRIORITY ACTION</span>
      <h2>Everything needed to prepare your quote.</h2>
      <p>Use the form to send your contact details, the type of garments required, approximate quantity, your logo and any special requirements.</p>
      <div class="quote-points">
        <div><b>01</b><span><strong>Garment requirements</strong><small>Chef coats, server uniforms, aprons, caps or other.</small></span></div>
        <div><b>02</b><span><strong>Approximate quantity</strong><small>Enough information to price the request clearly.</small></span></div>
        <div><b>03</b><span><strong>Upload your logo</strong><small>Attach the logo that will be used for embroidery.</small></span></div>
        <div><b>04</b><span><strong>One business day</strong><small>We typically respond within one business day.</small></span></div>
      </div>
      <div class="contact-card">
        <h3>Prefer direct contact?</h3>
        <?php $phone=get_theme_mod('hu_phone','');$email=get_theme_mod('hu_email','');$area=get_theme_mod('hu_service_area','Service area to be confirmed'); ?>
        <?php if($phone): ?><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone)); ?>"><?php echo esc_html($phone); ?></a><?php else: ?><span>Phone number will be added here</span><?php endif; ?>
        <?php if($email): ?><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a><?php else: ?><span>Email address will be added here</span><?php endif; ?>
        <span><?php echo esc_html($area); ?></span>
      </div>
    </aside>
    <div id="quote-form" class="quote-form-shell reveal"><?php echo do_shortcode('[hospitality_quote_form]'); ?></div>
  </div>
</section>
<?php get_footer(); ?>