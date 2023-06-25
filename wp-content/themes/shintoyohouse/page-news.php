<?php
/*
Template Name: News Template
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
				<li>新着情報</li>
			</ol>
		</div>
	</section>

  <?php
    $args = [
      'post_type' => 'post',
      'paged' => $paged,
      'posts_per_page' => 10,
      'tax_query' => [
        [
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    => 'news',
        ]
      ]
    ]; 
  ?>
  <?php $custom_query = new WP_Query( $args ); ?>

  <section class="p_main_section">
    <div class="container">
      <div class="p_archive_title">
        <h4 class="lead">お知らせ</h4>
        <p class="sub">News</p>
      </div>
      <?php if( $custom_query->have_posts() ) : ?>
        <ul class="p_news_list">
          <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
            <li>
              <div class="p_news_item">
                <p class="date"><?php the_time("Y年m月d日"); ?></p>
                <a href="<?php the_permalink(); ?>" class="thumb">
                  <?php if( has_post_thumbnail() ): ?>
                    <?php the_post_thumbnail("thumbnail"); ?>
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