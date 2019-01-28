@if ( is_active_sidebar( 'sidebar-primary' ) )
 	<aside id="secondary" class="widget-area" role="complementary" aria-label="{{ __('Blog Sidebar', 'starter_theme') }}">
 		<?php dynamic_sidebar( 'sidebar-primary' ); ?>
 	</aside>
@endif