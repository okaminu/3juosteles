<?php
/**
 * The template for displaying Category Archive pages.
 */

get_header(); ?>

		<div id="container">
		
			<div id="content" role="main">

				<span class="kategorija"><?php
				echo single_cat_title( '', false );
				?></span>
	<?php				
$cat = get_category_by_path(get_query_var('category_name'),false);
$current = $cat->cat_ID;
$recent = new WP_Query("cat=".$current."&showposts=1");
$recent->the_post();
$straipsnID = $post->id;
 if($current==15): ?>
<div id="comments">

<div id="respond">
<h3 id="reply-title"> <small><a rel="nofollow" id="cancel-comment-reply-link"
 <?php $cat = get_category_by_path(get_query_var('category_name'),false);
$current = $cat->cat_ID; 
echo "href='/?cat=$current#respond'" ?>
style="display:none;">Cancel reply</a></small></h3>
<form action="http://3juosteles.lt/wp-comments-post.php" method="post" id="commentform">
<p class="comment-form-comment"><label for="comment" style="font-size:15px">Irašyk atvaizdo adresą</label><textarea id="comment" name="comment" cols="45" rows="2" aria-required="true"></textarea></p>												<p class="form-submit">
<input name="submit" type="submit" id="submit" value="Skelbk" />
<input type='hidden' name='comment_post_ID' value="159" id='comment_post_ID' />
<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
</p>
</form>
</div><!-- #respond -->
						
</div><!-- #comments -->
	
 
<?php endif; ?>	

<?php //------------------------------------------------------------?>
<?php				
$cat = get_category_by_path(get_query_var('category_name'),false);
$current = $cat->cat_ID;
$recent = new WP_Query("cat=".$current."&showposts=1");
$recent->the_post();
$straipsnID = $post->id;
 if($current==19): ?>
<div id="comments">

<div id="respond">
<h3 id="reply-title"> <small><a rel="nofollow" id="cancel-comment-reply-link"
 <?php $cat = get_category_by_path(get_query_var('category_name'),false);
$current = $cat->cat_ID; 
echo "href='/?cat=$current#respond'" ?>
style="display:none;">Cancel reply</a></small></h3>
<form action="http://3juosteles.lt/wp-comments-post.php" method="post" id="commentform">
<p class="comment-form-comment"><label for="comment" style="font-size:15px">Irašyk video įrašo adresą</label><textarea id="comment" name="comment" cols="45" rows="2" aria-required="true"></textarea></p>												<p class="form-submit">
<input name="submit" type="submit" id="submit" value="Skelbk" />
<input type='hidden' name='comment_post_ID' value="157" id='comment_post_ID' />
<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
</p>
</form>
</div><!-- #respond -->
						
</div><!-- #comments -->
	
 
<?php endif; ?>	
				
				
				
				<?php
					

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */

				get_template_part( 'loop', 'category' );
				?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
