<?php 
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
