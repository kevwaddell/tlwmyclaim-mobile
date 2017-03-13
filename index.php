<?php
$user_id = get_current_user_id();
$user_type = get_user_meta( $user_id, 'user_type', true); 	
if ( is_user_logged_in() && ($user_type == "ref" || $user_type == "admin") ) { ?>

<?php get_header(); ?>
		
	<div class="jumbotron wht-border-bottom">
		<div class="container text-center">
			<h1>Client cases archive</h1>
			<p><strong>TLW's recent open and completed case files.</strong></p>
		</div>
	</div>
	
	<article <?php post_class('page'); ?>>
					
		<?php 
		global $current_user;
		get_currentuserinfo();
		
		$args = array(
		'post_status' => 'private'	
		);
		
		if ($user_type == "ref") {
		$args['meta_key'] = 'src_ref';	
		$args['meta_value'] = $current_user->user_login;
		}
		
		$wp_query = new WP_Query( $args );
		$found_posts = $wp_query->found_posts;
		$posts_per_page = get_query_var('posts_per_page');
		?>
			
		<?php if ( have_posts() ) : ?>
		<section id="client-cases">
			
		<div class="panel panel-default">	
			
			<div class="panel-heading text-center">Recent cases</div>	
			
			<table class="table table-bordered text-center">
				<thead>
					<tr>
						<td colspan="6">Status: <span class="label label-success">Open</span> <span class="label label-warning">Closed</span></td>
					</tr>
				</thead>
				
				<?php if ($user_type == "ref") { ?>
				<?php get_template_part( 'parts/cases/ref', 'caselist' ); ?>
				<?php } else { ?>
				<?php get_template_part( 'parts/cases/admin', 'caselist' ); ?>
				<?php } ?>
				<?php if ($found_posts > $posts_per_page) { ?>
				<tfoot>
					<tr>
						<td colspan="6"><?php wp_pagenavi(); ?></td>
					</tr>
				</tfoot>
				<?php } ?>
			</table>
			
		</div>
	
		</section>	
		
		<?php else: ?>
		<div class="well well-lg well-message text-center">
			<i class="fa fa-folder-open"></i>
			<h2>Sorry</h2>
			<p>There are no open cases at the moment.</p>
		</div>
		<?php endif; ?>
		
		<?php if ($user_type == "admin") { 
		$clients_pg = get_page_by_path( 'clients' );
		$referrers_pg = get_page_by_path( 'referrers' );	
		?>
		<a href="<?php echo get_permalink($clients_pg->ID ); ?>" class="red-btn btn btn-block">
			<i class="fa fa-users"></i>
			<?php echo get_the_title($clients_pg->ID); ?>
		</a>
		<a href="<?php echo get_permalink($referrers_pg->ID ); ?>" class="red-btn btn btn-block">
			<i class="fa fa-building"></i>
			<?php echo get_the_title($referrers_pg->ID); ?>
		</a>
		<?php } ?>
		<a href="<?php echo wp_logout_url( $redirect ); ?>" class="red-btn btn btn-block"><i class="fa fa-power-off fa-lg"></i>Log Out</a>
				
	</article>
	
<?php get_footer(); ?>

<?php } else { ?>
<?php 
$index_id = get_option( 'page_on_front' );
$url = get_permalink( $index_id  );
wp_redirect( $url );
exit;
?>
<?php }	?>