<?php
/*  
  Plugin Name: Facebook Social Stats
  Version: 1.1
  Plugin URI: http://ninanet.com/dev_fbsocialstats.php
  Description: Shows facebook shares, likes, comments and total counts for all posts and provides a link to the facebook's page admin page (if available)
  Author: ninanet site solutions
  Author URI: http://ninanet.com/
*/

/*  

	Copyright 2011  ninanet site solutions (email: nin@ninanet.com)

*/

function initialize_fbsocialstats() {
?>
	<div class="wrap">  
		<h2>FB Social Stats</h2>
		<?php show_fbsocialstats(); ?>
	</div>  
<?}

# add to admin submenu in index.php
function submenu_fbsocialstats() {  
  add_submenu_page('index.php', 'FB Social Stats', 'FB Social Stats', 8, __FILE__, 'initialize_fbsocialstats');  
}  

// function to go get the included style sheet and put it in the header. Feel free to adjust it :)
function add_style_sheet() {
	$siteurl = get_option('siteurl');
	$surl = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/style.css';
	echo "<link rel='stylesheet' type='text/css' href='$surl' />\n";
}


# The Hooks  
add_action('admin_head', 'add_style_sheet');
add_action('admin_menu', 'submenu_fbsocialstats');


// start the action! 
function show_fbsocialstats() {
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

echo '<div class="fbshareoutput">';
foreach($myposts as $post) { 
	// generate fb like & share counts
	$rurl = get_permalink();
	$fbcounts = "";
	
	foreach ($cdata['link_stat'][$x] as $k => $v) {
		switch($k) {
	    case "share_count":
	    $fbcounts .= "Shares: $v | ";
	    break;
	    case "like_count":
	    $fbcounts .= "Likes: $v | ";
	    break;
	    case "comment_count":
	    $fbcounts .= "Comments: $v | ";
	    break;
	    case "total_count":
	    $fbcounts .= "Total: $v | ";
	    break;
	    case "click_count":
	    $fbcounts .= "Clicks: $v ";
	    break;
	    }
	}
	
		
	// post vars
	setup_postdata($post);
 
	$year = mysql2date('Y', $post->post_date);
	$month = mysql2date('n', $post->post_date);
	$day = mysql2date('j', $post->post_date);
 
	?>
 	
	<?php if($year != $previous_year || $month != $previous_month) : ?>
 
		<?php if($ul_open == true) : ?>
		</ul>
		<?php endif; ?>
 
		<h3 class="month_archive"><?php the_time('F Y'); ?></h3>
 		<ul class="month_archive">
 
		<?php $ul_open = true; ?>
 
	<?php endif; ?>
 
	<?php $previous_year = $year; $previous_month = $month; ?>
 
	<li><div class="the_day"><?php the_time('M j Y'); ?></div> <div class="the_article"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <div id="fbout_<?=$x;?>" class="fbcount"><?=$fbcounts?></div></div></li>
	<?$x++;?>
<? } ?>
	</ul>
	</div>
<?php
}
?>
