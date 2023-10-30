<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gramercy-Village
 */

get_header();
?>
	<main class="rule">
        <section class="status-bar">
            <div class="nav-status">
                <a href="<?= esc_url(home_url('/')); ?>">トップ </a>
                <i class="fa fa-angle-right"></i>
                <h4>利用規約</h4>
            </div>
        </section>

        <section class="middleschool students-product">
            <div class="container">
                <div class="title-label">利用規約</div>
                <br><br><br class="pc">
                <?php the_content(); ?>
            </div>
        </section>

    </main><!-- #page-activity -->
<?php
get_footer();
?>