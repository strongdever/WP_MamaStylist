<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gramercy-Village
 */

get_header();
?>
	<main id="page-activity">

    <section class="status-bar">
            <div class="nav-status">
                <a href="<?= esc_url(home_url('/')); ?>">トップ </a>
                <i class="fa fa-angle-right"></i>
                <h4>ママはスタイリストとは</h4>
            </div>
        </section>
        <section class="mamasta">
            <div class="container">
                <div></div>
                <div class="top-header">中高生男子のお子様を<br class="sp">持つママへ！<br>
                    こんな <span>お悩み</span> ありませんか？
                </div>
                <figure class="first-view pc">
                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/mamasta-background.webp">
                </figure>
                <div class="first-view sp">
                    <div class="type1 type">
                        <div class="circles">
                            <span>男の子の洋服 、何を選んだら<br>
                            いいのかわからない…<br>
                            何がいい？って聞いても回答なし！<br>
                            一緒に買いに行くのは<br>
                            面倒くさいみたい…</span>
                            <span></span>
                            <span></span>
                        </div>
                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/mama01.png">
                    </div>
                    <div class="type2 type">
                        <div class="circles">
                            <span>普段はカジュアルなもので良くても、<br>
                            イベントの時には少しくらいは<br>
                            かっこつけさせたい。<br>
                            でも今の流行りなんてわからない…！
                            </span>
                            <span></span>
                            <span></span>
                        </div>
                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/mama02.png">
                    </div>
                    <div class="type1 type">
                        <div class="circles">
                            <span>すぐに汚す、サイズが小さくなるから<br>
                            高価なものも買えない！<br>
                            お手軽価格でわが子を<br>
                            おしゃれにするには<br>
                            どうしたらいいの？
                            </span>
                            <span></span>
                            <span></span>
                        </div>
                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/mama03.png">
                    </div>
                </div>
                <div class="content">
                    <div class="title">
                        <p>そんなママの洋服選びのお手伝いをするのが、<br></p>
                        <p><img class="logo" src="<?php echo T_DIRE_URI; ?>/assets/img/logo.png">です！</p>
                    </div>
                    <div class="desc">
                        男の子ママのための洋服選び「ママはスタイリスト」は、そんなお母さんのために洋服を<br>
                        シーン別に上下セットで紹介し、悩まずに買うことができるサイトです。<br><br>
                        中学生男子と高校生男子のシーン別の洋服がセットで表示されていますので、<br>
                        お子さんの洋服選びにお役立てください！
                    </div>
                    <ul class="btns">
                        <li>
                            <a class="btn" href="<?= esc_url(home_url('/middleschool')); ?>">
                                中学生男子の服はこちら<i class="fa fa-angle-right bounce"></i>
                            </a>
                        </li>
                        <li>
                            <a class="btn" href="<?= esc_url(home_url('/highschool')); ?>">
                                高校生男子の服はこちら<i class="fa fa-angle-right bounce"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

    </main><!-- #page-activity -->
<?php
get_footer();
