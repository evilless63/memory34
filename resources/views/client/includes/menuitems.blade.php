@foreach($items as $item)
    @if($item->attr('is_active') !== 1)
        @continue    
    @endif
    <!--Добавляем класс active для активного пункта меню-->
    <li {{ (URL::current() == $item->url()) ? "class=active" : '' }}>
        <!-- метод url() получает ссылку на пункт меню (указана вторым параметром
        при создании объекта LavMenu)-->
        <a href="{{ $item->url() }}">{{ $item->title }}</a> 
        <!--Формируем дочерние пункты меню
        метод haschildren() проверяет наличие дочерних пунктов меню-->
        @if($item->hasChildren())
            <ul class="sub-menu">
                <!--метод children() возвращает дочерние пункты меню для текущего пункта-->
                @include(env('THEME').'admin.includes.menuItems', ['items'=>$item->children()])
            </ul>
        @endif
    </li>
@endforeach