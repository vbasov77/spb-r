@extends('layouts.app')
@section('content')
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-lg-4">
                    <h3 style="margin-top: 60px; margin-bottom: 40px">Калькулятор. Стоимость упаковки</h3>

                    <form id="form">
                        <label for="price"><b>Цена за килограмм</b></label><br>
                        <input type="number" placeholder="Цена за килограмм" class="form-control" id="price"
                               required>
                        <br>
                        <label for="weight"><b>Вес(гр)</b></label><br>
                        <input type="number" placeholder="Вес" class="form-control" name="weight" id="weight"
                               required
                        ><br>
                        Цена за 1кг:
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
                    <a href="{{asset(route('productsCalculator'))}}" class="btn btn-outline-primary btn-sm" type="submit" >Калькулятор за кг</a>
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

        submit.addEventListener('click', event => {
            calculate();
        });

        clear.addEventListener('click', event => {
            clearInputs();
        });

        function clearInputs() {
            let form = document.getElementById('form');
            form.reset();

        }

        function calculate() {
            const price = document.getElementById('price').value;
            const weight = document.getElementById('weight').value;
            const totalCost = price / 1000 * weight;

            total.innerHTML = totalCost.toFixed(2);
        }
    </script>
@endsection