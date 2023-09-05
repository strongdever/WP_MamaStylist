<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gramercy-Village
 */

get_header();
?>
    <main id="produc-detail">
        <section class="status-bar">
            <div class="nav-status">
                <a href="<?= esc_url(home_url('/')); ?>">トップ </a>
                <i class="fa fa-angle-right"></i>
                <a href="">男友達と遊びに行くとき </a>
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
                        <div class="pickup">
                            <img class="target1" src="<?php echo T_DIRE_URI; ?>/assets/img/products/detail001.png" alt="">
                            <div class="picker-before"><i class="fa fa-angle-left"></i></div>
                            <div class="picker-next"><i class="fa fa-angle-right"></i></div>
                        </div>
                        <div class="thumbs picker" data-target="target1">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/products/detail001.png" alt="">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/products/detail002.png" alt="">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/products/detail003.png" alt="">
                        </div>
                    </div>
                    <div class="detail-wraper">
                        <div class="sub-text">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/stars.png">
                            <h2 class="sub-title">中学生男子の服</h2>
                        </div>
                        <p class="save-text">
                            単品購入より¥1,000お得
                        </p>
                        <div class="total-buy">
                            <div class="price-text">
                                ¥10,000
                                <span>税込</span>
                            </div>
                            <a class="btn" href="">
                                買いに行く<i class="fa fa-angle-right bounce"></i>
                            </a>
                        </div>
                        <div class="title">
                            単品で購入する
                        </div>
                        <div class="separate-buy">
                            <ul class="price-list">
                                <li>
                                    <div class="name">トップス</div>
                                    <div class="price">¥3,000</div>
                                    <a class="btn" href="">
                                        買いに行く<i class="fa fa-angle-right bounce"></i>
                                    </a>
                                </li>
                                <li>
                                    <div class="name">ボトムス</div>
                                    <div class="price">¥3,000</div>
                                    <a class="btn" href="">
                                        買いに行く<i class="fa fa-angle-right bounce"></i>
                                    </a>
                                </li>
                                <li>
                                    <div class="name">ベルト</div>
                                    <div class="price">¥3,000</div>
                                    <a class="btn" href="">
                                        買いに行く<i class="fa fa-angle-right bounce"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="cats-list">
                                <li class="cat-item">
                                    <span>男友達と遊びに行くとき</span>
                                </li>
                                <li class="cat-item">
                                    <span>綺麗めカジュアル系</span>
                                </li>
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
                        <div class="title">このコーディネートをシェア</div>
                        <ul class="social-items">
                            <li>
                                <a href="" class="social-item"><img src="<?php echo T_DIRE_URI; ?>/assets/img/twitter.png"></a>
                            </li>
                            <li>
                                <a href="" class="social-item"><img src="<?php echo T_DIRE_URI; ?>/assets/img/facebook.png"></a>
                            </li>
                            <li>
                                <a href="" class="social-item"><img src="<?php echo T_DIRE_URI; ?>/assets/img/line.png"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <h2 class="sub-title">同じシチュエーションの人気コーディネート</h2>
                <ul class="product-list">
                    <li>
                        <a class="product" href="">
                            <img class="thumb" src="<?php echo T_DIRE_URI; ?>/assets/img/products/product0001.png">
                            <div class="price-wrap">
                                <div class="pre-text">全部で</div>
                                <h3 class="price">
                                    ¥10,000
                                </h3>
                            </div>
                            <h4 class="product-cat">男友達</h4>
                        </a>
                    </li>
                    <li>
                        <a class="product" href="">
                            <img class="thumb" src="<?php echo T_DIRE_URI; ?>/assets/img/products/product0001.png">
                            <div class="price-wrap">
                                <div class="pre-text">全部で</div>
                                <h3 class="price">
                                    ¥10,000
                                </h3>
                            </div>
                            <h4 class="product-cat">男友達</h4>
                        </a>
                    </li>
                    <li>
                        <a class="product" href="">
                            <img class="thumb" src="<?php echo T_DIRE_URI; ?>/assets/img/products/product0001.png">
                            <div class="price-wrap">
                                <div class="pre-text">全部で</div>
                                <h3 class="price">
                                    ¥10,000
                                </h3>
                            </div>
                            <h4 class="product-cat">男友達</h4>
                        </a>
                    </li>
                    <li>
                        <a class="product" href="">
                            <img class="thumb" src="<?php echo T_DIRE_URI; ?>/assets/img/products/product0001.png">
                            <div class="price-wrap">
                                <div class="pre-text">全部で</div>
                                <h3 class="price">
                                    ¥10,000
                                </h3>
                            </div>
                            <h4 class="product-cat">男友達</h4>
                        </a>
                    </li>
                    <li>
                        <a class="product" href="">
                            <img class="thumb" src="<?php echo T_DIRE_URI; ?>/assets/img/products/product0001.png">
                            <div class="price-wrap">
                                <div class="pre-text">全部で</div>
                                <h3 class="price">
                                    ¥10,000
                                </h3>
                            </div>
                            <h4 class="product-cat">男友達</h4>
                        </a>
                    </li>
                    <li>
                        <a class="product" href="">
                            <img class="thumb" src="<?php echo T_DIRE_URI; ?>/assets/img/products/product0001.png">
                            <div class="price-wrap">
                                <div class="pre-text">全部で</div>
                                <h3 class="price">
                                    ¥10,000
                                </h3>
                            </div>
                            <h4 class="product-cat">男友達</h4>
                        </a>
                    </li>
                    <li>
                        <a class="product" href="">
                            <img class="thumb" src="<?php echo T_DIRE_URI; ?>/assets/img/products/product0001.png">
                            <div class="price-wrap">
                                <div class="pre-text">全部で</div>
                                <h3 class="price">
                                    ¥10,000
                                </h3>
                            </div>
                            <h4 class="product-cat">男友達</h4>
                        </a>
                    </li>
                    <li>
                        <a class="product" href="">
                            <img class="thumb" src="<?php echo T_DIRE_URI; ?>/assets/img/products/product0001.png">
                            <div class="price-wrap">
                                <div class="pre-text">全部で</div>
                                <h3 class="price">
                                    ¥10,000
                                </h3>
                            </div>
                            <h4 class="product-cat">男友達</h4>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
   
    </main>

<?php
    get_footer();
?>