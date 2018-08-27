@foreach($items as $item)
    <!--Добавляем класс active для активного пункта меню-->
    <li {{ (URL::current() == $item->url()) ? "class=active" : '' }}>
        <!-- метод url() получает ссылку на пункт меню (указана вторым параметром
        при создании объекта LavMenu)-->
        <a href="{{ $item->url() }}">{{ $item->title }}</a> | {!! $item->attr('is_active') == 1 ? '<span style="color:green">Активен</span>' : '<span style="color:red">Не активен</span>' !!}
        | {{ $item->attr('is_footer') == 1 ? 'Размещать в подвале сайта' : 'Не размещать в подвале сайта' }} | <a href="{{ route('menu.edit',  $item->id) }}">Редактировать</a> | 
                                                    <form style="display: inline;" action="{{ route('menu.destroy', $item->id) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" rel="tooltip" type="submit" class="btn btn-link">
                                                            Удалить
                                                        </button>
                                                    </form>
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
