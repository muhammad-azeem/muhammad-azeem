<?php
/**
 * Plugin Name: Hospitality Quote Manager
 * Description: Secure quote request form with garment selection, logo upload, admin storage and owner email notifications.
 * Version: 1.0.0
 * Author: EngrCreation
 */
if (!defined('ABSPATH')) exit;

function hqm_register_quotes() {
    register_post_type('hu_quote_request', [
        'labels' => [
            'name' => 'Quote Requests',
            'singular_name' => 'Quote Request',
            'menu_name' => 'Quote Requests',
            'all_items' => 'All Quote Requests',
            'view_item' => 'View Quote Request',
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => ['title'],
        'capability_type' => 'post',
    ]);
}
add_action('init', 'hqm_register_quotes');

function hqm_form_shortcode() {
    $status = isset($_GET['quote']) ? sanitize_key($_GET['quote']) : '';
    ob_start();
    ?>
    <form class="hu-form" method="post" enctype="multipart/form-data" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
      <h2>Tell us what your team needs.</h2>
      <p class="hu-form-note">We typically respond within one business day.</p>
      <?php if ($status === 'success') : ?><div class="hu-alert success">Thank you. Your quote request has been received.</div><?php endif; ?>
      <?php if ($status === 'error') : ?><div class="hu-alert error">Please check the required fields and try again.</div><?php endif; ?>
      <input type="hidden" name="action" value="hqm_submit_quote">
      <?php wp_nonce_field('hqm_submit_quote','hqm_nonce'); ?>
      <div class="hu-hp" aria-hidden="true"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
      <div class="hu-grid">
        <div class="hu-field"><label>Full Name *</label><input type="text" name="full_name" required></div>
        <div class="hu-field"><label>Business / Restaurant / Hotel Name *</label><input type="text" name="business_name" required></div>
        <div class="hu-field"><label>Phone Number *</label><input type="tel" name="phone" required></div>
        <div class="hu-field"><label>Email Address *</label><input type="email" name="email" required></div>
        <div class="hu-field full"><label>Type of garments needed *</label><div class="garment-grid">
          <?php foreach (['Chef Coats','Server Uniforms','Aprons','Caps','Other'] as $garment) : ?><label><input type="checkbox" name="garments[]" value="<?php echo esc_attr($garment); ?>"> <?php echo esc_html($garment); ?></label><?php endforeach; ?>
        </div></div>
        <div class="hu-field full"><label>Approximate Quantity *</label><input type="text" name="quantity" placeholder="e.g. 25 garments" required></div>
        <div class="hu-field full"><label>Upload Logo</label><input type="file" name="logo" accept=".png,.jpg,.jpeg,.pdf"><div class="hu-file-help">PNG, JPG or PDF. Maximum 5 MB.</div></div>
        <div class="hu-field full"><label>Special Requirements or Notes</label><textarea name="notes" placeholder="Tell us about sizes, garment preferences, embroidery placement, deadlines or anything else we should know."></textarea></div>
      </div>
      <button class="button button-gold hu-submit" type="submit">Send Quote Request <span>→</span></button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('hospitality_quote_form', 'hqm_form_shortcode');

function hqm_clean_list($items) {
    if (!is_array($items)) return [];
    return array_values(array_filter(array_map('sanitize_text_field', $items)));
}

function hqm_submission_rate_limited() {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $key = 'hqm_rl_' . md5($ip . wp_salt('nonce'));
    if (get_transient($key)) return true;
    set_transient($key, 1, 30);
    return false;
}

function hqm_submit_quote() {
    $back = wp_get_referer() ?: home_url('/get-a-quote/');
    if (!isset($_POST['hqm_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['hqm_nonce'])), 'hqm_submit_quote')) {
        wp_safe_redirect(add_query_arg('quote','error',$back)); exit;
    }
    if (!empty($_POST['website']) || hqm_submission_rate_limited()) {
        wp_safe_redirect(add_query_arg('quote','error',$back)); exit;
    }
    $full_name = sanitize_text_field(wp_unslash($_POST['full_name'] ?? ''));
    $business = sanitize_text_field(wp_unslash($_POST['business_name'] ?? ''));
    $phone = sanitize_text_field(wp_unslash($_POST['phone'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $quantity = sanitize_text_field(wp_unslash($_POST['quantity'] ?? ''));
    $notes = sanitize_textarea_field(wp_unslash($_POST['notes'] ?? ''));
    $garments = hqm_clean_list($_POST['garments'] ?? []);
    if (!$full_name || !$business || !$phone || !is_email($email) || !$quantity || !$garments) {
        wp_safe_redirect(add_query_arg('quote','error',$back)); exit;
    }
    $post_id = wp_insert_post([
        'post_type' => 'hu_quote_request',
        'post_status' => 'publish',
        'post_title' => $business . ' — ' . $full_name,
    ], true);
    if (is_wp_error($post_id)) { wp_safe_redirect(add_query_arg('quote','error',$back)); exit; }
    $meta = ['full_name'=>$full_name,'business_name'=>$business,'phone'=>$phone,'email'=>$email,'garments'=>implode(', ',$garments),'quantity'=>$quantity,'notes'=>$notes];
    foreach ($meta as $k=>$v) update_post_meta($post_id, '_hqm_'.$k, $v);

    $attachment_id = 0;
    if (!empty($_FILES['logo']['name']) && (int)$_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        if ((int)$_FILES['logo']['size'] <= 5 * 1024 * 1024) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $allowed = ['jpg|jpeg'=>'image/jpeg','png'=>'image/png','pdf'=>'application/pdf'];
            $upload = wp_handle_upload($_FILES['logo'], ['test_form'=>false,'mimes'=>$allowed]);
            if (empty($upload['error']) && !empty($upload['file'])) {
                $type = wp_check_filetype(basename($upload['file']), null);
                $attachment_id = wp_insert_attachment([
                    'post_mime_type' => $type['type'],
                    'post_title' => sanitize_file_name(pathinfo($upload['file'], PATHINFO_FILENAME)),
                    'post_status' => 'inherit',
                ], $upload['file'], $post_id);
                if ($attachment_id && !is_wp_error($attachment_id)) {
                    $meta_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
                    wp_update_attachment_metadata($attachment_id, $meta_data);
                    update_post_meta($post_id, '_hqm_logo_id', $attachment_id);
                }
            }
        }
    }

    $recipient = get_theme_mod('hu_email', '');
    if (!$recipient || !is_email($recipient)) $recipient = get_option('admin_email');
    $subject = 'New hospitality uniform quote request — ' . $business;
    $body = "New quote request received.\n\nName: $full_name\nBusiness: $business\nPhone: $phone\nEmail: $email\nGarments: " . implode(', ', $garments) . "\nApprox. quantity: $quantity\n\nNotes:\n$notes\n";
    if ($attachment_id) $body .= "\nLogo: " . wp_get_attachment_url($attachment_id) . "\n";
    $body .= "\nView in WordPress admin: " . admin_url('post.php?post='.$post_id.'&action=edit');
    wp_mail($recipient, $subject, $body, ['Reply-To: '.$full_name.' <'.$email.'>']);

    $clean_back = remove_query_arg('quote', $back);
    wp_safe_redirect(add_query_arg('quote','success',$clean_back) . '#quote-form');
    exit;
}
add_action('admin_post_nopriv_hqm_submit_quote', 'hqm_submit_quote');
add_action('admin_post_hqm_submit_quote', 'hqm_submit_quote');

function hqm_quote_meta_box() {
    add_meta_box('hqm_details','Quote Details','hqm_render_meta','hu_quote_request','normal','high');
}
add_action('add_meta_boxes','hqm_quote_meta_box');
function hqm_render_meta($post) {
    $fields = ['full_name'=>'Full Name','business_name'=>'Business','phone'=>'Phone','email'=>'Email','garments'=>'Garments','quantity'=>'Approx. Quantity','notes'=>'Notes'];
    echo '<table class="widefat striped"><tbody>';
    foreach ($fields as $key=>$label) {
        $value = get_post_meta($post->ID,'_hqm_'.$key,true);
        echo '<tr><th style="width:180px">'.esc_html($label).'</th><td>'.nl2br(esc_html($value)).'</td></tr>';
    }
    $logo = (int)get_post_meta($post->ID,'_hqm_logo_id',true);
    if ($logo) echo '<tr><th>Logo</th><td><a href="'.esc_url(wp_get_attachment_url($logo)).'" target="_blank">Open uploaded logo</a></td></tr>';
    echo '</tbody></table>';
}

function hqm_columns($columns) {
    return ['cb'=>$columns['cb'],'title'=>'Request','business'=>'Business','contact'=>'Contact','garments'=>'Garments','quantity'=>'Quantity','date'=>'Date'];
}
add_filter('manage_hu_quote_request_posts_columns','hqm_columns');
function hqm_column_content($column,$post_id) {
    if ($column==='business') echo esc_html(get_post_meta($post_id,'_hqm_business_name',true));
    if ($column==='contact') echo esc_html(get_post_meta($post_id,'_hqm_email',true)).'<br>'.esc_html(get_post_meta($post_id,'_hqm_phone',true));
    if ($column==='garments') echo esc_html(get_post_meta($post_id,'_hqm_garments',true));
    if ($column==='quantity') echo esc_html(get_post_meta($post_id,'_hqm_quantity',true));
}
add_action('manage_hu_quote_request_posts_custom_column','hqm_column_content',10,2);