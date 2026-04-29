
    Highcharts.setOptions({
        navigation: {
            buttonOptions: {
                enabled: false
            }
        },
        exporting: {
            contextButton: {
                enabled: false,
            }
        },
        exporting: false,
        credits: {
            enabled: false
        },
        title: {
            useHTML: true,
            color: "#00FF00"
        },
        legend: {
            enabled: true,
            itemStyle: {
                fontSize: '12px'
            },
        },
        tooltip: {
            formatter: function() {
                return this.series.name + '<br/>' + this.x + ': <b>' + Highcharts.numberFormat(this.y, 0) + "%</b>";
            }
        },

    })
