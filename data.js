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

    function destroy_chart(chart_name) {
        let chartStatus = Chart.getChart(chart_name); // <canvas> id
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }
    }

    // Sales by date bar chart
    var date_from = "";
    var date_until = "";
    $(".refresh_btn").on("click", function () {
        date_from = $("#date_from").val();
        date_until = $("#date_until").val();

        if (Date.parse(date_from) > Date.parse(date_until)) alert("Invalid range!");
        else {

            // Total sales chart
            $.ajax({
                url: "sales_by_date_data.php",
                type: "post",
                dataType: "json",
                data: {
                    "date_from": date_from,
                    "date_until": date_until
                },
                success: function (response) {
                    //console.log(response);
                    destroy_chart("bar_chart1");
                    destroy_chart("line_chart1");
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
                data: {
                    "date_from": date_from,
                    "date_until": date_until
                },
                success: function (response) {
                    //console.log(response);
                    destroy_chart("pie_chart1");
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
                data: {
                    "date_from": date_from,
                    "date_until": date_until
                },
                success: function (response) {
                    destroy_chart("pie_chart2");
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
                data: {
                    "date_from": date_from,
                    "date_until": date_until
                },
                success: function (response) {
                    destroy_chart("bar_chart2");
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
                data: {
                    "date_from": date_from,
                    "date_until": date_until
                },
                success: function (response) {
                    destroy_chart("pie_chart3");
                    $("#pie_chart3_div .wait_msg").remove();
                    display_chart(response, "pie_chart3", "pie", "Customers' rating");
                },
                error: function (response) {
                    // console.log(response);
                }
            });
        }
    });

    $.ajax({
        url: "sales_by_date_data.php",
        type: "post",
        dataType: "json",
        data: {
            "date_from": date_from,
            "date_until": date_until
        },
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

    // Students charts

    // Students gender data
    $.ajax({
        url: "student_gender_data.php",
        type: "post",
        dataType: "json",
        success: function (response) {
            $("#student_chart1_div .wait_msg").remove();
            display_chart(response, "student_chart1", "doughnut", "Students");
        },
        error: function(response) {
            console.log(response);
        }
    });

    // Students preferred study time data
    $.ajax({
        url: "student_study_time_data.php",
        type: "post",
        dataType: "json",
        success: function (response) {
            $("#student_chart2_div .wait_msg").remove();
            display_chart(response, "student_chart2", "pie", "Students");
        },
        error: function(response) {
            console.log(response);
        }
    });

    // Students' stress level
    $.ajax({
        url: "student_stress_level_data.php",
        type: "post",
        dataType: "json",
        success: function (response) {
            $("#student_chart3_div .wait_msg").remove();
            display_chart(response, "student_chart3", "pie", "Students");
        },
        error: function(response) {
            console.log(response);
        }
    });

    // Students' hobbies
    $.ajax({
        url: "student_hobbies_data.php",
        type: "post",
        dataType: "json",
        success: function (response) {
            $("#student_chart4_div .wait_msg").remove();
            display_chart(response, "student_chart4", "polarArea", "Students");
        },
        error: function(response) {
            console.log(response);
        }
    });

    // Students' daily studying time
    $.ajax({
        url: "student_studying_time_data.php",
        type: "post",
        dataType: "json",
        success: function(response) {
            $("#student_chart5_div .wait_msg").remove();
            display_chart(response, "student_chart5", "radar", "Students");
        },
        error: function(response) {
            console.log(response);
        }
    })
});
