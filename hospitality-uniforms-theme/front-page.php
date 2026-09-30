<?php get_header(); ?>
<?php if(hu_elementor_ready_content()){while(have_posts()){the_post();the_content();}get_footer();return;} ?>
<section class="home-hero">
  <div class="container hero-layout">
    <div class="hero-copy reveal">
      <span class="eyebrow">CUSTOM UNIFORMS • LOGO EMBROIDERY • HOSPITALITY ONLY</span>
      <h1>Professional Hospitality Uniforms <em>&amp; Embroidery</em></h1>
      <p class="hero-lead">Custom branded chef coats, server uniforms, aprons, and more. Low minimums. Fast turnaround. No long-term contracts.</p>
      <div class="hero-actions"><a class="button button-gold" href="<?php echo esc_url(hu_get_page_url('get-a-quote')); ?>">Get a Free Quote <span>→</span></a><a class="button button-outline" href="<?php echo esc_url(hu_get_page_url('services')); ?>">View Services</a></div>
      <div class="trust-row"><span>Low minimum orders</span><span>3–10 day turnaround</span><span>Local personal service</span></div>
    </div>
    <div class="hero-visual reveal">
      <img src="https://images.pexels.com/photos/8629122/pexels-photo-8629122.jpeg?auto=compress&cs=tinysrgb&w=1200" alt="Professional chef wearing a white chef coat">
      <div class="hero-tag"><strong>Hospitality Specialists</strong><small>Uniforms built for professional teams</small></div>
    </div>
  </div>
</section>

<section class="benefits-band"><div class="container benefits-grid">
  <article><span class="benefit-icon">01</span><div><h3>Low Minimum Orders</h3><p>Flexible quantities for teams of different sizes.</p></div></article>
  <article><span class="benefit-icon">02</span><div><h3>Fast Turnaround</h3><p>Typical turnaround of 3–10 days.</p></div></article>
  <article><span class="benefit-icon">03</span><div><h3>No Long-Term Contracts</h3><p>Order when your hospitality team needs it.</p></div></article>
  <article><span class="benefit-icon">04</span><div><h3>Local Personal Service</h3><p>Clear, direct support from quote to reorder.</p></div></article>
</div></section>

<section class="section light-section">
  <div class="container two-col intro-grid">
    <div class="reveal">
      <span class="eyebrow dark">HOSPITALITY UNIFORM SPECIALISTS</span>
      <h2>Branded workwear designed around real hospitality teams.</h2>
      <p>We provide custom uniforms and embroidery specifically for restaurants, hotels, cafés, bars and catering companies. The focus is a professional appearance, practical garments and an easy ordering process.</p>
      <a class="text-link" href="<?php echo esc_url(hu_get_page_url('services')); ?>">See our uniform services <span>→</span></a>
    </div>
    <div class="feature-photo reveal"><img src="https://images.pexels.com/photos/32641537/pexels-photo-32641537.jpeg?auto=compress&cs=tinysrgb&w=1200" alt="Professional embroidery machine stitching fabric"><div class="photo-label">Custom embroidery &amp; logo digitization</div></div>
  </div>
</section>

<section class="section navy-section">
  <div class="container">
    <div class="section-head reveal"><span class="eyebrow">WHO WE SERVE</span><h2>Uniform solutions for the hospitality industry.</h2><p>Every section below represents a real team type the business is set up to serve.</p></div>
    <div class="serve-grid">
      <a class="serve-card reveal" href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>#kitchen"><img src="https://images.unsplash.com/photo-1759521296047-89338c8e083d?auto=format&fit=crop&w=1000&q=85" alt="Chef in professional uniform"><div><span>Kitchen Teams</span><p>Chef coats, kitchen shirts and aprons.</p></div></a>
      <a class="serve-card reveal" href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>#front-of-house"><img src="https://images.pexels.com/photos/5920674/pexels-photo-5920674.jpeg?auto=compress&cs=tinysrgb&w=1000" alt="Hospitality server wearing apron"><div><span>Front-of-House / Servers</span><p>Server uniforms and branded service wear.</p></div></a>
      <a class="serve-card reveal" href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>#hotel"><img src="https://images.pexels.com/photos/5371677/pexels-photo-5371677.jpeg?auto=compress&cs=tinysrgb&w=1000" alt="Hotel staff member in professional uniform"><div><span>Hotel Staff</span><p>Reception and guest-facing uniform solutions.</p></div></a>
      <a class="serve-card reveal" href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>#cafe-bar"><img src="https://images.unsplash.com/photo-1770494347810-5aa9e689f13e?auto=format&fit=crop&w=1000&q=85" alt="Barista wearing professional apron"><div><span>Café &amp; Bar Teams</span><p>Aprons, shirts, caps and practical layers.</p></div></a>
      <a class="serve-card reveal" href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>#catering"><img src="https://images.pexels.com/photos/6817136/pexels-photo-6817136.jpeg?auto=compress&cs=tinysrgb&w=1000" alt="Professional waiter in uniform"><div><span>Catering Companies</span><p>Coordinated event and catering staff uniforms.</p></div></a>
    </div>
  </div>
</section>

<section class="section cream-section">
  <div class="container home-cta-card reveal">
    <div><span class="eyebrow dark">READY TO START?</span><h2>Send your logo and uniform requirements.</h2><p>Tell us the garments you need, approximate quantity and any special requirements. We’ll respond with a clear quote.</p></div>
    <a class="button button-gold" href="<?php echo esc_url(hu_get_page_url('get-a-quote')); ?>">Get a Free Quote <span>→</span></a>
  </div>
</section>
<?php get_footer(); ?>