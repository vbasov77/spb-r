Здравствуйте, {{ $data ['user_name']}}!<br>
<br>
Вы забронировали номер по адресу:<br>
Санкт-Петербург, пр. Обуховской обороны, д. 123А, №13<br>
<br>
Дата и время въезда: {{ $data ['in']}} с 14.00<br>
Дата и время выезда: {{ $data ['out']}} до 12.00<br>
<br>
Итого: {{$_POST ['sum']}} руб<br>
<br>
Ожидайте подтверждения бронироания...<br>

<br><br>
С уважением,
администрация сайта {{config('app.name')}}!