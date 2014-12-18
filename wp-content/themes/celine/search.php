<?php
/**
 * The template for displaying Search Results pages.
 *
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'Paieškos rezultatai: %s', 'celine' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nerasta ', 'celine' ); ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Pakartokite paieška su kitais žodžiais.', 'celine' ); ?></p>
						<br>
						<?php //get_search_form(); Arba standartine, arba mano paieska?>
						
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
				<!--Mano paieska-->
				
<!--Mano Paieska end-->
<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
