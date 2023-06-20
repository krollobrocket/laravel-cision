@props([
    'content',
    'settings',
    'pagination',
])
<h1>{{ $content->getTitle() }}</h1>
<p>{!! $content->getHtmlBody() !!}</p>
