<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gramercy-Village
 */

get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$sortby = get_query_var('sortby') ? get_query_var('sortby') : '';
?>
	<main id="page-activity">

        <section class="status-bar">
            <div class="nav-status">
                <a href="<?= esc_url(home_url('/')); ?>">トップ </a>
                <i class="fa fa-angle-right"></i>
                <h4>中学生男子の服</h4>
            </div>
        </section>

        <?php
            $number_per_page = 24;
            if(empty($sortby) || $sortby == 'popularity') {
                $args = [
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'paged' => $paged,
                    'posts_per_page' => $number_per_page,
                    'meta_key' => 'popularity_ranking',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => 'middleschool'
                        ),
                    ),
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
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => 'middleschool'
                        ),
                    ),
                ];
            }
            else if($sortby == 'price') {
                update_price_meta_key('middleschool');
                $args = [
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'paged' => $paged,
                    'posts_per_page' => $number_per_page,
                    'orderby'        => 'meta_value_num',
                    'meta_key'       => 'price',
                    'order' => 'ASC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => 'middleschool'
                        ),
                    ),
                ];
            }
            $product_query = new WP_Query( $args );
        ?>
        <section class="middleschool students-product">
            <div class="container">
                <h2 class="sub-title">
                    中学生男子の服
                </h2>
                <!-- <div class="search-part">
                    <div class="search-bar">
                        <div class="input-box">
                            <input type="text" name="keyboard" placeholder="シチュエーションから選ぶ">
                            <i class="fa fa-angle-down" aria-hidden="true" style="color: #888888"></i>
                        </div>
                        <button type="button"><i class="fas fa-search" style="color: #ffffff;"></i></button>
                    </div>
                    <div class="search-label">詳細検索</div>
                </div> -->
                <div class="search-wrapper">
                    <div class=search-result>
                        <span><?php echo $product_query->found_posts; ?></span>&nbsp;件見つかりました
                    </div>
                    <!-- <div class="search-keywords">
                        <div class="label">選択中の条件</div>
                        <div class="keywords-list">
                            <a class="keyword" href="">中学生男子
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 2.25C10.0716 2.25 8.18657 2.82183 6.58319 3.89317C4.97982 4.96451 3.73013 6.48726 2.99218 8.26884C2.25422 10.0504 2.06114 12.0108 2.43735 13.9021C2.81355 15.7934 3.74215 17.5307 5.10571 18.8943C6.46928 20.2579 8.20656 21.1865 10.0979 21.5627C11.9892 21.9389 13.9496 21.7458 15.7312 21.0078C17.5127 20.2699 19.0355 19.0202 20.1068 17.4168C21.1782 15.8134 21.75 13.9284 21.75 12C21.7473 9.41498 20.7192 6.93661 18.8913 5.10872C17.0634 3.28084 14.585 2.25273 12 2.25ZM15.5306 14.4694C15.6003 14.5391 15.6556 14.6218 15.6933 14.7128C15.731 14.8039 15.7504 14.9015 15.7504 15C15.7504 15.0985 15.731 15.1961 15.6933 15.2872C15.6556 15.3782 15.6003 15.4609 15.5306 15.5306C15.4609 15.6003 15.3782 15.6556 15.2872 15.6933C15.1961 15.731 15.0986 15.7504 15 15.7504C14.9015 15.7504 14.8039 15.731 14.7128 15.6933C14.6218 15.6556 14.5391 15.6003 14.4694 15.5306L12 13.0603L9.53063 15.5306C9.46095 15.6003 9.37822 15.6556 9.28718 15.6933C9.19613 15.731 9.09855 15.7504 9 15.7504C8.90146 15.7504 8.80388 15.731 8.71283 15.6933C8.62179 15.6556 8.53906 15.6003 8.46938 15.5306C8.3997 15.4609 8.34442 15.3782 8.30671 15.2872C8.269 15.1961 8.24959 15.0985 8.24959 15C8.24959 14.9015 8.269 14.8039 8.30671 14.7128C8.34442 14.6218 8.3997 14.5391 8.46938 14.4694L10.9397 12L8.46938 9.53063C8.32865 9.38989 8.24959 9.19902 8.24959 9C8.24959 8.80098 8.32865 8.61011 8.46938 8.46937C8.61011 8.32864 8.80098 8.24958 9 8.24958C9.19903 8.24958 9.3899 8.32864 9.53063 8.46937L12 10.9397L14.4694 8.46937C14.5391 8.39969 14.6218 8.34442 14.7128 8.3067C14.8039 8.26899 14.9015 8.24958 15 8.24958C15.0986 8.24958 15.1961 8.26899 15.2872 8.3067C15.3782 8.34442 15.4609 8.39969 15.5306 8.46937C15.6003 8.53906 15.6556 8.62178 15.6933 8.71283C15.731 8.80387 15.7504 8.90145 15.7504 9C15.7504 9.09855 15.731 9.19613 15.6933 9.28717C15.6556 9.37822 15.6003 9.46094 15.5306 9.53063L13.0603 12L15.5306 14.4694Z" fill="#F4983D"/>
                                </svg>
                            </a>
                            <a class="keyword" href="">中学生男子
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 2.25C10.0716 2.25 8.18657 2.82183 6.58319 3.89317C4.97982 4.96451 3.73013 6.48726 2.99218 8.26884C2.25422 10.0504 2.06114 12.0108 2.43735 13.9021C2.81355 15.7934 3.74215 17.5307 5.10571 18.8943C6.46928 20.2579 8.20656 21.1865 10.0979 21.5627C11.9892 21.9389 13.9496 21.7458 15.7312 21.0078C17.5127 20.2699 19.0355 19.0202 20.1068 17.4168C21.1782 15.8134 21.75 13.9284 21.75 12C21.7473 9.41498 20.7192 6.93661 18.8913 5.10872C17.0634 3.28084 14.585 2.25273 12 2.25ZM15.5306 14.4694C15.6003 14.5391 15.6556 14.6218 15.6933 14.7128C15.731 14.8039 15.7504 14.9015 15.7504 15C15.7504 15.0985 15.731 15.1961 15.6933 15.2872C15.6556 15.3782 15.6003 15.4609 15.5306 15.5306C15.4609 15.6003 15.3782 15.6556 15.2872 15.6933C15.1961 15.731 15.0986 15.7504 15 15.7504C14.9015 15.7504 14.8039 15.731 14.7128 15.6933C14.6218 15.6556 14.5391 15.6003 14.4694 15.5306L12 13.0603L9.53063 15.5306C9.46095 15.6003 9.37822 15.6556 9.28718 15.6933C9.19613 15.731 9.09855 15.7504 9 15.7504C8.90146 15.7504 8.80388 15.731 8.71283 15.6933C8.62179 15.6556 8.53906 15.6003 8.46938 15.5306C8.3997 15.4609 8.34442 15.3782 8.30671 15.2872C8.269 15.1961 8.24959 15.0985 8.24959 15C8.24959 14.9015 8.269 14.8039 8.30671 14.7128C8.34442 14.6218 8.3997 14.5391 8.46938 14.4694L10.9397 12L8.46938 9.53063C8.32865 9.38989 8.24959 9.19902 8.24959 9C8.24959 8.80098 8.32865 8.61011 8.46938 8.46937C8.61011 8.32864 8.80098 8.24958 9 8.24958C9.19903 8.24958 9.3899 8.32864 9.53063 8.46937L12 10.9397L14.4694 8.46937C14.5391 8.39969 14.6218 8.34442 14.7128 8.3067C14.8039 8.26899 14.9015 8.24958 15 8.24958C15.0986 8.24958 15.1961 8.26899 15.2872 8.3067C15.3782 8.34442 15.4609 8.39969 15.5306 8.46937C15.6003 8.53906 15.6556 8.62178 15.6933 8.71283C15.731 8.80387 15.7504 8.90145 15.7504 9C15.7504 9.09855 15.731 9.19613 15.6933 9.28717C15.6556 9.37822 15.6003 9.46094 15.5306 9.53063L13.0603 12L15.5306 14.4694Z" fill="#F4983D"/>
                                </svg>
                            </a>
                        </div>
                    </div> -->
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
                                <div class="price-wrap">
                                    <div class="pre-text">全部で</div>
                                    <?php
                                    $product_id = get_the_ID(); // Get the current product ID or specify the product ID

                                    // Get the product object
                                    $product = wc_get_product($product_id);

                                    // Check if the product has variations
                                    if ($product->is_type('variable')) {
                                        // Get all variations
                                        $variations = $product->get_available_variations();
                                        // var_export($variations[0]['variation_id']);
                                        $variation_id = $variations[0]['variation_id'];
                                        $variation_product = wc_get_product($variation_id);
                                        $price = $variation_product->get_price();
                                    }
                                    ?>
                                    <h3 class="price">
                                    ¥<?php echo $price; ?>
                                    </h3>
                                </div>
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
                window.location.href = "<?php echo HOME . 'middleschool'; ?>" + "?sortby=" + selectedValue;
            });
        });
    </script>
    </main><!-- #page-activity -->
<?php
get_footer();
?>
