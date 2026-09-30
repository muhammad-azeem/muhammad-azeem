</main>
<?php
$phone = get_theme_mod('hu_phone', '');
$email = get_theme_mod('hu_email', '');
$area = get_theme_mod('hu_service_area', 'Local hospitality businesses');
$whatsapp = get_theme_mod('hu_whatsapp', '');
?>
<section class="footer-cta">
  <div class="container footer-cta-inner">
    <div><span class="eyebrow">READY TO OUTFIT YOUR TEAM?</span><h2>Let’s create a professional uniform program for your team.</h2></div>
    <a class="button button-gold" href="<?php echo esc_url(hu_get_page_url('get-a-quote')); ?>">Request a Free Quote <span>→</span></a>
  </div>
</section>
<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><span class="brand-mark">♨</span><span><strong>HOSPITALITY</strong><small>UNIFORMS &amp; EMBROIDERY</small></span></a>
      <p>Custom branded uniforms and embroidery created specifically for restaurants, hotels, cafés, bars, catering companies and hospitality teams.</p>
    </div>
    <div><h3>Quick Links</h3><a href="<?php echo esc_url(hu_get_page_url('services')); ?>">Services</a><a href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>">Hospitality Solutions</a><a href="<?php echo esc_url(hu_get_page_url('about')); ?>">About</a><a href="<?php echo esc_url(hu_get_page_url('get-a-quote')); ?>">Get a Quote</a></div>
    <div><h3>Contact</h3>
      <?php if ($phone) : ?><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a><?php else: ?><span>Phone details to be added</span><?php endif; ?>
      <?php if ($email) : ?><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a><?php else: ?><span>Email details to be added</span><?php endif; ?>
      <span><?php echo esc_html($area); ?></span>
      <?php if ($whatsapp) : ?><a href="https://wa.me/<?php echo esc_attr(preg_replace('/\D+/', '', $whatsapp)); ?>" target="_blank" rel="noopener">WhatsApp</a><?php endif; ?>
    </div>
  </div>
  <div class="container footer-bottom"><span>© <?php echo esc_html(date('Y')); ?> Hospitality Uniforms &amp; Embroidery. All rights reserved.</span><span>Professional uniforms for hospitality teams.</span></div>
</footer>
<?php wp_footer(); ?>
</body>
</html>