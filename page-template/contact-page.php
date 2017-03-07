<?php 
/*
Template Name: Contact us page
*/
?>

<?php get_header(); ?>

<?php
if (is_user_logged_in() ) {
$user_id = $current_user->ID;
$login_email = $current_user->user_email;

$field_values = array();	
} else {
$field_values = null;	
}	
?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
	<div class="jumbotron wht-border-bottom">
		<div class="container-fluid">
			<?php the_content(); ?>
		</div>
	</div>
	<article <?php post_class(); ?>>
		<div class="container-fluid">
			<?php gravity_form( 1, false, false, false, $field_values, true ); ?>	
		</div>						
	</article><!-- #post-## -->
		
	<?php endwhile; ?>

<?php endif; ?>


<?php get_footer(); ?>