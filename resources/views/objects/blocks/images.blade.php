
<div id="file" class="upload"></div>
<div class="files" id="files"></div>
<div class="file" id="file">
    @if (!empty($images))
        @foreach ($images as $item)
            <img class="img-thumbnail del" src="{{ asset("images/$item") }}/" alt=""
                 data-file="{{$item}}">
        @endforeach
    @endif
</div>
<div class="preview" id="preview"></div>