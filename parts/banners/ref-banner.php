<?php
$account_pg = get_page_by_path( 'account-details' );
$dashboard_pg = get_page_by_path( 'dashboard' );
$cases_pg =  get_option('page_for_posts');	
$contact_pg = get_page_by_path( 'contact-us');
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
		<?php echo get_the_title($cases_pg); ?> archive
	</a>
	<a href="<?php echo get_permalink($account_pg->ID ); ?>" class="red-btn btn btn-block">
		<i class="fa fa-vcard"></i>
		<?php echo get_the_title($account_pg->ID); ?>
	</a>
	<a href="<?php echo get_permalink($contact_pg->ID ); ?>" class="red-btn btn btn-block">
		<i class="fa fa-envelope"></i>
		<?php echo get_the_title($contact_pg->ID); ?>
	</a>
	<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block btn-lg">
		<i class="fa fa-power-off fa-lg"></i>
		Log Out
	</a>
</div>		
