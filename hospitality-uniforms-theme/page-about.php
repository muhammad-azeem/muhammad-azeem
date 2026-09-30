<?php get_header(); ?>
<?php if(hu_elementor_ready_content()){while(have_posts()){the_post();the_content();}get_footer();return;} ?>
<section class="page-hero minimal-page-hero"><div class="container"><span class="eyebrow">ABOUT</span><h1>Hospitality expertise with a focus on <em>quality, speed and flexibility.</em></h1><p>Professional uniform and embroidery support for restaurants, hotels and hospitality businesses.</p></div></section>
<section class="section light-section">
  <div class="container two-col about-grid">
    <div class="reveal"><span class="eyebrow dark">HOSPITALITY-FOCUSED SERVICE</span><h2>Uniforms need to look professional and work in the real world.</h2><p>Hospitality teams need garments that support appearance, comfort, durability and a consistent brand image. The service is built around those practical requirements rather than a one-size-fits-all clothing approach.</p><p>From logo preparation and embroidery to garment selection and repeat orders, the process is kept clear, responsive and easy to manage.</p><a class="button button-gold" href="<?php echo esc_url(hu_get_page_url('get-a-quote')); ?>">Request a Free Quote →</a></div>
    <div class="feature-photo reveal"><img src="https://images.pexels.com/photos/32641537/pexels-photo-32641537.jpeg?auto=compress&cs=tinysrgb&w=1200" alt="Commercial embroidery process"><div class="photo-label">Professional embroidery for branded hospitality apparel</div></div>
  </div>
</section>
<section class="section cream-section"><div class="container"><div class="value-grid">
  <article class="reveal"><span>01</span><h3>Hospitality Specialization</h3><p>Focused on restaurants, hotels, cafés, bars, catering companies and similar hospitality teams.</p></article>
  <article class="reveal"><span>02</span><h3>Quality Embroidery</h3><p>Logo preparation and stitching designed for a polished, repeatable branded finish.</p></article>
  <article class="reveal"><span>03</span><h3>Fast Service</h3><p>A clear quote-to-production process with a typical turnaround target of 3–10 days.</p></article>
  <article class="reveal"><span>04</span><h3>Flexible Ordering</h3><p>Low minimums, no long-term contracts and easy reorders when staffing needs change.</p></article>
</div></div></section>
<section class="section navy-section"><div class="container about-service-area reveal"><div><span class="eyebrow">SERVICE AREA</span><h2>Local, personal support for hospitality businesses.</h2></div><p><?php echo esc_html(get_theme_mod('hu_service_area','Service area to be confirmed')); ?>. Final phone, email and service-area details can be entered from the WordPress Customizer once the client provides them.</p></div></section>
<?php get_footer(); ?>