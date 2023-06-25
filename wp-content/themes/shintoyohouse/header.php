<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja" style="margin-top: 0 !important;">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta property="og:locale" content="ja_JP">

  <!-- SEO Meta Tags -->
  <meta name="keywords" content="新豊不動産,賃貸マンション,高級賃貸,高級住宅,賃貸,売買,管理,分譲賃貸,不動産,不動産投資,投資物件" />
  <meta name="description" content="海外投資家向け高級住宅・高級不動産を取り扱う総合不動産会社、新豊不動産の公式サイトです。中央区銀座の新豊不動産では、東京を中心とした高級住宅や事業・投資用高級不動産を紹介しております。豊富な海外投資家ネットワークと経験豊かな国際人材にて、御社の事業をご支援いたします。"/>

  <!-- Webpage Title -->
  <title>
      <?php if(is_front_page() || is_home()){
          echo get_bloginfo('name');
      } else{
          wp_title('|',true,'right'); echo bloginfo('name'); 
      }?>      
  </title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <?php wp_head(); ?>

</head>

<?php 
  global $post;
  
  if( $post->post_type != "page" ) {
    $post_slug = $post->post_type;
  } else {
    $post_slug = $post->post_name;
  }
  if( is_single() ) {
    $category_arr = get_the_category( $post->ID );
    $post_slug = $category_arr[0]->slug;
  }
?>

<body>
  
  <div id="wrapper">

    <header id="header">
      <div class="container">
        <div class="header_wrapper">
          <h1 class="logo scrollto">
            <a href="<?php echo HOME; ?>">
              <img src="<?php echo T_DIRE_URI; ?>/assets/img/common/logo.svg" alt="新豊不動産｜中央区銀座【海外投資家向け高級住宅、事業・投資用高級不動産なら】">
            </a>
          </h1>
          <div class="intro">
            <h2>【海外エグゼクティブ層向け高級住宅、事業・投資向け高級不動産】</h2>
            <p> Luxury housing for overseas executives, luxury real estate for business and investment</p>
          </div>
        </div>
      </div>
    </header>

    <nav class="nav_menu_container">
      <ul class="nav_menu">
        <li>
          <a href="<?php echo HOME; ?>">
            <span class="m">TOP</span>
          </a>
        </li>
        <li>
          <a href="<?php echo HOME . 'about'; ?>">
            <span class="m">What’s 新豊不動産</span>
            <span class="s">サービス紹介</span>
          </a>
        </li>
        <li class="drop_down">
          <a>
            <span class="m">Property</span>
            <span class="s">物件情報</span>
          </a>
          <ul class="dropdown_menu">
            <li>
              <a href="<?php echo HOME . 'invest'; ?>">投資用不動産物件</a>
            </li>
            <li>
              <a href="<?php echo HOME . 'education'; ?>">文教子育て不動産物件</a>
            </li>
            <li>
              <a href="<?php echo HOME . 'pet'; ?>">ペット不動産物件</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="<?php echo HOME . 'company'; ?>">
            <span class="m">Company</span>
            <span class="s">会社情報</span>
          </a>
        </li>
        <li>
          <a href="<?php echo HOME . 'news'; ?>">
            <span class="m">News</span>
            <span class="s">お知らせ</span>
          </a>
        </li>
        <li>
          <a href="<?php echo HOME . 'contact'; ?>">
            <span class="m">Contact</span>
            <span class="s">お問い合わせ</span>
          </a>
        </li>
        <li>
          <a href="<?php echo HOME . 'trust'; ?>">
            <span class="m">SHINTOYO  TRUST</span>
            <span class="s">新豊投信</span>
          </a>
        </li>
      </ul>
    </nav>

    <div id="mobile_nav">
      <div class="nav_body">
        <nav class="mobile_nav_menu_container">
          <ul class="mobile_nav_menu">
            <li>
              <a href="<?php echo HOME; ?>" class="active">TOP</a>
            </li>
            <li>
              <a href="<?php echo HOME . 'about'; ?>">サービス紹介</a>
            </li>
            <li class="drop_down">
              <a>物件情報</a>
              <ul class="dropdown_menu">
                <li>
                  <a href="<?php echo HOME . 'invest'; ?>">投資用不動産物件</a>
                </li>
                <li>
                  <a href="<?php echo HOME . 'education'; ?>">文教子育て不動産物件</a>
                </li>
                <li>
                  <a href="<?php echo HOME . 'pet'; ?>">ペット不動産物件</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="<?php echo HOME . 'company'; ?>">会社案内</a>
            </li>
            <li>
              <a href="<?php echo HOME . 'news'; ?>">お知らせ</a>
            </li>
            <li>
              <a href="<?php echo HOME . 'contact'; ?>">お問い合わせ</a>
            </li>
            <li>
              <a href="<?php echo HOME . 'trust'; ?>">新豊投信</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>