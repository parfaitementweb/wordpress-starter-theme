@extends('layouts.master')

@section('content')

    @if (!have_posts())
        <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'starter_theme') }}
        </div>
        
    @endif

    <h1>{!! __( 'Search Results for: <span>' . $query . '</span>', 'starter_theme' ) !!}</h1>

    @while (have_posts()) @php the_post() @endphp
        @include('partials.contents.content')
    @endwhile

    {!! get_the_posts_navigation() !!}

@endsection