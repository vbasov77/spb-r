<h5>Паркинг:</h5>
<label class="checkbox-btn2">
    <input type="checkbox" name="parking[]"
           @php
               if (in_array("нет", $data["parking"])) {
                   echo 'checked';

               }@endphp
           value="нет">
    <span>Нет</span>
</label>
<label class="checkbox-btn2">
    <input type="checkbox" name="parking[]"
           @php
               if (in_array("на улице", $data["parking"])) {
                   echo 'checked';

               }@endphp
           value="на улице">
    <span>На улице</span>
</label>
<label class="checkbox-btn2">
    <input type="checkbox" name="parking[]"
           @php
               if (in_array("в здании", $data["parking"])) {
                   echo 'checked';
               }@endphp
           value="в здании">
    <span>В здании</span>
</label>