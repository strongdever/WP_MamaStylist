<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gramercy-Village
 */

get_header();
?>
	<main class="company">
        <section class="status-bar">
            <div class="nav-status">
                <a href="<?= esc_url(home_url('/')); ?>">トップ </a>
                <i class="fa fa-angle-right"></i>
                <h4>運営会社</h4>
            </div>
        </section>

        <section class="company-content">
            <div class="container">
                <div class="title-label">運営会社</div>
                <br><br><br>
                <?php the_content(); ?>
            </div>
        </section>

    </main><!-- #page-activity -->
<?php
get_footer();
?>
