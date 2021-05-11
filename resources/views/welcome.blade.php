<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="David Europe">
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

        <title>TAGMKR.IO</title>

        <!-- description -->
        <meta name="description" content="Create your own LinkedIn profile image tag.">
        <!-- keywords -->
        <meta name="keywords" content="linkedin, profile, image, profile image, tag, hashtag, david europe, david, europe, media, content, systems, technology, web, apps, enterprise, developments, start-up, satellite, streaming, turn-key, solutions, brand, identity, marketing">

        <!-- og -->
        <meta property="og:title" content="TAGMKR.IO">
        <meta property="og:description" content="Create your own LinkedIn profile image tag.">
        <meta property="og:image" content="https://tagmkr.io/images/og_image.jpg">
        <meta property="og:url" content="https://davideurope.com">
        <meta property="og:site_name" content="TAGMKR.IO">

        <!-- twitter -->
        <meta name="twitter:title" content="TAGMKR.IO">
        <meta name="twitter:description" content="Create your own LinkedIn profile image tag.">
        <meta name="twitter:image" content="https://tagmkr.io/images/og_image.jpg">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@TheDavidEurope">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        {{-- Rich Results --}}
        <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "Organization",
              "url": "https://tagmkr.io",
              "logo": "https://tagmkr.io/images/logo.png"
            }
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-F79143G7M4"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-F79143G7M4');
        </script>
        <style>
            body{
                background-color: #eee;
            }
        </style>
    </head>
    <body class="antialiased">
        <div id="app">
            <landing-page session={{ base64_encode(Request::ip()) }} ></landing-page>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
