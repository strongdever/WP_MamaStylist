<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gramercy-Village
 */

get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$sortby = get_query_var('sortby') ? get_query_var('sortby') : '';
$search_key = get_query_var('search_key') ? get_query_var('search_key') : '';
$s_keys = explode(' ', $search_key);
$middleschool = get_query_var('middleschool') ? get_query_var('middleschool') : '';
$highschool = get_query_var('highschool') ? get_query_var('highschool') : '';
if (isset($_GET['situation'])) {
    $situation_params = $_GET['situation'];
}
if (isset($_GET['genre'])) {
    $genre_params = $_GET['genre'];
}
if (isset($_GET['price'])) {
    $price_params = $_GET['price'];
}

?>
	<main id="page-activity">

        <section class="status-bar">
            <div class="nav-status">
                <a href="<?= esc_url(home_url('/')); ?>">トップ </a>
                <i class="fa fa-angle-right"></i>
                <h4>商品一覧</h4>
            </div>
        </section>

        <?php
            $number_per_page = 24;
            if(empty($sortby) || $sortby == 'popularity') {
                $args = [
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'posts_per_page' => $number_per_page,
                    'meta_key' => 'popularity_ranking',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                ];
                
            }
            else if($sortby == 'newly') {
                $args = [
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'paged' => $paged,
                    'posts_per_page' => $number_per_page,
                    'orderby'        => 'date',
                    'order' => 'DESC',
                ];
            }
            else if($sortby == 'price') {
                update_price_meta_key('');
                $args = [
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'paged' => $paged,
                    'posts_per_page' => $number_per_page,
                    'orderby'        => 'meta_value_num',
                    'meta_key'       => 'price',
                    'order' => 'ASC',
                ];
            }
            
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

            //search keys
            if($s_keys) {
                $meta_query = [
                    'relation' => 'OR',
                ];
                foreach( $s_keys as $s_key ) {
                    $meta_query[] = array(
                        'key'     => 'product_title', // Replace with the custom field key if needed
                        'value'   => $s_key, // Replace with your search keywords
                        'compare' => 'LIKE',
                    );
                    $meta_query[] = array(
                        'key'     => 'product_content', // Replace with the custom field key if needed
                        'value'   => $s_key, // Replace with your search keywords
                        'compare' => 'LIKE',
                    );
                }
                $args['meta_query'] = $meta_query;
            }

            $product_query = new WP_Query( $args );
        ?>
        <section class="middleschool students-product">
            <div class="container">
                <!-- <h2 class="sub-title">
                    中学生男子の服
                </h2> -->
                <div class="search-wrapper">
                    <div class=search-result>
                        <span><?php echo $product_query->found_posts; ?></span>&nbsp;件見つかりました
                    </div>
                    <?php if( $search_key || $middleschool || $highschool || $situation_params || $genre_params || $price_params) : ?>
                    <div class="search-keywords">
                        <div class="label">選択中の条件</div>
                        <div class="keywords-list">
                            <?php if($search_key) : ?>
                                <?php foreach ( $s_keys as $s_key ) : ?>
                                    <?php if(trim($s_key)) : ?>
                            <button class="btn-keyword" data-value="s_key" value="<?php echo $s_key; ?>">
                                <?php echo $s_key; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M10 0.25C8.07164 0.25 6.18657 0.821828 4.58319 1.89317C2.97982 2.96451 1.73013 4.48726 0.992179 6.26884C0.254225 8.05042 0.061142 10.0108 0.437348 11.9021C0.813554 13.7934 1.74215 15.5307 3.10571 16.8943C4.46928 18.2579 6.20656 19.1865 8.09787 19.5627C9.98919 19.9389 11.9496 19.7458 13.7312 19.0078C15.5127 18.2699 17.0355 17.0202 18.1068 15.4168C19.1782 13.8134 19.75 11.9284 19.75 10C19.7473 7.41498 18.7192 4.93661 16.8913 3.10872C15.0634 1.28084 12.585 0.25273 10 0.25ZM13.5306 12.4694C13.6003 12.5391 13.6556 12.6218 13.6933 12.7128C13.731 12.8039 13.7504 12.9015 13.7504 13C13.7504 13.0985 13.731 13.1961 13.6933 13.2872C13.6556 13.3782 13.6003 13.4609 13.5306 13.5306C13.4609 13.6003 13.3782 13.6556 13.2872 13.6933C13.1961 13.731 13.0986 13.7504 13 13.7504C12.9015 13.7504 12.8039 13.731 12.7128 13.6933C12.6218 13.6556 12.5391 13.6003 12.4694 13.5306L10 11.0603L7.53063 13.5306C7.46095 13.6003 7.37822 13.6556 7.28718 13.6933C7.19613 13.731 7.09855 13.7504 7 13.7504C6.90146 13.7504 6.80388 13.731 6.71283 13.6933C6.62179 13.6556 6.53906 13.6003 6.46938 13.5306C6.3997 13.4609 6.34442 13.3782 6.30671 13.2872C6.269 13.1961 6.24959 13.0985 6.24959 13C6.24959 12.9015 6.269 12.8039 6.30671 12.7128C6.34442 12.6218 6.3997 12.5391 6.46938 12.4694L8.93969 10L6.46938 7.53063C6.32865 7.38989 6.24959 7.19902 6.24959 7C6.24959 6.80098 6.32865 6.61011 6.46938 6.46937C6.61011 6.32864 6.80098 6.24958 7 6.24958C7.19903 6.24958 7.3899 6.32864 7.53063 6.46937L10 8.93969L12.4694 6.46937C12.5391 6.39969 12.6218 6.34442 12.7128 6.3067C12.8039 6.26899 12.9015 6.24958 13 6.24958C13.0986 6.24958 13.1961 6.26899 13.2872 6.3067C13.3782 6.34442 13.4609 6.39969 13.5306 6.46937C13.6003 6.53906 13.6556 6.62178 13.6933 6.71283C13.731 6.80387 13.7504 6.90145 13.7504 7C13.7504 7.09855 13.731 7.19613 13.6933 7.28717C13.6556 7.37822 13.6003 7.46094 13.5306 7.53063L11.0603 10L13.5306 12.4694Z" fill="#13A4A0"/>
</svg>
                            </button>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if($middleschool) : ?>
                            <button class="btn-keyword" data-value="middleschool">
                                中学生男子の服
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path d="M10 0.25C8.07164 0.25 6.18657 0.821828 4.58319 1.89317C2.97982 2.96451 1.73013 4.48726 0.992179 6.26884C0.254225 8.05042 0.061142 10.0108 0.437348 11.9021C0.813554 13.7934 1.74215 15.5307 3.10571 16.8943C4.46928 18.2579 6.20656 19.1865 8.09787 19.5627C9.98919 19.9389 11.9496 19.7458 13.7312 19.0078C15.5127 18.2699 17.0355 17.0202 18.1068 15.4168C19.1782 13.8134 19.75 11.9284 19.75 10C19.7473 7.41498 18.7192 4.93661 16.8913 3.10872C15.0634 1.28084 12.585 0.25273 10 0.25ZM13.5306 12.4694C13.6003 12.5391 13.6556 12.6218 13.6933 12.7128C13.731 12.8039 13.7504 12.9015 13.7504 13C13.7504 13.0985 13.731 13.1961 13.6933 13.2872C13.6556 13.3782 13.6003 13.4609 13.5306 13.5306C13.4609 13.6003 13.3782 13.6556 13.2872 13.6933C13.1961 13.731 13.0986 13.7504 13 13.7504C12.9015 13.7504 12.8039 13.731 12.7128 13.6933C12.6218 13.6556 12.5391 13.6003 12.4694 13.5306L10 11.0603L7.53063 13.5306C7.46095 13.6003 7.37822 13.6556 7.28718 13.6933C7.19613 13.731 7.09855 13.7504 7 13.7504C6.90146 13.7504 6.80388 13.731 6.71283 13.6933C6.62179 13.6556 6.53906 13.6003 6.46938 13.5306C6.3997 13.4609 6.34442 13.3782 6.30671 13.2872C6.269 13.1961 6.24959 13.0985 6.24959 13C6.24959 12.9015 6.269 12.8039 6.30671 12.7128C6.34442 12.6218 6.3997 12.5391 6.46938 12.4694L8.93969 10L6.46938 7.53063C6.32865 7.38989 6.24959 7.19902 6.24959 7C6.24959 6.80098 6.32865 6.61011 6.46938 6.46937C6.61011 6.32864 6.80098 6.24958 7 6.24958C7.19903 6.24958 7.3899 6.32864 7.53063 6.46937L10 8.93969L12.4694 6.46937C12.5391 6.39969 12.6218 6.34442 12.7128 6.3067C12.8039 6.26899 12.9015 6.24958 13 6.24958C13.0986 6.24958 13.1961 6.26899 13.2872 6.3067C13.3782 6.34442 13.4609 6.39969 13.5306 6.46937C13.6003 6.53906 13.6556 6.62178 13.6933 6.71283C13.731 6.80387 13.7504 6.90145 13.7504 7C13.7504 7.09855 13.731 7.19613 13.6933 7.28717C13.6556 7.37822 13.6003 7.46094 13.5306 7.53063L11.0603 10L13.5306 12.4694Z" fill="#13A4A0"/>
</svg>
                            </button>
                            <?php endif; ?>

                            <?php if($highschool) : ?>
                            <button class="btn-keyword" data-value="highschool">
                                高校生男子の服
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path d="M10 0.25C8.07164 0.25 6.18657 0.821828 4.58319 1.89317C2.97982 2.96451 1.73013 4.48726 0.992179 6.26884C0.254225 8.05042 0.061142 10.0108 0.437348 11.9021C0.813554 13.7934 1.74215 15.5307 3.10571 16.8943C4.46928 18.2579 6.20656 19.1865 8.09787 19.5627C9.98919 19.9389 11.9496 19.7458 13.7312 19.0078C15.5127 18.2699 17.0355 17.0202 18.1068 15.4168C19.1782 13.8134 19.75 11.9284 19.75 10C19.7473 7.41498 18.7192 4.93661 16.8913 3.10872C15.0634 1.28084 12.585 0.25273 10 0.25ZM13.5306 12.4694C13.6003 12.5391 13.6556 12.6218 13.6933 12.7128C13.731 12.8039 13.7504 12.9015 13.7504 13C13.7504 13.0985 13.731 13.1961 13.6933 13.2872C13.6556 13.3782 13.6003 13.4609 13.5306 13.5306C13.4609 13.6003 13.3782 13.6556 13.2872 13.6933C13.1961 13.731 13.0986 13.7504 13 13.7504C12.9015 13.7504 12.8039 13.731 12.7128 13.6933C12.6218 13.6556 12.5391 13.6003 12.4694 13.5306L10 11.0603L7.53063 13.5306C7.46095 13.6003 7.37822 13.6556 7.28718 13.6933C7.19613 13.731 7.09855 13.7504 7 13.7504C6.90146 13.7504 6.80388 13.731 6.71283 13.6933C6.62179 13.6556 6.53906 13.6003 6.46938 13.5306C6.3997 13.4609 6.34442 13.3782 6.30671 13.2872C6.269 13.1961 6.24959 13.0985 6.24959 13C6.24959 12.9015 6.269 12.8039 6.30671 12.7128C6.34442 12.6218 6.3997 12.5391 6.46938 12.4694L8.93969 10L6.46938 7.53063C6.32865 7.38989 6.24959 7.19902 6.24959 7C6.24959 6.80098 6.32865 6.61011 6.46938 6.46937C6.61011 6.32864 6.80098 6.24958 7 6.24958C7.19903 6.24958 7.3899 6.32864 7.53063 6.46937L10 8.93969L12.4694 6.46937C12.5391 6.39969 12.6218 6.34442 12.7128 6.3067C12.8039 6.26899 12.9015 6.24958 13 6.24958C13.0986 6.24958 13.1961 6.26899 13.2872 6.3067C13.3782 6.34442 13.4609 6.39969 13.5306 6.46937C13.6003 6.53906 13.6556 6.62178 13.6933 6.71283C13.731 6.80387 13.7504 6.90145 13.7504 7C13.7504 7.09855 13.731 7.19613 13.6933 7.28717C13.6556 7.37822 13.6003 7.46094 13.5306 7.53063L11.0603 10L13.5306 12.4694Z" fill="#13A4A0"/>
</svg>
                            </button>
                            <?php endif; ?>

                            <?php if( $situation_params ) : ?>
                                <?php foreach($situation_params as $situation_slug) :
                                    $taxonomy = get_term_by('slug', $situation_slug, 'product_cat');
                                    if ($taxonomy) {
                                        $taxonomy_name = $taxonomy->name;
                                    }
                                ?>
                            <button class="btn-keyword" data-value="<?php echo $situation_slug; ?>">
                                <?php echo $taxonomy_name; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path d="M10 0.25C8.07164 0.25 6.18657 0.821828 4.58319 1.89317C2.97982 2.96451 1.73013 4.48726 0.992179 6.26884C0.254225 8.05042 0.061142 10.0108 0.437348 11.9021C0.813554 13.7934 1.74215 15.5307 3.10571 16.8943C4.46928 18.2579 6.20656 19.1865 8.09787 19.5627C9.98919 19.9389 11.9496 19.7458 13.7312 19.0078C15.5127 18.2699 17.0355 17.0202 18.1068 15.4168C19.1782 13.8134 19.75 11.9284 19.75 10C19.7473 7.41498 18.7192 4.93661 16.8913 3.10872C15.0634 1.28084 12.585 0.25273 10 0.25ZM13.5306 12.4694C13.6003 12.5391 13.6556 12.6218 13.6933 12.7128C13.731 12.8039 13.7504 12.9015 13.7504 13C13.7504 13.0985 13.731 13.1961 13.6933 13.2872C13.6556 13.3782 13.6003 13.4609 13.5306 13.5306C13.4609 13.6003 13.3782 13.6556 13.2872 13.6933C13.1961 13.731 13.0986 13.7504 13 13.7504C12.9015 13.7504 12.8039 13.731 12.7128 13.6933C12.6218 13.6556 12.5391 13.6003 12.4694 13.5306L10 11.0603L7.53063 13.5306C7.46095 13.6003 7.37822 13.6556 7.28718 13.6933C7.19613 13.731 7.09855 13.7504 7 13.7504C6.90146 13.7504 6.80388 13.731 6.71283 13.6933C6.62179 13.6556 6.53906 13.6003 6.46938 13.5306C6.3997 13.4609 6.34442 13.3782 6.30671 13.2872C6.269 13.1961 6.24959 13.0985 6.24959 13C6.24959 12.9015 6.269 12.8039 6.30671 12.7128C6.34442 12.6218 6.3997 12.5391 6.46938 12.4694L8.93969 10L6.46938 7.53063C6.32865 7.38989 6.24959 7.19902 6.24959 7C6.24959 6.80098 6.32865 6.61011 6.46938 6.46937C6.61011 6.32864 6.80098 6.24958 7 6.24958C7.19903 6.24958 7.3899 6.32864 7.53063 6.46937L10 8.93969L12.4694 6.46937C12.5391 6.39969 12.6218 6.34442 12.7128 6.3067C12.8039 6.26899 12.9015 6.24958 13 6.24958C13.0986 6.24958 13.1961 6.26899 13.2872 6.3067C13.3782 6.34442 13.4609 6.39969 13.5306 6.46937C13.6003 6.53906 13.6556 6.62178 13.6933 6.71283C13.731 6.80387 13.7504 6.90145 13.7504 7C13.7504 7.09855 13.731 7.19613 13.6933 7.28717C13.6556 7.37822 13.6003 7.46094 13.5306 7.53063L11.0603 10L13.5306 12.4694Z" fill="#13A4A0"/>
</svg>
                            </button>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if( $genre_params ) : ?>
                                <?php foreach($genre_params as $genre_slug) :
                                    $taxonomy = get_term_by('slug', $genre_slug, 'product_cat');
                                    if ($taxonomy) {
                                        $taxonomy_name = $taxonomy->name;
                                    }
                                ?>
                            <button class="btn-keyword" data-value="<?php echo $genre_slug; ?>">
                                <?php echo $taxonomy_name; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path d="M10 0.25C8.07164 0.25 6.18657 0.821828 4.58319 1.89317C2.97982 2.96451 1.73013 4.48726 0.992179 6.26884C0.254225 8.05042 0.061142 10.0108 0.437348 11.9021C0.813554 13.7934 1.74215 15.5307 3.10571 16.8943C4.46928 18.2579 6.20656 19.1865 8.09787 19.5627C9.98919 19.9389 11.9496 19.7458 13.7312 19.0078C15.5127 18.2699 17.0355 17.0202 18.1068 15.4168C19.1782 13.8134 19.75 11.9284 19.75 10C19.7473 7.41498 18.7192 4.93661 16.8913 3.10872C15.0634 1.28084 12.585 0.25273 10 0.25ZM13.5306 12.4694C13.6003 12.5391 13.6556 12.6218 13.6933 12.7128C13.731 12.8039 13.7504 12.9015 13.7504 13C13.7504 13.0985 13.731 13.1961 13.6933 13.2872C13.6556 13.3782 13.6003 13.4609 13.5306 13.5306C13.4609 13.6003 13.3782 13.6556 13.2872 13.6933C13.1961 13.731 13.0986 13.7504 13 13.7504C12.9015 13.7504 12.8039 13.731 12.7128 13.6933C12.6218 13.6556 12.5391 13.6003 12.4694 13.5306L10 11.0603L7.53063 13.5306C7.46095 13.6003 7.37822 13.6556 7.28718 13.6933C7.19613 13.731 7.09855 13.7504 7 13.7504C6.90146 13.7504 6.80388 13.731 6.71283 13.6933C6.62179 13.6556 6.53906 13.6003 6.46938 13.5306C6.3997 13.4609 6.34442 13.3782 6.30671 13.2872C6.269 13.1961 6.24959 13.0985 6.24959 13C6.24959 12.9015 6.269 12.8039 6.30671 12.7128C6.34442 12.6218 6.3997 12.5391 6.46938 12.4694L8.93969 10L6.46938 7.53063C6.32865 7.38989 6.24959 7.19902 6.24959 7C6.24959 6.80098 6.32865 6.61011 6.46938 6.46937C6.61011 6.32864 6.80098 6.24958 7 6.24958C7.19903 6.24958 7.3899 6.32864 7.53063 6.46937L10 8.93969L12.4694 6.46937C12.5391 6.39969 12.6218 6.34442 12.7128 6.3067C12.8039 6.26899 12.9015 6.24958 13 6.24958C13.0986 6.24958 13.1961 6.26899 13.2872 6.3067C13.3782 6.34442 13.4609 6.39969 13.5306 6.46937C13.6003 6.53906 13.6556 6.62178 13.6933 6.71283C13.731 6.80387 13.7504 6.90145 13.7504 7C13.7504 7.09855 13.731 7.19613 13.6933 7.28717C13.6556 7.37822 13.6003 7.46094 13.5306 7.53063L11.0603 10L13.5306 12.4694Z" fill="#13A4A0"/>
</svg>
                            </button>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if( $price_params ) : ?>
                                <?php foreach($price_params as $price_slug) :
                                    $taxonomy = get_term_by('slug', $price_slug, 'product_cat');
                                    if ($taxonomy) {
                                        $taxonomy_name = $taxonomy->name;
                                    }
                                ?>
                            <button class="btn-keyword" data-value="<?php echo $price_slug; ?>">
                                <?php echo $taxonomy_name; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path d="M10 0.25C8.07164 0.25 6.18657 0.821828 4.58319 1.89317C2.97982 2.96451 1.73013 4.48726 0.992179 6.26884C0.254225 8.05042 0.061142 10.0108 0.437348 11.9021C0.813554 13.7934 1.74215 15.5307 3.10571 16.8943C4.46928 18.2579 6.20656 19.1865 8.09787 19.5627C9.98919 19.9389 11.9496 19.7458 13.7312 19.0078C15.5127 18.2699 17.0355 17.0202 18.1068 15.4168C19.1782 13.8134 19.75 11.9284 19.75 10C19.7473 7.41498 18.7192 4.93661 16.8913 3.10872C15.0634 1.28084 12.585 0.25273 10 0.25ZM13.5306 12.4694C13.6003 12.5391 13.6556 12.6218 13.6933 12.7128C13.731 12.8039 13.7504 12.9015 13.7504 13C13.7504 13.0985 13.731 13.1961 13.6933 13.2872C13.6556 13.3782 13.6003 13.4609 13.5306 13.5306C13.4609 13.6003 13.3782 13.6556 13.2872 13.6933C13.1961 13.731 13.0986 13.7504 13 13.7504C12.9015 13.7504 12.8039 13.731 12.7128 13.6933C12.6218 13.6556 12.5391 13.6003 12.4694 13.5306L10 11.0603L7.53063 13.5306C7.46095 13.6003 7.37822 13.6556 7.28718 13.6933C7.19613 13.731 7.09855 13.7504 7 13.7504C6.90146 13.7504 6.80388 13.731 6.71283 13.6933C6.62179 13.6556 6.53906 13.6003 6.46938 13.5306C6.3997 13.4609 6.34442 13.3782 6.30671 13.2872C6.269 13.1961 6.24959 13.0985 6.24959 13C6.24959 12.9015 6.269 12.8039 6.30671 12.7128C6.34442 12.6218 6.3997 12.5391 6.46938 12.4694L8.93969 10L6.46938 7.53063C6.32865 7.38989 6.24959 7.19902 6.24959 7C6.24959 6.80098 6.32865 6.61011 6.46938 6.46937C6.61011 6.32864 6.80098 6.24958 7 6.24958C7.19903 6.24958 7.3899 6.32864 7.53063 6.46937L10 8.93969L12.4694 6.46937C12.5391 6.39969 12.6218 6.34442 12.7128 6.3067C12.8039 6.26899 12.9015 6.24958 13 6.24958C13.0986 6.24958 13.1961 6.26899 13.2872 6.3067C13.3782 6.34442 13.4609 6.39969 13.5306 6.46937C13.6003 6.53906 13.6556 6.62178 13.6933 6.71283C13.731 6.80387 13.7504 6.90145 13.7504 7C13.7504 7.09855 13.731 7.19613 13.6933 7.28717C13.6556 7.37822 13.6003 7.46094 13.5306 7.53063L11.0603 10L13.5306 12.4694Z" fill="#13A4A0"/>
</svg>
                            </button>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="products">
                    <!-- <div class="sortby">
                        <ul class="sortby-tabs">
                            <li>
                                <a class="sortby-item" href="">
                                    人気順
                                </a>
                            </li>
                            <li>
                                <a class="sortby-item" href="">
                                    価格の安い順
                                </a>
                            </li>
                            <li>
                                <a class="sortby-item" href="">
                                    新着順
                                </a>
                            </li>
                        </ul>
                    </div> -->
                    
                    <div class="pagination">
                        <?php
                        $total_counts = $product_query->found_posts;
                        $current_page = $paged;
                        $first_number = $total_counts == 0 ? 0 : ($current_page - 1) * $number_per_page + 1;
                        $secode_number = ($current_page * $number_per_page) > $total_counts ? $total_counts : ($current_page * $number_per_page);
                        ?>
                        <p class="pager__num"<?php echo $paginate_links ? '' : ' style="margin-right: 0;"'; ?>><?php echo $first_number; ?>～<?php echo $secode_number; ?>件表示</p>

                        <!-- <div class="display-number">50件中  1-20件表示</div> -->
                        <select name="sortby" id="sortby" class="mid-produc-sort">
                            <option value="popularity" <?php echo $sortby=="popularity" ? "selected" : ""; ?>>人気順</option>
                            <option value="price" <?php echo $sortby=="price" ? "selected" : ""; ?>>価格の安い順</option>
                            <option value="newly" <?php echo $sortby=="newly" ? "selected" : ""; ?>>新着順</option>
                        </select>
                        <?php custom_pagination($product_query->max_num_pages, $paged, $product_query->found_posts); ?>
                    </div>
                    
                    <?php if($product_query->have_posts()) : ?>
                    <ul class="product-list">
                    <?php while($product_query->have_posts()) : $product_query->the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" class="product">
                            <?php if( has_post_thumbnail() ): ?>
                                <img class="thumb" src="<?php echo get_the_post_thumbnail_url(); ?>">
                            <?php else: ?>
                                <img class="thumb" src="<?php echo catch_that_image(); ?>"></a>
                            <?php endif; ?>
                                
                                <?php
                                $product_cats = get_the_terms(get_the_ID(), 'product_cat');
                                if( $product_cats ) :
                                    foreach($product_cats as $product_cat) :
                                        $parent_term = get_term( $product_cat->parent );
                                        if( $parent_term->name == 'シチュエーションから選ぶ' ) :
                                ?>
                                <h4 class="product-cat"><?php echo $product_cat->name; ?></h4>
                                <?php endif; ?>
                                <?php endforeach;
                                endif; ?>

                                <h3 class="product-name"><?php the_title(); ?></h3>

                                <div class="price-wrap">
                                    <div class="pre-text">全部で</div>
                                    <?php
                                    $product_id = get_the_ID(); // Get the current product ID or specify the product ID
                                    $product = wc_get_product($product_id); // Get the product object
                                    if ($product->is_type('variable')) { // Check if the product has variations
                                        $variations = $product->get_available_variations(); // Get all variations
                                        $variation_id = $variations[0]['variation_id'];  // var_export($variations[0]['variation_id']);
                                        $variation_product = wc_get_product($variation_id);
                                        $price = $variation_product->get_price();
                                    }
                                    ?>
                                    <h3 class="price">
                                    ¥<?php echo number_format($price); ?>
                                    </h3>
                                </div>
                            </a>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <script type="text/javascript">
        $(document).ready(function() {
        // Attach a change` event handler to the select element with id "mySelect"
            $("#sortby").change(function() {
                // Get the selected value
                var selectedValue = $(this).val();
                var url = "<?php echo HOME . 'product'; ?>" + "?sortby=" + selectedValue;
                <?php
                if($search_key) {
                ?>
                url = url + "<?php echo '&search_key=' . $search_key; ?>";
                <?php
                }
                ?>

                <?php
                if($middleschool) {
                ?>
                url = url + "<?php echo '&middleschool=1'; ?>";
                <?php
                }
                ?>

                <?php
                if($highschool) {
                ?>
                url = url + "<?php echo '&highschool=1'; ?>";
                <?php
                }
                ?>

                <?php if($situation_params) :
                    $i = 0;
                    foreach($situation_params as $situation_param) : ?>
                url = url + "<?php echo '&situation[' . $i . ']=' . $situation_param; ?>";
                    <?php
                    $i++;
                    endforeach;
                    ?>
                <?php endif; ?>

                <?php if($genre_params) :
                    $i = 0;
                    foreach($genre_params as $genre_param) : ?>
                url = url + "<?php echo '&genre[' . $i . ']=' . $genre_param; ?>";
                    <?php
                    $i++;
                    endforeach;
                    ?>
                <?php endif; ?>

                <?php if($price_params) :
                    $i = 0;
                    foreach($price_params as $price_param) : ?>
                url = url + "<?php echo '&price[' . $i . ']=' . $price_param; ?>";
                    <?php
                    $i++;
                    endforeach;
                    ?>
                <?php endif; ?>
                window.location.href = url;
            });

            var key_clicked = false;
            $(".btn-keyword").click(function() {
                if(!key_clicked) {
                    $(this).remove();
                    var url = "<?php echo HOME . 'product'; ?>?";
                    <?php if($sortby) : ?>
                    url += 'sortby=<?php echo $sortby; ?>';
                    <?php endif; ?>
                    
                    <?php
                    if($search_key) {
                    ?>
                        var search_value = '';
                    <?php
                        foreach( $s_keys as $s_key ) {
                    ?>
                            if('<?php echo $s_key; ?>' != $(this).val()) {
                                search_value += '<?php echo $s_key; ?> ';
                            }
                    <?php
                        }
                    ?>  
                        if(search_value) {
                            <?php
                            if($sortby) {
                            ?>
                                url += '&search_key=' + search_value;
                            <?php
                            } else {
                            ?>
                                url += '?search_key=' + search_value;
                            <?php
                            }
                            ?>
                        }
                    <?php
                    }
                    ?>

                    if($(this).attr("data-value") != 'middleschool') {
                        <?php if($middleschool) : 
                            if($sortby || $search_key) {
                            ?>
                        url += '&middleschool=1';
                        <?php
                            } else {
                        ?>
                        url += '?middleschool=1';
                        <?php 
                            }
                        endif; ?>
                    }

                    if($(this).attr("data-value") != 'highschool') {
                        <?php if($highschool) : 
                            if($sortby || $search_key || $middleschool) {
                            ?>
                        url += '&highschool=1';
                        <?php
                            } else {
                        ?>
                        url += '?highschool=1';
                        <?php 
                            }
                        endif; ?>
                    }

                    <?php
                    if($situation_params) {
                        $i = 0;
                        foreach($situation_params as $situation_slug) :
                        ?>
                        if('<?php echo $situation_slug; ?>' != $(this).attr("data-value") ) {
                        <?php
                            if( $i == 0 ) {
                                if( $sortby || $search_key || $middleschool || $highschool ) {
                        ?>
                        url = url + '&situation[0]=' + '<?php echo $situation_slug; ?>';
                        <?php
                                } else {
                        ?>
                        url = url + '?situation[0]=' + '<?php echo $situation_slug; ?>';
                        <?php
                                }
                            } else {
                        ?>
                        url = url + '&situation[<?php echo $i; ?>]=<?php echo $situation_slug; ?>';
                        <?php 
                            }
                        ?>
                        }
                        <?php 
                        $i++;
                        endforeach;
                    }
                    ?>

                    <?php
                    if($genre_params) {
                        $i = 0;
                        foreach($genre_params as $genre_slug) :
                        ?>
                        if('<?php echo $genre_slug; ?>' != $(this).attr("data-value") ) {
                        <?php
                            if( $i == 0 ) {
                                if( $sortby || $search_key || $middleschool || $highschool || $situation_params ) {
                        ?>
                        url = url + '&genre[0]=' + '<?php echo $genre_slug; ?>';
                        <?php
                                } else {
                        ?>
                        url = url + '?genre[0]=' + '<?php echo $genre_slug; ?>';
                        <?php
                                }
                            } else {
                        ?>
                        url = url + '&genre[<?php echo $i; ?>]=<?php echo $genre_slug; ?>';
                        <?php 
                            }
                        ?>
                        }
                        <?php 
                        $i++;
                        endforeach;
                    }
                    ?>

                    <?php
                    if($price_params) {
                        $i = 0;
                        foreach($price_params as $price_slug) :
                        ?>
                        if('<?php echo $price_slug; ?>' != $(this).attr("data-value") ) {
                        <?php
                            if( $i == 0 ) {
                                if( $sortby || $search_key || $middleschool || $highschool || $situation_params || $genre_params ) {
                        ?>
                        url = url + '&price[0]=' + '<?php echo $price_slug; ?>';
                        <?php
                                } else {
                        ?>
                        url = url + '?price[0]=' + '<?php echo $price_slug; ?>';
                        <?php
                                }
                            } else {
                        ?>
                        url = url + '&price[<?php echo $i; ?>]=<?php echo $price_slug; ?>';
                        <?php 
                            }
                        ?>
                        }
                        <?php 
                        $i++;
                        endforeach;
                    }
                    ?>
                    window.location.href = url;
                }
                key_clicked = true;
            })
        });
    </script>
    </main><!-- #page-activity -->
<?php
get_footer();
?>