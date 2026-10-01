<?php
/**
 * Plugin Name: Hospitality Elementor Demo Setup
 * Description: Creates the five client-required pages and editable Elementor header/footer/templates for the hospitality uniforms website.
 * Version: 1.0.0
 * Author: EngrCreation
 */
if (!defined('ABSPATH')) exit;

function hues_id() {
    return substr(md5(uniqid('', true)), 0, 7);
}
function hues_widget($type, $settings, $class='') {
    if ($class) $settings['css_classes'] = trim(($settings['css_classes'] ?? '') . ' ' . $class);
    return ['id'=>hues_id(),'elType'=>'widget','widgetType'=>$type,'settings'=>$settings,'elements'=>[]];
}
function hues_heading($text,$tag='h2',$class='') {
    return hues_widget('heading',['title'=>$text,'header_size'=>$tag],$class);
}
function hues_text($html,$class='') {
    return hues_widget('text-editor',['editor'=>$html],$class);
}
function hues_image($url,$alt='',$class='') {
    return hues_widget('image',['image'=>['url'=>$url,'id'=>''],'image_size'=>'full','caption_source'=>'none','link_to'=>'none','image_alt'=>$alt],$class);
}
function hues_button($text,$url,$class='hu-btn-gold') {
    return hues_widget('button',['text'=>$text,'link'=>['url'=>$url,'is_external'=>'','nofollow'=>''],'align'=>'left','size'=>'md'],$class);
}
function hues_shortcode($code,$class='') {
    return hues_widget('shortcode',['shortcode'=>$code],$class);
}
function hues_html($html,$class='') {
    return hues_widget('html',['html'=>$html],$class);
}
function hues_column($size,$elements,$class='') {
    return ['id'=>hues_id(),'elType'=>'column','settings'=>['_column_size'=>$size,'css_classes'=>$class],'elements'=>$elements];
}
function hues_section($columns,$class='',$settings=[]) {
    $settings=array_merge(['layout'=>'boxed','content_width'=>['unit'=>'px','size'=>1220,'sizes'=>[]],'gap'=>'default','css_classes'=>$class],$settings);
    return ['id'=>hues_id(),'elType'=>'section','settings'=>$settings,'elements'=>$columns];
}
function hues_inner_section($columns,$class='',$settings=[]) {
    $settings=array_merge(['structure'=>'20','css_classes'=>$class],$settings);
    return ['id'=>hues_id(),'elType'=>'section','isInner'=>true,'settings'=>$settings,'elements'=>$columns];
}
function hues_store_elementor($post_id,$data) {
    update_post_meta($post_id,'_elementor_edit_mode','builder');
    update_post_meta($post_id,'_elementor_data',wp_slash(wp_json_encode($data)));
    update_post_meta($post_id,'_elementor_page_settings',[]);
    if (defined('ELEMENTOR_VERSION')) update_post_meta($post_id,'_elementor_version',ELEMENTOR_VERSION);
    if (class_exists('\Elementor\Core\Files\CSS\Post')) {
        try { (new \Elementor\Core\Files\CSS\Post($post_id))->update(); } catch (\Throwable $e) {}
    }
}
function hues_get_or_create_page($title,$slug) {
    $existing=get_page_by_path($slug);
    if($existing) return $existing->ID;
    return wp_insert_post(['post_title'=>$title,'post_name'=>$slug,'post_type'=>'page','post_status'=>'publish','post_content'=>'']);
}
function hues_library_template($title,$slug,$data) {
    $existing=get_page_by_path($slug,OBJECT,'elementor_library');
    $id=$existing?$existing->ID:wp_insert_post(['post_title'=>$title,'post_name'=>$slug,'post_type'=>'elementor_library','post_status'=>'publish']);
    if(!$id || is_wp_error($id)) return 0;
    update_post_meta($id,'_elementor_template_type','section');
    hues_store_elementor($id,$data);
    return $id;
}
function hues_header_data() {
    $logo=get_template_directory_uri().'/assets/logo-mark.svg';
    $brand='<a class="hu-brand-widget" href="'.esc_url(home_url('/')).'"><span class="hu-brand-mark"><img src="'.esc_url($logo).'" alt=""></span><span><strong>HOSPITALITY UNIFORMS</strong><small>&amp; CUSTOM EMBROIDERY</small></span></a>';
    $nav='<div class="hu-nav-wrap"><button class="hu-menu-toggle" aria-expanded="false" aria-label="Open menu"><span></span><span></span><span></span></button><nav class="hu-nav-links"><a href="'.esc_url(home_url('/')).'">Home</a><a href="'.esc_url(home_url('/services/')).'">Services</a><a href="'.esc_url(home_url('/hospitality-solutions/')).'">Hospitality Solutions</a><a href="'.esc_url(home_url('/about/')).'">About</a><a href="'.esc_url(home_url('/get-a-quote/')).'">Contact</a></nav><a class="hu-nav-cta" href="'.esc_url(home_url('/get-a-quote/')).'">Get a Free Quote →</a></div>';
    return [
      hues_section([
        hues_column(35,[hues_html($brand)]),
        hues_column(65,[hues_html($nav)])
      ],'hu-site-header',['gap'=>'no'])
    ];
}
function hues_footer_data() {
    $brand='<a class="hu-brand-widget" href="'.esc_url(home_url('/')).'"><span class="hu-brand-mark"><img src="'.esc_url(get_template_directory_uri().'/assets/logo-mark.svg').'" alt=""></span><span><strong>HOSPITALITY UNIFORMS</strong><small>&amp; CUSTOM EMBROIDERY</small></span></a>';
    $links='<div class="hu-footer-links"><a href="'.esc_url(home_url('/')).'">Home</a><a href="'.esc_url(home_url('/services/')).'">Services</a><a href="'.esc_url(home_url('/hospitality-solutions/')).'">Hospitality Solutions</a><a href="'.esc_url(home_url('/about/')).'">About</a><a href="'.esc_url(home_url('/get-a-quote/')).'">Get a Quote</a></div>';
    $contact='<div class="hu-footer-links"><span>Phone: add client number</span><span>Email: add client email</span><span>Service area: to be confirmed</span></div>';
    return [
      hues_section([
        hues_column(72,[hues_heading('Let’s create a professional uniform program for your team.','h2','hu-section-title'),hues_text('<p>Tell us what your hospitality team needs and send your logo for a clear quote.</p>','hu-body-light')]),
        hues_column(28,[hues_button('Request a Free Quote →',home_url('/get-a-quote/'))])
      ],'hu-footer-cta'),
      hues_section([
        hues_column(45,[hues_html($brand),hues_text('<p>Custom branded chef coats, server uniforms, aprons and hospitality workwear with professional logo embroidery.</p>')]),
        hues_column(25,[hues_heading('Quick Links','h3'),hues_html($links)]),
        hues_column(30,[hues_heading('Contact','h3'),hues_html($contact)])
      ],'hu-footer-main'),
      hues_section([
        hues_column(60,[hues_text('<p>© '.date('Y').' Hospitality Uniforms &amp; Custom Embroidery.</p>')]),
        hues_column(40,[hues_text('<p>Built for restaurants, hotels, cafés, bars and catering teams.</p>')])
      ],'hu-footer-main hu-footer-bottom',['gap'=>'no'])
    ];
}
function hues_home_data() {
    $quote=home_url('/get-a-quote/'); $services=home_url('/services/'); $solutions=home_url('/hospitality-solutions/');
    return [
      hues_section([
        hues_column(52,[
          hues_heading('CUSTOM UNIFORMS • LOGO EMBROIDERY • HOSPITALITY ONLY','h6','hu-kicker'),
          hues_heading('Professional Hospitality Uniforms &amp; Embroidery','h1','hu-display'),
          hues_text('<p>Custom branded chef coats, server uniforms, aprons, and more. Low minimums. Fast turnaround. No long-term contracts.</p>','hu-body-light'),
          hues_inner_section([
             hues_column(50,[hues_button('Get a Free Quote →',$quote)]),
             hues_column(50,[hues_button('Explore Our Services',$services,'hu-btn-outline')])
          ]),
          hues_text('<p>✓ Low Minimum Orders &nbsp;&nbsp; ✓ Fast Turnaround (3–10 days) &nbsp;&nbsp; ✓ No Long-Term Contracts &nbsp;&nbsp; ✓ Local Personal Service</p>','hu-body-light')
        ],'hu-hero-copy'),
        hues_column(48,[
          hues_image('https://images.pexels.com/photos/8629122/pexels-photo-8629122.jpeg?auto=compress&cs=tinysrgb&w=1200','Professional chef wearing a white chef coat','hu-hero-image'),
          hues_heading('Hospitality Uniform Specialists','h3','hu-hero-note'),
          hues_text('<p>Professional appearance, practical garments and consistent branding.</p>','hu-hero-note')
        ])
      ],'hu-hero-section'),
      hues_section([
        hues_column(25,[hues_heading('01','h3','hu-benefit-number'),hues_heading('Low Minimum Orders','h3'),hues_text('<p>Flexible quantities for hospitality teams of different sizes.</p>')],'hu-benefit-card'),
        hues_column(25,[hues_heading('02','h3','hu-benefit-number'),hues_heading('Fast Turnaround','h3'),hues_text('<p>Typical turnaround of 3–10 days.</p>')],'hu-benefit-card'),
        hues_column(25,[hues_heading('03','h3','hu-benefit-number'),hues_heading('No Long-Term Contracts','h3'),hues_text('<p>Order when your team needs it without ongoing commitments.</p>')],'hu-benefit-card'),
        hues_column(25,[hues_heading('04','h3','hu-benefit-number'),hues_heading('Local Personal Service','h3'),hues_text('<p>Clear support from the first quote through easy reorders.</p>')],'hu-benefit-card')
      ],'hu-benefits-section',['gap'=>'no']),
      hues_section([
        hues_column(50,[
          hues_heading('HOSPITALITY-FOCUSED EXPERTISE','h6','hu-kicker-dark'),
          hues_heading('Uniform solutions built around the way hospitality teams work.','h2','hu-display-dark'),
          hues_text('<p>We focus exclusively on hospitality workwear, helping restaurants, hotels, cafés, bars and catering companies create a professional, consistent look while keeping teams comfortable for day-to-day service.</p>','hu-body-dark'),
          hues_button('View Our Services →',$services,'hu-link-button')
        ]),
        hues_column(50,[hues_image('https://images.pexels.com/photos/32641537/pexels-photo-32641537.jpeg?auto=compress&cs=tinysrgb&w=1200','Professional embroidery machine stitching fabric','hu-photo-card')])
      ],'hu-section-light'),
      hues_section([
        hues_column(100,[
          hues_heading('WHO WE SERVE','h6','hu-kicker'),
          hues_heading('Professional uniforms for every hospitality team.','h2','hu-section-title'),
          hues_text('<p>Role-specific garments and branding for the hospitality businesses this service is designed to support.</p>','hu-body-light')
        ])
      ],'hu-section-navy'),
      hues_section([
        hues_column(20,[hues_image('https://images.unsplash.com/photo-1759521296047-89338c8e083d?auto=format&fit=crop&w=1000&q=85','Chef in professional uniform'),hues_heading('Kitchen Teams','h3'),hues_text('<p>Chef coats, kitchen shirts and aprons.</p>')],'hu-role-card'),
        hues_column(20,[hues_image('https://images.pexels.com/photos/5920674/pexels-photo-5920674.jpeg?auto=compress&cs=tinysrgb&w=1000','Front-of-house server wearing apron'),hues_heading('Front-of-House / Servers','h3'),hues_text('<p>Server uniforms and branded service wear.</p>')],'hu-role-card'),
        hues_column(20,[hues_image('https://images.pexels.com/photos/5371677/pexels-photo-5371677.jpeg?auto=compress&cs=tinysrgb&w=1000','Hotel staff member in professional uniform'),hues_heading('Hotel Staff','h3'),hues_text('<p>Reception and guest-facing uniform solutions.</p>')],'hu-role-card'),
        hues_column(20,[hues_image('https://images.unsplash.com/photo-1770494347810-5aa9e689f13e?auto=format&fit=crop&w=1000&q=85','Barista wearing professional apron'),hues_heading('Café &amp; Bar Teams','h3'),hues_text('<p>Aprons, shirts, caps and practical layers.</p>')],'hu-role-card'),
        hues_column(20,[hues_image('https://images.pexels.com/photos/6817136/pexels-photo-6817136.jpeg?auto=compress&cs=tinysrgb&w=1000','Professional catering staff'),hues_heading('Catering Companies','h3'),hues_text('<p>Coordinated event and catering uniforms.</p>')],'hu-role-card')
      ],'hu-section-navy'),
      hues_section([
        hues_column(72,[hues_heading('READY TO START?','h6','hu-kicker-dark'),hues_heading('Send your logo and uniform requirements.','h2','hu-section-title'),hues_text('<p>Tell us the garments you need, approximate quantity and any special requirements. We’ll respond with a clear quote.</p>','hu-body-dark')]),
        hues_column(28,[hues_button('Get a Free Quote →',$quote)])
      ],'hu-section-cream hu-cta-panel')
    ];
}
function hues_services_data() {
    $quote=home_url('/get-a-quote/');
    return [
      hues_section([
        hues_column(58,[hues_heading('HOSPITALITY UNIFORM SERVICES','h6','hu-kicker'),hues_heading('Professional services for branded hospitality workwear.','h1','hu-page-title'),hues_text('<p>Custom embroidery, logo digitization, branded apparel and easy reordering for restaurants, hotels and hospitality teams.</p>','hu-body-light')]),
        hues_column(42,[hues_image('https://images.pexels.com/photos/32641537/pexels-photo-32641537.jpeg?auto=compress&cs=tinysrgb&w=1100','Professional embroidery machine','hu-page-hero-photo')])
      ],'hu-page-hero'),
      hues_section([
        hues_column(100,[hues_heading('CORE SERVICES','h6','hu-kicker-dark'),hues_heading('Hospitality Uniform Services','h2','hu-section-title'),hues_text('<p>Everything needed to take a hospitality team from logo preparation to branded garments and repeat orders.</p>','hu-body-dark')])
      ],'hu-section-light'),
      hues_section([
        hues_column(25,[hues_heading('01','h3','hu-card-number'),hues_heading('Custom Embroidery','h3'),hues_text('<p>Professional logo embroidery on suitable hospitality garments for a clean, consistent branded appearance.</p>')],'hu-card'),
        hues_column(25,[hues_heading('02','h3','hu-card-number'),hues_heading('Logo Digitization','h3'),hues_text('<p>Your logo is prepared as an embroidery-ready file so the design can be stitched accurately.</p>')],'hu-card'),
        hues_column(25,[hues_heading('03','h3','hu-card-number'),hues_heading('Branded Hospitality Apparel','h3'),hues_text('<p>Uniform garments selected for kitchen, front-of-house, hotel, café, bar and catering roles.</p>')],'hu-card'),
        hues_column(25,[hues_heading('04','h3','hu-card-number'),hues_heading('Easy Reordering','h3'),hues_text('<p>Your approved logo can be kept on file, making repeat orders easier for changing teams.</p>')],'hu-card')
      ],'hu-section-light'),
      hues_section([
        hues_column(100,[hues_heading('PRODUCTS WE SPECIALIZE IN','h6','hu-kicker-dark'),hues_heading('Workwear for hospitality roles.','h2','hu-section-title')])
      ],'hu-section-cream'),
      hues_section([
        hues_column(33,[hues_heading('C','h3','hu-product-code'),hues_heading('Chef Coats','h3'),hues_text('<p>Professional chef coats for branded kitchen teams.</p>')],'hu-product-card'),
        hues_column(33,[hues_heading('S','h3','hu-product-code'),hues_heading('Server Shirts / Blouses','h3'),hues_text('<p>Smart service wear for front-of-house staff.</p>')],'hu-product-card'),
        hues_column(34,[hues_heading('A','h3','hu-product-code'),hues_heading('Waist &amp; Bib Aprons','h3'),hues_text('<p>Practical branded aprons for kitchen, café, bar and servers.</p>')],'hu-product-card')
      ],'hu-section-cream'),
      hues_section([
        hues_column(33,[hues_heading('F','h3','hu-product-code'),hues_heading('Kitchen &amp; Front-of-House','h3'),hues_text('<p>Coordinated uniform options across back and front of house.</p>')],'hu-product-card'),
        hues_column(33,[hues_heading('H','h3','hu-product-code'),hues_heading('Caps &amp; Hats','h3'),hues_text('<p>Suitable headwear for branded hospitality teams.</p>')],'hu-product-card'),
        hues_column(34,[hues_heading('O','h3','hu-product-code'),hues_heading('Suitable Outerwear','h3'),hues_text('<p>Professional layers where the role or environment requires them.</p>')],'hu-product-card')
      ],'hu-section-cream'),
      hues_section([
        hues_column(100,[hues_heading('HOW IT WORKS','h6','hu-kicker'),hues_heading('A simple five-step process.','h2','hu-section-title')])
      ],'hu-section-navy'),
      hues_section([
        hues_column(20,[hues_heading('1','h3','hu-card-number'),hues_heading('Send us your logo','h3')],'hu-process-card'),
        hues_column(20,[hues_heading('2','h3','hu-card-number'),hues_heading('Receive a clear quote','h3')],'hu-process-card'),
        hues_column(20,[hues_heading('3','h3','hu-card-number'),hues_heading('Approve the design','h3')],'hu-process-card'),
        hues_column(20,[hues_heading('4','h3','hu-card-number'),hues_heading('We produce and deliver','h3')],'hu-process-card'),
        hues_column(20,[hues_heading('5','h3','hu-card-number'),hues_heading('Easy reorders anytime','h3')],'hu-process-card')
      ],'hu-section-navy'),
      hues_section([hues_column(100,[hues_button('Request a Free Quote →',$quote)])],'hu-section-navy')
    ];
}
function hues_solutions_data() {
    $quote=home_url('/get-a-quote/');
    $rows=[
      ['KITCHEN TEAMS','Professional kitchen uniforms.','Practical garments for cooks and chefs working through demanding service periods.','Chef coats|Kitchen shirts|Waist and bib aprons|Comfort-focused options for long shifts|Durable embroidery for a consistent brand look','https://images.unsplash.com/photo-1759521296144-fe6f2d2dc769?auto=format&fit=crop&w=1200&q=85','Chef wearing white chef uniform'],
      ['FRONT-OF-HOUSE / SERVERS','Polished service uniforms.','Guest-facing clothing that keeps the team looking coordinated without compromising movement.','Server shirts and blouses|Branded aprons|Suitable waistcoats or layers|Consistent logo placement|Professional front-of-house presentation','https://images.pexels.com/photos/5920674/pexels-photo-5920674.jpeg?auto=compress&cs=tinysrgb&w=1200','Front-of-house server in professional apron'],
      ['HOTEL STAFF','Uniforms for professional hotel teams.','A consistent appearance across guest-facing and operational hotel roles.','Reception and concierge attire|Housekeeping and operational garments|Professional shirts and suitable outerwear|Department-wide branding consistency|Comfort for daily guest service','https://images.pexels.com/photos/5371677/pexels-photo-5371677.jpeg?auto=compress&cs=tinysrgb&w=1200','Hotel staff in formal hospitality uniform'],
      ['CAFÉ & BAR TEAMS','Modern uniforms for fast-moving teams.','Flexible workwear that supports a relaxed or premium café and bar identity.','Branded shirts or polos|Waist and bib aprons|Caps and hats|Practical outer layers|Easy-to-repeat branding across staff','https://images.unsplash.com/photo-1770494347810-5aa9e689f13e?auto=format&fit=crop&w=1200&q=85','Cafe barista wearing a work apron'],
      ['CATERING & EVENT STAFF','Coordinated event team presentation.','Professional uniforms that make temporary, mobile or event-based teams look consistent.','Catering shirts and service wear|Event staff attire|Branded aprons|Professional coordinated layers|Flexible ordering for changing team sizes','https://images.pexels.com/photos/6817136/pexels-photo-6817136.jpeg?auto=compress&cs=tinysrgb&w=1200','Catering and event service staff']
    ];
    $data=[hues_section([hues_column(100,[hues_heading('HOSPITALITY SOLUTIONS','h6','hu-kicker'),hues_heading('Uniforms Designed for Hospitality Professionals','h1','hu-page-title'),hues_text('<p>Appearance, comfort, durability and brand image considered for every role.</p>','hu-body-light')])],'hu-page-hero')];
    foreach($rows as $i=>$r){
       $lis=''; foreach(explode('|',$r[3]) as $li) $lis.='<li>'.esc_html($li).'</li>';
       $imageCol=hues_column(50,[hues_image($r[4],$r[5],'hu-solution-photo')]);
       $textCol=hues_column(50,[hues_heading($r[0],'h6','hu-kicker-dark'),hues_heading($r[1],'h2','hu-section-title'),hues_text('<p>'.esc_html($r[2]).'</p><ul>'.$lis.'</ul>','hu-solution-text'),hues_button('Request a Quote →',$quote,'hu-link-button')]);
       $data[]=hues_section($i%2?[$textCol,$imageCol]:[$imageCol,$textCol],$i%2?'hu-solution-row hu-alt':'hu-solution-row');
    }
    $data[]=hues_section([hues_column(72,[hues_heading('NEED A CUSTOM SOLUTION?','h6','hu-kicker-dark'),hues_heading('Let’s create a professional uniform program for your team.','h2','hu-section-title'),hues_text('<p>Send the team type, garments, quantity and logo. We’ll use those details to prepare your quote.</p>','hu-body-dark')]),hues_column(28,[hues_button('Get a Free Quote →',$quote)])],'hu-section-cream hu-cta-panel');
    return $data;
}
function hues_about_data() {
    $quote=home_url('/get-a-quote/');
    return [
      hues_section([hues_column(100,[hues_heading('ABOUT','h6','hu-kicker'),hues_heading('Hospitality expertise with a focus on quality, speed and flexibility.','h1','hu-page-title'),hues_text('<p>Professional uniform and embroidery support for restaurants, hotels and hospitality businesses.</p>','hu-body-light')])],'hu-page-hero'),
      hues_section([
        hues_column(52,[hues_heading('HOSPITALITY-FOCUSED SERVICE','h6','hu-kicker-dark'),hues_heading('Uniforms need to look professional and work in the real world.','h2','hu-section-title'),hues_text('<p>Hospitality teams need garments that support appearance, comfort, durability and a consistent brand image. The service is built around those practical requirements rather than a one-size-fits-all clothing approach.</p><p>From logo preparation and embroidery to garment selection and repeat orders, the process is kept clear, responsive and easy to manage.</p>','hu-body-dark'),hues_button('Request a Free Quote →',$quote)]),
        hues_column(48,[hues_image('https://images.pexels.com/photos/32641537/pexels-photo-32641537.jpeg?auto=compress&cs=tinysrgb&w=1200','Professional embroidery process','hu-photo-card')])
      ],'hu-section-light'),
      hues_section([
        hues_column(25,[hues_heading('01','h3','hu-card-number'),hues_heading('Hospitality Specialization','h3'),hues_text('<p>Focused on restaurants, hotels, cafés, bars, catering companies and similar hospitality teams.</p>')],'hu-about-value'),
        hues_column(25,[hues_heading('02','h3','hu-card-number'),hues_heading('Quality Embroidery','h3'),hues_text('<p>Logo preparation and stitching designed for a polished, repeatable branded finish.</p>')],'hu-about-value'),
        hues_column(25,[hues_heading('03','h3','hu-card-number'),hues_heading('Fast Service','h3'),hues_text('<p>A clear quote-to-production process with a typical turnaround target of 3–10 days.</p>')],'hu-about-value'),
        hues_column(25,[hues_heading('04','h3','hu-card-number'),hues_heading('Flexible Ordering','h3'),hues_text('<p>Low minimums, no long-term contracts and easy reorders when staffing needs change.</p>')],'hu-about-value')
      ],'hu-section-cream'),
      hues_section([
        hues_column(50,[hues_heading('SERVICE AREA','h6','hu-kicker'),hues_heading('Local, personal support for hospitality businesses.','h2','hu-section-title')]),
        hues_column(50,[hues_text('<p>Service area information will be shown here once the client confirms it. Phone, email and service-area details can be changed from the WordPress Customizer without editing page code.</p>','hu-body-light')])
      ],'hu-section-navy')
    ];
}
function hues_quote_data() {
    return [
      hues_section([hues_column(100,[hues_heading('CONTACT / GET A QUOTE','h6','hu-kicker'),hues_heading('Request a Free Quote','h1','hu-page-title'),hues_text('<p>Tell us about your hospitality team’s uniform needs and we’ll respond quickly with a clear quote.</p>','hu-body-light')])],'hu-page-hero'),
      hues_section([
        hues_column(40,[
          hues_heading('HIGHEST-PRIORITY ACTION','h6','hu-kicker-dark'),
          hues_heading('Everything needed to prepare your quote.','h2','hu-section-title'),
          hues_text('<p>Use the form to send your contact details, garment type, approximate quantity, your logo and any special requirements.</p><p><strong>Garments:</strong> Chef Coats, Server Uniforms, Aprons, Caps or Other.</p><p><strong>Response:</strong> We typically respond within one business day.</p>','hu-body-dark'),
          hues_heading('Prefer direct contact?','h3'),
          hues_text('<p>Phone number: add client number<br>Email address: add client email<br>Service area: to be confirmed</p>','hu-body-dark')
        ],'hu-quote-info'),
        hues_column(60,[hues_shortcode('[hospitality_quote_form]','hu-quote-shell')])
      ],'hu-section-light')
    ];
}
function hues_install_demo() {
    if (!did_action('elementor/loaded')) return;
    if (get_option('hues_demo_installed')) return;

    $header=hues_library_template('Site Header - Elementor Editable','hospitality-site-header',hues_header_data());
    $footer=hues_library_template('Site Footer - Elementor Editable','hospitality-site-footer',hues_footer_data());
    update_option('hue_header_template_id',$header);
    update_option('hue_footer_template_id',$footer);

    $pages=[
      'home'=>['Home','home',hues_home_data()],
      'services'=>['Services','services',hues_services_data()],
      'solutions'=>['Hospitality Solutions','hospitality-solutions',hues_solutions_data()],
      'about'=>['About','about',hues_about_data()],
      'quote'=>['Get a Quote','get-a-quote',hues_quote_data()],
    ];
    $ids=[];
    foreach($pages as $key=>$p){
      $id=hues_get_or_create_page($p[0],$p[1]);
      $ids[$key]=$id;
      hues_store_elementor($id,$p[2]);
    }
    update_option('show_on_front','page');
    update_option('page_on_front',(int)$ids['home']);
    update_option('permalink_structure','/%postname%/');
    flush_rewrite_rules();

    update_option('blogname','Hospitality Uniforms & Custom Embroidery');
    update_option('blogdescription','Professional custom uniforms and embroidery for hospitality teams');
    update_option('hues_demo_installed',time());
    if (class_exists('\Elementor\Plugin')) {
      try { \Elementor\Plugin::$instance->files_manager->clear_cache(); } catch (\Throwable $e) {}
    }
}
add_action('init','hues_install_demo',99);

function hues_admin_notice() {
    if (!current_user_can('edit_pages')) return;
    $home=get_page_by_path('home');
    if(!$home) return;
    echo '<div class="notice notice-success"><p><strong>Hospitality Elementor website is ready.</strong> All five page layouts are stored as Elementor data. Open any page and choose <em>Edit with Elementor</em>. Header and footer templates are under Templates → Saved Templates.</p></div>';
}
add_action('admin_notices','hues_admin_notice');
