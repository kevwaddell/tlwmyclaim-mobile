<?php 
/*
Template Name: Clients List page
*/
?>

<?php if ( is_user_logged_in() && current_user_can( 'administrator' )  ) { ?>

<?php get_header(); ?>

<?php $users_args = array(
	'role'         => 'subscriber',
	'meta_key'     => 'user_type',
	'meta_value'   => 'client',
	'orderby'      => 'display_name'
 ); 
$users = get_users( $users_args ); 
//$users = false;
//echo '<pre class="debug">';print_r($users);echo '</pre>';
?>
<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
					
		<div class="jumbotron wht-border-bottom">
			<div class="container-fluid">
			<?php the_content(); ?>	
			</div>
		</div>
			
		<article <?php post_class(); ?>>

			<?php if (!empty($users)) { ?>
			<section id="users-list">

				<div class="panel panel-default">	
		
					<div class="panel-heading text-center">Clients</div>	
		
					<table class="table table-bordered">
					
						<tbody>	
							<tr>
								<th width="15%" class="text-center">Cases</th>
								<th width="70%" class="text-center">Client name</th>
								<th width="15%" class="text-center"><i class="fa fa-cogs fa-lg"></i></th>
							</tr>
						  	<?php foreach ($users as $user) { 
							//echo '<pre class="debug">';print_r($user->ID);echo '</pre>';
							$client_personal_raw = get_user_meta($user->ID, 'client_personal', true); 	
							$client_personal = unserialize($client_personal_raw); 	
							$client_contact_raw = get_user_meta($user->ID, 'client_contact', true);
							$client_contact = unserialize($client_contact_raw);
							$claims_args = array(
							'posts_per_page' => -1,
							'post_type'		=> 'post',
							'post_status'	=>	'private',
							'author'	=> $user->ID,
							'orderby'	=> 'date'
							);
							$claims = get_posts( $claims_args );
							//echo '<pre class="debug">';print_r($claims);echo '</pre>';
						  	?>
						  	<tr>
							  	<td class="text-center" style="vertical-align: middle;">
								  	<?php if (count($claims) > 1) { ?>
								  	<div class="btn-group">
								  <button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Select a case</span> <i class="fa fa-folder-open"></i>
								  </button>
								  <ul class="dropdown-menu">
									  <?php foreach ($claims as $claim) { 
									   $case_ref = get_post_meta( $claim->ID, 'case_ref', true);
									  ?>
									  <li><a href="<?php echo get_permalink( $claim->ID ); ?>"><?php echo $case_ref; ?><i class="fa fa-angle-right pull-right" style="line-height: 18px;"></i></a></li>
									  <?php } ?>
								   
								  </ul>
								</div>
								  	<?php } else { 
									$case_ref = get_post_meta( $claims[0]->ID, 'case_ref', true);
								  	?>
								  	<a href="<?php echo get_permalink( $claims[0]->ID ); ?>" class="btn btn-default btn-block"><span class="sr-only">View case <?php echo $case_ref; ?></span><i class="fa fa-folder-open"></i></a>
								  	<?php } ?>
																	</td>
								<td class="text-center" style="vertical-align: middle;">
									<?php echo $client_personal[title]; ?> <?php echo $client_personal[forename]; ?> <?php echo $client_personal[surname]; ?>	</td>
								<td class="text-center" style="vertical-align: middle;">
								<a href="<?php echo get_author_posts_url($user->ID); ?>" class="btn btn-default btn-block"><span class="sr-only">View client profile</span><i class="fa fa-vcard"></i></a>
								</td>
						  </tr>
						  	<?php } ?>
						  	
						</tbody>
					</table>
					
				</div>
			
			</section>
			<?php } else { ?>
			<div class="well well-lg well-message text-center">
				<h2>Sorry</h2>
				<p>There are no clients at the moment.</p>
			</div>
			<?php } ?>

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