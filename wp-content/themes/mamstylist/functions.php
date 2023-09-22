<?php
/**
 * GLANSTELLA-CABIN functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gramercy-Village
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mamstylist_setup() {
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'mamstylist_setup' );

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

define( 'THEME_NOTE', 'trustrate' );

error_reporting(0);

flush_rewrite_rules();

add_filter('query_vars', function($vars) {
	$vars[] = 'sortby';
    $vars[] = 'search_key';
    $vars[] = 'middleschool';
    $vars[] = 'highschool';
	return $vars;
});

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

// function remove_default_post_type() { 
//    remove_menu_page('edit.php');
// }

// add_action('admin_menu', 'remove_default_post_type'); 


/**
 * Enqueue scripts and styles.
 */
function mamstylist_scripts() {
	if (!is_admin()) {
		// バンドル版のjQueryをロードしない
		wp_deregister_script('jquery');

		// CSSロード
        wp_enqueue_style('c-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', [], '1.0', 'all');
        wp_enqueue_style('c-aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css', [], '1.0', 'all');
		wp_enqueue_style('c-fonts', get_template_directory_uri() . '/assets/font/fonts.css', [], '1.0', 'all');
		wp_enqueue_style('c-reset', get_template_directory_uri() . '/assets/css/reset.css', [], '1.0', 'all');
		wp_enqueue_style('c-common', get_template_directory_uri() . '/assets/css/common.css', [], '1.0', 'all');
        wp_enqueue_style('c-style', get_template_directory_uri() . '/assets/css/style.css', [], '1.0', 'all');
		wp_enqueue_style('c-slick', T_DIRE_URI.'/assets/css/slick.min.css', [], '1.0', 'all');
		wp_enqueue_style('c-slick-theme', T_DIRE_URI.'/assets/css/slick-theme.min.css', [], '1.0', 'all');

		// JSロード
		wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', [], '1.0', 'all');
		wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', [], '1.0', 'all');
        wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/8cbdf0a85f.js', [], '1.0', 'all');
		wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.min.js', [], '1.0', 'all');
		wp_enqueue_script('commonjs', get_template_directory_uri() . '/assets/js/common.js', [], '1.0', 'all');
        wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', [], '1.0', 'all');
        wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/page-search.php', array( 'jquery' ), '1.0', true );
        wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}
}
add_action('wp_enqueue_scripts', 'mamstylist_scripts');

/**
 * 不要なヘッダーを削除
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);


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
    add_image_size( "case-thumbnail", 96, 96, true );
    add_image_size( "medium", 480, 320, true );
    set_post_thumbnail_size( 480, 320, true );
    add_editor_style('assets/css/reset.css');
    add_editor_style('assets/css/common.css');
    add_editor_style('assets/css/style.css');
    add_theme_support( 'automatic-feed-links' );
}

add_action( 'after_setup_theme', 'theme_custom_setup' );

//------remove autop------{
add_filter('tiny_mce_before_init', 'disable_wpautop');
function disable_wpautop($init) {
    $init['wpautop'] = false;
    return $init;
}

define( 'WPCF7_AUTOP', false );

function disable_wp_auto_p( $content ) {
    if ( is_singular( 'page' ) ) {
      remove_filter( 'the_content', 'wpautop' );
    }
    remove_filter( 'the_excerpt', 'wpautop' );
    return $content;
}

add_filter( 'the_content', 'disable_wp_auto_p', 0 );

add_filter('wpcf7_autop_or_not', '__return_false');

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

function custom_tinymce_config( $init ) {
    $init['wpautop'] = false;
    $init['apply_source_formatting'] = true;
    $init['forced_root_block'] = false;
    $init['force_br_newlines'] = true;
    $init['force_p_newlines'] = false;
    $init['convert_newlines_to_brs'] = true;
    return $init;
}
add_filter( 'tiny_mce_before_init', 'custom_tinymce_config' );
//<------remove autop------}

function custom_excerpt_length($length) {
    return 120; // Change this number to set your desired character limit
}
add_filter('excerpt_length', 'custom_excerpt_length');

function custom_excerpt_more($more) {
    return '...'; // Replace this string with your desired ellipsis
}
add_filter('excerpt_more', 'custom_excerpt_more');

//hide the content editor of the interview post
add_action( 'init', function() {
    remove_post_type_support( 'interview', 'editor' );
}, 99);

add_action( 'init', function() {
    remove_post_type_support( 'case', 'editor' );
}, 99);

function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];
  
    if(empty($first_img)) {
      $first_img = T_DIRE_URI . "/assets/img/noimage.png";
    }
    return $first_img;
}

// Define the popularity_ranking key
function custom_product_popularity_ranking_key() {
    return 'popularity_ranking';
}
add_filter('custom_product_popularity_ranking_key', 'custom_product_popularity_ranking_key');

// Update popularity ranking based on sales
function update_product_popularity_ranking_bysales($order_id) {
    $order = wc_get_order($order_id);
    $items = $order->get_items();

    foreach ($items as $item) {
        $product_id = $item->get_product_id();
        $ranking_value = (int) get_post_meta($product_id, 'popularity_ranking', true);
        $ranking_value += 2;
        update_post_meta($product_id, 'popularity_ranking', $ranking_value);
    }
}
add_action('woocommerce_order_status_completed', 'update_product_popularity_ranking_bysales');


function update_product_popularity_ranking_byviews() {
    $product_id = get_the_ID();
    // Update popularity ranking based on product views
    if (is_singular('product')) {
        $ranking_value = (int) get_post_meta($product_id, 'popularity_ranking', true);
        $ranking_value += 1;
        update_post_meta($product_id, 'popularity_ranking', $ranking_value);
    }

    // Store recently visited product IDs in a cookie
    if (is_singular('product')) {
        $recently_viewed = isset($_COOKIE['recently_viewed']) ? $_COOKIE['recently_viewed'] : '';
        $recently_viewed = explode(',', $recently_viewed);
        $recently_viewed = array_filter($recently_viewed);
        $recently_viewed = array_diff($recently_viewed, array($product_id));
        array_unshift($recently_viewed, $product_id);
        $recently_viewed = array_slice($recently_viewed, 0, 5);
        setcookie('recently_viewed', implode(',', $recently_viewed), time() + 3600, '/');
    }

}
add_action('template_redirect', 'update_product_popularity_ranking_byviews');

//Update the price meta key
function update_price_meta_key($cat_slug) {
    $args = [
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ];
    $tax_query = [];
    if($cat_slug) {
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $cat_slug,
        ];
    }
    if(!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }
    $product_query = new WP_Query( $args );
    if($product_query->have_posts()) {
        while($product_query->have_posts()) : $product_query->the_post();
            $product_id = get_the_ID();
            $product = wc_get_product($product_id);
            $variations = $product->get_available_variations();
            $variation_id = $variations[0]['variation_id'];
            $variation_product = wc_get_product($variation_id);
            $price = $variation_product->get_price();
            update_post_meta( $product_id, 'price', $price );
        endwhile;
    }
}

//pagination
function custom_pagination($total_pages, $current_page = 1, $total_counts = 0) {
    global $wp_query;

    $big = 99999999; // set a big number for the links

    $paginate_links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, $current_page),
        'total' => $total_pages,
        'type' => 'array',
        'prev_text' => __('<i class="fa fa-angle-left bounce"></i>'),
        'next_text' => __('<i class="fa fa-angle-right bounce"></i>'),
        'show_all' => true,
        'end_size' => 3,
        'mid_size' => 3
    ));

    
?>
    
    <?php if ($paginate_links) : ?>
    <div class="pager">
        <ul class="pager__wrap">
            <?php foreach ($paginate_links as $link) : ?>
                <li class="pager__bt"><?php echo $link; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
<?php
}

//Ajax request for the number of the posts on the search page.

function handle_ajax_request() {
    // Retrieve the data
    $data = $_POST['my_data'];
    
    // Access the individual values
    $middleschool = $data['middleschool'];
    $highschool = $data['highschool'];
    $situation_params = $data['situation'];
    $genre_params = $data['genre'];
    $price_params = $data['price'];
    $args = [
        'post_type' => 'product',
        'post_status' => 'publish',
        'paged' => $paged,
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
    ];
    
    $tax_query = [];
    
    if($middleschool) {
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => 'middleschool',
        ];
    }
    
    if($highschool) {
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => 'highschool',
        ];
    }
    
    if($situation_params) {
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $situation_params,
        ];
    }

    if($genre_params) {
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $genre_params,
        ];
    }
    
    if($price_params) {
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $price_params,
        ];
    }
    
    if(!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }
    $product_query  = new WP_Query( $args );
    
    $total_counts = $product_query->found_posts;
    
    $response = array(
        'total_counts' => $total_counts,
        'message' => 'Data received and processed successfully!',
    );
    // echo "sdgsgsergrstg";
    wp_send_json_success( $response );
    wp_die();
}
add_action( 'wp_ajax_my_ajax_action', 'handle_ajax_request' );
add_action( 'wp_ajax_nopriv_my_ajax_action', 'handle_ajax_request' );

//add css style to the admin dashboard
// function custom_dashboard_css() {
//   wp_enqueue_style( 'custom-dashboard-css', T_DIRE_URI.'/assets/css/admin-dashboard.css' );
// }
// add_action( 'admin_enqueue_scripts', 'custom_dashboard_css' );


?>