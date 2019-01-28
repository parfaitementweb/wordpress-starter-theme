<article id="post-{{ get_the_id() }}" @php post_class() @endphp>
    <header class="entry-header">
        @if ( is_singular() )
        	<h1 class="entry-title">{{ get_the_title() }}</h1>
        @else
        	<h2 class="entry-title"><a href="{{ get_permalink() }}" rel="bookmark">{{ get_the_title() }}</a></h2>
        @endif
        @include('partials.contents.entry-meta')
    </header>
    <div class="entry-summary">
        {{ the_content( __('Read more', 'starter_theme')) }}
    </div>
</article>