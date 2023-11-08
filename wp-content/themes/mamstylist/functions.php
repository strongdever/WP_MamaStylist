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
        wp_enqueue_style('c-theme-style', get_template_directory_uri() . '/style.css', [], '1.0', 'all');
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

function set_custom_meta_key($post_id) {    //when click the publish button
    // Check if the post is not an auto-save or revision
    if ( ! wp_is_post_autosave($post_id) && ! wp_is_post_revision($post_id) ) {
        // Set the value for your custom meta key
        $product = get_post($post_id);

        //meta keys of product_title and product_content
        if ($product) {
            $product_title = $product->post_title;
            $product_content = $product->post_content;
        } else {
            $product_title = "";
            $product_content = "";
        }
        update_post_meta($post_id, 'product_title', $product_title);
        update_post_meta($post_id, 'product_content', $product_content);

        //initializing the meta key for 人気順
        $ranking_value = (int) get_post_meta($post_id, 'popularity_ranking', true);
        if( !($ranking_value > 0) ) {
            update_post_meta($post_id, 'popularity_ranking', 0);
        }

    }
}
    add_action('save_post', 'set_custom_meta_key');

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

//woocommerce product related product title and the menu title change
add_filter(  'gettext',  'wps_translate_words_array'  );
add_filter(  'ngettext',  'wps_translate_words_array'  );
function wps_translate_words_array( $translated ) {
     $words = array(
                // 'word to translate' = > 'translation'
               'Products' => 'コーディネートのポイント',
               'All Items' => '商品一覧',
               'Add New' => '新規追加',
               'Edit product' => '商品一覧',
               '商品' => '商品一覧',
               '商品一覧名' => 'コーディネートのポイント',
               'Description' => '商品ページURL',
               '商品一覧説明' => 'コーディネートのポイント',
               '商品一覧の簡単な説明' => 'コーディネートのポイントの簡単な商品ページURL',
               'すべてのコーディネートのポイント' => '商品一覧',
               '商品一覧を編集' => '商品編集',
               '商品一覧データ' => '商品のデータ',
               '属性' => '各アイテムの名前',
               'バリエーション' => '各アイテムの価格とURL',
               '新商品一覧を追加' => '商品を追加',
               '商品一覧画像' => 'サムネイル',
               '商品一覧カテゴリー' => 'カテゴリー',
               '商品一覧タグ' => 'タグ',
               '商品一覧ギャラリー' => '商品画像',
               'すべての商品一覧' => '商品一覧',
     );
     $translated = str_ireplace(  array_keys($words),  $words,  $translated );
     return $translated;
}

function change_woocommerce_menu_name( $menu ) {
    foreach ( $menu as $key => $item ) {
        if ( $item[2] === 'edit.php?post_type=product' ) {
            $menu[$key][0] = '商品';
            break;
        }
    }
    return $menu;
}
add_filter( 'add_menu_classes', 'change_woocommerce_menu_name' );

//adding font family
function custom_editor_fonts($initArray) {
    $initArray['font_formats'] = 'Arial=arial,helvetica,sans-serif;Verdana=verdana,geneva,sans-serif;DNP ShueiMGoStd=DNP ShueiMGoStd;DIN 2014 Demi=DIN 2014 Demi';
    return $initArray;
}
add_filter('tiny_mce_before_init', 'custom_editor_fonts');

//add javascript to the admin dashboard
function enqueue_custom_scripts() {
    wp_enqueue_script('custom-editor-script', get_template_directory_uri() . '/assets/js/custom-editor-script.js', array('jquery'), '1.0', true);
  }
add_action('admin_enqueue_scripts', 'enqueue_custom_scripts');

// add css style to the admin dashboard
function custom_dashboard_css() {
  wp_enqueue_style( 'custom-dashboard-css', T_DIRE_URI.'/assets/css/admin-dashboard.css' );
}
add_action( 'admin_enqueue_scripts', 'custom_dashboard_css' );

function remove_product_column( $columns ) { // Remove the desired column by unset() function
    unset( $columns['sku'] ); //hide 'SKU' column item from the product list on the wordpress dashboard
    unset( $columns['is_in_stock'] ); //hide '在庫' column item from the product list on the wordpress dashboard
    unset( $columns['product_tag'] ); //hide 'タグ' column item from the product list on the wordpress dashboard
    return $columns;
}
add_filter( 'manage_product_posts_columns', 'remove_product_column', 99 );

function change_product_column_text( $columns ) { // Change the text of the desired column
    $columns['price'] = '価格帯'; // Replace 'column_name' with the actual column you want to change
    return $columns;
}
add_filter( 'manage_product_posts_columns', 'change_product_column_text', 20 );

function add_set_column( $columns ) {
    $columns['set_price'] = '金額'; // Add the new column
    return $columns;
}
add_filter( 'manage_product_posts_columns', 'add_set_column', 10, 1 );

function customize_column_item_sortable($columns) {
    $columns['set_price'] = 'set_price';  // Add the new column item to the sortable columns array
    return $columns;  // Return the modified sortable columns array
}
add_filter('manage_edit-product_sortable_columns', 'customize_column_item_sortable');

function rearrange_columns($columns) {
    // Define the desired column order
    $new_columns = array(
        'cb' => $columns['cb'],
        'thumb' => $columns['thumb'],
        'title' => $columns['name'],
        'set_price' => $columns['set_price'],
        'price' => $columns['price'],
        'product_cat' => $columns['product_cat'],
        'featured' => $columns['featured'],
        'date' => $columns['date'],
    );
    return $new_columns;  // Return the rearranged columns array
}
add_filter('manage_edit-product_columns', 'rearrange_columns');

function populate_set_column( $column, $post_id ) {
    if ( $column === 'set_price' ) {
        $product = wc_get_product($post_id); // Get the product object
        if ($product->is_type('variable')) { // Check if the product has variations
            $variations = $product->get_available_variations(); // Get all variations
            $variation_id = $variations[0]['variation_id'];
            $variation_product = wc_get_product($variation_id);
            $price = number_format($variation_product->get_price());
        }
        echo '¥' . $price; // Display a dash if the attribute value is not 'all'
    }
}
add_action( 'manage_product_posts_custom_column', 'populate_set_column', 10, 2 );

function handle_column_item_sort($query) {
    if (!is_admin()) {
        return;
    }
  
    $orderby = $query->get('orderby');
  
    if ('set_price' === $orderby) {
        $query->set('meta_key', 'price');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'handle_column_item_sort');
?>