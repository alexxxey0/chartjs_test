$(document).ready(function () {

    function display_bar_chart(data, chart_element, label) {
        var data_array = Object.keys(data).map((key) => [key, data[key]]); // Convert JS to object to array
        //console.log(data_array);

        const chart = document.getElementById(chart_element);
        new Chart(chart, {
            type: "bar",
            data: {
                labels: data_array.map(row => row[0]),
                datasets: [
                    {
                        label: label,
                        data: data_array.map(row => row[1])
                    }
                ]
            }
        });
    }

    function display_pie_chart(data, chart_element, label) {
        var data_array = Object.keys(data).map((key) => [key, data[key]]);

        const chart = document.getElementById(chart_element);
        new Chart(chart, {
            type: "pie",
            data: {
                labels: data_array.map(row => row[0]),
                datasets: [
                    {
                        label: label,
                        data: data_array.map(row => row[1])
                    }
                ]
            }
        });
    }

    // Sales by date chart
    $.ajax({
        url: "sales_by_date_data.php",
        type: "post",
        dataType: "json",
        success: function (response) {
            //console.log(response);
            $("#bar_chart1_div .wait_msg").remove();
            display_bar_chart(response, "bar_chart1", "Sales");
        },
        error: function (response) {
            //console.log(response);
        }
    });

    // Sales by gender chart
    $.ajax({
        url: "sales_by_gender_data.php",
        type: "post",
        dataType: "json",
        success: function (response) {
            //console.log(response);
            display_pie_chart(response, "pie_chart1", "Sales");
        },
        error: function (response) {
            //console.log(response);
        }
    });

    // Payment type chart
    $.ajax({
        url: "payment_type_data.php",
        type: "post",
        dataType: "json",
        success: function (response) {
            display_pie_chart(response, "pie_chart2", "Payments");
        },
        error: function (response) {
            // console.log(response);
        }
    });
});
