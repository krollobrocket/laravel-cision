@props([
    'content',
    'settings',
])
@foreach ($content as $item)
    <div class="">
        <h2>{{ $item->Title }}</h2>
        <span>{{ date($settings['feed_date_format'], strtotime($item->PublishDate)) }}</span>
        {{ $item->Intro }}
        @if (isset($item->Image))
            <img src="{{ $item->Image->Url }}" alt="{{ $item->Image->Title }}" />
        @endif
    </div>
@endforeach
