<?php get_header(); ?>
<?php if(hu_elementor_ready_content()){while(have_posts()){the_post();the_content();}get_footer();return;} ?>
<section class="page-hero clean-hero">
  <div class="container page-hero-grid">
    <div><span class="eyebrow">HOSPITALITY UNIFORM SERVICES</span><h1>Professional services for <em>branded hospitality workwear.</em></h1><p>Custom embroidery, logo preparation, branded apparel and straightforward reordering for restaurants, hotels and hospitality teams.</p></div>
    <img src="https://images.pexels.com/photos/32641537/pexels-photo-32641537.jpeg?auto=compress&cs=tinysrgb&w=1000" alt="Commercial embroidery machine">
  </div>
</section>
<section class="section light-section">
  <div class="container">
    <div class="section-head reveal"><span class="eyebrow dark">CORE SERVICES</span><h2>Hospitality Uniform Services</h2><p>Each service supports the full process from receiving your logo to producing branded garments that can be reordered later.</p></div>
    <div class="service-grid">
      <article class="service-card reveal"><div class="line-icon">✦</div><h3>Custom Embroidery</h3><p>Professional logo embroidery on suitable hospitality garments for a clean, consistent branded appearance.</p></article>
      <article class="service-card reveal"><div class="line-icon">◇</div><h3>Logo Digitization</h3><p>Your logo is prepared as an embroidery-ready file so the design can be stitched accurately and consistently.</p></article>
      <article class="service-card reveal"><div class="line-icon">▦</div><h3>Branded Hospitality Apparel</h3><p>Uniform garments selected specifically for kitchen, front-of-house, hotel, café, bar and catering roles.</p></article>
      <article class="service-card reveal"><div class="line-icon">↻</div><h3>Easy Reordering</h3><p>Your approved logo can be kept on file, making repeat orders easier when staffing needs change.</p></article>
    </div>
  </div>
</section>
<section class="section cream-section">
  <div class="container">
    <div class="section-head center reveal"><span class="eyebrow dark">PRODUCTS WE SPECIALIZE IN</span><h2>Workwear for hospitality roles.</h2></div>
    <div class="garment-grid-cards">
      <article class="garment-card reveal"><div class="garment-symbol">C</div><h3>Chef Coats</h3><p>Professional chef coats suitable for branded kitchen teams.</p></article>
      <article class="garment-card reveal"><div class="garment-symbol">S</div><h3>Server Shirts &amp; Blouses</h3><p>Smart service wear for front-of-house staff.</p></article>
      <article class="garment-card reveal"><div class="garment-symbol">A</div><h3>Aprons</h3><p>Waist and bib apron options for kitchen, café, bar and server teams.</p></article>
      <article class="garment-card reveal"><div class="garment-symbol">F</div><h3>Kitchen &amp; Front-of-House</h3><p>Coordinated garment choices across back and front of house.</p></article>
      <article class="garment-card reveal"><div class="garment-symbol">H</div><h3>Caps &amp; Hats</h3><p>Suitable headwear for branded hospitality teams.</p></article>
      <article class="garment-card reveal"><div class="garment-symbol">O</div><h3>Suitable Outerwear</h3><p>Professional layers where the role or environment requires them.</p></article>
    </div>
  </div>
</section>
<section class="section navy-section">
  <div class="container">
    <div class="section-head center reveal"><span class="eyebrow">HOW IT WORKS</span><h2>A simple five-step process.</h2></div>
    <div class="process-grid exact">
      <article class="reveal"><b>1</b><h3>Send us your logo</h3></article>
      <article class="reveal"><b>2</b><h3>Receive a clear quote</h3></article>
      <article class="reveal"><b>3</b><h3>Approve the design</h3></article>
      <article class="reveal"><b>4</b><h3>We produce and deliver</h3></article>
      <article class="reveal"><b>5</b><h3>Easy reorders anytime</h3></article>
    </div>
    <div class="center-cta"><a class="button button-gold" href="<?php echo esc_url(hu_get_page_url('get-a-quote')); ?>">Request a Free Quote →</a></div>
  </div>
</section>
<?php get_footer(); ?>