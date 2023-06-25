<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// サイト情報
define( 'HOME', home_url( '/' ) );
define( 'TITLE', get_option( 'blogname' ) );

// 状態
define( 'IS_ADMIN', is_admin() );
define( 'IS_LOGIN', is_user_logged_in() );
define( 'IS_CUSTOMIZER', is_customize_preview() );

// テーマディレクトリパス
define( 'T_DIRE', get_template_directory() );
define( 'S_DIRE', get_stylesheet_directory() );
define( 'T_DIRE_URI', get_template_directory_uri() );
define( 'S_DIRE_URI', get_stylesheet_directory_uri() );

define( 'THEME_NOTE', 'shinpohouse' );

// define( 'WPCF7_AUTOP', false );

error_reporting(0);

flush_rewrite_rules();

// 固定ページとMW WP Formでビジュアルモードを使用しない
function stop_rich_editor($editor) {
    global $typenow;
    global $post;
    if(in_array($typenow, array('page', 'post', 'mw-wp-form'))) {
        $editor = true;
    }
    return $editor;
}

add_filter('user_can_richedit', 'stop_rich_editor');

// エディター独自スタイル追加
//TinyMCE追加用のスタイルを初期化
if(!function_exists('initialize_tinymce_styles')) {
    function initialize_tinymce_styles($init_array) {
        //追加するスタイルの配列を作成
        $style_formats = array(
            array(
                'title' => '注釈',
                'inline' => 'span',
                'classes' => 'cmn_note'
            )
        );
        //JSONに変換
        $init_array['style_formats'] = json_encode($style_formats);
        return $init_array;
    }
}

add_filter('tiny_mce_before_init', 'initialize_tinymce_styles', 10000);

// オプションページを追加
if(function_exists('acf_add_options_page')) {
    $option_page = acf_add_options_page(array(
        'page_title' => 'テーマオプション', // 設定ページで表示される名前
        'menu_title' => 'テーマオプション', // ナビに表示される名前
        'menu_slug' => 'top_setting',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

function my_script_constants() {
?>
    <script type="text/javascript">
        var templateUrl = '<?php echo S_DIRE_URI; ?>';
        var baseSiteUrl = '<?php echo HOME; ?>';
        var themeAjaxUrl = '<?php echo admin_url( 'admin-ajax.php' ) ?>';
    </script>
<?php
}

add_action('wp_head', 'my_script_constants');

// CSS・スクリプトの読み込み
function theme_add_files() {
    global $post;

	wp_enqueue_style('c-font-common', T_DIRE_URI.'/assets/font/fonts.css', [], '1.0', 'all');
	
    wp_enqueue_style('c-reset', T_DIRE_URI.'/assets/css/reset.css', [], '1.0', 'all');
    wp_enqueue_style('c-slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css', [], '1.0', 'all');
    wp_enqueue_style('c-slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', [], '1.0', 'all');
    wp_enqueue_style('c-lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css', [], '1.0', 'all');
    wp_enqueue_style('c-common', T_DIRE_URI.'/assets/css/common.css', [], '1.0', 'all');
    wp_enqueue_style('c-style', T_DIRE_URI.'/assets/css/style.css', [], '1.0', 'all');
    wp_enqueue_style('c-theme', T_DIRE_URI.'/style.css', [], '1.0', 'all');

    // WordPress本体のjquery.jsを読み込まない
    if(!is_admin()) {
        wp_deregister_script('jquery');
    }

    wp_enqueue_script('s-jquery', T_DIRE_URI.'/assets/js/jquery.min.js', [], '1.0', false);
    wp_enqueue_script('s-slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', [], '1.0', true);
    wp_enqueue_script('s-lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', [], '1.0', true);  
    wp_enqueue_script('s-common', T_DIRE_URI.'/assets/js/common.js', [], '1.0', true);  
}

add_action('wp_enqueue_scripts', 'theme_add_files');

function theme_admin_assets() {
    wp_enqueue_script( 'csv-uploader', T_DIRE_URI . '/admin/script.js', array( 'jquery' ) );
}

// add_action('admin_enqueue_scripts', 'theme_admin_assets');

function custom_term_radio_checklist( $args ) {
    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'product' || $args['taxonomy'] === 'category' ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { 
            if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, ...$args ) {
                        $output = parent::walk( $elements, $max_depth, ...$args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );

                        return $output;
                    }
                }
            }

            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
        }
    }

    return $args;
}

add_filter( 'wp_terms_checklist_args', 'custom_term_radio_checklist' );

function theme_custom_setup() {
    add_theme_support( 'post-thumbnails' ); 
    add_image_size( "thumbnail", 150, 100, true );
    add_image_size( "medium", 480, 320, true );
    set_post_thumbnail_size( 480, 320, true );
    add_editor_style('assets/css/reset.css');
    add_editor_style('assets/css/common.css');
    add_editor_style('assets/css/style.css');
    add_editor_style('editor-style.css');
    add_theme_support( 'automatic-feed-links' );
}

add_action( 'after_setup_theme', 'theme_custom_setup' );

function replaceImagePath( $arg ) {
    $content = str_replace('"images/', '"' . T_DIRE_URI . '/assets/img/', $arg);
    $content = str_replace('"/images/', '"' . T_DIRE_URI . '/assets/img/', $content);
    $content = str_replace(', images/', ', ' . T_DIRE_URI . '/assets/img/', $content);
    $content = str_replace("('images/", "('". T_DIRE_URI . '/assets/img/', $content);
    return $content;
}

add_action('the_content', 'replaceImagePath');

function disable_wp_auto_p( $content ) {
    if ( is_singular( 'page' ) ) {
      remove_filter( 'the_content', 'wpautop' );
    }
    remove_filter( 'the_excerpt', 'wpautop' );
    return $content;
}

add_filter( 'the_content', 'disable_wp_auto_p', 0 );

add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('query_vars', function($vars) {
	$vars[] = 'news_category';
	return $vars;
});

add_filter( 'wpcf7_validate_email*', 'custom_email_confirmation_validation_filter', 20, 2 );
  
function custom_email_confirmation_validation_filter( $result, $tag ) {
  if ( 'your-email-confirm' == $tag->name ) {
    $your_email = isset( $_POST['your-email'] ) ? trim( $_POST['your-email'] ) : '';
    $your_email_confirm = isset( $_POST['your-email-confirm'] ) ? trim( $_POST['your-email-confirm'] ) : '';
  
    if ( $your_email != $your_email_confirm ) {
      $result->invalidate( $tag, "これが正しいメールアドレスですか？" );
    }
  }
  
  return $result;
}

function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];
  
    if(empty($first_img)) {
      $first_img = T_DIRE_URI . "/assets/img/common/no_image.jpg";
    }
    return $first_img;
  }

//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

function taxonomy_checklist_checked_ontop_filter ($args) {
    $args['checked_ontop'] = false;
    return $args;
}

add_filter('wp_terms_checklist_args','taxonomy_checklist_checked_ontop_filter');

function new_excerpt_length($length) {
    return 72;
}
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($more) {
    return '...';
}

add_filter('excerpt_more', 'new_excerpt_more');

function wp_set_post_views( $postID ) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta( $postID, $count_key, true );

    if( $count == '' ) {
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    } else {
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

function wp_get_post_views( $content ) {
    if ( is_single() ) {
        wp_set_post_views(get_the_ID());
    }
    return $content;
}
add_filter( 'the_content', 'wp_get_post_views' );

add_filter( 'previous_post_link', 'filter_single_post_pagination', 10, 4 );
add_filter( 'next_post_link',     'filter_single_post_pagination', 10, 4 );

function filter_single_post_pagination( $output, $format, $link, $post )
{
    if( $post ) {
        $title = get_the_title( $post );
        $url   = get_permalink( $post->ID );
        
        $class = 'prev_btn';

        if ( 'next_post_link' === current_filter() )
        {
            $class = 'next_btn';
        }
        if( $link ) {
            $text = $link;
        }
        ob_start();
        ?>
        <a href="<?php echo $url; ?>" class="page_btn <?php echo $class; ?>"><span><?php echo $text; ?></span></a>
        <?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    return false;
}

function custom_link_btn( $attr ) {

    $args = shortcode_atts( array(
        'link' => '/',
        'text' => 'もっと見る',
    ), $attr );
    
    ob_start();
    $link = $args['link'];
    if (strpos($args['link'], 'http') == false) {
        $link = home_url( $args['link']);
    }
    ?>
    <a href="<?php echo $link; ?>" class="btn mx_auto">
        <span><?php echo $args['text'] ?></span>
    </a>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('link-btn', 'custom_link_btn');

function custom_post_news( $attr ) {

    $args = shortcode_atts( array(
        'count' => 5,

    ), $attr );
    
    ob_start();

    $news_args = [
        'post_type' => 'news',
        'post_status' => 'publish',
        'posts_per_page' => $args['count'],
    ];

    $news_query = new WP_Query( $news_args );

    ?>
    <?php if( $news_query->have_posts() ) : ?>
        <div class="p_news_list_container content_in">
            <div class="p_news_list">
                <?php while( $news_query->have_posts() ) : $news_query->the_post(); ?>
                    <div class="p_news_item" data-aos="fade-up" data-aos-delay="150">
                        <p class="news_date"><?php the_time("Y.m.d"); ?></p>
                        <h4 class="news_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <div class="p_link_btn_wrap" data-aos="fade-up" data-aos-delay="300">
                <a href="<?php echo HOME . 'news'; ?>" class="link_btn ml_auto">
                    <span>すベての記事を見る</span>
                    <picture class="icon_arrow">
                        <source media="(min-width:769px)" srcset="<?php echo T_DIRE_URI; ?>/assets/img/common/arrow-right-pc.png">
                        <source media="(max-width:768px)" srcset="<?php echo T_DIRE_URI; ?>/assets/img/common/arrow-right-sp.png">
                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/common/arrow-right-pc.png" alt="">
                    </picture>
                </a>
            </div>
        </div>
    <?php endif; ?>
    
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('post-news', 'custom_post_news');

?>