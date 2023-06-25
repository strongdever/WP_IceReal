<?php
/*
Template Name: Invest Template
*/

if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

?>
<main>

	<section class="p_breadcrumbs_section">
		<div class="container">
			<ol>
				<li><a href="<?php echo HOME; ?>">TOP</a></li>
				<li>投資用不動産物件</li>
			</ol>
		</div>
	</section>

	<section class="p_main_section">
		<div class="container">
      <div class="p_archive_cat">
        <h3 class="lead">投資用不動産物件</h3>
        <h4 class="sub">Investment property</h4>
      </div>
			<ul class="p_archive_list">
        <?php
          $cat_args = [
            'hide_empty' => true,
            'parent' => 1
          ];

          $child_categories = get_categories( $cat_args );
        ?>
        <?php foreach( $child_categories as $child_category ) : ?>
          <li>
            <div class="p_archive_title">
              <h4 class="lead"><?php echo $child_category->name; ?></h4>
              <p class="sub"><?php echo get_field('en_name', 'category_' . $child_category->term_id); ?></p>
            </div>
            <?php
              $post_args = [
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'tax_query' => [
                  [
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $child_category->term_id,
                  ]
                ]
              ];
            ?>
            <?php $post_query = new WP_Query( $post_args ); ?>
            <?php if( $post_query->have_posts() ) : ?>
            <ul class="sub_archive_list">
              <?php	while( $post_query->have_posts() ) :  $post_query->the_post(); ?>
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
              <?php wp_reset_postdata(); ?>
            </ul>
            <div class="p_archive_action">
              <a href="<?php echo HOME . 'invest/' . $child_category->slug; ?>" class="action_btn mx_auto">
                <span>view all　></span>
              </a>
            </div>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
		</div>
	</section>

</main>

<?php get_footer();?>