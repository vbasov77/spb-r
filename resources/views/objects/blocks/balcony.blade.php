

<label class="checkbox-btn2">
    <input type="checkbox" name="balcony[]"
           @php
               if (in_array("балкон", $data["balcony"])) {
                   echo 'checked';

               }@endphp
           value="балкон">
    <span>Балкон</span>
</label>
<label class="checkbox-btn2">
    <input type="checkbox" name="balcony[]"
           @php
               if (in_array("лоджия",  $data["balcony"])) {
                   echo 'checked';

               }@endphp
           value="лоджия">
    <span>Лоджия</span>
</label>
