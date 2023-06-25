<?php

if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$is_child = true;

$current_category = get_the_category()[0];

if( $current_category->category_parent == 0 ) {
	$is_child = false;
}

?>
<main>

	<section class="p_breadcrumbs_section">
		<div class="container">
			<ol>
				<li><a href="<?php echo HOME; ?>">TOP</a></li>
				<?php if( $is_child ) : ?>
					<?php
						$parent_category = get_category($current_category->parent);
					?>
					<li><a href="<?php echo HOME . $parent_category->slug; ?>"><?php echo $parent_category->name; ?></a></li>
				<?php endif; ?>
				<li><?php echo $current_category->name; ?></li>
			</ol>
		</div>
	</section>
	
  <?php
    $args = [
      'post_type' => 'post',
      'paged' => $paged,
      'posts_per_page' => 9,
    ]; 

    $tax_query = [];

    if( $current_category ) {
      $tax_query[] = [
				'taxonomy' => 'category',
				'field' => 'term_id',
				'terms' => $current_category->term_id
			];
    }

    if ( !empty($tax_query) ) {
      $args['tax_query'] = $tax_query;
    }

  ?>
  <?php $custom_query = new WP_Query( $args ); ?>

	<section class="p_main_section">
		<div class="container">
			<div class="p_archive_title">
				<h4 class="lead"><?php echo $current_category->name; ?></h4>
				<p class="sub"><?php echo get_field('en_name', 'category_' . $current_category->term_id); ?></p>
			</div>
			<?php if( $custom_query->have_posts() ) : ?>
				<?php if( $is_child ) : ?>
					<ul class="sub_archive_list">
						<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
							<li>
								<div class="sub_archive_item">
									<div class="left">
										<a href="<?php the_permalink(); ?>" class="thumb">
											<?php if( has_post_thumbnail() ): ?>
												<?php the_post_thumbnail("medium"); ?>
											<?php else: ?>
												<img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>">
											<?php endif; ?>
										</a>
									</div>
									<div class="right">
										<h4 class="phrase"><?php the_field('property_phrase'); ?></h4>
										<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										<ul class="txt">
											<li>所在地：<?php the_field('property_address'); ?></li>
											<li>交通：<?php the_field('property_traffic'); ?></li>
											<li>築年月：<?php the_field('property_builddate'); ?></li>
											<li>間取り：<?php the_field('property_plan'); ?></li>
											<li>販売価格：<?php the_field('property_price'); ?></li>
										</ul>
										<div class="action">
											<a href="<?php the_permalink(); ?>" class="more_link">詳しくはコチラ</a>
										</div>
									</div>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
				<?php else : ?>
					<ul class="p_news_list">
						<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
							<li>
								<div class="p_news_item">
									<p class="date"><?php the_time("Y年m月d日"); ?></p>
									<a href="<?php the_permalink(); ?>" class="thumb">
										<?php if( has_post_thumbnail() ): ?>
											<?php the_post_thumbnail("medium"); ?>
										<?php else: ?>
											<img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>">
										<?php endif; ?>
									</a>
									<div class="content">
										<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										<div class="txt"><?php the_excerpt(); ?></div>
									</div>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
				<div class="p_wp_pagination mt_50 mt_sp_40">
					<?php if(function_exists('wp_pagenavi')) : ?>
						<?php wp_pagenavi(array('query' => $custom_query)); ?>
					<?php endif; ?>
				</div>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
	</section>

</main>

<?php get_footer();?>