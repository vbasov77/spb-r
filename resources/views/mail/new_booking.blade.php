mieten.ru<br>
Новое бронирование<br>
<br>
Даты: {{$data['in'] . ' - ' . $data ['out']}}<br>
<br>
Забронировал: {{$data['user_name']}}<br>
<br>
<a href="{{$data['url']}}/{{route("admin.order.verification", ["id" => $data['id']])}}">Перейти</a>





