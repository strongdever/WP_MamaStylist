<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gramercy-Village
 */

get_header();
?>
	<main id="front-page">
        <section class="mainvisual" id="mainvisual">
            <figure class="mainvisual_image">
                <img class="pc" src="<?php echo T_DIRE_URI; ?>/assets/img/mainvisual_image.webp" alt="洋服選">
                <img class="sp" src="<?php echo T_DIRE_URI; ?>/assets/img/mainvisual_image_sp.webp" alt="洋服選">
            </figure>
            <div class="search-bar">
                <div class="input-box">
                    <input type="text" name="keyboard" placeholder="キーワード検索" class="search-key-front">
                    <!-- <i class="fa fa-angle-down" aria-hidden="true" style="color: #888888"></i> -->
                </div>
                <button type="button" class="btn-search-front"><i class="fas fa-search" style="color: #ffffff;"></i></button>
                <a href="<?= esc_url(home_url('/search')); ?>" class="goto-search">詳細検索</a>
            </div>
        </section>

        <section class="recommend-style">
            <div class="container">
                <div class="middleschool">
                    <h1 class="main-title">おすすめのスタイル</h1>
                    <div class="sub-text">
                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/stars.png">
                        <h2 class="sub-title">中学生男子の服</h2>
                    </div>
                    <?php
                        $args = [
                            'post_type' => 'product',
                            'post_status' => 'publish',
                            'paged' => $paged,
                            'posts_per_page' => 3,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'slug',
                                    'terms' => 'middleschool'
                                ),
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'slug',
                                    'terms' => 'recommended'
                                ),
                            ),
                        ];
                        
                        $product_query = new WP_Query( $args );
                    ?>
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
                                        $variation_id = $variations[0]['variation_id'];
                                        $variation_product = wc_get_product($variation_id);
                                        $price = number_format($variation_product->get_price());
                                        // Loop through each variation
                                        // foreach ($variations as $variation) {
                                        //     $variation_id = $variation['variation_id']; // Get the variation ID

                                        //     // Get the variation object
                                        //     $variation_product = wc_get_product($variation_id);

                                        //     // Get the price
                                        //     $price = $variation_product->get_price();

                                        //     // Output the price
                                        //     var_export($price);
                                        // }
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
                <div class="hightschool">
                    <div class="sub-text">
                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/stars.png">
                        <h2 class="sub-title">高校生男子の服</h2>
                    </div>
                    <?php
                        $args = [
                            'post_type' => 'product',
                            'post_status' => 'publish',
                            'paged' => $paged,
                            'posts_per_page' => 3,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'slug',
                                    'terms' => 'highschool'
                                ),
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'slug',
                                    'terms' => 'recommended'
                                ),
                            ),
                        ];
                        
                        $product_query = new WP_Query( $args );
                    ?>
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
                                        $variation_id = $variations[0]['variation_id'];
                                        $variation_product = wc_get_product($variation_id);
                                        $price = number_format($variation_product->get_price());
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

        <?php
        $product_cats = get_terms( array(
            'taxonomy'       => 'product_cat',
            'hide_empty'     => false,
        ) );
        ?>
        <section class="situation-choose">
            <div class="container">
                <h1 class="main-title">シチュエーションから選ぶ</h1>
                <ul class="product-in-situation">
                <?php
                if($product_cats) :
                    foreach($product_cats as $product_cat) :
                        $parent_cat = get_term($product_cat->parent);
                        $cat_slug = $product_cat->slug;
                        $cat_name = $product_cat->name;
                        if($parent_cat->slug == "situation") :
                            $cat_id = $product_cat->term_id;
                            $cat_thumbnail_id = get_term_meta($cat_id, 'thumbnail_id', true);
                            $image_attributes = wp_get_attachment_image_src($cat_thumbnail_id, 'thumbnail');
                            $cat_image_url = '';
                            if($image_attributes) {
                                $cat_image_url = $image_attributes[0];
                            }
                            if($cat_image_url) {
                        ?>
                     <li>
                        <a href="<?= esc_url(home_url('/product/?situation[0]=' . $cat_slug)); ?>">
                            <img class="thumb" src="<?php echo $cat_image_url; ?>">
                            <h3 class="situation"><?php echo $cat_name; ?></h3>
                        </a>
                    </li>
                    <?php
                            } else {
                    $args = [
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'paged' => $paged,
                        'posts_per_page' => 1,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'slug',
                                'terms' => $cat_slug,
                            ),
                        ),
                    ];
                    
                    $product_query = new WP_Query( $args );
                ?>
                    <?php if($product_query) :?>
                        <?php while( $product_query->have_posts() ) : $product_query->the_post(); ?>
                    <li>
                        <a href="<?= esc_url(home_url('/product/?situation[0]=' . $cat_slug)); ?>">
                            <?php if( has_post_thumbnail() ): ?>
                            <img class="thumb" src="<?php echo get_the_post_thumbnail_url(); ?>">
                            <?php else: ?>
                            <img class="thumb" src="<?php echo catch_that_image(); ?>"></a>
                            <?php endif; ?>
                            <h3 class="situation"><?php echo $cat_name; ?></h3>
                        </a>
                    </li>
                    <?php endwhile; ?>
                    <?php endif; ?>
                            <?php
                            }
                            ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </section>

        <?php
        $product_cats = get_terms( array(
            'taxonomy'       => 'product_cat',
            'orderby'        => 'ID',
            'order'          => 'ASC',
            'hide_empty'     => false
        ) );
        ?>
        <section class="choosing-section">
            <div class="container">
                <div class="type-list like-products">
                    <?php if( $product_cats ) : ?>
                    <h1 class="main-title">好みのジャンルから選ぶ</h1>
                    <ul class="cat-list">
                    <?php
                        foreach($product_cats as $product_cat) :
                            $parent_cat = get_term($product_cat->parent);
                            $cat_slug = $product_cat->slug;
                            $cat_name = $product_cat->name;
                            if($parent_cat->slug == "genre") :
                    ?>
                        <li>
                            <a class="cat-item" href="<?= esc_url(home_url('/product/?genre[0]=' . $cat_slug)); ?>"><span><?php echo $cat_name; ?></span></a>
                        </li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <div class="price-list like-products">
                    <?php if( $product_cats ) : ?>
                    <h1 class="main-title">コーディネート一式の<br class="sp">価格から選ぶ</h1>
                    <ul class="cat-list">
                    <?php
                        foreach($product_cats as $product_cat) :
                            $parent_cat = get_term($product_cat->parent);
                            $cat_slug = $product_cat->slug;
                            $cat_name = $product_cat->name;
                            if($parent_cat->slug == "price") :
                    ?>
                        <li>
                            <a class="cat-item" href="<?= esc_url(home_url('/product/?price[0]=' . $cat_slug)); ?>"><span><?php echo $cat_name; ?></span></a>
                        </li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <?php
                    $args = [
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'paged' => $paged,
                        'posts_per_page' => 5,
                        'meta_key' => 'popularity_ranking',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                    ];
                    
                    $product_query = new WP_Query( $args );
                ?>
                <div class="popular-product">
                    <?php if( $product_query ) : ?>
                    <h1 class="main-title">人気のコーディネート<br class="sp">ランキング</h1>
                    <ul class="product-list">
                        <?php $i = 1; ?>
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
                                        $variation_id = $variations[0]['variation_id'];
                                        $variation_product = wc_get_product($variation_id);
                                        $price = number_format($variation_product->get_price());
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
                            <div class="mark order<?php echo $i; ?>"><?php echo $i; ?></div>
                        </li>
                        <?php $i++; ?>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
            
        <?php
            $args = [
                'post_type' => 'blog',
                'post_status' => 'publish',
                'paged' => $paged,
                'posts_per_page' => 12,
                'orderby' => 'date',
                'order' => 'DESC',
            ];
            
            $blog_query = new WP_Query( $args );
        ?>
        <?php if( $blog_query ) : ?>
        <section class="cheering-section">
            <div class="container">
                <h1 class="main-title">男の子のママ応援団</h1>
                <div class="header">
                    <h3 class="desc">
                        男の子ママ必見のお役立ち情報について発信中！
                    </h3>
                </div>
            </div>
            <!-- <ul class="cheering-part spslider"> -->
            <ul class="cheering-part spslider">
                <?php while( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php if( has_post_thumbnail() ): ?>
                            <img class="thumb" src="<?php echo get_the_post_thumbnail_url(); ?>">
                        <?php else: ?>
                            <img class="thumb" src="<?php echo catch_that_image(); ?>"></a>
                        <?php endif; ?>
                        <div class="text-wrapper">
                            <h3 class="title"><?php the_title(); ?></h3>
                            <div class="last-text">
                                <?php
                                $post_cats = get_the_terms(get_the_ID(), 'blog-category');
                                if( $post_cats ) :
                                    foreach($post_cats as $post_cat) :
                                ?>
                                <div class="method"><?php echo $post_cat->name; ?></div>
                                <?php endforeach;
                                endif; ?>
                                <div class="date"><?php the_time('Y.m.d'); ?></div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php endwhile; ?>
            </ul>
        </section>
        <?php endif; ?>

        <section class="latest-section">
            <div class="container">
                <h1 class="main-title">最近チェックした<br class="sp">コーディネート</h1>
                <?php
                    $recently_viewed = isset($_COOKIE['recently_viewed']) ? $_COOKIE['recently_viewed'] : '';
                    $recently_viewed = explode(',', $recently_viewed);
                    $recently_viewed = array_filter($recently_viewed);
                    if (!empty($recently_viewed)) {
                        $args = array(
                            'post_type' => 'product',
                            'post__in' => $recently_viewed,
                            'orderby' => 'post__in',
                            'posts_per_page' => 5,
                        );
                        $products = new WP_Query($args);
                
                        if ($products->have_posts()) :
                ?>
                <ul class="product-list">
                    <?php while($products->have_posts()) : $products->the_post(); ?>
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
                                    $variation_id = $variations[0]['variation_id'];
                                    $variation_product = wc_get_product($variation_id);
                                    $price = number_format($variation_product->get_price());
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
                <?php
                }
                else {
                ?>
                <span class='noitem'><?php echo "最近閲覧した商品はありません。"; ?></span>
                <?php
                }
                ?>
            </div>
        </section>
    </main><!-- #front-page -->
    
<?php
get_footer();
?>