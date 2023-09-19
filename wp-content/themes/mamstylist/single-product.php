<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gramercy-Village
 */

get_header();
?>
    <main id="produc-detail">
        <?php
        $curr_cats = get_the_terms(get_the_ID(), 'product_cat');
        ?>
        <section class="status-bar">
            <div class="nav-status">
                <a href="<?= esc_url(home_url('/')); ?>">トップ </a>
                <i class="fa fa-angle-right"></i>
                <?php foreach($curr_cats as $curr_cat) : ?>
                    <?php
                    $parent_cat = get_term($curr_cat->parent);
                    if($parent_cat->name == 'シチュエーションから選ぶ') :
                    ?>
                <a href="<?php echo get_term_link($curr_cat); ?>"><?php echo $curr_cat->name; ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
                <i class="fa fa-angle-right"></i>
                <h4>○○のトレーナー、ジーンズ、全3点</h4>
            </div>
        </section>
        
        <section class="detail-section">
            <div class="container">
                <div class="product-detail">
                    <div class="sub-text mobile">
                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/stars.png">
                        <h2 class="sub-title">中学生男子の服</h2>
                    </div>
                    <div class="photos">
                        <?php
                        $product_id = get_the_ID(); // Get the current product ID
                        $product = new WC_product($product_id);
                        $gallery_image_ids = $product->get_gallery_image_ids();
                        // $gallery_image_ids = get_post_meta($product_id, '_product_image_gallery', true); // Get the gallery image IDs
                        ?>
                        <?php if(!empty($gallery_image_ids)) : ?>
                        <div class="pickup woocommerce-image-container">
                            <?php
                            foreach ($gallery_image_ids as $image_id) {
                            $image_data = wp_get_attachment_image_src($image_id, 'full'); // Get the full-sized image URL
                            $image_url = $image_data[0];
                            break;
                            }
                            ?>
                            <img class="target1 scaled-image" src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
                            <div class="picker-before"><i class="fa fa-angle-left"></i></div>
                            <div class="picker-next"><i class="fa fa-angle-right"></i></div>
                        </div>
                        <div class="thumbs picker" data-target="target1">
                            <?php
                            $gallery_image_ids = $product->get_gallery_image_ids();
                            if(!empty($gallery_image_ids)) :
                            foreach ($gallery_image_ids as $image_id) :
                            $image_data = wp_get_attachment_image_src($image_id, 'full'); // Get the full-sized image URL
                            $image_url = $image_data[0];
                            ?>
                            <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
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
                        $total_price = $variation_product->get_price();
                        // Loop through each variation
                        $sum_price = 0;
                        $i = 0;
                        foreach ($variations as $variation) {
                            $variation_id = $variation['variation_id']; // Get the variation ID

                            // Get the variation object
                            $variation_product = wc_get_product($variation_id);

                            // Get the price
                            if($i != 0) {
                                $sum_price += $variation_product->get_price();
                            }

                            $i++;
                        }
                    }
                    ?>
                    <div class="detail-wraper">
                        <div class="sub-text">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/stars.png">
                            <h2 class="sub-title"><?php the_title(); ?></h2>
                        </div>
                        <p class="save-text">
                            単品購入より¥<?php echo ($total_price - $sum_price); ?>お得
                        </p>
                        <div class="total-buy">
                            <div class="price-text">
                                ¥<?php echo $total_price; ?>
                                <span>税込</span>
                            </div>
                            <a class="btn" href="<?php echo wc_get_checkout_url(); ?>">
                                買いに行く<i class="fa fa-angle-right bounce"></i>
                            </a>
                        </div>
                        <div class="title">
                            単品で購入する
                        </div>
                        <div class="separate-buy">
                            <ul class="price-list">
                            <?php
                            $i = 0;
                            foreach ($variations as $variation) {
                                $variation_id = $variation['variation_id']; // Get the variation ID

                                // Get the variation object
                                $variation_product = wc_get_product($variation_id);

                                // Get the price
                                if($i != 0) {
                            ?>
                                    <li>
                                        <div class="name"><?php echo $variation_product->get_variation_attributes()['attribute_clothes']; ?></div>
                                        <div class="price">¥<?php echo $variation_product->get_price(); ?></div>
                                        <a class="btn" href="">
                                            買いに行く<i class="fa fa-angle-right bounce"></i>
                                        </a>
                                    </li>
                            <?php
                                }
                                $i++;
                            }
                            ?>
                            </ul>
                            <ul class="cats-list">
                            <?php foreach($curr_cats as $curr_cat) : ?>
                                <?php
                                $parent_cat = get_term($curr_cat->parent);
                                if($parent_cat->name == 'シチュエーションから選ぶ') :
                                ?>
                                <li class="cat-item">
                                    <span><?php echo $curr_cat->name; ?></span>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php foreach($curr_cats as $curr_cat) : ?>
                            <?php
                                $parent_cat = get_term($curr_cat->parent);
                                if($parent_cat->name == '好みのジャンルから選ぶ') :
                                ?>
                                <li class="cat-item">
                                    <span><?php echo $curr_cat->name; ?></span>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="title">コーディネートのポイント</div>
                        <div class="desc-wraper">
                            <p class="desc">
                                ストレッチが効いたデニムを使用した、程よくリラックスしたデニムブルゾンです。
                            </p>
                            <p class="desc">
                                大きめの胸のポケットが印象的なアウターです。
                            </p>
                            <p class="desc">
                                カラーはデニムの濃淡とホワイトの3色展開★デニムの濃淡はカジュアル感が強く、チノパンツなど相性抜群です。
                            </p>
                            <p class="desc">
                                ホワイトは爽やかな印象なので、清潔感があります♪春、秋と大活躍出来る商品に仕上げました。
                            </p>
                            <p class="desc">
                                <span>モデル身長：155cm<span></span>着用サイズ：160cm</span>
                            </p>
                        </div>
                        <ul class="social-items">
                            <?php if (shortcode_exists('addtoany')) : ?>
                                <?php echo do_shortcode('[addtoany]'); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <?php
                    $curr_cats = get_the_terms(get_the_ID(), 'product_cat');
                    $args = [
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'post__not_in'      => array(get_the_ID()), // Exclude the current post
                        'paged' => $paged,
                        'posts_per_page' => 3,
                        'orderby' => 'post_date',
                        'order' => 'DESC',
                    ];

                    $tax_query = [];

                    if( $curr_cats ) {
                        foreach($curr_cats as $curr_cat) {
                            $tax_query[] = [
                                'taxonomy' => 'product_cat',
                                'field' => 'slug',
                                'terms' => $curr_cat->slug,
                            ];
                        }
                    }
                
                    if ( !empty($tax_query) ) {
                        $args['tax_query'] = $tax_query;
                    }

                    $product_query = new WP_Query( $args );
                ?>
                <?php if($product_query->have_posts()) : ?>
                <h2 class="sub-title">同じシチュエーションの人気コーディネート</h2>
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
        </section>
   
    </main>

<?php
    get_footer();
?>