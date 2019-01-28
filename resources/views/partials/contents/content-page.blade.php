<article id="post-{{ get_the_id() }}" @php post_class() @endphp>
    <header class="entry-header">
        <h1 class="entry-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h1>
        @include('partials.contents.entry-meta')
    </header>
    <div class="entry-content">
        {{ the_content() }}
    </div>
</article>