<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gramercy-Village
 */

get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$cat_slug = get_query_var('blog-category') ? get_query_var('blog-category') : "";
?>
	<main id="archive-blog">

    <section class="status-bar">
            <div class="nav-status">
                <a href="<?= esc_url(home_url('/')); ?>">トップ </a>
                <i class="fa fa-angle-right"></i>
                <h4>男の子のママ応援団</h4>
            </div>
        </section>

        <section class="cheering-page">
            <div class="container">
                <h2 class="sub-title">男の子のママ応援団</h2>
                <?php  
                    $cats_args = [
                        'taxonomy' => 'blog-category',
                        'hide_empty' => false,
                    ];
                    $cats = get_terms( $cats_args );
                ?>
                <?php if( $cats ) : ?>
                <ul class="cats-list">
                    <li>
                        <a class="cat<?php echo $cat_slug ? '' : ' active'; ?>" href="<?php echo HOME; ?>/blog">全て</a>
                    </li>
                    <?php foreach($cats as $cat) : ?>
                    <li>
                        <a class="cat<?php if($cat_slug == $cat->slug ){ echo ' active'; } else { echo ''; } ?>" href="<?php echo get_term_link($cat); ?>"><?php echo $cat->name; ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <?php
                    $args = [
                        'post_type' => 'blog',
                        'post_status' => 'publish',
                        'paged' => $paged,
                        'posts_per_page' => 12,
                        'orderby' => 'post_date',
                        'order' => 'DESC'
                    ];
                    $tax_query = [];

                    if( $cat_slug ) {
                        $tax_query[] = [
                            'taxonomy' => 'blog-category',
                            'field' => 'slug',
                            'terms' => $cat_slug
                        ];
                    }
                
                    if ( !empty($tax_query) ) {
                        $args['tax_query'] = $tax_query;
                    }

                    $custom_query = new WP_Query( $args );
                ?>
                <?php if ($custom_query->have_posts()) : ?>
                <ul class="cheering-part">
                    <?php while($custom_query->have_posts()) : $custom_query->the_post(); ?>
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
                <!-- <div class="interview-pagination">
                    <?php the_posts_pagination( array(
                    'next_text' => '<i class="fa fa-angle-right" style="font-size:36px"></i>',
                    'prev_text' => '<i class="fa fa-angle-left" style="font-size:36px"></i>',
                ) ); ?>
                </div> -->
                <?php endif; ?>
            </div>
        </section>

    </main><!-- #page-activity -->
<?php
get_footer();
