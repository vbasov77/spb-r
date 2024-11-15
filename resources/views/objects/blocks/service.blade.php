<h4>Сервис</h4>

<h5>Техника:</h5>
<label class="checkbox-btn2">
    <input type="checkbox" name="service[]"
           @php
               if (in_array("кондиционер", $data["service"])) {
                   echo 'checked';

               }@endphp
           value="кондиционер">
    <span>Кондиционер</span>
</label>

<label class="checkbox-btn2">
    <input type="checkbox" name="service[]"
           @php
               if (in_array("холодильник", $data["service"])) {
                   echo 'checked';

               }@endphp
           value="холодильник">
    <span>Холодильник</span>
</label>

<label class="checkbox-btn2">
    <input type="checkbox" name="service[]"
           @php
               if (in_array("плита", $data["service"])) {
                   echo 'checked';

               }@endphp
           value="плита">
    <span>Плита</span>
</label>

<label class="checkbox-btn2">
    <input type="checkbox" name="service[]"
           @php
               if (in_array("микроволновка", $data["service"])) {
                   echo 'checked';

               }@endphp
           value="микроволновка">
    <span>Микроволновка</span>
</label>

<label class="checkbox-btn2">
    <input type="checkbox" name="service[]"
           @php
               if (in_array("стиральная машина", $data["service"])) {
                   echo 'checked';

               }@endphp
           value="стиральная машина">
    <span>Стиральная машина</span>
</label>

<label class="checkbox-btn2">
    <input type="checkbox" name="service[]"
           @php
               if (in_array("посудомоецная машина", $data["service"])) {
                   echo 'checked';

               }@endphp
           value="посудомоецная машина">
    <span>Посудомоецная машина</span>
</label>

<label class="checkbox-btn2">
    <input type="checkbox" name="service[]"
           @php
               if (in_array("водонагреватель", $data["service"])) {
                   echo 'checked';

               }@endphp
           value="водонагреватель">
    <span>Водонагреватель</span>
</label>

<label class="checkbox-btn2">
    <input type="checkbox" name="service[]"
           @php
               if (in_array("телевизор", $data["service"])) {
                   echo 'checked';

               }@endphp
           value="телевизор">
    <span>Телевизор</span>
</label>

<label class="checkbox-btn2">
    <input type="checkbox" name="service[]"
           @php
               if (in_array("фен", $data["service"])) {
                   echo 'checked';

               }@endphp
           value="фен">
    <span>Фен</span>
</label>
<label class="checkbox-btn2">
    <input type="checkbox" name="service[]"
           @php
               if (in_array("утюг", $data["service"])) {
                   echo 'checked';

               }@endphp
           value="утюг">
    <span>Утюг</span>
</label>

