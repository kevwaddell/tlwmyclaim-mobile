<?php 
/*
Template Name: User Claims Page
*/
?>
<?php if ( is_user_logged_in() ) { ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
		
		<?php 
		$account_pg = get_page_by_path( 'account-details' );
		$contact_pg = get_page_by_path( 'contact-us');
		$dashboard_pg = get_page_by_path( 'dashboard' );
		?>
		<div class="jumbotron wht-border-bottom">
				<div class="container-fluid">
				<?php the_content(); ?>	
				</div>
		</div>
		<article id="user-account-info" <?php post_class(); ?>>

			<?php
			$user_id = $current_user->ID;
			
			$claims_args = array(
				'posts_per_page' => 1,
				'post_type'		=> 'post',
				'post_status'	=>	'private',
				'author'	=> $user_id,
				'orderby'	=> 'date'
			);
			$claims = get_posts( $claims_args );
			//echo '<pre class="debug">';print_r($claims);echo '</pre>';
			?>
			<section class="claims-list">
				<?php
				$case_progress_raw = get_post_meta( $claims[0]->ID, 'case_progress', true );
				$case_progress = unserialize($case_progress_raw);
				$fee_earner_raw = get_post_meta( $claims[0]->ID, 'fee_earner', true );
				$fee_earner = unserialize($fee_earner_raw);
				$claim_details_raw = get_post_meta( $claims[0]->ID, 'claim_details', true );
				$claim_details = unserialize($claim_details_raw);
				$case_ref = get_post_meta( $claims[0]->ID, 'case_ref', true);
				?>
				

				<div class="alert alert-info text-center case-progress">
			 		<?php 
				 	$case_progress = array_reverse($case_progress); 
				 	$date = date('l jS F, Y', strtotime( str_replace('/','-',$case_progress[0]['date']) ) );
				 	$status = $case_progress[0]['status'];
				 	?>
				 	<div class="icon">
					 	<i class="fa fa-hourglass-half fa-2x"></i>
					 	<div class="icon-label">Progress Report</div>
				 	</div>
				 	
					<div class="status-date"><?php echo $date; ?></div>
					<div class="case-details"><span>Case type: <?php echo $claim_details['claim-type']; ?></span><br><span>Case Ref: <?php echo $case_ref; ?></span></div>
					<div class="case-status"><i class="fa fa-check-circle txt-col-orange-dk fa-lg"></i> <?php echo $status; ?></div>
					
				</div>
			
				<div class="panel panel-default">
		
			 		<div class="panel-heading text-center">Case details</div>	
			
					<table class="table table-bordered text-center">
					<tbody>
						<tr>
							<th width="50%" class="text-center">Claim Reference</th>
							<th width="50%" class="text-center">Date created</th>
					  	</tr>
					  	<tr>
							<td><strong><?php echo $case_ref; ?></strong></td>
							<td><strong><?php echo $case_progress[0]['date']; ?></strong></td>
					  	</tr>
					  	<tr>
							<th class="text-center">Claim Type</th>
							<th class="text-center">Accident Date</th>
					  	</tr>
					  	<tr>
							<td><strong><?php echo $claim_details['claim-type']; ?></strong></td>
							<td><strong><?php echo $claim_details['accident-date']; ?></strong></td>
					  	</tr>
					  	<tr>
							<th class="text-center">Case handler</th>
							<th class="text-center">Case handler Email</th>
					  	</tr>
					  	<tr>
							<td><strong><?php echo $fee_earner['name']; ?></strong></td>
							<td><strong><a href="mailto:<?php echo $fee_earner['email']; ?>"><?php echo $fee_earner['email']; ?></a></strong></td>
					  	</tr>
					</tbody>
				</table>
						
				</div>	

				<?php if (count($case_progress) > 0) { ?>
				<div class="panel panel-default">

		 		<div class="panel-heading text-center">Case history</div>	
		
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="5%" class="text-center"><i class="fa fa-info-circle"></i></th>
							<th width="30%" class="text-center">Date</th>
							<th width="65%" class="text-center">Details</th>
						</tr>
					  	<?php 
						//array_shift($case_progress);
						foreach ($case_progress as $k => $progress) {
					  	?>
					  	<tr class="<?php echo ($k == 0) ? 'warning' : 'success'; ?>">
						  	<td class="text-center"><i class="fa <?php echo ($k == 0) ? 'fa-hourglass-half text-warning' : 'fa-check-circle text-success'; ?>"></i></td>
						  	<td class="text-center"><strong><?php echo $progress['date']; ?></strong></td>
						  	<td class="text-center"><?php echo $progress['status']; ?></td>
						</tr>	
					  	<?php } ?>
					  	
					</tbody>
				</table>
				
			</div>
				<?php } ?>
				
				<button id="contact-handler-btn" class="red-btn btn btn-block btn-lg"><i class="fa fa-comments fa-lg"></i>Message case handler</button>
				<a href="<?php echo get_permalink( $dashboard_pg->ID ); ?>" class="red-btn btn btn-block btn-lg"><i class="fa fa-dashboard fa-lg"></i><?php echo get_the_title($dashboard_pg->ID); ?></a>
				<a href="<?php echo get_permalink( $account_pg->ID ); ?>" class="red-btn btn btn-block btn-lg"><i class="fa fa-vcard fa-lg"></i><?php echo get_the_title($account_pg->ID); ?></a>
				<a href="<?php echo get_permalink( $contact_pg->ID ); ?>" class="red-btn btn btn-block btn-lg"><i class="fa fa-envelope fa-lg"></i><?php echo get_the_title($contact_pg->ID); ?></a>
				<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block btn-lg"><i class="fa fa-power-off fa-lg"></i>Log Out</a>
			</section>
			
		</article><!-- #post-## -->

		<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>

<?php } else { ?>
<?php 
$index_id = get_option( 'page_on_front' );
$url = get_permalink( $index_id  );
wp_safe_redirect( $url );
exit;
?>
<?php }	?>