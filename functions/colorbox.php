<?php
/**
 * Colorbox script
 *
 * Adds the Colorbox jQuery lightbox script to the theme if supported.
 *
 * Supported by default, remove it in a child theme with
 * remove_theme_support( 'cakifo-colorbox' );
 *
 * @package		Cakifo
 * @subpackage	Functions
 * @version		1.3
 * @link		http://jacklmoore.com/colorbox/
 */

add_action( 'wp_enqueue_scripts', 'cakifo_colorbox_script' );
add_action( 'wp_footer', 'cakifo_colorbox', 100 );

/**
 * Load the Colorbox script and style
 *
 * @uses	wp_enqueue_script()
 * @uses	wp_enqueue_style()
 *
 * @since	1.3
 */
function cakifo_colorbox_script() {
	wp_enqueue_script( 'colorbox', THEME_URI . '/js/jquery.colorbox-min.js', array( 'jquery' ), '1.3.18', true );
	wp_enqueue_style( 'colorbox', THEME_URI . '/css/colorbox.css', array(), '1.3', 'screen' );
}

/**
 * Prints the Colorbox script in the footer
 *
 * @since	1.3
 */
function cakifo_colorbox() {

	/**
	 * See all arguments at http://jacklmoore.com/colorbox/
	 */
	$defaults = array(
		'selector' => '.colorbox',
		'maxWidth' => '80%',
		'maxHeight' => '80%',
		'opacity' => '0.6', // For modern browsers that support CSS3 gradients this will be actually be 1
		'fixed' => true,
		'slideshowStart' => '\u25B6',
		'slideshowStop' => 'll',
	);

	$args = array();

	/**
	 * Allow child themes to filter the arguments. Use it like this:
	 *
	 * add_filter( 'cakifo_colorbox_args', 'my_child_colorbox_args' );
	 * function my_child_colorbox_args( $args ) {
	 * 		$args['selector'] = '.colorbox, .my-new-awesome-selector';
     *		return $args;
	 *	}
	 */
	$args = apply_filters( 'cakifo_colorbox_args', $args );

	/**
	 * Parse incoming $args into an array and merge it with $defaults
	 */
	$args = wp_parse_args( $args, $defaults );

	// Get the selector and remove it from the arguments
	$selector = $args['selector'];
	unset( $args['selector'] );

	// JSON encode the arguments
	$json = json_encode( $args );

	echo "<script>
			jQuery(document).ready(function($) {
				$('" . esc_js( $selector ) . "').colorbox(
					{$json}
				);
			});
		</script>";
}

?>