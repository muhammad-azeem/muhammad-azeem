<?php
if (!defined('ABSPATH')) exit;

function hue_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height' => 120,
        'width' => 420,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
}
add_action('after_setup_theme', 'hue_theme_setup');

function hue_assets() {
    wp_enqueue_style('hue-style', get_stylesheet_uri(), [], '2.0.0');
    wp_enqueue_style('hue-site', get_template_directory_uri() . '/assets/css/site.css', ['hue-style'], '2.0.0');
    wp_enqueue_script('hue-site', get_template_directory_uri() . '/assets/js/site.js', [], '2.0.0', true);
}
add_action('wp_enqueue_scripts', 'hue_assets');

function hue_customize_register($wp_customize) {
    $wp_customize->add_section('hue_business', [
        'title' => __('Business Details', 'hospitality-uniforms-elementor'),
        'priority' => 30,
    ]);
    $fields = [
        'hu_phone' => ['Phone Number', ''],
        'hu_email' => ['Business Email', ''],
        'hu_service_area' => ['Service Area', 'Service area to be confirmed'],
        'hu_whatsapp' => ['WhatsApp Number', ''],
        'hu_ga_id' => ['Google Analytics Measurement ID (optional)', ''],
    ];
    foreach ($fields as $key => $data) {
        $wp_customize->add_setting($key, [
            'default' => $data[1],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control($key, [
            'label' => __($data[0], 'hospitality-uniforms-elementor'),
            'section' => 'hue_business',
            'type' => 'text',
        ]);
    }
}
add_action('customize_register', 'hue_customize_register');

function hue_render_elementor_template($option_key) {
    $template_id = (int) get_option($option_key, 0);
    if (!$template_id || !did_action('elementor/loaded') || !class_exists('\\Elementor\\Plugin')) return false;
    echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($template_id);
    return true;
}

function hue_meta_description() {
    if (is_front_page()) return 'Professional hospitality uniforms and custom embroidery for restaurants, hotels, cafes, bars and catering companies. Request a free quote.';
    if (is_page('services')) return 'Custom embroidery, logo digitization, branded hospitality apparel and easy reordering for hospitality teams.';
    if (is_page('hospitality-solutions')) return 'Uniform solutions for kitchen teams, front-of-house staff, hotels, cafes, bars, catering and event staff.';
    if (is_page('about')) return 'Hospitality-focused uniform and embroidery service built around quality, fast service and flexible ordering.';
    if (is_page('get-a-quote')) return 'Request a free quote for custom hospitality uniforms and logo embroidery.';
    return get_bloginfo('description');
}
add_action('wp_head', function () {
    echo '<meta name="description" content="' . esc_attr(hue_meta_description()) . '">' . "\n";
}, 1);

function hue_output_analytics() {
    $id = trim((string) get_theme_mod('hu_ga_id', ''));
    if (!$id || !preg_match('/^G-[A-Z0-9]+$/i', $id)) return;
    $safe = esc_attr($id);
    echo "<script async src=\"https://www.googletagmanager.com/gtag/js?id={$safe}\"></script>\n";
    echo "<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{$safe}');</script>\n";
}
add_action('wp_head', 'hue_output_analytics', 20);


// Built-in quote workflow and Elementor demo installer.
require_once get_template_directory() . '/inc/quote-manager.php';
require_once get_template_directory() . '/inc/elementor-setup.php';
