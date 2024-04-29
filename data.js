$(document).ready(function () {

    function display_chart(data) {
        var data_array = Object.keys(data).map((key) => [key, data[key]]); // Convert JS to object to array
        //console.log(data_array);

        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: data_array.map(row => row[0]),
                datasets: [
                    {
                        label: "Sales",
                        data: data_array.map(row => row[1])
                    }
                ]
            }
        });
    }

    let data;
    $.ajax({
        url: "data.php",
        type: "post",
        dataType: "json",
        success: function (response) {
            //console.log(response);
            $("#wait_msg").remove();
            data = response;
            display_chart(data);
        },
        error: function (response) {
            //console.log(response);
            data = null;
        }
    });
});
