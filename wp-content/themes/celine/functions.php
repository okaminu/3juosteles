<?php
/**
 * celine functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, celine_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'celine_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */

function catch_that_image() 
{
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all( '/<iframe.+title=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
    $first_img = $matches[1][0];

    //Defines a default image
    if( empty( $first_img ) )
    { 
        $first_img = '/images/default.jpg';
    }
    return $first_img;
}

 function display_images($size = thumbnail) {

	if($images = get_posts(array(
		'post_parent'    => get_the_ID(),
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image',
                'orderby'        => 'menu_order',
                'order'           => 'ASC',
	))) {
		foreach($images as $image) {
			$attimg   = wp_get_attachment_image($image->ID,$size);
echo "<br><br>";
echo "<div class='remas'>";
echo $attimg;
echo "</div>";

		}
	}
}
 //---------------------------------------------------------------------
 function straipsniai_pagal_likes($riba){ //perduodama riba, kiek straispniu rodoma
// start the action! 

	global $post,$myxml;

// Declare some helper vars
$previous_year = $year = 0;
$previous_month = $month = 0;
$ul_open = false;
 
// Get the posts
$myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');

// we love counters
$x = 0;
$y = 0;
$num_posts = count($myposts);

// build string of urls we query from FB, no comma at the end
foreach($myposts as $post) { 
	$urls .= get_permalink();
	if ($y < ($num_posts-1)) { $urls .= ",";}
	$y++;
}	

// API call: get counts
$countxml = simplexml_load_file("http://api.facebook.com/restserver.php?method=links.getStats&urls=$urls");
$cdata = get_object_vars($countxml);

$arr=array();

foreach($myposts as $post) { 
	// generate fb like & share counts
	$rurl = get_permalink();
	$fbcounts = "";
	
	foreach ($cdata['link_stat'][$x] as $k => $v) {
		switch($k) {
	    case "like_count":
		$arr[get_the_ID()]=$v;
	    break;
	    }
	}
			
	// post vars
	//setup_postdata($post);
 
	//$year = mysql2date('Y', $post->post_date);
	//$month = mysql2date('n', $post->post_date);
	//$day = mysql2date('j', $post->post_date);
 
$x++;
}

arsort($arr, SORT_NUMERIC);
$kiek=0;
echo "<div class='posts_by_like'>";
foreach($arr as $key => $value){
$title=get_the_title($key);
$link=get_permalink($key);
$likes=$value;

if($kiek<$riba):


echo "<div class='post_by_like_single'><a href=' $link '> $title ";
echo "</a> <span href=' $link '> ($likes)</span></div>";

$kiek++;
endif;

}
echo "</div>";
}
//------------------------------------------------------------
 
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run celine_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'celine_setup' );

if ( ! function_exists( 'celine_setup' ) ):

function celine_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'celine', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'celine' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', '' );

	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	if ( ! defined( 'HEADER_IMAGE' ) )
		define( 'HEADER_IMAGE', '%s/images/logo.png' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to celine_header_image_width and celine_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'celine_header_image_width', 576 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'celine_header_image_height', 191 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See celine_admin_header_style(), below.
	add_custom_image_header( '', 'celine_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/blue_bubbles.png',
			'thumbnail_url' => '%s/images/headers/blue_bubbles_thumb.png',
			/* translators: header image description */
			'description' => __( 'Blue Bubbles', 'celine' )
		),
		'cherryblossom' => array(
			'url' => '%s/images/headers/orange_bubbles.png',
			'thumbnail_url' => '%s/images/headers/orange_bubbles_thumb.png',
			/* translators: header image description */
			'description' => __( 'Orange Bubbles', 'celine' )
		),
		'concave' => array(
			'url' => '%s/images/headers/retro_stripes.png',
			'thumbnail_url' => '%s/images/headers/retro_stripes_thumb.png',
			/* translators: header image description */
			'description' => __( 'Retro Pinstripes', 'celine' )
		),
		'fern' => array(
			'url' => '%s/images/headers/retro_stripes_with_div.png',
			'thumbnail_url' => '%s/images/headers/retro_stripes_with_div_thumb.png',
			/* translators: header image description */
			'description' => __( 'Retro Pins 2', 'celine' )
		
		)
	) );
}
endif;

if ( ! function_exists( 'celine_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in celine_setup().
 *
 * @since Twenty Ten 1.0
 */
function celine_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 */
function celine_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'celine_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 */

 
function celine_excerpt_length( $length ) {
	return 0;
}



add_filter( 'excerpt_length', 'celine_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function celine_continue_reading_link() {
	return '<div class="entry-more"><a href="'. get_permalink() . '"><span>GIMME MOAR!</span></a></div>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and celine_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 * @return string An ellipsis
 */
function celine_auto_excerpt_more( $more ) {
	return    ' <div class="entry-more"><a href="'. get_permalink() . '"><span>GIMME MOAR!</span></a></div>';

	/*' &hellip;' . celine_continue_reading_link()*/;
}
add_filter( 'excerpt_more', 'celine_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 */
function celine_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= celine_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'celine_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function celine_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'celine_remove_gallery_css' );

if ( ! function_exists( 'celine_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own celine_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function celine_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">rašo:</span>', 'celine' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Jusu komentaras laukia patvirtinimo.', 'celine' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'celine' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'celine' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<!-- no reply form-->
		<div class="reply">
			<?php //comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
		
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'celine' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'celine' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override celine_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 */
function celine_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'celine' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'celine' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'celine' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'celine' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'celine' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'celine' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'celine' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'celine' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'celine' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'celine' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'celine' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'celine' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running celine_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'celine_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
 *
 */
function celine_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'celine_remove_recent_comments_style' );

if ( ! function_exists( 'celine_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function celine_posted_on() {
	printf( __( '<span class="%1$s">%2$s</span>  &nbsp;&nbsp;|&nbsp;&nbsp; <span class="meta-sep">Autorius:</span> %3$s &nbsp;&nbsp;|&nbsp;&nbsp;<span class="meta-sep"> Skleisk gerąją žinią:</span> 
	', 'celine' ),
		'meta-prep meta-prep-author',
		sprintf( '<span class="entry-date">%3$s</span>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>
		',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'celine' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'celine_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 */
function celine_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'celine' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'celine' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'celine' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;
