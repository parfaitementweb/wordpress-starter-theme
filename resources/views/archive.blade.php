@extends('layouts.master')

@section('content')

    @if (!have_posts())
        <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'starter_theme') }}
        </div>
        {!! get_search_form(false) !!}
    @else
        <header class="page-header">
            {{ the_archive_title('<h1 class="page-title">', '</h1>') }}
        </header>
    @endif

    @while (have_posts()) @php the_post() @endphp
        @include('partials.contents.content')
    @endwhile

    {!! get_the_posts_navigation() !!}

@endsection