<style>
    /*-----------------------------------------Стилизация кнопки*/
    @media screen and (max-width: 640px) {
        .form_radio_btn2, .form_radio_btn2 label {
            width: 100%;
        }

        .my_mobile {
            margin-top: 10px;
        }
    }

    .form_radio_btn2 {
        display: inline-block;
        margin-right: 5px;
    }

    .form_radio_btn2 input[type=radio] {
        display: none;
    }

    .form_radio_btn2 label {
        display: inline-block;
        cursor: pointer;
        padding: 7px;
        border: 1px solid #999;
        border-radius: 6px;
        user-select: none;
    }

    /* Checked */
    .form_radio_btn2 input[type=radio]:checked + label {
        background: #999;
        color: white;
    }

    /* Hover */
    .form_radio_btn2 label:hover {
        color: #666;
    }

    /* Disabled */
    .form_radio_btn2 input[type=radio]:disabled + label {
        background: #efefef;
        color: #666;
    }
</style>

<h2>
    Правила въезда
</h2>

<h5 style="margin-top: 15px"> Можно с детьми</h5>
<div class='form_radio_btn2 my_mobile' style="text-align: center;">
    <input type='radio' id="initial1" name='children' required value='да'
            @php
                if (in_array("да", $data["children"])) {
                    echo 'checked';

                }@endphp  >
    <label for='initial1'>Да</label></div>

<div class='form_radio_btn2 my_mobile' style="text-align: center;">
    <input type='radio' id="initial2" name='children' required value='нет'
            @php
                if (in_array("нет", $data["children"])) {
                    echo 'checked';

                }@endphp
    >
    <label for='initial2'>Нет</label></div>


<h5 style="margin-top: 15px"> Можно с животными</h5>
<div class='form_radio_btn2 my_mobile' style="text-align: center;">
    <input type='radio' id="initial3" name='animals' required value='да'
            @php
                if (in_array("да", $data["animals"])) {
                    echo 'checked';

                }@endphp>
    <label for='initial3'>Да</label></div>

<div class='form_radio_btn2 my_mobile' style="text-align: center;">
    <input type='radio' id="initial4" name='animals' required value='нет'
            @php
                if (in_array("нет", $data["animals"])) {
                    echo 'checked';

                }@endphp>
    <label for='initial4'>Нет</label></div>

<h5 style="margin-top: 15px"> Можно курить</h5>
<div class='form_radio_btn2 my_mobile' style="text-align: center;">
    <input type='radio' id="initial5" name='smoking' required value='да'
            @php
                if (in_array("да", $data["smoking"])) {
                    echo 'checked';

                }@endphp>
    <label for='initial5'>Да</label></div>

<div class='form_radio_btn2 my_mobile' style="text-align: center;">
    <input type='radio' id="initial6" name='smoking' required value='нет'
            @php
                if (in_array("нет", $data["smoking"])) {
                    echo 'checked';

                }@endphp>
    <label for='initial6'>Нет</label></div>

<h5 style="margin-top: 15px">Разрешены вечеринки</h5>
<div class='form_radio_btn2 my_mobile' style="text-align: center;">
    <input type='radio' id="initial7" name='party' required value='да'
            @php
                if (in_array("да", $data["party"])) {
                    echo 'checked';

                }@endphp>
    <label for='initial7'>Да</label></div>

<div class='form_radio_btn2 my_mobile' style="text-align: center;">
    <input type='radio' id="initial8" name='party' required value='нет'
            @php
                if (in_array("нет", $data["party"])) {
                    echo 'checked';

                }@endphp>
    <label for='initial8'>Нет</label></div>

<h5 style="margin-top: 15px">Есть отчётные документы</h5>
<div class='form_radio_btn2 my_mobile' style="text-align: center;">
    <input type='radio' id="initial9" name='documents' required value='да'
            @php
                if (in_array("да", $data["documents"])) {
                    echo 'checked';

                }@endphp>
    <label for='initial9'>Да</label></div>

<div class='form_radio_btn2 my_mobile' style="text-align: center;">
    <input type='radio' id="initial10" name='documents' required value='нет'
            @php
                if (in_array("нет", $data["documents"])) {
                    echo 'checked';

                }@endphp>
    <label for='initial10'>Нет</label></div>

<h5 style="margin-top: 15px">Можно снять помесячно</h5>
<div class='form_radio_btn2 my_mobile' style="text-align: center;">
    <input type='radio' id="initial11" name='monthly' required value='да'
            @php
                if (in_array("да", $data["monthly"])) {
                    echo 'checked';

                }@endphp>
    <label for='initial11'>Да</label></div>

<div class='form_radio_btn2 my_mobile' style="text-align: center;">
    <input type='radio' id="initial12" name='monthly' required value='нет'
            @php
                if (in_array("нет", $data["monthly"])) {
                    echo 'checked';

                }@endphp>
    <label for='initial12'>Нет</label></div>