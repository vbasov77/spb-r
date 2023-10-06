
Здравствуйте, <?= $data ['user_name']?>!<br>
<br>
Вы забронировали тур: <?= $data ['name_tour']?> <br>
<br>
<br>
Дата: <?= $data ['date_tour']?><br>
Время: <?= $data ['time_tour']?><br>
<br>
Итого: <?= $data ['total']?> руб<br>
<br>
Ожидайте подтверждения бронироания...<br>

<br>
С уважением,
администрация сайта {{config('app.name')}}!
