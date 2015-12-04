<aside class="main-sidebar">
    <section class="sidebar">

        <ul class="sidebar-menu">
            <li class="header">{{ config('transleite.name') }}</li>

            @foreach ($items as $item)
            <li{!! $item['isActive'] ? ' class="active"' : '' !!}><a href="{{ $item['route'] }}"><span>{{ $item['name'] }}</span></a></li>
            @endforeach
        </ul>
    </section>
</aside>