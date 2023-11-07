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

                <div class="search-wrapper">
                    <div class=search-result>
                        <span><?php echo $product_query->found_posts; ?></span>&nbsp;件見つかりました
                    </div>
                </div>

                <div class="products">                  
                    <div class="pagination">
                        <?php
                        $total_counts = $product_query->found_posts;
                        $current_page = $paged;
                        $first_number = $total_counts == 0 ? 0 : ($current_page - 1) * $number_per_page + 1;
                        $secode_number = ($current_page * $number_per_page) > $total_counts ? $total_counts : ($current_page * $number_per_page);
                        ?>
                        <p class="pager__num"<?php echo $paginate_links ? '' : ' style="margin-right: 0;"'; ?>><?php echo $first_number; ?>～<?php echo $secode_number; ?>件表示</p>

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
                window.location.href = "<?php echo HOME . 'middleschool'; ?>" + "?sortby=" + selectedValue;
            });
        });
    </script>
    </main>
<?php
get_footer();
?>
