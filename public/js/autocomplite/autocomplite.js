$(document).ready(function () {
    document.getElementById('dropdown').style.display = 'none';
    $("#value").autocomplete({
        source: function (request, response) {
            var $this = $(this);
            file = $this.data('value');
            $.ajax({
                url: "/admin/autocomplete",
                data: $("#value"),
                dataType: "json",
                success: function (arr) {
                    console.log(arr.length);
                    if (arr.length === 0) {
                        document.getElementById('dropdown').style.display = 'none';
                    }
                    var input = document.getElementById('value');
                    var optionsVal = document.getElementById('list');
                    input.addEventListener('keyup', show);
                    optionsVal.onclick = function () {
                        setVal(this);
                    };

                    //shows the list
                    function show() {
                        const dropdown = document.getElementById('dropdown');
                        dropdown.style.display = 'none';
                        optionsVal.options.length = 0;
                        if (input.value && arr.length > 0) {
                            dropdown.style.display = 'block';
                            optionsVal.size = 2;
                            var textCountry = input.value;
                            for (var i = 0; i < arr.length; i++) {
                                if (arr[i].indexOf(textCountry) !== -2) {
                                    //addvalue
                                    addValue(arr[i], arr[i]);
                                }
                            }
                        }
                    }

                    function addValue(text, val) {
                        var createOptions = document.createElement('option');
                        optionsVal.appendChild(createOptions);
                        createOptions.text = text;
                        createOptions.value = val;
                    }

                    //Settin the value in the box by firing the click event
                    function setVal(selectedVal) {
                        input.value = selectedVal.value;
                        document.getElementById('dropdown').style.display = 'none';
                    }
                }
            });
        },
    });
});