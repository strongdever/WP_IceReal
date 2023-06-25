<?php

	/*
	Template Name: FrontPage
	*/

	if ( ! defined( 'ABSPATH' ) ) exit;
	get_header();

?>

<main id="top">
  <?php if( have_rows('mainvisual_slide', 'option') ): ?>
    <section class="c_top_fv_section">
      <div class="c_top_main_slider">
        <?php while( have_rows('mainvisual_slide', 'option') ) : the_row(); ?>
          <?php if( get_row_layout() == 'video' ) : ?>
            <div class="c_main_slide_item">
              <video class="c_main_slide_video" data-desktop-vid="<?php echo esc_attr( get_sub_field('slide_video_pc') ); ?>" data-mobile-vid="<?php echo esc_attr( get_sub_field('slide_video_sp') ); ?>" autoplay loop muted webkit-playsinline playsinline controlsList="nodownload"></video>
            </div>
          <?php elseif( get_row_layout() == 'picture' ): ?>
            <div class="c_main_slide_item">
              <picture class="c_main_slide_img">
                <source media="(min-width:769px)" srcset="<?php echo esc_attr( get_sub_field('slide_image_pc') ); ?>">
                <source media="(max-width:768px)" srcset="<?php echo esc_attr( get_sub_field('slide_image_sp') ); ?>">
                <img src="<?php echo esc_attr( get_sub_field('slide_image_pc') ); ?>" alt="">
              </picture>
            </div>
          <?php endif; ?>
        <?php endwhile; ?>
      </div>
      <div class="c_top_main_title">
        <div class="inner">
          <div class="container">
            <figure class="title_picture">
              <img src="<?php echo T_DIRE_URI; ?>/assets/img/top/title.png" alt="Suggestions for affuence">
            </figure>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php
    $news_args = [
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 2,
      'tax_query' => [
        [
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    => 'news',
        ]
      ]
    ];
    $news_query = new WP_Query( $news_args );
  ?>
  <?php if( $news_query->have_posts() ) : ?>

  <section class="top_news_section">
    <div class="container">
      <div class="top_news_inner">
        <div class="inner_left">
          <h3 class="news_ttl">News</h3>
          <div class="viewmore">
            <a href="<?php echo HOME . 'news'; ?>" class="morelink">View All</a>
          </div>
        </div>
        <div class="inner_right">
          <ul class="news_list">
            <?php	while( $news_query->have_posts() ) :  $news_query->the_post(); ?>
            <li>
              <div class="news_item">
                <time class="date"><?php the_time("Y.m.d"); ?></time>
                <h4 class="ttl">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
              </div>
            </li>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          </ul>
        </div>
      </div>
    </div>
  </section>
    
  <?php endif; ?>

  <section class="top_intro_section">
    <div class="container">
      <h3 class="p_main_ttl">海外のエクゼクティブ層向け<br class="sp">不動産仲介</h3>
      <h4 class="p_sub_ttl">私たち新豊不動産は、国内の高級不動産会社及び国際人材ネットワークを構築しながら、<br>日本での<span class="color_red">不動産投資、日本への移住全般</span>のサポートをいたします。</h4>
      <div class="trans">
        <h3 class="tr_main_ttl">Real estate brokerage for overseas <br class="sp">executives</h3>
        <h4 class="tr_sub_ttl">We, Shintoyo House investment in Japan, immigration to Japan in general We will support you.</h4>
      </div>
      <div class="viewmore">
        <a href="<?php echo HOME . 'about'; ?>" class="morelink">What’s 新豊不動産／ Service ></a>
      </div>
    </div>
  </section>

  <section class="top_archive_section top_feature_section">
    <div class="container">
      <div class="top_archive_title">
        <h2 class="base">Feature</h2>
        <h3 class="ttl">海外のお客様の投資資産を守る<br class="sp">弊社の特徴</h3>
      </div>
      <div class="top_archive_desc">
        <p class="m_txt">弊社は、海外のお客様に対して、購入される不動産を安全かつ透明性の高い情報提供で、お客様の日本での資産形成をお手伝いいたします。</p>
      </div>
      <div class="top_archive_trans">
        <h3 class="tr_m_ttl">Feature of our company that protect the investment assets of overseas customers</h3>
        <p class="tr_m_txt">We provide safe and highly transparent information on real estate purchased by overseas customers to help them build their assets in Japan.</p>
      </div>
    </div>
  </section>

  <section class="top_feature_list_section">
    <div class="container">
      <ul class="top_feature_list">
        <li>
          <div class="feature_item">
            <figure class="icon">
              <img src="<?php echo T_DIRE_URI; ?>/assets/img/top/feature-icon-01.png" alt="">
            </figure>
            <h4 class="title">Overseas support</h4>
            <div class="content">
              <div class="lead"><span class="x">海外サポート</span><br><span class="m">1,500</span><span class="s">社の実績</span><em class="tag">※1</em></div>
              <p class="help">※1 新豊投信グループとして</p>
            </div>
          </div>
        </li>
        <li>
          <div class="feature_item">
            <figure class="icon">
              <img src="<?php echo T_DIRE_URI; ?>/assets/img/top/feature-icon-02.png" alt="">
            </figure>
            <h4 class="title">Real estate experience</h4>
            <div class="content">
              <div class="lead"><span class="x">不動産実績<br>10年以上</span><em class="tag">※1</em></div>
              <p class="help">東京都知事（3）第92005号</p>
            </div>
          </div>
        </li>
        <li>
          <div class="feature_item">
            <figure class="icon">
              <img src="<?php echo T_DIRE_URI; ?>/assets/img/top/feature-icon-03.png" alt="">
            </figure>
            <h4 class="title">After support</h4>
            <div class="content">
              <div class="lead"><span class="x">購入後の</span><br><span class="m">3</span><span class="s">大サポート</span><em class="tag">※2</em></div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>

  <section class="top_point_list_section">
    <div class="container">
      <h3 class="point_main_ttl">購入後の３大サポート <small>※2</small></h3>
      <ul class="point_list">
        <li>
          <div class="point_item">
            <figure class="thumb">
              <img src="<?php echo T_DIRE_URI; ?>/assets/img/top/top_3dai_1.jpg" alt="">
            </figure>
            <div class="content">
              <h4 class="ttl">24時間暮らしの<br>サポート</h4>
              <p class="txt">購入後のカギの紛失や水道トラブルなどに24時間対応いたします。</p>
              <p class="help">※弊社指定の火災保険に加入いただきます。</p>
            </div>
          </div>
        </li>
        <li>
          <div class="point_item">
            <figure class="thumb">
              <img src="<?php echo T_DIRE_URI; ?>/assets/img/top/top_3dai_2.jpg" alt="">
            </figure>
            <div class="content">
              <h4 class="ttl">子育て<br>教育サポート</h4>
              <p class="txt">日本の教育機関の紹介や子供が学校の規則・マナーなど日本独自の生活に馴染めるよう、お客様のご相談に対応させていただきます。</p>
              <p class="help">※半年間無料</p>
            </div>
          </div>
        </li>
        <li>
          <div class="point_item">
            <figure class="thumb">
              <img src="<?php echo T_DIRE_URI; ?>/assets/img/top/top_3dai_3.jpg" alt="">
            </figure>
            <div class="content">
              <h4 class="ttl">医療<br>サポート</h4>
              <p class="txt">日本の医療機関の紹介や日本での医療に関するご相談を承ります。</p>
              <p class="help">※半年間無料</p>
            </div>
          </div>
        </li>
      </ul>
      <div class="point_alert">
        <h4 class="lead">購入される不動産ごとに必ず200項目以上の調査・確認をし、<br class="pc">弊社の宅建士が購入トラブルを未然に防ぎます。</h4>
      </div>
      <div class="point_help">①権利関係調査　②法令上の制限等の調査　<br>③管理・修繕状況の調査　④現地調査など ...200項目以上</div>
      <div class="point_notice">
        <h4 class="lead">弊社は日本の不動産投資・日本への移住をサポートします</h4>
      </div>
    </div>
  </section>

  <section class="top_archive_section top_service_section">
    <div class="container">
      <div class="top_archive_title">
        <h2 class="base">Service</h2>
        <h3 class="ttl">海外のエグゼクティブ層のニーズに合わせた物件をご紹介</h3>
      </div>
      <div class="top_archive_desc">
        <p class="m_txt">弊社は、海外のエグゼクティブ層のニーズに合わせた特徴のある<br class="pc">物件のみを厳選してご紹介しています。</p>
      </div>
      <div class="top_archive_trans">
        <h3 class="tr_m_ttl">Introducing properties that meet the needs of overseas executives</h3>
        <p class="tr_m_txt">We carefully select and introduce only properties with characteristics that meet the needs of overseas executives.</p>
      </div>
    </div>
  </section>

  <section class="top_service_list_section">
    <ul class="service_list">
      <li>
        <div class="service_item">
          <div class="left">
            <figure class="thumb">
              <img src="<?php echo T_DIRE_URI; ?>/assets/img/top/top_service-1.jpg" alt="">
            </figure>
          </div>
          <div class="right">
            <a href="<?php echo HOME . 'invest'; ?>" class="index">
              <h4 class="lead">投資用不動産物件</h4>
              <p class="sub">Investment property</p>
            </a>
            <div class="content">
              <div class="m_txt">投資用収益物件・事業用地・ビルなど取扱中物件の一部を公開しております。個人資産としての大型不動産の購入もサポートいたします。</div>
              <div class="trans">
                <div class="tr_m_txt">Some of the properties we are handling, such as profitable properties for investment, business sites, and buildings, are open to the public. We also support the purchase of large real estate as personal assets.</div>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="service_item reverse">
          <div class="left">
            <figure class="thumb">
              <img src="<?php echo T_DIRE_URI; ?>/assets/img/top/top_service-2.jpg" alt="">
            </figure>
          </div>
          <div class="right">
            <a href="<?php echo HOME . 'education'; ?>" class="index">
              <h4 class="lead">文教子育て不動産物件</h4>
              <p class="sub">Property for education</p>
            </a>
            <div class="content">
              <div class="m_txt">将来の資産価値を考えつつ、日本での子どもの教育環境に良い住まいを購入したいというご要望に応えるべく、文教子育て物件をご紹介させていただきます。</div>
              <div class="trans">
                <div class="tr_m_txt">In order to meet the needs of those who want to purchase a home that is good for their children's educational environment in Japan while considering the future asset value, we will introduce educational properties for raising children.</div>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="service_item">
          <div class="left">
            <figure class="thumb">
              <img src="<?php echo T_DIRE_URI; ?>/assets/img/top/top_service-3.jpg" alt="">
            </figure>
          </div>
          <div class="right">
            <a href="<?php echo HOME . 'pet'; ?>" class="index">
              <h4 class="lead">ペット不動産物件</h4>
              <p class="sub">Pet friendly real estate</p>
            </a>
            <div class="content">
              <div class="m_txt">日本ではペットと住める物件が圧倒的に少なく、条件も限定されます。ペットは大切な家族の一員です。弊社では最適な物件をご紹介させていただきます。</div>
              <div class="trans">
                <div class="tr_m_txt">In Japan, there are few properties where you can live with pets, and the conditions are limited.<br>Pets are important members of the family.<br>We will introduce the best properties for you.</div>
              </div>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </section>

</main>

<?php get_footer(); ?>


        