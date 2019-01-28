@extends('layouts.master')

@section('content')
	<section class="error-404 not-found">
		<header class="page-header">
			<h1 class="page-title">{{ __( 'Oops! That page can\'t be found.', 'starter_theme' ) }}</h1>
		</header>

		<div class="page-content">
			<p>{{ __( 'It looks like nothing was found at this location. Maybe try a search?', 'starter_theme' ) }}</p>
			{!! get_search_form() !!}
   		</div><!-- .page-content -->
   	</section><!-- .error-404 -->
@endsection