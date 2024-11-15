<h5>Интернет и ТВ:</h5>

<label class="checkbox-btn2">
    <input type="checkbox" name="service[]"
           @php
           if (in_array("vi-fi", $data["service"])) {
    echo 'checked';

    }@endphp
    value="vi-fi">
    <span>Vi-Fi</span>
</label>
<label class="checkbox-btn2">
    <input type="checkbox" name="service[]"
           @php
           if (in_array("телевидение", $data["service"])) {
    echo 'checked';

    }@endphp
    value="телевидение">
    <span>Телевидение</span>
</label>