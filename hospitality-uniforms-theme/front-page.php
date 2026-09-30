<?php get_header(); ?>
<?php if (hu_elementor_ready_content()) { while (have_posts()) { the_post(); the_content(); } get_footer(); return; } ?>
<section class="hero">
  <div class="hero-media" style="background-image:linear-gradient(90deg,rgba(3,19,34,.96) 0%,rgba(3,19,34,.82) 42%,rgba(3,19,34,.20) 72%,rgba(3,19,34,.08) 100%),url('https://unsplash.com/photos/9xObRZdEN7g/download?force=true&w=1800');"></div>
  <div class="container hero-content">
    <div class="hero-copy reveal">
      <span class="eyebrow">CUSTOM UNIFORMS • LOGO EMBROIDERY • HOSPITALITY SPECIALISTS</span>
      <h1>Professional Hospitality Uniforms <em>&amp; Embroidery</em></h1>
      <p>Custom branded chef coats, server uniforms, aprons and more. Low minimums. Fast turnaround. No long-term contracts.</p>
      <div class="hero-actions"><a class="button button-gold" href="<?php echo esc_url(hu_get_page_url('get-a-quote')); ?>">Get a Free Quote <span>→</span></a><a class="button button-outline" href="<?php echo esc_url(hu_get_page_url('services')); ?>">Explore Our Services</a></div>
      <div class="hero-points"><span>✓ Low Minimum Orders</span><span>✓ 3–10 Day Turnaround</span><span>✓ Local Personal Service</span></div>
    </div>
  </div>
</section>

<section class="benefits-band">
  <div class="container benefits-grid">
    <article><b>01</b><div><h3>Low Minimum Orders</h3><p>Flexible quantities for growing hospitality teams.</p></div></article>
    <article><b>02</b><div><h3>Fast Turnaround</h3><p>Typical production turnaround of 3–10 days.</p></div></article>
    <article><b>03</b><div><h3>No Long-Term Contracts</h3><p>Order what you need without unnecessary commitments.</p></div></article>
    <article><b>04</b><div><h3>Local Personal Service</h3><p>Clear communication from quote to delivery.</p></div></article>
  </div>
</section>

<section class="section light-section">
  <div class="container two-col intro-grid">
    <div class="reveal"><span class="eyebrow dark">HOSPITALITY-FOCUSED EXPERTISE</span><h2>Uniform solutions built around the way hospitality teams work.</h2><p>We focus exclusively on hospitality workwear, helping restaurants, hotels, cafés, bars and catering companies present a polished, consistent brand while keeping teams comfortable for day-to-day service.</p><a class="text-link" href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>">Explore hospitality solutions <span>→</span></a></div>
    <div class="image-stack reveal"><img src="https://unsplash.com/photos/YFK5dBI6Ftc/download?force=true&w=1000" alt="Hospitality kitchen team"><div class="floating-card"><strong>Hospitality first.</strong><span>Professional appearance, comfort, durability and brand consistency.</span></div></div>
  </div>
</section>

<section class="section dark-section">
  <div class="container">
    <div class="section-head reveal"><span class="eyebrow">WHO WE SERVE</span><h2>Professional uniforms for every hospitality team.</h2><p>Role-specific garments, consistent branding and embroidery that helps your staff look ready for service.</p></div>
    <div class="card-grid five">
      <a class="role-card reveal" href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>#kitchen"><img src="https://unsplash.com/photos/VnFTWmdjw4Q/download?force=true&w=700" alt="Kitchen team"><div><span>01</span><h3>Kitchen Teams</h3><p>Chef coats, kitchen shirts and aprons.</p></div></a>
      <a class="role-card reveal" href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>#front-of-house"><img src="https://unsplash.com/photos/lC8i5_lJqgU/download?force=true&w=700" alt="Front of house staff"><div><span>02</span><h3>Front-of-House</h3><p>Server shirts, blouses and branded layers.</p></div></a>
      <a class="role-card reveal" href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>#hotel"><img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=900&q=80" alt="Hotel staff environment"><div><span>03</span><h3>Hotel Staff</h3><p>Reception, concierge and operational uniforms.</p></div></a>
      <a class="role-card reveal" href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>#cafe-bar"><img src="https://images.unsplash.com/photo-1515003197210-e0cd71810b5f?auto=format&fit=crop&w=900&q=80" alt="Cafe and bar team"><div><span>04</span><h3>Café &amp; Bar Teams</h3><p>Aprons, shirts, caps and outer layers.</p></div></a>
      <a class="role-card reveal" href="<?php echo esc_url(hu_get_page_url('hospitality-solutions')); ?>#catering"><img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=900&q=80" alt="Catering team"><div><span>05</span><h3>Catering &amp; Events</h3><p>Coordinated professional event uniforms.</p></div></a>
    </div>
  </div>
</section>

<section class="section light-section">
  <div class="container process-wrap">
    <div class="section-head center reveal"><span class="eyebrow dark">SIMPLE FROM START TO REORDER</span><h2>How it works.</h2></div>
    <div class="process-grid">
      <article class="reveal"><b>01</b><h3>Send Your Logo</h3><p>Share your logo and uniform requirements.</p></article>
      <article class="reveal"><b>02</b><h3>Receive a Quote</h3><p>Get a clear quote based on garments and quantity.</p></article>
      <article class="reveal"><b>03</b><h3>Approve the Design</h3><p>Review the branding placement before production.</p></article>
      <article class="reveal"><b>04</b><h3>Production &amp; Delivery</h3><p>Your approved uniforms are produced and delivered.</p></article>
      <article class="reveal"><b>05</b><h3>Easy Reorders</h3><p>Your logo can be kept on file for quicker repeat orders.</p></article>
    </div>
  </div>
</section>
<?php get_footer(); ?>