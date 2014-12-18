<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 */
?>
	<!-- #main -->


<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	/*get_sidebar( 'footer' );*/
?>

 <footer role="contentinfo" class="grid_13"> 
        <div id="colophon">
          <div id="inside">
            
            <div id="footer-navi" class="grid_9 sufix_2 omega">
             <div></div>
            </div>
            <div id="footer-contacts" class="grid_9 sufix_2 omega">
            </div> 
Programavimas: AurimasDGT (aurimasdgt@gmail.com) 
<br>Dizainas: Aurimas Preilauskas
<br>Svetainės talpinimas: UAB HOSTEX 
<br>Kontaktai: info@3juosteles.lt
<br>Tel. nr. 8 638 19172

</div>
          
        </div><!-- #colophon --> 
		<script src="/wp-content/themes/celine/JavaSkriptasDOWN.js">

</script>
      </footer><!-- #footer -->
      <div class="clear-bottom">&nbsp;</div> 
    </div><!-- #container --> 

      

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>
