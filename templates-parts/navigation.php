<nav class="bg-black" x-data="{ open: false }">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex justify-between h-16">
			<div class="relative flex w-full">
				<div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
					<!-- Mobile menu button -->
					<button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
						<span class="sr-only">Open main menu</span>
						<svg x-state:on="Menu open" x-state:off="Menu closed" class="block h-6 w-6" :class="{ 'hidden': open, 'block': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
						</svg>
						<svg x-state:on="Menu open" x-state:off="Menu closed" class="hidden h-6 w-6" :class="{ 'block': open, 'hidden': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
						</svg>
					</button>
				</div>

				<div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
					<div class="flex-shrink-0 flex items-center">
						<a href="<?php echo home_url( '/' ) ?>" rel="home">
							<img class="h-12 w-auto" src="<?php echo asset('img/logo.svg') ?>" alt="Vaux Hall Brussels">
                        </a>
					</div>

					<?php
					wp_nav_menu([
							'theme_location' => 'primary_navigation',
							'menu_class' => 'primary-navigation hidden sm:ml-6 sm:flex sm:items-center lg:space-x-4 flex-grow justify-end',
							'container' => null,
					])
					?>

					<div class="hidden sm:flex items-center justify-center flex-grow-0 ml-4">
						<?php do_action('wpml_add_language_selector'); ?>
					</div>

				</div>

			</div>
		</div>
	</div>

	<div class="md:hidden" id="mobile-menu" x-show="open">
        <?php
        wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'menu_class' => 'primary-navigation px-2 pt-2 space-y-1 sm:px-3',
            'container' => null,
        ])
        ?>
		<div class="md:hidden pb-3 px-2 space-y-1 sm:px-3">
			<?php do_action('wpml_add_language_selector'); ?>
		</div>
	</div>
</nav>