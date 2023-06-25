<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
	?>

	<main id="main">

		<?php get_template_part('template', 'parts/breadcrumbs'); ?>

		<?php the_content(); ?>
		
	</main>

	<?php
		endwhile;
	endif;
	?>

<?php get_footer();?>
