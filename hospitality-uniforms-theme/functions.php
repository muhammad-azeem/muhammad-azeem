<?php
if (!defined('ABSPATH')) exit;

function hu_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height' => 100,
        'width' => 320,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    register_nav_menus(['primary' => __('Primary Menu', 'hospitality-uniforms')]);
}
add_action('after_setup_theme', 'hu_theme_setup');

function hu_enqueue_assets() {
    wp_enqueue_style('hu-style', get_stylesheet_uri(), [], '1.0.0');
    wp_enqueue_style('hu-main', get_template_directory_uri() . '/assets/css/main.css', ['hu-style'], '1.0.0');
    wp_enqueue_script('hu-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'hu_enqueue_assets');

function hu_customize_register($wp_customize) {
    $wp_customize->add_section('hu_business', [
        'title' => __('Business Details', 'hospitality-uniforms'),
        'priority' => 30,
    ]);
    $settings = [
        'hu_phone' => ['Phone Number', ''],
        'hu_email' => ['Business Email', ''],
        'hu_service_area' => ['Service Area', 'Local hospitality businesses'],
        'hu_whatsapp' => ['WhatsApp Number', ''],
    ];
    foreach ($settings as $key => $data) {
        $wp_customize->add_setting($key, ['default' => $data[1], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control($key, [
            'label' => __($data[0], 'hospitality-uniforms'),
            'section' => 'hu_business',
            'type' => 'text',
        ]);
    }
}
add_action('customize_register', 'hu_customize_register');

function hu_get_page_url($slug) {
    $page = get_page_by_path($slug);
    return $page ? get_permalink($page) : home_url('/' . trim($slug, '/') . '/');
}

function hu_create_required_pages() {
    $pages = [
        'home' => 'Home',
        'services' => 'Services',
        'hospitality-solutions' => 'Hospitality Solutions',
        'about' => 'About',
        'get-a-quote' => 'Get a Quote',
    ];
    $ids = [];
    foreach ($pages as $slug => $title) {
        $existing = get_page_by_path($slug);
        if ($existing) {
            $ids[$slug] = $existing->ID;
            continue;
        }
        $ids[$slug] = wp_insert_post([
            'post_title' => $title,
            'post_name' => $slug,
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_content' => '',
        ]);
    }
    if (!empty($ids['home']) && !is_wp_error($ids['home'])) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', (int) $ids['home']);
    }
    update_option('permalink_structure', '/%postname%/');
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'hu_create_required_pages');

function hu_meta_description() {
    if (is_front_page()) return 'Professional hospitality uniforms and custom embroidery for restaurants, hotels, cafes, bars and catering teams. Request a free quote.';
    if (is_page('services')) return 'Custom embroidery, logo digitization, branded hospitality apparel and easy reordering for hospitality teams.';
    if (is_page('hospitality-solutions')) return 'Uniform solutions for kitchen teams, front-of-house staff, hotels, cafes, bars, catering and events.';
    if (is_page('about')) return 'Hospitality-focused uniform and embroidery service built around quality, fast service and flexible ordering.';
    if (is_page('get-a-quote')) return 'Request a free quote for custom hospitality uniforms and logo embroidery.';
    return get_bloginfo('description');
}
function hu_output_meta_description() {
    echo '<meta name="description" content="' . esc_attr(hu_meta_description()) . '">' . "\n";
}
add_action('wp_head', 'hu_output_meta_description', 1);

function hu_elementor_ready_content() {
    if (!is_singular('page')) return false;
    $id = get_the_ID();
    return did_action('elementor/loaded') && get_post_meta($id, '_elementor_edit_mode', true) === 'builder';
}

add_filter('show_admin_bar', '__return_false');