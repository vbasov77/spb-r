<center><h3 style="margin: 60px 0 40px 0">Культурные новости, куда сходить в СПб</h3></center>
<div class="wrap">
    <button onclick="window.location.href = 'https://t.me/spb_mieten';"
            style="color: white; margin-top: 50px; margin-bottom: 50px;" class="button2">Telegram Канал
    </button>
</div>
<link rel="stylesheet" href="{{asset('css/for_index/for_index.css')}}">
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div id="col-md" class="col-md-9">
            <center><h5 style="margin-bottom: 50px; text-align: left;">Будь в курсе! Подпишись на культурные новости Санкт-Петербурга!</h5>
            </center>
            @if(count($news))
                @foreach($news as $item)
                    @php
                        $img = json_decode($item->img)
                    @endphp

                    <div class="card" style="margin-top: 25px;">
                        <div class="card-body text-left">
                            <a class="link" style="text-decoration: none" href="{{route('post', ["id"=>$item['id']])}}">
                                @if(!empty($img[0]))

                                    <img src="{{$img[0]}}"
                                         height="150px" width="auto" class="rightM box3">
                                @else
                                    <img src="{{ asset("images/no_image/no_image.jpg") }}"
                                         height="150px" width="auto"
                                         class="rightM box3">
                                @endif
                                {{mb_substr($item ['text'],  0, 250, 'UTF-8') }}...
                                <br>
                                <p style="font-size: 10px; margin-top: 20px; float: left">{{date('d.m.Y', strtotime($item['created_at']))}}</p>
                            </a>
                        </div>
                    </div>
                @endforeach

                <br>
                <br>
                <center>
                    <a style="text-decoration: none" target="_blank" href="{{route('news')}}">Смотреть все новости</a>
                </center>
            @else
                Нет материала
            @endif
        </div>
    </div>
</div>