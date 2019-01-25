@extends('layouts.master')

@section('content')

    @if (!have_posts())
        <div class="alert alert-warning">
            {{ __('Sorry, no results were found.') }}
        </div>
        {!! get_search_form(false) !!}
    @endif

    <h1>{{ printf( esc_html__( 'Search Results for: %s', 'parf' ), '<span>' . get_search_query() . '</span>' ) }}</h1>

    @while (have_posts()) @php the_post() @endphp
        @include('partials.contents.content')
    @endwhile

    {!! get_the_posts_navigation() !!}

@endsection