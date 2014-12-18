<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
 
<head>

<link rel="image_src" href="http://3juosteles.lt/wp-content/themes/celine/images/3j.jpg" />
<meta property="og:image" content="http://3juosteles.lt/wp-content/themes/celine/images/3j.jpg"/>
	


<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="icon" href="wp-content/themes/celine/images/favicon.ico" type="image/x-icon"/>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'celine' ), max( $paged, $page ) );

	?></title>
	
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<script src="/wp-content/themes/celine/JavaSkriptasUP.js">

</script>
<!--Google Analytics-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-24953025-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28171062-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>


<body <?php body_class(); ?> onLoad="bodyInit()">

<div id="wrapper">
	<div id="header">
		<div id="masthead">
			<div id="branding" role="banner">
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				
				

				<?php
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
  //$cat = get_category_by_path(get_query_var('category_name'),false);
  //$current = $cat->cat_ID;

  //$recent = new WP_Query("cat=".$current."&showposts=1"); $recent->the_post();

					if (!is_home() && current_theme_supports( 'post-thumbnails' ) &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID );
					elseif ( get_header_image() ) : ?>
						<a title="Grįžti į Pradžią" href="http://3juosteles.lt"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
						</a>
					<?php endif; ?>
					


                                                                                                         
        <div id="VirsutinisMeniu">
<ul class="AktyvusMeniu">

	  	<li id="Skaitalai" class="sritisUnMarked" onMouseOver="MeniuOpen('Skaitalai')" onMouseOut="MeniuClose('Skaitalai')" style="left:30px" onmousedown="return false;" onselectstart="return false;">
		Skaitalai
		</li> 
		<li id="Video" class="sritisUnMarked" onMouseOver="MeniuOpen('Video')" onMouseOut="MeniuClose('Video')" style="left:95px" onmousedown="return false;" onselectstart="return false;">
		Video
		</li>  
		<li id="Audio" class="sritisUnMarked" onMouseOver="MeniuOpen('Audio')" onMouseOut="MeniuClose('Audio')" style="left:125px" onmousedown="return false;" onselectstart="return false;">
		Audio
		</li> 
		<li id="Foto" class="sritisUnMarked" onMouseOver="MeniuOpen('Foto')" onMouseOut="MeniuClose('Foto')" style="left:155px" onmousedown="return false;" onselectstart="return false;">
		Foto
		</li> 
		<li id="Sms" class="sritisUnMarked" onMouseOver="MeniuOpen('Sms')" onMouseOut="MeniuClose('Sms')" style="left:175px" onmousedown="return false;" onselectstart="return false;">
		Kitur_Netilpo
		</li> 		
</ul>

<ul class="AktyvusMeniuSub">

	  	<li class="sritisSub" onMouseOver="MeniuOpen('Skaitalai')" onMouseOut="MeniuClose('Skaitalai')" style="left:-260px;">
		  <span id="SkaitalaiSub" class="SubMeniuHidden">
		  <a href="/index.php">Trys Juostelės</a>
		  <a href="/?cat=5">Turisto apklausa</a>
		  <a href="/?cat=6">Amfiteatro rubrika</a>
		  <a href="/?cat=7">Super įvykis</a>
		  </span>
		</li> 
		<li class="sritisSub" onMouseOver="MeniuOpen('Video')" onMouseOut="MeniuClose('Video')" style="left:-155px">
		  <span id="VideoSub" class="SubMeniuHidden">
		  <a href="/?cat=8">Video Blogas</a>
		  <a href="/?cat=9">Tutorialas</a>
		  <a href="/?cat=10">Už jūrų</a>
		  <a href="/?cat=11">Šiandien mačiau</a>
		  </span>
		</li> 
		<li class="sritisSub" onMouseOver="MeniuOpen('Audio')" onMouseOut="MeniuClose('Audio')" style="left:-45px">
		  <span id="AudioSub" class="SubMeniuHidden">
		  <a href="/?cat=12">Dienos judesiukas</a>
		  <a href="/?cat=13">Dabar klausau</a>
		  <a href="/?cat=14">Šios savaitės renginukai</a>
		  </span>
		</li> 
		<li class="sritisSub" onMouseOver="MeniuOpen('Foto')" onMouseOut="MeniuClose('Foto')" style="left:50px;">
		  <span id="FotoSub" class="SubMeniuHidden">
		  <a  href="/?cat=15" style="left:20px;">Pagauk sportininką</a>
		  <a  href="/?cat=16" style="left:20px;">Dienos foto</a>
		  </span>
		</li> 
		<li class="sritisSub" onMouseOver="MeniuOpen('Sms')" onMouseOut="MeniuClose('Sms')" style="left:140px;">
		  <span id="SmsSub" class="SubMeniuHidden">
		  <a href="/?cat=17">Reikia patarimo</a>
		  <a href="/?cat=18">Kiečiausi dienos komentarai</a>
		  </span>
		</li>		
</ul>
        </div>

					<div class="clear"></div>
			</div><!-- #branding -->
<div class="clear"></div>




			<!-- #access -->
		</div><!-- #masthead -->
		
	</div><!-- #header -->
<br>
	<div id="main" style="width:1000px">
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