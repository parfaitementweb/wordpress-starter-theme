@extends('layouts.master')

@section('content')

    @if (!have_posts())
        <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'starter_theme') }}
        </div>
        {!! get_search_form(false) !!}
    @endif

    @while (have_posts()) @php the_post() @endphp
        @include('partials.contents.content-page')
    @endwhile

@endsection