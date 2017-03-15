<?php get_header(); ?>
<?php $banner_img = get_field( 'hp_banner_img', 'options' ); ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
		
		<article <?php post_class('front-page'); ?>>
			<div class="hp-banner jumbotron wht-border-bottom">
				<div class="hp-img" style="background-image: url(<?php echo $banner_img; ?>)"></div>
			<?php if (is_user_logged_in()) { 
			global $current_user;
			$user_id = $current_user->ID;
			$user_type = get_user_meta( $user_id, 'user_type', true);	
			?>
				
				<?php if ($user_type == 'client') { ?>
				<?php get_template_part( 'parts/banners/client', 'banner' ); ?>
				<?php } ?>
				
				<?php if ($user_type == 'ref') { ?>
				<?php get_template_part( 'parts/banners/ref', 'banner' ); ?>
				<?php } ?>
				
				<?php if ($user_type == 'admin') { 	?>
				<?php get_template_part( 'parts/banners/admin', 'banner' ); ?>				
				<?php } ?>

			<?php } else {
			$login_pg = get_page_by_path( 'login' );
			$banner_intro = get_field( 'hp_banner_intro', 'options' );
			?>
			
				<div class="container-fluid">
				<?php echo $banner_intro; ?>
				</div>
				<div class="banner-links">
					<a href="<?php echo get_permalink( $login_pg->ID ); ?>" class="red-btn btn btn-block"><i class="fa fa-sign-in"></i>Login now</a>
				</div>

			<?php }	?>
				</div>
		</article><!-- #post-## -->
	
	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>