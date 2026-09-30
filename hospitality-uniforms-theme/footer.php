</main>
<?php
$phone=get_theme_mod('hu_phone','');
$email=get_theme_mod('hu_email','');
$area=get_theme_mod('hu_service_area','Service area to be confirmed');
$whatsapp=get_theme_mod('hu_whatsapp','');
?>
<section class="footer-cta">
  <div class="container footer-cta-inner">
    <div><span class="eyebrow">LET’S OUTFIT YOUR TEAM</span><h2>Tell us what your hospitality team needs.</h2><p>Send your requirements and logo for a clear, no-obligation quote.</p></div>
    <a class="button button-gold" href="<?php echo esc_url(hu_get_page_url('get-a-quote')); ?>">Request a Free Quote <span>→</span></a>
  </div>
</section>
<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <a class="brand footer-logo" href="<?php echo esc_url(home_url('/')); ?>"><?php hu_brand_markup(true); ?></a>
      <p>Custom branded chef coats, server uniforms, aprons and hospitality workwear with professional logo embroidery.</p>
    </div>
    <div><h3>Quick Links</h3><a href="<?php echo esc_url(home_url('/')); ?>">Home</a><a href="<?php echo esc_url(hu_get_page_url('services')); ?>">Services</a><a href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>">Hospitality Solutions</a><a href="<?php echo esc_url(hu_get_page_url('about')); ?>">About</a></div>
    <div><h3>Contact</h3>
      <?php if($phone): ?><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone)); ?>"><?php echo esc_html($phone); ?></a><?php else: ?><span>Phone: add client number</span><?php endif; ?>
      <?php if($email): ?><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a><?php else: ?><span>Email: add client email</span><?php endif; ?>
      <span><?php echo esc_html($area); ?></span>
      <?php if($whatsapp): ?><a href="https://wa.me/<?php echo esc_attr(preg_replace('/\D+/','',$whatsapp)); ?>" target="_blank" rel="noopener">WhatsApp</a><?php endif; ?>
    </div>
  </div>
  <div class="container footer-bottom"><span>© <?php echo esc_html(date('Y')); ?> Hospitality Uniforms &amp; Custom Embroidery.</span><span>Built for restaurants, hotels, cafés, bars and catering teams.</span></div>
</footer>
<?php wp_footer(); ?>
</body>
</html>