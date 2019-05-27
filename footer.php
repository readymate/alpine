<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package readymate
 */

?>

</div><!-- #content -->
<?php do_action("after_content"); ?>
</div><!-- #page -->
<?php do_action("after_page"); ?>

<?php alpine_template('footer', get_option('footer-layout', 'flat')); ?>

<?php do_action("before_wp_footer"); ?>
<?php wp_footer(); ?>
<?php do_action("after_wp_footer"); ?>

</body>
<?php do_action("after_body"); ?>

</html>
