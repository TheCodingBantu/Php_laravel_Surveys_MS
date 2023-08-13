
window.addEventListener('DOMContentLoaded', event => {

    const litepickerSingleDate = document.getElementById('litepickerSingleDate');
    if (litepickerSingleDate) {
   
        
        window. picker= new Litepicker({
            element: litepickerSingleDate,
            format: 'YYYY/MM/DD',
            onSelect: function(inst) {
                $(inst.el).trigger('change');
            }

        });
       
    }

    const litepickerDateRange = document.getElementById('litepickerDateRange');
    if (litepickerDateRange) {
        new Litepicker({
            element: litepickerDateRange,
            singleMode: false,
            format: 'MMM DD, YYYY',
            onSelect: function(inst) {
                $(inst.el).trigger('change');
            }
        });
    }

    const litepickerDateRange2Months = document.getElementById('litepickerDateRange2Months');
    if (litepickerDateRange2Months) {
        new Litepicker({
            element: litepickerDateRange2Months,
            singleMode: false,
            numberOfMonths: 2,
            numberOfColumns: 2,
            format: 'MMM DD, YYYY'
        });
    }

    const litepickerRangePlugin = document.getElementById('litepickerRangePlugin');
    if (litepickerRangePlugin) {
        new Litepicker({
            element: litepickerRangePlugin,
            startDate: new Date(),
            endDate: new Date(),
            singleMode: false,
            numberOfMonths: 2,
            numberOfColumns: 2,
            format: 'YYYY/MM/DD',
            plugins: ['ranges']
        });
    }

});
