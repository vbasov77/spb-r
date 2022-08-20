<template>

    <div>
        <datepicker></datepicker>
    </div>

</template>

<script>


    import AirDatepicker from 'air-datepicker';
    import 'air-datepicker/air-datepicker.css';

    var minDate = new Date();

    minDate.setDate(minDate.getDate() + 1);

    new AirDatepicker('#el', {
        dateFormat: "dd.M.yyyy",
        autoClose: true,
        inline: true,
        isMobile: true,
        minDate: minDate,
        multipleDatesSeparator: " - ",
        showEvent: "focus",
        toggleSelected: false,
        onRenderCell({date, cellType}) {
            var month = date.getMonth() + 1;
            var a = date.getDate() + "." + month + "." + date.getFullYear();
            const myAwesomeArray = datedis;
            if (cellType === 'day') {
                if (myAwesomeArray.some(test => test === a)) {
                    return {
                        disabled: true
                    }
                }
            }
        }

    });

    export default {
        data() {
            return {}
        },
        components: {
            datepicker
        },

    }
</script>

