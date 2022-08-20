@extends('layouts.app')
@section('content')

    <div class="container mt-5 mb-5">

        <h3>Проверкае данных:</h3><br>

        Id: <?= $res [0] ['id'] ?> <br>
        Даты: <?= $res [0] ['no_in'] . ' - ' . $res [0] ['no_out']?> <br>
        ФИО: <?= $res [0] ['name_user'] ?> <br>
        Телефон: <?= $res [0] ['phone_user'] ?> <br>
        Email: <?= $res [0] ['email_user'] ?> <br>
        Сумма: <?= $res [0] ['summ'] ?> <br>
        Статус: <?php if (!empty($res[0]['pay'] == 0)): ?>
        Не оплачен<br>
        <? else: ?>
        Оплачен<br>
        <?
        $os = explode(';', $res [0] ['info_pay']);
        $ost = $res [0]['summ'] - $os[2];
        ?>
        Остаток: <?= $ost;?> руб.<br>
        <?php endif;?>
        Ночей: <?= $nights?><br>
        <br>
        Гости:<br>
        <?php foreach ($user_info as $item): ?>
        <div>
            <?= $item ?> <br>
        </div>
        <?php endforeach; ?>
        <br>

        @if (!empty($res [0] ['more_book']))
            <?php
            $info = explode(',', $res [0] ['more_book']);
            ?>

            @foreach($info as $item)
                <?= $item;?><br>

            @endforeach
        @endif
        <br>
        <br>
        @if($res [0]['confirmed'] == 0)<br>
        <div>

            <a onClick="return confirm('Подтвердите подтверждение!')" style="margin: 5px"
               href='/order/{{$res [0] ['id']}}/confirm' type='button'
               class="btn btn-outline-success btn-sm">Подтвердить</a>

            <a onClick="return confirm('Подтвердите отклонение!')" style="margin: 5px"
               href='/order/<?= $res [0] ['id'] ?>/reject' type='button'
               class="btn btn-outline-secondary btn-sm">Отклонить</a>

        </div>
        @endif
        @if($res [0]['confirmed'] == 1)
            <button class="btn btn-outline-success btn-sm"
                    onclick="window.location.href = '/order/<?= $res [0] ['id'] ?>/to_pay';">
                Внести
            </button>
        @endif
    </div>
@endsection
