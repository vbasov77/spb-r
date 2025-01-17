@extends('layouts.recipes')
@section('content')
    <link href="{{ asset('css/checkbox/radio.css') }}" rel="stylesheet">
    <section>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-lg-10">
                    <form action="{{route("update.recipe")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h3 style="margin-top: 60px">Редактирование рецепта</h3>
                        <input type="hidden" name="id" value="{{$recipe->id}}">
                        <label for="name"><b>Название</b></label><br>
                        <input type="text" placeholder="Название" class="form-control" name="name"
                               required value="{{$recipe->title}}"
                        ><br>
                        <br>
                        <label for="description"><b>Описание</b></label><br>
                        <textarea type="text" placeholder="Описание" class="form-control" name="description"
                                  required>{{$recipe->description }}</textarea>
                        <br>
                        @if(!empty(count($ingredients)))
                            @for($i = 0; $i < $countIngredients; $i++)
                                <br>
                                <input class="form-control" type="text" name="ingredients[{{$i}}]"
                                       placeholder="Введите текст" value="{{$ingredients[$i]}}"></input>
                            @endfor
                        @endif
                        <br>
                        <div class="ingredient"></div>
                        <br>
                        <div class='form_radio_btn2 my_mobile' style="text-align: center;">
                            <input type='radio' id="addIngredients"
                            ><label for='addIngredients'>Добавить ингредиент</label></div>
                        <br>
                        @for($i = 0; $i < $count; $i++)
                            @if($elements[$i]->elem === "text")
                                <br>
                                <textarea class="form-control" type="text" name="text[{{$i}}]"
                                          placeholder="Введите текст">{{$elements[$i]->v}}</textarea>                            @else
                                @if($elements[$i]->v !== null)
                                    <br>
                                    <div id="div{{$i}}" class="div{{$i}}" data-code="{{$elements[$i]->code}}">
                                        <img src="{{$elements[$i]->v}}"
                                             width="50%" height="auto">
                                        <input type="hidden" name="img[{{$i}}]" value="{{$elements[$i]->v}}">
                                        <div>
                                            <br>
                                            <button type="submit" class="btn btn-outline-danger btn-sm" id="{{$i}}">
                                                Удалить фото
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endfor

                        <div class="elem"></div>
                        <br>
                        <div class='form_radio_btn2 my_mobile' style="text-align: center;">
                            <input type='radio' id="addText"
                            ><label for='addText'>Добавить текст</label></div>
                        <div class='form_radio_btn2 my_mobile' style="text-align: center;">
                            <input type='radio' id="addImg"
                            ><label for='addImg'>Добавить фото</label></div>
                        <br>
                        <br>
                        <input class="btn btn-outline-success" type="submit" value="Сохранить">
                    </form>
                    <div>
                        <br>
                        <div class="btn btn-outline-danger btn-sm deleteRecipe" type="submit">Удалить</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const recipeId = @json($recipe->id);
        let count = @json($count);
        let countIngredients = @json($countIngredients);
        const allButtons = document.querySelectorAll('button[type="submit"]');
    </script>
    <script src="{{ asset('js/deletes/delete_recipe.js') }}" defer></script>
    <script src="{{ asset('js/recipes/edit.js') }}" defer></script>
@endsection