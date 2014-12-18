<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 */
?>


		<div id="primary" class="grid_4 widget-area" role="complementary"> 
			  <ul class="xoxo">

          <li class="grid_4 banner">
            <div class="inbanner">
			<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Ftrysjuosteles.lt&amp;
			width=270&amp;colorscheme=light&amp;show_faces=true&amp;border_color=c2c2c2&amp;stream=false&amp;header=false&amp;height=188"
			scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:269px; height:160px;" style=""
			allowTransparency="true"></iframe>
            </div>
          </li>
			
<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>

	
	
			<li id="search" class="search grid_4">
				<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div><label class="screen-reader-text" for="s">Search for:</label>
        <input type="text" value="Ieškomas raktažodis" name="s" id="s" onClick="clearSearch()"/>
        <input type="submit" id="searchsubmit" value="GO" />
    </div>
</form>
			</li>

			          <li class="grid_4 line_top">
            <img class="icon" src="/wp-content/themes/celine/images/ikona_skelk.png"  alt="Skelk taip, kad jaustųsi"/>
            <h2 class="side-title"><span>Skelk taip,</span><span>kad jaustųsi</span></h2>
            <p>Skelk naujieną, dainą, anekdotą - bet ką, kas tau ant liežuvio</p>
			<div id="comments" class="tavo">

<div id="respond">
<h3 id="reply-title"> <small><a rel="nofollow" id="cancel-comment-reply-link"
 href='/?cat=15#respond'style="display:none;">Cancel reply</a></small></h3>

<form action="http://3juosteles.lt/wp-comments-post.php" method="post" id="commentform">
<p class="comment-form-comment"><textarea id="skelk" name="comment" cols="45" rows="10" aria-required="true" onClick="clearSkelk()"></textarea></p>
<p class="form-submit">
<input class="submit" name="submit" type="submit" id="submit" value="SKELIU" />
<input type='hidden' name='comment_post_ID' value="170" id='comment_post_ID' />
<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
</p>

</form>
</div><!-- #respond -->
						
</div><!-- #comments -->
<br><br>
          </li> 
		  
		  
		  <?php
//pagauk sportininka naujausias atvaizdas
$recent = new WP_Query("cat=15&showposts=1");
$recent->the_post();
$straipsnID = get_the_ID();
		  
$images = get_children( array( 'post_parent' => $post->ID,
'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => -1 ) );
if ( $images ) :
$total_images = count( $images );
$image = array_shift( $images );
$image_img_tag = wp_get_attachment_image( $image->ID, 'large' );

endif;		
				?>
				
				<?php
//sukasi mp3 naujausias atvaizdas
$recent2 = new WP_Query("cat=19&showposts=1");
$recent2->the_post();
$straipsnID2 = get_the_ID();
		  
$arr=array('numberposts' => 1, 'category' => 19,'order' => 'DESC');

$postai=get_posts($arr);

foreach($postai as $postas):

$text=$postas->post_content;

endforeach;

$text=str_replace("httpv://youtu.be/", "", $text);

				?>
        <li class="grid_4 line_top" style="height:285px;">
            <img class="icon" src="/wp-content/themes/celine/images/ikona_sport.png" alt="Pagauk sportininką"/>
            <h2 class="side-title"><a href="/?cat=15"><span>Pagauk</span><span>sportininką!</span></a></h2>
			<p>Pamačius ar kitaip pagavus, būtinai paspausk šį mygtuką</p>
			<div class="remas_son"><a href="/?p=<?php echo $straipsnID ?>"><?php echo $image_img_tag;?></a></div>
			<a href="/?cat=15"><div class="submit" style="  text-indent:-10px;  left: 27px; top: -40px;"> PAGAVAU!</div></a>
        </li> 
		  
		<li class="grid_4 line_top" style="height: 180px">
            <h2 class="side-title-amfi"><a href="/?cat=6"><span>Amfiteatro</span><br><span style="left:75px; top:36px;"> Pašnekesiai</span></a></h2>
			<p style="width: 209px">Pamatei gražią merginą, <br>nori pasiulyti idėjų, <br>paklausti arba aptarti su visais,<br> ką šiandien nuveikei amfiteatre</p>
			<a href="/?cat=6"><div class="submit" style="  text-indent:-7px;   left: 0px; top: -55px;"> PARAŠYK!</div></a>
        </li> 
		  
        <li class="grid_4 line_top" style="height:309px;">
            <img class="icon" src="/wp-content/themes/celine/images/ikona_mp3.png" alt="Pas mus MP3 sukasi"/>
            <h2 class="side-title"><a href="/?cat=19"><span>Pas mus</span><span>MP3 sukasi</span></a></h2>
			<p>Skelbk kas "sukasi" pas tave</p>
			<div class="play"></div><span class="video_side_name"><?php the_title(); ?></span>
			<div class="remas_vid1"><div class="remas_vid"><iframe width="420" height="315" src="http://www.youtube.com/embed/<?php echo $text;?>" frameborder="0"></iframe></div></div>
			<a href="/?cat=19"><div class="submit"   style="text-indent:-5px; left: 27px; top: -40px;"> SKELBIU!</div></a>
        </li> 
		  
        <li class="grid_4 line_top">
            <img class="icon" src="/wp-content/themes/celine/images/ikona_pop.png" alt="Mūsų populiariausi"/>
            <h2 class="side-title"><span>Mūsų</span><span>populiariausi!</span></h2>
			<?php straipsniai_pagal_likes(5); ?>
		</li> 
			
		<li class="grid_4 line_top">
            <img class="icon" src="/wp-content/themes/celine/images/apie.png" alt="Apie mus"/>
            <h2 class="side-title"><a href="/?p=336"><span>Šiek Tiek apie mus</span></a></h2>
		</li>
			

		<?php endif; // end primary widget area ?>
			</ul>
		</div><!-- #primary .widget-area -->

<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

		<!-- #secondary .widget-area -->

<?php endif; ?>
