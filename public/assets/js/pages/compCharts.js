var CompCharts = function() {
    return {
        init: function() {
            var chart = $("#chart-bars");
            var url_json_chart = chart.data('url-json');

            $.ajax({
                type: "GET",
                url: url_json_chart
            }).done(function(json) {
                console.log(json);
                $.plot(chart,
                    json["content"],
                    {
                        colors: ["#5ccdde", "#454e59"],
                        legend: {show: true, position: "nw", backgroundOpacity: 1},
                        bars: {show: true, lineWidth: 1},
                        grid: {
                            borderWidth: 1,
                            hoverable: true,
                            labelMargin: 10,
                            axisMargin: 1
                        },
                        yaxis: {ticks: 15, tickColor: "#f5f5f5"},
                        xaxis: {ticks: json["names"], tickColor: "#f5f5f5"}
                    }
                );
            });

            var chart2 = $("#chart-bars2");
            var url_json_chart2 = chart2.data('url-json');

            $.ajax({
                type: "GET",
                url: url_json_chart2
            }).done(function(json) {
                console.log(json);
                $.plot(chart2,
                    json["content"],
                    {
                        colors: ["#bf8989", "#70b280", "#eeefa2", "#5063ce", "#ff0000", "#e300fc", "#5ccdde", "#454e59", "#00ff21"],
                        legend: {show: true, position: "nw", backgroundOpacity: 0},
                        bars: {show: true, lineWidth: 0},
                        grid: {
                            borderWidth: 1,
                            hoverable: true,
                            labelMargin: 10,
                            axisMargin: 1
                        },
                        yaxis: {ticks: 15, tickColor: "#f5f5f5"},
                        xaxis: {ticks: json["names"], tickColor: "#f5f5f5"}
                    }
                );
            });

            var chart3 = $("#chart-bars3");
            var url_json_chart3 = chart3.data('url-json');

            $.ajax({
                type: "GET",
                url: url_json_chart3
            }).done(function(json) {
                console.log(json);
                $.plot(chart3,
                    json["content"],
                    {
                        colors: ["#bf8989", "#70b280", "#eeefa2", "#5063ce", "#ff0000", "#e300fc", "#5ccdde", "#454e59", "#00ff21"],
                        legend: {show: true, position: "nw", backgroundOpacity: 0},
                        bars: {show: true, lineWidth: 0},
                        grid: {
                            borderWidth: 1,
                            hoverable: true,
                            labelMargin: 10,
                            axisMargin: 1
                        },
                        yaxis: {ticks: 25, tickColor: "#f5f5f5"},
                        xaxis: {ticks: json["names"], tickColor: "#f5f5f5"}
                    }
                );
            });

            var chart4 = $("#chart-bars4");
            var url_json_chart4 = chart4.data('url-json');

            $.ajax({
                type: "GET",
                url: url_json_chart4
            }).done(function(json) {
                console.log(json);
                $.plot(chart4,
                    json["content"],
                    {
                        colors: ["#bf8989", "#70b280", "#eeefa2", "#5063ce", "#ff0000", "#e300fc", "#5ccdde", "#454e59", "#00ff21"],
                        legend: {show: true, position: "nw", backgroundOpacity: 0},
                        bars: {show: true, lineWidth: 0},
                        grid: {
                            borderWidth: 1,
                            hoverable: true,
                            labelMargin: 10,
                            axisMargin: 1
                        },
                        yaxis: {ticks: 15, tickColor: "#f5f5f5"},
                        xaxis: {ticks: json["names"], tickColor: "#f5f5f5"}
                    }
                );
            });
        }
    };
}();