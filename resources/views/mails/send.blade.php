<h2>Сообщение с сайта</h2>
<p>Данное сообщение получено с сайта memory34.ru</p>

<div>
    <p>Отправитель: {{ $send->name }}</p>
    <p>Контактный номер: {{ $send->phone }}</p>
    <p>Контактный email: {{ $send->email }}</p>
</div>

<div>
    @if($send->product->isNotEmpty())
    <p>Вопрос по товару: {{ $send->product }}</p>
    @else
    <p>Тема письма: {{ $send->title }}</p>
    @endif
    <p>Текст письма: {{ $send->text }}</p>
</div>