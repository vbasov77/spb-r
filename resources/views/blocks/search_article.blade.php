<link rel="stylesheet" href="{{asset('css/search/search.css')}}">
<section class="about-section text-center">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-8" style="margin-top: 60px">
                <form class="example" method="post" action="{{route('search.articles')}}">
                    @csrf
                    <input id="input" type="search" value="{{session("search_articles")}}" placeholder="Поиск...."
                           name="search" required>
                    <button type="submit"><img width="20px" src="{{asset('/icons/search.svg')}}"></button>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('js/jquery/jquery-3.5.1.js')}}"></script>

<script>
    const inputEl = document.querySelector('#input');
    inputEl.addEventListener('focus', event => { //Покрасит рамку
        event.target.style.outline = "1px solid #f57106";

    });
    inputEl.addEventListener('blur', event => { //Покрасит рамку
        event.target.style.removeProperty('outline')
    });

    document.getElementById('input').addEventListener('input', (e) => {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'admin/delete_session',
        });
    });
</script>
<script>
    $(window).resize(function () {
        var width = $('body').innerWidth();
        if (width < 600) {
            $('.col-md').removeClass('col-md-9').addClass('col-md-12');
        }
    });
</script>
