<article @php post_class() @endphp>
    <header>
        <h2 class="entry-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
        @include('partials.contents.entry-meta')
    </header>
    <div class="entry-summary">
        @php the_excerpt() @endphp
    </div>
    <a class="entry-read-more" href="{{get_permalink()}}">{{__('Read more')}}</a>
</article>