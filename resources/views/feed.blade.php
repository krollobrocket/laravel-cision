@props([
    'content',
    'config',
    'pagination',
])
@php /** @var \Cyclonecode\Cision\FeedSettings $config */ @endphp
<link rel="stylesheet" href="{{ asset('vendor/cision/cision.css') }}" />
<div class="cision-feed">
@php /** @var \Cyclonecode\Cision\FeedItem $item */ @endphp
@foreach ($content as $item)
    <div class="item">
        <h2>{{ $item->getTitle() }}</h2>
        <span>{{ $item->getPublishDate()->format($config->getDateFormat()) }}</span>
        {{ $item->getIntro() }}
        @if ($item->getImages() && $config->getImageStyle())
            <img src="{{ $item->getImages()[0]->{ "get" . $config->getImageStyle() }() }}" alt="{{ $item->getImages()[0]->getTitle() }}" />
        @endif
        <a href="{{ $config->getBaseSlug() }}/{{ $item->getEncryptedId() }}">Readmore</a>
    </div>
@endforeach
    {!! $pagination !!}
</div>
