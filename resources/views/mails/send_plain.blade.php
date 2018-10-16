Сообщение с сайта
Данное сообщение получено с сайта memory34.ru,

Отправитель: {{ $send->name }},
>Контактный номер: {{ $send->phone }},
Контактный email: {{ $send->email }}.

@if($send->product->isNotEmpty())
Вопрос по товару: {{ $send->product }},
@else
Тема письма: {{ $send->title }},
@endif
Текст письма: {{ $send->text }}.
