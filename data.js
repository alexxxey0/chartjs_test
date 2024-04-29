$(document).ready(function () {

    function display_chart(data, chart_element, chart_type, label) {
        var data_array = Object.keys(data).map((key) => [key, data[key]]); // Convert JS to object to array
        //console.log(data_array);

        const chart = document.getElementById(chart_element);
        new Chart(chart, {
            type: chart_type,
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

    // Sales by date bar chart
    $.ajax({
        url: "sales_by_date_data.php",
        type: "post",
        dataType: "json",
        success: function (response) {
            //console.log(response);
            $("#bar_chart1_div .wait_msg").remove();
            display_chart(response.total_sales, "bar_chart1", "bar", "Sales");
            $("#line_chart1_div .wait_msg").remove();
            display_chart(response.total_sales, "line_chart1", "line", "Sales");
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
            $("#pie_chart1_div .wait_msg").remove();
            display_chart(response, "pie_chart1", "pie", "Sales");
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
            $("#pie_chart2_div .wait_msg").remove();
            display_chart(response, "pie_chart2", "pie", "Payments");
        },
        error: function (response) {
            // console.log(response);
        }
    });

    // Sales by category chart
    $.ajax({
        url: "category_data.php",
        type: "post",
        dataType: "json",
        success: function (response) {
            $("#bar_chart2_div .wait_msg").remove();
            display_chart(response, "bar_chart2", "bar", "Sales by category");
        },
        error: function (response) {
            // console.log(response);
        }
    });

    // Customers' rating chart
    $.ajax({
        url: "rating_data.php",
        type: "post",
        dataType: "json",
        success: function (response) {
            $("#pie_chart3_div .wait_msg").remove();
            display_chart(response, "pie_chart3", "pie", "Customers' rating");
        },
        error: function (response) {
            // console.log(response);
        }
    });
});
