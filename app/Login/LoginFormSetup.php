<?php

namespace App\Login;

class LoginFormSetup {

	public function handle() {
		add_action( 'after_setup_theme', function () {

			foreach ( [ [ 'title' => 'Login Page', 'name' => 'user-login' ], [ 'title' => 'Registration Page', 'name' => 'user-register' ] ] as $page ) {
				if ( ( new \WP_Query( [ 'post_type' => 'page', 'pagename' => 'user-login', ] ) )->post_count == 0 ) {
					$page = array(
						'post_title'   => $page['title'],
						'post_content' => '',
						'post_status'  => 'publish',
						'post_author'  => 1,
						'post_type'    => 'page',
						'post_name'    => $page['name']
					);
					wp_insert_post( $page );
				}
			}

		} );
	}

}