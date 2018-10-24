@foreach($items as $item)
    @if($item->attr('is_active') !== 1)
        @continue
    @endif

    @if($item->hasChildren())
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                {{ $item->title }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                @include(env('THEME').'client.includes.menuItems', ['items'=>$item->children()])
            </div>
        </li>
    @elseIf($item->hasParent())
        <a class="dropdown-item" href="{{ $item->url() }}">{{ $item->title }}</a>
    @else
        <li {{ (URL::current() == $item->url()) ? "class=active nav-item" : "class=nav-item" }}>
            <a class="nav-link" href="{{ $item->url() }}">{{ $item->title }}</a>
        </li>
    @endif
@endforeach