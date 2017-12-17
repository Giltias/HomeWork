<header class="main-header">
    <div class="top-header">
        <div class="top-header__wrap">
            <div class="logotype-block">
                <div class="logo-wrap"><a href="/"><img src="/img/logo.svg" alt="Логотип"
                                                        class="logo-wrap__logo-img"></a></div>
            </div>
            <?php wp_nav_menu([
                'menu_class' => 'nav-list',
                'container' => 'nav',
                'container_class' => 'main-navigation'
            ]); ?>
        </div>
    </div>
    <div class="bottom-header">
        <div class="search-form-wrap">
            <form role="search" action="/" method="get" class="search-form">
                <input type="text" placeholder="Поиск..." name="s" class="search-form__input" value="">
                <button class="search-form__btn-search"><i class="icon icon-search"></i></button>
            </form>
        </div>
    </div>
</header>