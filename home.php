<?php
/**
 * Home Template
 *
 * This is the home template.  Technically, it is the "posts page" template.
 * It is used when a visitor is on the page assigned to show a site's
 * latest blog posts.
 *
 * @package Cakifo
 * @subpackage Template
 */

get_header(); ?>

	<?php do_atomic( 'before_main' ); ?>

	<main id="main" class="site-main" role="main">

		<?php do_atomic( 'open_main' ); ?>


		<?php if ( have_posts() ) : ?>

			<?php get_template_part( 'loop-meta' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php cakifo_get_loop_template( get_post_format() ); ?>

			<?php endwhile; ?>

			<?php get_template_part( 'loop-nav' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>


		<?php do_atomic( 'close_main' ); ?>

	</main> <!-- .site-main -->

	<?php do_atomic( 'after_main' ); ?>

<?php get_footer(); ?>
