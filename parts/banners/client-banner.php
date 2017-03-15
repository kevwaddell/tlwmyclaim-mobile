<?php  
$account_pg = get_page_by_path( 'account-details' );
$dashboard_pg = get_page_by_path( 'dashboard' );
$your_claim_pg = get_page_by_path( 'your-claim' );	
$contact_pg = get_page_by_path( 'contact-us');	
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
	<a href="<?php echo get_permalink($contact_pg->ID ); ?>" class="red-btn btn btn-block">
		<i class="fa fa-envelope"></i>
		<?php echo get_the_title($contact_pg->ID); ?>
	</a>
	<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block btn-lg">
		<i class="fa fa-power-off fa-lg"></i>
		Log Out
	</a>
</div>	
