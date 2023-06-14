@props([
    'content',
])
@foreach ($content as $item)
    <div class="">
        <h2>{{ $item->Title }}</h2>
        <span>{{ date('m/d/Y', strtotime($item->PublishDate)) }}</span>
        {{ $item->Intro }}
        @if (count($item->Images) > 0)
            <img src="{{ $item->Images[0]->DownloadUrl }}" alt="{{ $item->Images[0]->Title }}" />
        @endif
    </div>
@endforeach
