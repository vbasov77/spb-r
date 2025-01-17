@extends('layouts.app')
@section('content')
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-lg-4">
                    <form id="form">
                        <h3 style="margin-top: 60px">Калькулятор Омега3</h3>
                        <label for="price"><b>Цена за упаковку</b></label><br>
                        <input type="number" placeholder="Цена за упаковку" class="form-control" id="price"
                               required>
                        <br>
                        <label for="count"><b>Штук в упаковке</b></label><br>
                        <input type="number" placeholder="Штук в упаковке" class="form-control" name="count" id="count"
                               required value=""
                        ><br>
                        <label for="epa"><b>EPA</b></label><br>
                        <input type="number" placeholder="Эйкозапентаеновая кислота" class="form-control" name="epa"
                               id="epa"
                               required value=""
                        ><br>
                        <label for="dha"><b>DHA</b></label><br>
                        <input type="number" placeholder="Докозагексаеновая кислота" class="form-control" name="dha"
                               id="dha"
                               required value="">
                        <br>
                        <label for="portion"><b>Порция</b></label><br>
                        <input type="number" placeholder="Количество в порции" class="form-control" name="portion"
                               id="portion"
                               required value="">
                        <br>

                        Цена за 1гр:
                        <div style="font-size: 25px; font-weight: bold" id="total"></div>
                        <br>
                        <br>
                    </form>
                    <button class="btn btn-outline-success btn-sm" type="submit" id="submit">Посчитать</button>
                    <br>
                    <br>
                    <button class="btn btn-outline-info btn-sm" type="submit" id="clearInputs">Очистить</button>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </section>
    <script>


        const submit = document.getElementById('submit');
        const total = document.getElementById('total');
        const clear = document.getElementById('clearInputs');

        clear.addEventListener('click', event => {
            clearInputs();
        });

        function clearInputs() {
            let form = document.getElementById('form');
            form.reset();

        }

        submit.addEventListener('click', event => {
            calculate();
        });

        function calculate() {
            const price = document.getElementById('price').value;
            const count = document.getElementById('count').value;
            const epa = parseInt(document.getElementById('epa').value);
            const dha = parseInt(document.getElementById('dha').value);
            const portion = document.getElementById('portion').value;

            const omega3 = epa + dha;
            const one = omega3 / portion;
            const all = one * count;
            const totalCost = price / all * 1000;

            total.innerHTML = totalCost.toFixed(2);
        }
    </script>
@endsection