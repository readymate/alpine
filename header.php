<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package alpine
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php do_action("before_wp_head"); ?>
	<?php wp_head(); ?>
	<?php do_action("after_wp_head"); ?>
</head>

<?php do_action("before_body"); ?>

<body <?php body_class(); ?>>

	<?php do_action("before_page"); ?>
	<div id="page" class="site">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'alpine'); ?></a>

		<?php alpine_template('header', get_option('header-layout', 'flat')); ?>

		<?php do_action("before_content"); ?>
		<div id="content" class="site-content">
