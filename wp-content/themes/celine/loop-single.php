<?php


//CIA TALPINTI APATINIO BANNERIO ATVAIZDO NUORODA (bannerio ismatavimai 100x670, m-top m-left 16px, class= banner)


$BANNERIO_NUORODA2="<img class='banner' src='http://3juosteles.lt/wp-content/themes/celine/images/banner_test.jpg'>";


//RASYTI True JEI IJUNGTI BANNERI, False JEI ISJUNGTI
$RodytiBanneri2=True;





















?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                 <!--Virsutine navigacija tarp straipsniu-->
				<!--<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php //previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'celine' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php //next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'celine' ) . '</span>' ); ?></div>
				</div>--><!-- #nav-above -->
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" 
			title="<?php printf( esc_attr__( 'Permalink to %s', 'celine' ), 
			the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			
			
					<div class="entry-meta">
						<?php celine_posted_on(); ?>
						<span class="social-links">
              <a href="http://facebook.com/share.php?u=<?php the_permalink(); ?>" title="Facebook" target="_blank"><img src="/wp-content/themes/celine/images/icon_facebook.png" alt="Facebook"/></a>			
              <a href="http://twitter.com/intent/tweet?via=trysjuosteles&amp;text=<?php the_title(); ?>;url=<?php the_permalink(); ?>;hastags=trysjuosteles" title="Twitter"><img src="/wp-content/themes/celine/images/icon_twitter.png" alt="Twitter"/></a>			
              <a href="mailto:?subject=Geras%20straipsnis%20(trysjuosteles.lt)&amp;body=Sveikas,%20paskaityk%20<?php the_permalink(); ?>%20@%20trysjuosteles.lt" title="Mail"><img src="/wp-content/themes/celine/images/icon_mail.png" alt="Mail"/></a>
            </span>
					</div><!-- .entry-meta -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'celine' ), 'after' => '</div>' ) ); ?>
						
						
						<?php 
						if(the_category_ID($echo)!=19):
						echo display_images('large'); /*vienam image - $image_img_tag, visiem display_images('large')*/
						endif;
						
						?>
						<!-- .gallery-thumb -->				
						
						<div class="entry-like">
				
            <span><span>paLIKE'inu!&nbsp;&nbsp;<iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=47&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" style="border:none; overflow:hidden; width:47px; height:20px;"></iframe></span></span> 
          </div>
					</div><!-- .entry-content -->

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'celine_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'celine' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'celine' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
<?php endif; ?>


					<div class="entry-utility">
						<?php// celine_posted_in(); ?>
						<?php //edit_post_link( __( 'Edit', 'celine' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->
				
				<!--Apatine navigacija tarp straipsniu-->
				<!--<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php //previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'celine' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php //next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'celine' ) . '</span>' ); ?></div>
				</div>-->
				<!-- #nav-below -->
				<!--FB komentarai-->
<?php
if($RodytiBanneri2){
				
		echo "<div class='reklama2'>";
                //echo "".$BANNERIO_NUORODA."";
		$id=859;
			$pageas=get_page($id);
			


				
		wp_swfobject_echo($pageas->post_content, "670", "100");
                echo "</div>";	
	}				
					?>	
				
				
				
			<div id="fb-root"></div>
    <script type="text/javascript" src="http://connect.facebook.net/lt_LT/all.js"></script>
    <script>
      FB.init(
        {
          appId: '118476611572823',
          status: true,
          cookie: true,
          xfbml: true
        }
      );
    </script>
    <fb:comments href="<?php the_permalink(); ?>" num_posts="8" width="500"></fb:comments>
				<?php //comments_template( '', true ); ?>


<?php endwhile; // end of the loop. ?>