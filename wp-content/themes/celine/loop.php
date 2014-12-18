<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 */
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>

	<div id="nav-above" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr; Seniau skaičiau</span>', 'celine' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( '<span class="meta-nav">Naujesni Straipsniai &rarr;</span>', 'celine' ) ); ?></div>
	</div><!-- #nav-above -->
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>

	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Nėra Straipsnių', 'celine' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Šioje kategorijoje nėra straipsnių', 'celine' ); ?></p>
			<br>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>

	<?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'celine' ) ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" 
			title="<?php printf( esc_attr__( 'Permalink to %s', 'celine' ), 
			the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="comment-count clearfix">
            <a href="<?php the_permalink(); ?>#comments"><fb:comments-count href="<?php the_permalink(); ?>"></fb:comments-count></a>     
          </div>
			
			
			<div class="entry-meta grid_9">
				<?php celine_posted_on(); ?>
				<span class="social-links">
              <a href="http://facebook.com/share.php?u=<?php the_permalink(); ?>" title="Facebook" target="_blank"><img src="/wp-content/themes/celine/images/icon_facebook.png" alt="Facebook"/></a>			
              <a href="http://twitter.com/intent/tweet?via=trysjuosteles&amp;text=<?php the_title(); ?>;url=<?php the_permalink(); ?>;hastags=trysjuosteles" title="Twitter"><img src="/wp-content/themes/celine/images/icon_twitter.png" alt="Twitter"/></a>			
              <a href="mailto:?subject=Geras%20straipsnis%20(trysjuosteles.lt)&amp;body=Sveikas,%20paskaityk%20<?php the_permalink(); ?>%20@%203juosteles.lt" title="Mail"><img src="/wp-content/themes/celine/images/icon_mail.png" alt="Mail"/></a>
            </span>
			</div><!-- .entry-meta 1-->

			<div class="entry-content">
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'celine' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'celine' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								number_format_i18n( $total_images )
							); ?></em></p>
				<?php endif; ?>
						<?php the_excerpt(); ?>
						
						<br><br>
						<div class="entry-like">
				
            <span><span>paLIKE'inu!&nbsp;&nbsp;<iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=47&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" style="border:none; overflow:hidden; width:47px; height:20px;" seamless></iframe></span></span> 
          </div>
						
<?php endif; ?>
			</div><!-- .entry-content -->

			
		</div><!-- #post-## -->

<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>

	<?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'celine' ) )  ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'celine' ) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<div class="entry-utility">
				<?php celine_posted_on(); ?>
				
				<span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'celine' ), __( '1 Comment', 'celine' ), __( '% Comments', 'celine' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'celine' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php /* How to display all other posts. */ ?>

	<?php else : ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<meta property="og:image" content="http://3juosteles.lt/wp-content/themes/celine/images/3j.jpg"/>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" 
			title="<?php printf( esc_attr__( 'Permalink to %s', 'celine' ), 
			the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			
			 
	
		  <?php if(!is_page()):?>
		  <div class="comment-count clearfix">
            <a href="<?php the_permalink(); ?>#comments"><fb:comments-count href="<?php the_permalink(); ?>"></fb:comments-count></a>     
          </div>
		  
			<div class="entry-meta grid_9">
				<?php celine_posted_on(); ?>
				<span class="social-links">
              <a href="http://facebook.com/share.php?u=<?php the_permalink(); ?>" title="Facebook" target="_blank"><img src="/wp-content/themes/celine/images/icon_facebook.png" alt="Facebook"/></a>			
              <a href="http://twitter.com/intent/tweet?via=trysjuosteles&amp;text=<?php the_title(); ?>;url=<?php the_permalink(); ?>;hastags=trysjuosteles" title="Twitter"><img src="/wp-content/themes/celine/images/icon_twitter.png" alt="Twitter"/></a>			
              <a href="mailto:?subject=Geras%20straipsnis%20(trysjuosteles.lt)&amp;body=Sveikas,%20paskaityk%20<?php the_permalink(); ?>%20@%203juosteles.lt" title="Mail"><img src="/wp-content/themes/celine/images/icon_mail.png" alt="Mail"/></a>
            </span>
			</div><!-- .entry-meta -->
<?php endif;?>
	<?php if ( !1==1 ) : // Paieskai ir archyvui, ir kategorijom' if ( is_archive() || is_search() ) : '?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	<?php else : ?>
	
			<div class="entry-content grid_9">
			<?php if(!is_page()):?>
				<?php //the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'celine' ) );
                      the_content();?>
				<?php else:?>
				<?php the_content(); ?>
				
				<?php endif;?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Puslapis:', 'celine' ), 'po' => '</div>' ) ); ?>
				
				<?php
					$images = get_children( array( 'post_parent' => $post->ID,
					'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => -1 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'large' );
						

						if(the_category_ID($echo)!=19):
						echo "<br><br><br>";
						echo "<div class='remas'>";
						echo $image_img_tag; /*vienam image - $image_img_tag, visiem display_images('large')*/
						echo "</div><!-- .gallery-thumb -->";
						endif;					
						
						?>
						
						
						

				<?php endif; ?>
<?php if(!is_page()):?>
<div class="clear"></div>

				<div class="entry-like">
				
            <span><span>paLIKE'inu!&nbsp;&nbsp;<iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=47&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" style="border:none; overflow:hidden; width:47px; height:20px;"></iframe></span></span> 
          </div>
		 <?php endif;?> 
			</div><!-- .entry-content -->
	<?php endif; ?>

			<div class="entry-utility">
				<?php if ( count( get_the_category() ) ) : ?>
					
					
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<span class="tag-links">
						<?php printf( __( '<!---<span class="%1$s">Tagged</span> %2$s --->', 'celine' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</span>
					
				<?php endif; ?> 
				<!--Skirta komantaru lapui atsirasti-->
				 <!---<span class="comments-link"><?php //comments_popup_link( __( 'Leave a comment', 'celine' ), __( '1 Comment', 'celine' ), __( '% Comments', 'celine' ) ); */?></span> -->
				<?php //edit_post_link( __( 'Redaguoti', 'celine' ), ' <div class="edit-link">', '</div>' ); */?>
				
			</div><!-- .entry-utility -->
			
		    </div><!-- #post-## -->

		<?php// comments_template( '', true ); ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr; Seniau skaičiau</span>', 'celine' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( '<span class="meta-nav">Naujesni Straipsniai &rarr;</span>', 'celine' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>
