@if (has_nav_menu('primary_navigation'))
	<nav role="navigation" class="nav-menu" aria-label="{{ __('Primary Menu', 'starter_theme') }}">

		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'starter_theme' ); ?></button>

        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'container' => null]) !!}
	</nav>
@endif