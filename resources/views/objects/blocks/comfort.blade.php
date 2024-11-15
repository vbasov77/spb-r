<h5 style="margin-top: 20px">Комфорт:</h5>
<label class="checkbox-btn2">
    <input type="checkbox" name="comfort[]"
           @php
               if (in_array("постельное бельё", $data["comfort"])) {
                   echo 'checked';

               }@endphp
           value="постельное бельё">
    <span>Постельное бельё</span>
</label>

<label class="checkbox-btn2">
    <input type="checkbox" name="comfort[]"
           @php
               if (in_array("полотенца", $data["comfort"])) {
                   echo 'checked';

               }@endphp
           value="полотенца">
    <span>Полотенца</span>
</label>

<label class="checkbox-btn2">
    <input type="checkbox" name="comfort[]"
           @php
               if (in_array("средства гигиены", $data["comfort"])) {
                   echo 'checked';

               }@endphp
           value="средства гигиены">
    <span>Средства гигиены</span>
</label>