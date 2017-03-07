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
			$account_pg = get_page_by_path( 'your-account' );	
			?>
				
				<?php if ($user_type == 'client') { 
				$dashboard_pg = get_page_by_path( 'dashboard' );
				$your_claim_pg = get_page_by_path( 'your-claim' );	
				?>
				<div class="container-fluid">
				<?php the_content(); ?>
				</div>	
				
				<div class="banner-links">	
					<a href="<?php echo get_permalink($dashboard_pg->ID ); ?>" class="red-btn btn btn-block">
						<i class="fa fa-dashboard"></i>
						<?php echo get_the_title($dashboard_pg->ID); ?>
					</a>
					<a href="<?php echo get_permalink($your_claim_pg->ID ); ?>" class="red-btn btn btn-block">
						<i class="fa fa-folder-open"></i>
						<?php echo get_the_title($your_claim_pg->ID); ?>
					</a>
					<a href="<?php echo get_permalink($account_pg->ID ); ?>" class="red-btn btn btn-block">
						<i class="fa fa-vcard"></i>
						<?php echo get_the_title($account_pg->ID); ?>
					</a>
					<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block btn-lg">
						<i class="fa fa-power-off fa-lg"></i>
						Log Out
					</a>
				</div>	
				<?php } ?>
				
				<?php if ($user_type == 'ref') { 
				$dashboard_pg = get_page_by_path( 'dashboard' );
				$cases_pg =  get_option('page_for_posts');	
				$banner_intro = get_field( 'hp_banner_ref_intro', 'options' );	
				?>
				<div class="container-fluid">
				<?php echo $banner_intro; ?>
				</div>
				<div class="banner-links">
					<a href="<?php echo get_permalink($dashboard_pg->ID ); ?>" class="red-btn btn btn-block">
						<i class="fa fa-dashboard"></i>
						<?php echo get_the_title($dashboard_pg->ID); ?>
					</a>
					<a href="<?php echo get_permalink($cases_pg); ?>" class="red-btn btn btn-block">
						<i class="fa fa-folder-open"></i>
						<?php echo get_the_title($cases_pg); ?>
					</a>
					<a href="<?php echo get_permalink($account_pg->ID ); ?>" class="red-btn btn btn-block">
						<i class="fa fa-vcard"></i>
						<?php echo get_the_title($account_pg->ID); ?>
					</a>
					<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block btn-lg">
						<i class="fa fa-power-off fa-lg"></i>
						Log Out
					</a>
				</div>		
				<?php } ?>
				
				<?php if ($user_type == 'admin') { 
				$cases_pg =  get_option('page_for_posts');
				$clients_pg = get_page_by_path( 'clients' );
				$referrers_pg = get_page_by_path( 'referrers' );
				$banner_intro = get_field( 'hp_banner_admin_intro', 'options' );		
				?>
				<div class="container-fluid">
				<?php echo $banner_intro; ?>
				</div>
				<div class="banner-links">	
					<a href="<?php echo get_permalink($cases_pg); ?>" class="red-btn btn btn-block">
						<i class="fa fa-folder-open"></i>
						<?php echo get_the_title($cases_pg); ?>
					</a>
					<a href="<?php echo get_permalink($clients_pg->ID ); ?>" class="red-btn btn btn-block">
						<i class="fa fa-users"></i>
						<?php echo get_the_title($clients_pg->ID); ?>
					</a>
					<a href="<?php echo get_permalink($referrers_pg->ID ); ?>" class="red-btn btn btn-block">
						<i class="fa fa-building"></i>
						<?php echo get_the_title($referrers_pg->ID); ?>
					</a>
					<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block btn-lg">
						<i class="fa fa-power-off fa-lg"></i>
						Log Out
					</a>
				</div>	
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