<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
	?>

	<main id="single">

	<?php
		$is_child = true;

		$current_category = get_the_category()[0];

		if( $current_category->category_parent == 0 ) {
			$is_child = false;
		}
	?>

	<section class="p_breadcrumbs_section">
		<div class="container">
			<ol>
				<li><a href="<?php echo HOME; ?>">TOP</a></li>
				<?php if( $is_child ) : ?>
					<?php
						$parent_category = get_category($current_category->parent);
					?>
					<li><a href="<?php echo HOME . $parent_category->slug; ?>"><?php echo $parent_category->name; ?></a></li>
					<li><a href="<?php echo HOME . $parent_category->slug . '/' . $current_category->slug; ?>"><?php echo $current_category->name; ?></a></li>
				<?php else : ?>
					<li><a href="<?php echo HOME . $current_category->slug; ?>"><?php echo $current_category->name; ?></a></li>
				<?php endif; ?>
				<li><?php the_title(); ?></li>
			</ol>
		</div>
	</section>

	<section class="p_main_section">
		<div class="container">
			<?php if( $is_child ) : ?>
				<?php
					$parent_category = get_category($current_category->parent);
				?>
				<div class="p_archive_cat">
					<h3 class="lead"><?php echo $current_category->name; ?></h3>
					<h4 class="sub"><?php echo get_field('en_name', 'category_' . $current_category->term_id); ?></h4>
				</div>
				<div class="p_archive_summary">
					<div class="sumary_main">
						<div class="number"><?php the_field('property_phrase'); ?></div>
						<h4 class="title"><?php the_title(); ?></h4>
						<table class="sumary">
							<tbody>
								<tr>
									<th>販売価格</th>
									<td class="b"><?php the_field('property_price'); ?></td>
								</tr>
								<tr>
									<th>所在地</th>
									<td><?php the_field('property_address'); ?></td>
								</tr>
								<tr>
									<th>交通</th>
									<td><?php the_field('property_traffic'); ?></td>
								</tr>
								<tr>
									<th>物件番号</th>
									<td><?php the_field('property_number'); ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="sumary_side">
						<?php if( has_post_thumbnail() ): ?>
							<a href="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), "full" ) ) ?>" class="gallery_thumb" data-lightbox="detail" data-title="<?php the_title(); ?>">
								<?php the_post_thumbnail("medium"); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>

				<?php $gallery = get_field('thumb_gallery'); ?>
				<?php if( $gallery ) : ?>
					<ul class="p_archive_gallery">
						<?php foreach ($gallery as $gallery_id) : ?>
							<li>
								<a href="<?php echo wp_get_attachment_image_url( $gallery_id, 'full' ); ?>" class="gallery_thumb" data-lightbox="detail" data-title="<?php the_title(); ?>">
									<?php echo wp_get_attachment_image( $gallery_id, 'medium' ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php if( get_field('embed_url') ) : ?>
					<div class="p_archive_youtube">
            <div class="youtube_wrapper">
              <iframe width="600" height="400" src="<?php echo esc_url(get_field('embed_url')); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>
				<?php endif; ?>

				<?php if( get_field('listing_content') ) : ?>
					<div class="p_archive_content"><?php the_field('listing_content'); ?></div>
				<?php endif; ?>
				<div class="sub_archive_header">
					<div class="archive_title">
						<figure class="icon">
							<img src="<?php echo T_DIRE_URI; ?>/assets/img/common/icon-sub.png" alt="">
						</figure>
						<h3 class="title">物件詳細</h3>
					</div>
				</div>
				<div class="p_archive_list_wrapper mb_30">
					<?php if( strpos($current_category->slug, 'apart') !== false ) : ?>
						<div class="scroll pc">
							<table class="p_archive_table">
								<tbody>
									<tr>
										<th>物件名</th>
										<td colspan="3"><?php the_field('property_name'); ?></td>
									</tr>
									<tr>
										<th>交通</th>
										<td colspan="3"><?php the_field('property_traffic'); ?></td>
									</tr>
									<tr>
										<th>価格</th>
										<td><?php the_field('property_price'); ?></td>
										<th>駐車場</th>
										<td><?php the_field('property_parking'); ?></td>
									</tr>
									<tr>
										<th>専有面積</th>
										<td><?php the_field('property_area_1'); ?></td>
										<th>バルコニー面積</th>
										<td><?php the_field('property_area_2'); ?></td>
									</tr>
									<tr>
										<th>間取り</th>
										<td colspan="3"><?php the_field('property_plan'); ?></td>
									</tr>
									<tr>
										<th>構造・規模</th>
										<td><?php the_field('property_scale'); ?></td>
										<th>所在階</th>
										<td><?php the_field('property_floor'); ?></td>
									</tr>
									<tr>
										<th>現況</th>
										<td><?php the_field('property_state'); ?></td>
										<th>引渡時期</th>
										<td><?php the_field('property_delivertime'); ?></td>
									</tr>
									<tr>
										<th>管理費等</th>
										<td><?php the_field('property_manafee'); ?></td>
										<th>修繕積立金</th>
										<td><?php the_field('property_repairfee'); ?></td>
									</tr>
									<tr>
										<th>管理形態</th>
										<td><?php the_field('property_manatype'); ?></td>
										<th>管理会社</th>
										<td><?php the_field('property_manacompany'); ?></td>
									</tr>
									<tr>
										<th>総戸数</th>
										<td><?php the_field('property_total'); ?></td>
										<th>築年月</th>
										<td><?php the_field('property_builddate'); ?></td>
									</tr>
									<tr>
										<th>向き</th>
										<td><?php the_field('property_direction'); ?></td>
										<th>土地権利</th>
										<td><?php the_field('property_land'); ?></td>
									</tr>
									<tr>
										<th>設備</th>
										<td colspan="3"><?php the_field('property_facility'); ?></td>
									</tr>
									<tr>
										<th>小／中学校区</th>
										<td colspan="3"><?php the_field('property_school'); ?></td>
									</tr>
									<tr>
										<th>特記事項</th>
										<td colspan="3"><?php the_field('property_remark'); ?></td>
									</tr>
									<tr>
										<th>備考</th>
										<td colspan="3"><?php the_field('property_bio'); ?></td>
									</tr>
									<tr>
										<th>取引態様</th>
										<td colspan="3"><?php the_field('property_transaction'); ?></td>
									</tr>
									<tr>
										<th>情報提供日</th>
										<td><?php the_field('property_providedate'); ?></td>
										<th>次回更新予定日</th>
										<td><?php the_field('property_nextdate'); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="scroll sp">
							<table class="p_archive_table">
								<tbody>
									<tr>
										<th>物件名</th>
										<td><?php the_field('property_name'); ?></td>
									</tr>
									<tr>
										<th>交通</th>
										<td><?php the_field('property_traffic'); ?></td>
									</tr>
									<tr>
										<th>価格</th>
										<td><?php the_field('property_price'); ?></td>
									</tr>
									<tr>
										<th>駐車場</th>
										<td><?php the_field('property_parking'); ?></td>
									</tr>
									<tr>
										<th>専有面積</th>
										<td><?php the_field('property_area_1'); ?></td>
									</tr>
									<tr>
										<th>バルコニー面積</th>
										<td><?php the_field('property_area_2'); ?></td>
									</tr>
									<tr>
										<th>間取り</th>
										<td><?php the_field('property_plan'); ?></td>
									</tr>
									<tr>
										<th>構造・規模</th>
										<td><?php the_field('property_scale'); ?></td>
									</tr>
									<tr>
										<th>所在階</th>
										<td><?php the_field('property_floor'); ?></td>
									</tr>
									<tr>
										<th>現況</th>
										<td><?php the_field('property_state'); ?></td>
									</tr>
									<tr>
										<th>引渡時期</th>
										<td><?php the_field('property_delivertime'); ?></td>
									</tr>
									<tr>
										<th>管理費等</th>
										<td><?php the_field('property_manafee'); ?></td>
									</tr>
									<tr>
										<th>修繕積立金</th>
										<td><?php the_field('property_repairfee'); ?></td>
									</tr>
									<tr>
										<th>管理形態</th>
										<td><?php the_field('property_manatype'); ?></td>
									</tr>
									<tr>
										<th>管理会社</th>
										<td><?php the_field('property_manacompany'); ?></td>
									</tr>
									<tr>
										<th>総戸数</th>
										<td><?php the_field('property_total'); ?></td>
									</tr>
									<tr>
										<th>築年月</th>
										<td><?php the_field('property_builddate'); ?></td>
									</tr>
									<tr>
										<th>向き</th>
										<td><?php the_field('property_direction'); ?></td>
									</tr>
									<tr>
										<th>土地権利</th>
										<td><?php the_field('property_land'); ?></td>
									</tr>
									<tr>
										<th>設備</th>
										<td><?php the_field('property_facility'); ?></td>
									</tr>
									<tr>
										<th>小／中学校区</th>
										<td><?php the_field('property_school'); ?></td>
									</tr>
									<tr>
										<th>特記事項</th>
										<td><?php the_field('property_remark'); ?></td>
									</tr>
									<tr>
										<th>備考</th>
										<td><?php the_field('property_bio'); ?></td>
									</tr>
									<tr>
										<th>取引態様</th>
										<td><?php the_field('property_transaction'); ?></td>
									</tr>
									<tr>
										<th>情報提供日</th>
										<td><?php the_field('property_providedate'); ?></td>
									</tr>
									<tr>
										<th>次回更新予定日</th>
										<td><?php the_field('property_nextdate'); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					<?php elseif( strpos($current_category->slug, 'land') !== false ) : ?>
						<div class="scroll pc">
							<table class="p_archive_table">
								<tbody>
									<tr>
										<th>物件名</th>
										<td colspan="3"><?php the_field('property_name'); ?></td>
									</tr>
									<tr>
										<th>交通</th>
										<td colspan="3"><?php the_field('property_traffic'); ?></td>
									</tr>
									<tr>
										<th>価格</th>
										<td><?php the_field('property_price'); ?></td>
										<th>土地面積平米</th>
										<td><?php the_field('property_area_1'); ?></td>
									</tr>
									<tr>
										<th>土地面積坪</th>
										<td><?php the_field('property_area_2'); ?></td>
										<th>私道面積</th>
										<td><?php the_field('property_area_3'); ?></td>
									</tr>
									<tr>
										<th>間取り</th>
										<td colspan="3"><?php the_field('property_plan'); ?></td>
									</tr>
									<tr>
										<th>構造・規模</th>
										<td><?php the_field('property_scale'); ?></td>
										<th>築年月</th>
										<td><?php the_field('property_builddate'); ?></td>
									</tr>
									<tr>
										<th>駐車場</th>
										<td><?php the_field('property_parking'); ?></td>
										<th>現況</th>
										<td><?php the_field('property_state'); ?></td>
									</tr>
									<tr>
										<th>引渡時期</th>
										<td><?php the_field('property_delivertime'); ?></td>
										<th>接道状況</th>
										<td><?php the_field('property_situation'); ?></td>
									</tr>
									<tr>
										<th>建築確認番号</th>
										<td><?php the_field('property_confirmnum'); ?></td>
										<th>国土法届出</th>
										<td><?php the_field('property_law'); ?></td>
									</tr>
									<tr>
										<th>土地権利</th>
										<td><?php the_field('property_land'); ?></td>
										<th>都市計画</th>
										<td><?php the_field('property_city'); ?></td>
									</tr>
									<tr>
										<th>用途地域</th>
										<td><?php the_field('property_usagearea'); ?></td>
										<th>地目</th>
										<td><?php the_field('property_ground'); ?></td>
									</tr>
									<tr>
										<th>建ぺい率</th>
										<td><?php the_field('property_coverage'); ?></td>
										<th>容積率</th>
										<td><?php the_field('property_volumn'); ?></td>
									</tr>
									<tr>
										<th>公法制限</th>
										<td colspan="3"><?php the_field('property_restrict'); ?></td>
									</tr>
									<tr>
										<th>設備</th>
										<td colspan="3"><?php the_field('property_facility'); ?></td>
									</tr>
									<tr>
										<th>小／中学校区</th>
										<td colspan="3"><?php the_field('property_school'); ?></td>
									</tr>
									<tr>
										<th>特記事項</th>
										<td colspan="3"><?php the_field('property_remark'); ?></td>
									</tr>
									<tr>
										<th>備考</th>
										<td colspan="3"><?php the_field('property_bio'); ?></td>
									</tr>
									<tr>
										<th>取引態様</th>
										<td colspan="3"><?php the_field('property_transaction'); ?></td>
									</tr>
									<tr>
										<th>情報提供日</th>
										<td><?php the_field('property_providedate'); ?></td>
										<th>次回更新予定日</th>
										<td><?php the_field('property_nextdate'); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="scroll sp">
							<table class="p_archive_table">
								<tbody>
									<tr>
										<th>物件名</th>
										<td><?php the_field('property_name'); ?></td>
									</tr>
									<tr>
										<th>交通</th>
										<td><?php the_field('property_traffic'); ?></td>
									</tr>
									<tr>
										<th>価格</th>
										<td><?php the_field('property_price'); ?></td>
									</tr>
									<tr>
										<th>土地面積平米</th>
										<td><?php the_field('property_area_1'); ?></td>
									</tr>
									<tr>
										<th>土地面積坪</th>
										<td><?php the_field('property_area_2'); ?></td>
									</tr>
									<tr>
										<th>私道面積</th>
										<td><?php the_field('property_area_3'); ?></td>
									</tr>
									<tr>
										<th>間取り</th>
										<td><?php the_field('property_plan'); ?></td>
									</tr>
									<tr>
										<th>構造・規模</th>
										<td><?php the_field('property_scale'); ?></td>
									</tr>
									<tr>
										<th>築年月</th>
										<td><?php the_field('property_builddate'); ?></td>
									</tr>
									<tr>
										<th>駐車場</th>
										<td><?php the_field('property_parking'); ?></td>
									</tr>
									<tr>
										<th>現況</th>
										<td><?php the_field('property_state'); ?></td>
									</tr>
									<tr>
										<th>引渡時期</th>
										<td><?php the_field('property_delivertime'); ?></td>
									</tr>
									<tr>
										<th>接道状況</th>
										<td><?php the_field('property_situation'); ?></td>
									</tr>
									<tr>
										<th>建築確認番号</th>
										<td><?php the_field('property_confirmnum'); ?></td>
									</tr>
									<tr>
										<th>国土法届出</th>
										<td><?php the_field('property_law'); ?></td>
									</tr>
									<tr>
										<th>土地権利</th>
										<td><?php the_field('property_land'); ?></td>
									</tr>
									<tr>
										<th>都市計画</th>
										<td><?php the_field('property_city'); ?></td>
									</tr>
									<tr>
										<th>用途地域</th>
										<td><?php the_field('property_usagearea'); ?></td>
									</tr>
									<tr>
										<th>地目</th>
										<td><?php the_field('property_ground'); ?></td>
									</tr>
									<tr>
										<th>建ぺい率</th>
										<td><?php the_field('property_coverage'); ?></td>
									</tr>
									<tr>
										<th>容積率</th>
										<td><?php the_field('property_volumn'); ?></td>
									</tr>
									<tr>
										<th>公法制限</th>
										<td><?php the_field('property_restrict'); ?></td>
									</tr>
									<tr>
										<th>設備</th>
										<td><?php the_field('property_facility'); ?></td>
									</tr>
									<tr>
										<th>小／中学校区</th>
										<td><?php the_field('property_school'); ?></td>
									</tr>
									<tr>
										<th>特記事項</th>
										<td><?php the_field('property_remark'); ?></td>
									</tr>
									<tr>
										<th>備考</th>
										<td><?php the_field('property_bio'); ?></td>
									</tr>
									<tr>
										<th>取引態様</th>
										<td><?php the_field('property_transaction'); ?></td>
									</tr>
									<tr>
										<th>情報提供日</th>
										<td><?php the_field('property_providedate'); ?></td>
									</tr>
									<tr>
										<th>次回更新予定日</th>
										<td><?php the_field('property_nextdate'); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					<?php elseif( strpos($current_category->slug, 'house') !== false || strpos($current_category->slug, 'sale') !== false || strpos($current_category->slug, 'rental') !== false ) : ?>
						<div class="scroll pc">
							<table class="p_archive_table">
								<tbody>
									<tr>
										<th>物件名</th>
										<td colspan="3"><?php the_field('property_name'); ?></td>
									</tr>
									<tr>
										<th>交通</th>
										<td colspan="3"><?php the_field('property_traffic'); ?></td>
									</tr>
									<tr>
										<th>価格</th>
										<td><?php the_field('property_price'); ?></td>
										<th>土地面積平米</th>
										<td><?php the_field('property_area_1'); ?></td>
									</tr>
									<tr>
										<th>土地面積坪</th>
										<td><?php the_field('property_area_2'); ?></td>
										<th>私道面積</th>
										<td><?php the_field('property_area_3'); ?></td>
									</tr>
									<tr>
										<th>建物面積平米</th>
										<td><?php the_field('property_area_4'); ?></td>
										<th>建物面積坪</th>
										<td><?php the_field('property_area_5'); ?></td>
									</tr>
									<tr>
										<th>間取り</th>
										<td colspan="3"><?php the_field('property_plan'); ?></td>
									</tr>
									<tr>
										<th>構造・規模</th>
										<td><?php the_field('property_scale'); ?></td>
										<th>築年月</th>
										<td><?php the_field('property_builddate'); ?></td>
									</tr>
									<tr>
										<th>駐車場</th>
										<td><?php the_field('property_parking'); ?></td>
										<th>現況</th>
										<td><?php the_field('property_state'); ?></td>
									</tr>
									<tr>
										<th>引渡時期</th>
										<td><?php the_field('property_delivertime'); ?></td>
										<th>接道状況</th>
										<td><?php the_field('property_situation'); ?></td>
									</tr>
									<tr>
										<th>建築確認番号</th>
										<td><?php the_field('property_confirmnum'); ?></td>
										<th>国土法届出</th>
										<td><?php the_field('property_law'); ?></td>
									</tr>
									<tr>
										<th>土地権利</th>
										<td><?php the_field('property_land'); ?></td>
										<th>都市計画</th>
										<td><?php the_field('property_city'); ?></td>
									</tr>
									<tr>
										<th>用途地域</th>
										<td><?php the_field('property_usagearea'); ?></td>
										<th>地目</th>
										<td><?php the_field('property_ground'); ?></td>
									</tr>
									<tr>
										<th>建ぺい率</th>
										<td><?php the_field('property_coverage'); ?></td>
										<th>容積率</th>
										<td><?php the_field('property_volumn'); ?></td>
									</tr>
									<tr>
										<th>公法制限</th>
										<td colspan="3"><?php the_field('property_restrict'); ?></td>
									</tr>
									<tr>
										<th>設備</th>
										<td colspan="3"><?php the_field('property_facility'); ?></td>
									</tr>
									<tr>
										<th>小／中学校区</th>
										<td colspan="3"><?php the_field('property_school'); ?></td>
									</tr>
									<tr>
										<th>特記事項</th>
										<td colspan="3"><?php the_field('property_remark'); ?></td>
									</tr>
									<tr>
										<th>備考</th>
										<td colspan="3"><?php the_field('property_bio'); ?></td>
									</tr>
									<tr>
										<th>取引態様</th>
										<td colspan="3"><?php the_field('property_transaction'); ?></td>
									</tr>
									<tr>
										<th>情報提供日</th>
										<td><?php the_field('property_providedate'); ?></td>
										<th>次回更新予定日</th>
										<td><?php the_field('property_nextdate'); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="scroll sp">
							<table class="p_archive_table">
								<tbody>
									<tr>
										<th>物件名</th>
										<td><?php the_field('property_name'); ?></td>
									</tr>
									<tr>
										<th>交通</th>
										<td><?php the_field('property_traffic'); ?></td>
									</tr>
									<tr>
										<th>価格</th>
										<td><?php the_field('property_price'); ?></td>
									</tr>
									<tr>
										<th>土地面積平米</th>
										<td><?php the_field('property_area_1'); ?></td>
									</tr>
									<tr>
										<th>土地面積坪</th>
										<td><?php the_field('property_area_2'); ?></td>
									</tr>
									<tr>
										<th>私道面積</th>
										<td><?php the_field('property_area_3'); ?></td>
									</tr>
									<tr>
										<th>建物面積平米</th>
										<td><?php the_field('property_area_4'); ?></td>
									</tr>
									<tr>
										<th>建物面積坪</th>
										<td><?php the_field('property_area_5'); ?></td>
									</tr>
									<tr>
										<th>間取り</th>
										<td><?php the_field('property_plan'); ?></td>
									</tr>
									<tr>
										<th>構造・規模</th>
										<td><?php the_field('property_scale'); ?></td>
									</tr>
									<tr>
										<th>築年月</th>
										<td><?php the_field('property_builddate'); ?></td>
									</tr>
									<tr>
										<th>駐車場</th>
										<td><?php the_field('property_parking'); ?></td>
									</tr>
									<tr>
										<th>現況</th>
										<td><?php the_field('property_state'); ?></td>
									</tr>
									<tr>
										<th>引渡時期</th>
										<td><?php the_field('property_delivertime'); ?></td>
									</tr>
									<tr>
										<th>接道状況</th>
										<td><?php the_field('property_situation'); ?></td>
									</tr>
									<tr>
										<th>建築確認番号</th>
										<td><?php the_field('property_confirmnum'); ?></td>
									</tr>
									<tr>
										<th>国土法届出</th>
										<td><?php the_field('property_law'); ?></td>
									</tr>
									<tr>
										<th>土地権利</th>
										<td><?php the_field('property_land'); ?></td>
									</tr>
									<tr>
										<th>都市計画</th>
										<td><?php the_field('property_city'); ?></td>
									</tr>
									<tr>
										<th>用途地域</th>
										<td><?php the_field('property_usagearea'); ?></td>
									</tr>
									<tr>
										<th>地目</th>
										<td><?php the_field('property_ground'); ?></td>
									</tr>
									<tr>
										<th>建ぺい率</th>
										<td><?php the_field('property_coverage'); ?></td>
									</tr>
									<tr>
										<th>容積率</th>
										<td><?php the_field('property_volumn'); ?></td>
									</tr>
									<tr>
										<th>公法制限</th>
										<td><?php the_field('property_restrict'); ?></td>
									</tr>
									<tr>
										<th>設備</th>
										<td><?php the_field('property_facility'); ?></td>
									</tr>
									<tr>
										<th>小／中学校区</th>
										<td><?php the_field('property_school'); ?></td>
									</tr>
									<tr>
										<th>特記事項</th>
										<td><?php the_field('property_remark'); ?></td>
									</tr>
									<tr>
										<th>備考</th>
										<td><?php the_field('property_bio'); ?></td>
									</tr>
									<tr>
										<th>取引態様</th>
										<td><?php the_field('property_transaction'); ?></td>
									</tr>
									<tr>
										<th>情報提供日</th>
										<td><?php the_field('property_providedate'); ?></td>
									</tr>
									<tr>
										<th>次回更新予定日</th>
										<td><?php the_field('property_nextdate'); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					<?php endif; ?>
				</div>
				<div class="sub_archive_header">
					<div class="archive_title">
						<figure class="icon">
							<img src="<?php echo T_DIRE_URI; ?>/assets/img/common/icon-sub.png" alt="">
						</figure>
						<h3 class="title">物件詳細について</h3>
					</div>
				</div>
				<div class="p_archive_list_wrapper">
					<div class="m_txt"><?php the_field('detail_content'); ?></div>
				</div>
			<?php else : ?>
				<div class="p_blog_single">
					<div class="single_main">
						<time class="date"><?php the_time("Y.m.d"); ?></time>
						<h3 class="title"><?php the_title(); ?></h3>
						<?php if( has_post_thumbnail() ): ?>
							<figure class="thumb">
								<?php the_post_thumbnail("full"); ?>
							</figure>
						<?php endif; ?>
					</div>
					<div class="single_content"><?php the_content(); ?></div>
				</div>
			<?php endif; ?>
			<div class="p_single_pagination">
				<?php if( previous_post_link( "%link" ,'&lt;前へ' ,$in_same_cat = true) ) : ?><?php endif ; ?>
				<?php if( next_post_link( "%link" ,'次へ&gt;' ,$in_same_cat = true) ) : ?><?php endif ; ?>
			</div>
		</div>
	</section>

		
		
	</main>

	<?php
		endwhile;
	endif;
	?>

<?php get_footer();?>
