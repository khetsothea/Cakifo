<?php
/**
 * 404 Template
 *
 * The 404 template is used when a reader visits an invalid URL on your site. By default, the template will 
 * display a generic message.
 *
 * @package Cakifo
 * @subpackage Template
 * @link http://codex.wordpress.org/Creating_an_Error_404_Page
 */

@header( 'HTTP/1.1 404 Not found', true, 404 );

get_header(); // Loads the header.php template ?>

	<?php do_atomic( 'before_main' ); // cakifo_before_main ?>

    <div id="main">

        <?php do_atomic( 'open_main' ); // cakifo_open_main ?>
        
            <div id="post-0" class="<?php hybrid_entry_class(); ?>">
            
                <h1 class="error-404-title entry-title"><?php _e( 'Not Found', hybrid_get_textdomain() ); ?></h1>
                
                <div class="entry-content">
                    <p>
                        <?php printf( __( 'You tried going to %1$s, and it doesn\'t exist. All is not lost! You can search for what you\'re looking for.', hybrid_get_textdomain() ), '<code>' . site_url( esc_url( $_SERVER['REQUEST_URI'] ) ) . '</code>' ); ?>
                    </p>
                    
                    <?php get_search_form(); // Loads the searchform.php template. ?>
                    </div> <!-- .entry-content -->
            
            </div> <!-- .hentry -->
            
        <?php do_atomic( 'close_main' ); // cakifo_close_main ?>
        
    </div> <!-- #main -->

    <?php do_atomic( 'after_main' ); // cakifo_after_main ?>

<?php get_footer(); // Loads the footer.php template ?>