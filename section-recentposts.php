<?php
/**
 * The template for displaying Recent Posts in the template-front-page.php template.
 *
 * Child Themes can replace this template part file by overwriting section-recentposts.php
 *
 * @package Cakifo
 * @subpackage Template
 */

	/**
	 * Create the Recent Posts query.
	 *
	 * @var array
	 */
	$recent_args = array(
		'posts_per_page'      => 4,
		'ignore_sticky_posts' => 1,
		'post_status'         => 'publish',
		'no_found_rows'       => true,
	);

	/**
	 * Filter the recent posts query.
	 *
	 * @param array $recent_args An array of valid WP_Query arguments.
	 */
	$recent = new WP_Query( apply_filters( 'cakifo_recent_posts_query', $recent_args ) );

	if ( $recent->have_posts() ) :
?>

	<?php do_atomic( 'before_recent_posts' ); ?>

	<section class="recent-post-columns clearfix">

		<?php do_atomic( 'open_recent_posts' ); ?>

		<h1 class="section-title">
			<a href="<?php echo esc_url( cakifo_get_blog_page_url() ); ?>"><?php _e( 'Recent Posts', 'cakifo' ); ?></a>
		</h1>

		<?php while ( $recent->have_posts() ) : $recent->the_post(); ?>

			<article class="recent-post">
				<?php do_atomic( 'open_recent_posts_item' ); ?>

					<?php
						/* Get the thumbnail */
						if ( current_theme_supports( 'get-the-image' ) ) {
							get_the_image( array(
								'size'          => 'recent',
								'image_class'   => 'thumbnail',
								'default_image' => THEME_URI . '/images/default-thumb-220-150.png',
							));
						}
					?>

					<header class="entry-header">
						<?php the_title( sprintf( '<h2 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

						<?php
							$time = cakifo_get_post_date();
							$author = cakifo_get_post_author();

							$meta = '<span class="recent-posts-meta">' . $time . ' ' . $author . '</span>';

							/**
							 * Filter recent posts post meta.
							 *
							 * This filter provides backward compatibility with earlier versions of Cakifo
							 * that used shortcodes in the string. A compatibility plugin with the shortcodes
							 * will be released soon.
							 *
							 * @since Cakifo 1.2
							 *
							 * @param string $meta The meta string
							 */
							echo do_shortcode( apply_filters( 'cakifo_recent_posts_meta', $meta ) );
						?>
					</header> <!-- .details -->

					<div class="entry-summary">
						<?php
							echo wp_trim_words( get_the_excerpt(), 20 );

							$more_text = sprintf( __( 'Continue reading %s', 'cakifo' ), the_title( '<span class="screen-reader-text">', '</span>', false ) );

							echo '<a href="' . esc_url( get_permalink() ) . '" class="more-link">' . $more_text . '</a>';
						?>
					</div> <!-- .entry-summary -->

				<?php do_atomic( 'close_recent_posts_item' ); ?>
			</article> <!-- .recent-post -->

		<?php endwhile; wp_reset_query(); ?>

		<?php do_atomic( 'close_recent_posts' ); ?>

	</section> <!-- .recent-post-columns -->

	<?php do_atomic( 'after_recent_posts' ); ?>

<?php endif; ?>
