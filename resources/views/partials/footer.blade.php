<nav role="navigation" class="nav-menu">
    @if (has_nav_menu('footer_navigation'))
        {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'nav', 'container' => null]) !!}
    @endif
</nav>