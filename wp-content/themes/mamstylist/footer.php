    <footer id="footer">
        <div class="container">
            <div class="footer-main">
                <nav class="footer-nav">
                    <ul class="nav-menu">
                        <li>
                            <a href="<?= esc_url(home_url('/rule')); ?>">
                                <span>利用規約</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= esc_url(home_url('/privacy')); ?>">
                                <span>プライバシーポリシー</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= esc_url(home_url('/company')); ?>">
                                <span>運営会社</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <p class="copyright">© ママはスタイリスト All Right Reserved.</p>
        </div>

    </footer>

	<?php wp_footer(); ?>

	<div id="lightbox"><img></div>

    <script type="text/javascript">
        $(document).ready(function() {
        // Attach a change` event handler to the select element with id "mySelect"
            //pc header search bar
            $(".pc-header .btn-search-header").click(function() {
                var search_key = $('.pc-header .search-key-header').val();
                var url = "<?php echo HOME; ?>product/?search_key=" + search_key;
                window.location.href = url;
            })
            //sp header search bar
            $(".mobile-header .btn-search-header").click(function() {
                var search_key = $('.mobile-header .search-key-header').val();
                var url = "<?php echo HOME; ?>product/?search_key=" + search_key;
                window.location.href = url;
            })

            $(".btn-search-front").click(function() {
                var search_key = $('.search-key-front').val();
                var url = "<?php echo HOME; ?>product/?search_key=" + search_key;
                window.location.href = url;
            })
            
        })
    </script>
</body>
</html>