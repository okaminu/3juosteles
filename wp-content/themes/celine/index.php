<?php

//CIA TALPINTI VIRSUTINIO BANNERIO ATVAIZDO NUORODA (bannerio ismatavimai 100x670, m-top m-left 16px, class= banner)

$BANNERIO_NUORODA="<img class='banner' src='http://3juosteles.lt/wp-content/themes/celine/images/banner_test.jpg'>";




//RASYTI True JEI IJUNGTI BANNERI, False JEI ISJUNGTI

$RodytiBanneri1=True;




















get_header(); 

		echo "<div id='container'>";if($RodytiBanneri1){
		echo "<div class='reklama'>";
                //echo "".$BANNERIO_NUORODA."";
				
			$id=857;
			$pageas=get_page($id);
			


				
		wp_swfobject_echo($pageas->post_content, "670", "100"); 
                echo "</div>";	


	
}
		
		
	?>
		
			<div id="content" role="main">

			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'index' );
			?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
