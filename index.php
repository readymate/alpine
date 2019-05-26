<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alpine
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		if (have_posts()) :

			if (is_home() && !is_front_page()) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php
		endif;

		/* Start the Loop */
		while (have_posts()) :
			the_post();

			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php
						the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
						?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
						the_content(sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'alpine'),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						));

						wp_link_pages(array(
							'before' => '<div class="page-links">' . esc_html__('Pages:', 'alpine'),
							'after'  => '</div>',
						));
						?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
			<?php
		endwhile;

		the_posts_navigation();

	else :
		?>
			<section class="no-results not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e('Nothing Found', 'alpine'); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p>
						<?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'alpine'); ?>
					</p>
				</div><!-- .page-content -->
			</section><!-- .no-results -->
		<?php

	endif;
	?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
