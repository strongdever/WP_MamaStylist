<?php
/**
 * Template Name: Search Page
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<?php
$args = [
    'post_type' => 'product',
    'post_status' => 'publish',
    'paged' => $paged,
    'posts_per_page' => -1,
];

$product_query = new WP_Query( $args );
$total_post = $product_query->found_posts;
?>
	<main id="search">
        <section class="status-bar">
            <div class="nav-status">
                <a href="index.html">トップ</a>
                <i class="fa fa-angle-right"></i>
                <h4>詳細検索</h4>
            </div>
        </section>
        
        <section class="search-wrap">
            <div class="container">
                <h2 class="sub-title">
                    詳細検索
                </h2>

                <div class="gradeby-wrap wraper">
                    <!-- <h3 class="wrap-title">学年</h3>  -->
                    <ul class="grade-wrap">
                        <li>
                            <input type="checkbox" id="middle" name="middle" value="中学生男子" class="grade">
                            <label for="middle">中学生男子</label>
                        </li>
                        <li>
                            <input type="checkbox" id="high" name="high" value="高校生男子" class="grade">
                            <label for="high">高校生男子</label>
                        </li>
                    </ul>
                </div>

                <?php
                $product_cats = get_terms( array(
                    'taxonomy'      => 'product_cat',
                    'orderby'       => 'ID',
                    'order' => 'ASC',
                    'hide_empty'    => false,
                ) );
                ?>
                <?php if( $product_cats ) : ?>
                <div class="situationby wraper">
                    <h3 class="wrap-title">シチュエーション</h3> 
                    <ul class="cat-list">
                        <?php foreach($product_cats as $product_cat) : ?>
                            <?php $parent_cat = get_term($product_cat->parent); ?>
                            <?php if( $parent_cat->slug == 'situation' ) : ?>
                        <li>
                            <a class="cat-item <?php echo $product_cat->slug; ?>" data-cat='<?php echo $product_cat->slug; ?>' data-parent='<?php echo $parent_cat->slug; ?>'><span><?php echo $product_cat->name; ?></span></a>
                        </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="genreby wraper">
                    <h3 class="wrap-title">ジャンル</h3> 
                    <ul class="cat-list">
                        <?php foreach($product_cats as $product_cat) : ?>
                            <?php $parent_cat = get_term($product_cat->parent); ?>
                            <?php if( $parent_cat->slug == 'genre' ) : ?>
                        <li>
                            <a class="cat-item <?php echo $product_cat->slug; ?>" data-cat='<?php echo $product_cat->slug; ?>' data-parent='<?php echo $parent_cat->slug; ?>'><span><?php echo $product_cat->name; ?></span></a>
                        </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="priceby wraper">
                    <h3 class="wrap-title">価格</h3> 
                    <ul class="cat-list">
                        <?php foreach($product_cats as $product_cat) : ?>
                            <?php $parent_cat = get_term($product_cat->parent); ?>
                            <?php if( $parent_cat->slug == 'price' ) : ?>
                        <li>
                            <a class="cat-item <?php echo $product_cat->slug; ?>" data-cat='<?php echo $product_cat->slug; ?>' data-parent='<?php echo $parent_cat->slug; ?>'><span><?php echo $product_cat->name; ?></span></a>
                        </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- <div class="search-keywords wraper">
                    <div class="label">選択中の条件</div>
                    <div class="keywords-list">
                        
                    </div>
                </div> -->
            </div>
            <ul class="btns">
                <!-- <li>
                    <a class="btn allclear">
                        すべてクリア
                    </a>
                </li> -->
                <li>
                    <a class="btn search">
                        検索する（<span><?php echo $total_post; ?></span>件）<i class="fa fa-angle-right bounce"></i>
                    </a>
                </li>
            </ul>
        </section>
   
    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            var middleschool = null, highschool = null;
            var situation = [];
            var genre = [];
            var price = [];
            var key_list = [];

            $('#middle').change(function() {
                if($(this).prop('checked')) {   //when change the middleschool checkbox
                    middleschool = 1;
                } else {
                    middleschool = null;
                }
                async_Request();
            })

            $('#high').change(function() {
                if($(this).prop('checked')) {   //when change the highschool checkbox
                    highschool = 1;
                } else {
                    highschool = null;
                }
                async_Request();
            })

            //keyword button click event
            $('.cat-item').click(function() {
                //add key-list array
                if($(this).hasClass('active')) {
                    for( var i = 0; i < key_list.length; i++) {
                        if( $(this).attr('data-cat') == key_list[i][0] ) {
                            key_list.splice(i, 1);
                            break;
                        }
                    }
                } else {
                    var item = [$(this).attr('data-cat'), $(this).text(), $(this).attr('data-parent')];
                    key_list.push(item);
                }

                //add situation category array
                if( $(this).attr('data-parent') == 'situation' ) {
                    if($(this).hasClass('active')) {
                        for( var i = 0; i < situation.length; i++) {
                            if( $(this).attr('data-cat') == situation[i] ) {
                                situation.splice(i, 1);
                                break;
                            }
                        }
                    } else {
                        var item = $(this).attr('data-cat');
                        situation.push(item);
                    }
                }

                //add genre category array
                if( $(this).attr('data-parent') == 'genre' ) {
                    if($(this).hasClass('active')) {
                        for( var i = 0; i < genre.length; i++) {
                            if( $(this).attr('data-cat') == genre[i] ) {
                                genre.splice(i, 1);
                                break;
                            }
                        }
                    } else {
                        var item = $(this).attr('data-cat');
                        genre.push(item);
                    }
                }

                //add price category array
                if( $(this).attr('data-parent') == 'price' ) {
                    if($(this).hasClass('active')) {
                        for( var i = 0; i < price.length; i++) {
                            if( $(this).attr('data-cat') == price[i] ) {
                                price.splice(i, 1);
                                break;
                            }
                        }
                    } else {
                        var item = $(this).attr('data-cat');
                        price.push(item);
                    }
                }
                
                //active and deactive
                if( $(this).hasClass('active') ) {
                    $(this).removeClass('active')
                } else {
                    $(this).addClass('active');
                }

                async_Request();
                // add_Keywords(key_list);
            })

            // //選択中の条件 keyword add and cancel function.
            // function add_Keywords( key_list ) {
            //     var parentElement = $('.keywords-list');
            //     parentElement.empty();
            //     for( var i = 0; i < key_list.length; i++ ) {
            //         var newElement = $('<button class="keyword btn-keyword" data-cat="' + key_list[i][0] + '" data-parent="' + key_list[i][2] + '">' + key_list[i][1] +
            //                 '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 2.25C10.0716 2.25 8.18657 2.82183 6.58319 3.89317C4.97982 4.96451 3.73013 6.48726 2.99218 8.26884C2.25422 10.0504 2.06114 12.0108 2.43735 13.9021C2.81355 15.7934 3.74215 17.5307 5.10571 18.8943C6.46928 20.2579 8.20656 21.1865 10.0979 21.5627C11.9892 21.9389 13.9496 21.7458 15.7312 21.0078C17.5127 20.2699 19.0355 19.0202 20.1068 17.4168C21.1782 15.8134 21.75 13.9284 21.75 12C21.7473 9.41498 20.7192 6.93661 18.8913 5.10872C17.0634 3.28084 14.585 2.25273 12 2.25ZM15.5306 14.4694C15.6003 14.5391 15.6556 14.6218 15.6933 14.7128C15.731 14.8039 15.7504 14.9015 15.7504 15C15.7504 15.0985 15.731 15.1961 15.6933 15.2872C15.6556 15.3782 15.6003 15.4609 15.5306 15.5306C15.4609 15.6003 15.3782 15.6556 15.2872 15.6933C15.1961 15.731 15.0986 15.7504 15 15.7504C14.9015 15.7504 14.8039 15.731 14.7128 15.6933C14.6218 15.6556 14.5391 15.6003 14.4694 15.5306L12 13.0603L9.53063 15.5306C9.46095 15.6003 9.37822 15.6556 9.28718 15.6933C9.19613 15.731 9.09855 15.7504 9 15.7504C8.90146 15.7504 8.80388 15.731 8.71283 15.6933C8.62179 15.6556 8.53906 15.6003 8.46938 15.5306C8.3997 15.4609 8.34442 15.3782 8.30671 15.2872C8.269 15.1961 8.24959 15.0985 8.24959 15C8.24959 14.9015 8.269 14.8039 8.30671 14.7128C8.34442 14.6218 8.3997 14.5391 8.46938 14.4694L10.9397 12L8.46938 9.53063C8.32865 9.38989 8.24959 9.19902 8.24959 9C8.24959 8.80098 8.32865 8.61011 8.46938 8.46937C8.61011 8.32864 8.80098 8.24958 9 8.24958C9.19903 8.24958 9.3899 8.32864 9.53063 8.46937L12 10.9397L14.4694 8.46937C14.5391 8.39969 14.6218 8.34442 14.7128 8.3067C14.8039 8.26899 14.9015 8.24958 15 8.24958C15.0986 8.24958 15.1961 8.26899 15.2872 8.3067C15.3782 8.34442 15.4609 8.39969 15.5306 8.46937C15.6003 8.53906 15.6556 8.62178 15.6933 8.71283C15.731 8.80387 15.7504 8.90145 15.7504 9C15.7504 9.09855 15.731 9.19613 15.6933 9.28717C15.6556 9.37822 15.6003 9.46094 15.5306 9.53063L13.0603 12L15.5306 14.4694Z" fill="#F4983D"/></svg></button>');
            //         parentElement.append(newElement);

            //         newElement.on('click', function() {
            //             //delete the item from key_list array
            //             for( var i = 0; i < key_list.length; i++ ) {
            //                 if(key_list[i][0] == $(this).attr('data-cat')) {
            //                     key_list.splice(i, 1);
            //                 }
            //             }

            //             //delete the item from situation array
            //             if($(this).attr('data-parent') == 'situation') {
            //                 for( var i = 0; i < situation.length; i++ ) {
            //                     if(situation[i] == $(this).attr('data-cat')) {
            //                         situation.splice(i, 1);
            //                     }
            //                 }
            //             }

            //             //delete the item from genre array
            //             if($(this).attr('data-parent') == 'genre') {
            //                 for( var i = 0; i < genre.length; i++ ) {
            //                     if(genre == $(this).attr('data-cat')) {
            //                         genre.splice(i, 1);
            //                     }
            //                 }
            //             }

            //             //delete the item from price array
            //             if($(this).attr('data-parent') == 'price') {
            //                 for( var i = 0; i < price.length; i++ ) {
            //                     if(price[i] == $(this).attr('data-cat')) {
            //                         price.splice(i, 1);
            //                     }
            //                 }
            //             }

            //             var key_slug = $(this).attr('data-cat');
            //             var cat_item = $('.' + key_slug);
            //             if(cat_item.hasClass('active')) {
            //                 cat_item.removeClass('active');
            //             }
            //             async_Request();
            //             add_Keywords(key_list);
            //         });
            //     }
            // }

            //すべてクリア
            $('.allclear').click(function() {
                // var parentElement = $('.keywords-list');
                // parentElement.empty();
                middleschool = null;
                highschool = null;
                situation = [];
                genre = [];
                price = [];
                key_list = [];
                $('.btn.search span').text('<?php echo $total_post; ?>')
                if($('.cat-item').hasClass('active')) {
                    $('.cat-item').removeClass('active');
                }
                $('.grade').prop('checked', false);
            })

            //検索する（10件）
            $('.btn.search').click(function() {
                var url = "<?php echo HOME; ?>product/"; 
                if(middleschool) {
                    url = url + '?middleschool=1';
                }

                if(highschool) {
                    if(middleschool) {
                        url = url + '&highschool=1';
                    }
                    else {
                        url = url + '?highschool=1';
                    }
                }

                if(situation) {
                    for(var i = 0; i < situation.length; i++) {
                        if( i == 0 ) {
                            if(middleschool || highschool) {
                                url = url + '&situation[' + i + ']=' + situation[i];
                            }
                            else {
                                url = url + '?situation[' + i + ']=' + situation[i];
                            }
                        } else {
                            url = url + '&situation[' + i + ']=' + situation[i];
                        }
                    }
                }
                
                if(genre) {
                    for(var i = 0; i < genre.length; i++) {
                        if( i == 0 ) {
                            if(middleschool || highschool || situation.length != 0) {
                                url = url + '&genre[' + i + ']=' + genre[i];
                            }
                            else {
                                url = url + '?genre[' + i + ']=' + genre[i];
                            }
                        } else {
                            url = url + '&genre[' + i + ']=' + genre[i];
                        }
                    }
                }

                if(price) {
                    for(var i = 0; i < price.length; i++) {
                        if( i == 0 ) {
                            if(middleschool || highschool || situation.length != 0 || genre.length !=0) {
                                url = url + '&price[' + i + ']=' + price[i];
                            }
                            else {
                                url = url + '?price[' + i + ']=' + price[i];
                            }
                        } else {
                            url = url + '&price[' + i + ']=' + price[i];
                        }
                    }
                }
                window.location.href = url;
            });

            function async_Request() {
                var data = {
                    middleschool: middleschool,
                    highschool: highschool,
                    situation: situation,
                    genre: genre,
                    price: price
                }
                // var json_data = JSON.stringify(data);
                $.ajax({
                    url: ajax_object.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'my_ajax_action',
                        my_data: data
                    },
                    success: function(response) {
                        // Handle the response
                        post_number = response.data['total_counts'];
                        $('.btn.search span').text(post_number);
                    },
                });
            }
        });
    </script>
<?php
get_footer();
?>