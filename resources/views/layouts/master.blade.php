<!doctype html>
<html {{substr( get_bloginfo ( 'language' ), 0, 2 )}}>

@php do_action('get_header') @endphp
@include('partials.head')

<body @php body_class() @endphp>

@include('partials.header')

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            @yield('content')
        </main><!-- #main -->
    </div><!-- #primary -->
    @include('sidebar')
</div><!-- .wrap -->

@php do_action('get_footer') @endphp
@include('partials.footer')

<noscript id="deferred-styles">
    {{--<link rel="dns-prefetch" href="https://fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700" rel="stylesheet" type="text/css">--}}
</noscript>

<script>
    var loadDeferredStyles = function() {
        var addStylesNode = document.getElementById("deferred-styles");
        var replacement = document.createElement("div");
        replacement.innerHTML = addStylesNode.textContent;
        document.body.appendChild(replacement)
        addStylesNode.parentElement.removeChild(addStylesNode);
    };
    var raf = requestAnimationFrame || mozRequestAnimationFrame ||
        webkitRequestAnimationFrame || msRequestAnimationFrame;
    if (raf) raf(function() {
        window.setTimeout(loadDeferredStyles, 0);
    });
    else window.addEventListener('load', loadDeferredStyles);
</script>

@php wp_footer() @endphp
</body>
</html>
