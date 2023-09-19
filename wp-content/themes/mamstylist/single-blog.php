<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gramercy-Village
 */

get_header();
?>
	<main id="blog-archive" class="cheering-page">

    <section class="status-bar">
        <div class="nav-status">
            <a href="<?= esc_url(home_url('/')); ?>">トップ </a>
            <i class="fa fa-angle-right"></i>
            <a href="<?= esc_url(home_url('/blog')); ?>">男の子のママ応援団 </a>
            <i class="fa fa-angle-right"></i>
            <h4><?php the_title(); ?></h4>
        </div>
    </section>

    <section class="single-cheering">
        <div class="container">
            <div class="cat-date">
                <?php
                $post_cats = get_the_terms(get_the_ID(), "blog-category");
                if($post_cats) :
                    foreach($post_cats as $post_cat) :
                ?>
                <a href="<?php echo get_term_link($post_cat); ?>"><p class="category"><?php echo $post_cat->name; ?></p></a>
                <?php
                    endforeach;
                endif;
                ?>
                <div class="date"><?php the_time('Y.m.d'); ?></div>
            </div>
            <a href=""><h2 class="cheering-title"><?php the_title(); ?></h2></a>

            <?php if( has_post_thumbnail() ): ?>
                <img class="cheering-thumb" src="<?php echo get_the_post_thumbnail_url(); ?>">
            <?php else: ?>
                <img class="cheering-thumb" src="<?php echo catch_that_image(); ?>"></a>
            <?php endif; ?>
            
            <br><br>
            
            <?php the_content(); ?>

            <?php if (shortcode_exists('addtoany')) : ?>
                <?php echo do_shortcode('[addtoany]'); ?>
            <?php endif; ?>

            <?php
            $args = array(
                'post_type'         => 'blog',
                'post_status'       => 'publish',
                'post__not_in'      => array(get_the_ID()), // Exclude the current post
                'posts_per_page'    => 3, // Number of related articles to display
                'orderby'           => 'rand', // Randomize the order of related articles
            );
            $related_query = new WP_Query($args);
            ?> 

            <?php if( $related_query->have_posts() ):
            ?>

            <div class="related-article">
                <div class="label">関連記事</div>
                <ul class="cheering-part">
                    <?php 
                    while( $related_query->have_posts() ) : $related_query->the_post(); 
                    ?>
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
                                    $post_cats = get_the_terms(get_the_ID(), "blog-category");
                                    if($post_cats) :
                                        foreach($post_cats as $post_cat) :
                                    ?>
                                    <div class="method"><?php echo $post_cat->name; ?></div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                    <div class="date"><?php the_time('Y.m.d'); ?></div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
        <a class="green-btn" href="<?php echo HOME . 'blog'; ?>">記事一覧に戻る</a>
    </section>

    </main><!-- #page-activity -->
<?php
get_footer();
?>