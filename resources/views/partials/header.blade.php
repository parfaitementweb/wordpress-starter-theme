<header id="masthead" class="site-header" role="banner">
	@if ( is_front_page() && is_home() )
		<h1 class="site-title">
			<a href="{{ home_url( '/' ) }}" rel="home">{{ bloginfo( 'name' ) }}</a>
		</h1>
	@else
		<p class="site-title">
			<a href="{{ home_url( '/' ) }}" rel="home">{{ bloginfo( 'name' ) }}</a>
		</p>
	@endif
	
	@if (has_nav_menu('primary_navigation'))
		<nav role="navigation" class="nav-menu">
	        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'container' => null]) !!}
		</nav>
	@endif
</header>