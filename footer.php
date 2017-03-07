	<?php if ( !current_user_can( 'administrator' ) ) { ?>
	<?php get_template_part( 'parts/global/freephone', 'number' ); ?>
	<?php } ?>
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( !current_user_can( 'administrator' ) ) { ?>
		<?php wp_nav_menu(array( 'container_class' => 'footer-links', 'theme_location' => 'footer-menu', 'fallback_cb' => false ) ); ?>
		<?php } ?>
		<div class="copyright-legal text-center">&copy; TLW Solicitors <?php echo date('Y'); ?>. All rights reserved.<br>Authorised and regulated by the <a href="http://www.sra.org.uk/home/home.page" target="_blank">Solicitors Regulation Authority</a></div>
		<a href="https://www.tlwsolicitors.co.uk" class="visit-site-btn btn btn-block btn-lg" target="_blank">Visit the <span>TLW Solicitors</span> website</a>
	</footer><!-- .site-footer -->

	
	</main><!-- .site-main -->
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>