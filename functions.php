<?php
/**
 * alpine functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package alpine
 */

if (!function_exists('alpine_setup')) :
	function alpine_setup()
	{
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));
		add_theme_support('custom-background', apply_filters('alpine_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));
		add_theme_support('customize-selective-refresh-widgets');
		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));
		register_nav_menus(array(
			'primary' => esc_html__('Primary', 'alpine'),
		));
	}
endif;
add_action('after_setup_theme', 'alpine_setup');

function alpine_content_width()
{
	$GLOBALS['content_width'] = apply_filters('alpine_content_width', 640);
}
add_action('after_setup_theme', 'alpine_content_width', 0);

function alpine_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'alpine'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.', 'alpine'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'alpine_widgets_init');

function alpine_scripts()
{
	wp_enqueue_style('alpine-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('alpine-style-client', get_template_directory_uri() . '/dist/css/client.bundle.css');
	wp_enqueue_style('alpine-style-client-theme', get_template_directory_uri() . '/theme.css');
}
add_action('wp_enqueue_scripts', 'alpine_scripts');

function alpine_template($name, $part = null)
{
	do_action("before_header_{$name}");
	get_template_part("templates/{$name}", $part);
	do_action("after_header_{$name}");
}

require get_template_directory() . '/settings/theme-settings.php';
