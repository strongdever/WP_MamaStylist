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
            <a href="<?= esc_url(home_url('/')); ?>">男の子のママ応援団 </a>
            <i class="fa fa-angle-right"></i>
            <h4>あっという間に大きくなる体もこれで大丈夫!</h4>
        </div>
    </section>

    <section class="single-cheering">
        <div class="container">
            <div class="cat-date">
                <a href=""><p class="category">着回し</p></a>
                <div class="date">2023年5月15日</div>
            </div>
            <a href=""><h2 class="cheering-title">あっという間に大きくなる体もこれで大丈夫!</h2></a>
            <img class="cheering-thumb" src="<?php echo T_DIRE_URI; ?>/assets/img/cheering-thumb.png">
            <br><br>
            
            <p class="desc">
            こんにちは！<br>
            ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。
            </p>
            <br><br>
            <h2 class="star-subtitle">ここにh2が入ります</h2>
            <br><br>
            <h3 class="underline-subtitle">ここにh3が入ります</h3>
            <br>
            <p class="desc">
            ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。<br>
            ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。<br><br>
            ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。
            </p>
            <br><br>
            <h2 class="star-subtitle">ここにh2が入ります</h2>
            <br><br>
            <h3 class="underline-subtitle">ここにh3が入ります</h3>
            <br>
            <p class="desc">
            ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。<br>
            ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。<br><br>
            ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。ここに文章が入ります。
            </p>
            <br><br>

            <div class="socials">
                <div class="social-label">この記事をシェアする</div>
                <div class="social-icons">
                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/twitter.png" class="social-icon">
                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/line.png" class="social-icon">
                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/facebook.png" class="social-icon">
                </div>
            </div>

            <br><br>

            <div class="related-article">
                <div class="label">関連記事</div>
                <ul class="cheering-part">
                    <li>
                        <a href="">
                            <img class="thumb" src="<?php echo T_DIRE_URI; ?>/assets/img/cheering0001.png" alt="">
                            <div class="text-wrapper">
                                <h3 class="title">あっという間に大きくなる体もこれで大丈夫!</h3>
                                <div class="last-text">
                                    <div class="method">着回し術</div>
                                    <div class="date">2023年5月15日</div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img class="thumb" src="<?php echo T_DIRE_URI; ?>/assets/img/cheering0001.png" alt="">
                            <div class="text-wrapper">
                                <h3 class="title">あっという間に大きくなる体もこれで大丈夫!</h3>
                                <div class="last-text">
                                    <div class="method">着回し術</div>
                                    <div class="date">2023年5月15日</div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img class="thumb" src="<?php echo T_DIRE_URI; ?>/assets/img/cheering0001.png" alt="">
                            <div class="text-wrapper">
                                <h3 class="title">あっという間に大きくなる体もこれで大丈夫!</h3>
                                <div class="last-text">
                                    <div class="method">着回し術</div>
                                    <div class="date">2023年5月15日</div>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <a class="green-btn" href="<?php echo HOME . 'party'; ?>">記事一覧に戻る</a>
    </section>

    </main><!-- #page-activity -->
<?php
get_footer();
?>