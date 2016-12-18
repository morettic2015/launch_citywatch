<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<div id="newsletterform">
    <h1 style="margin-top: 100px">Filtro</h1>
    <small>
        Estatísticas de visualização de suas experiências
    </small>


    <div id="stats1" style="min-width: 450px; height: 400px; margin: 0 auto"></div>
    <br>
    <div id="pie" style="width: 450px; height: 400px; margin: 0 auto"></div>
    <script>
        $(function () {
            Highcharts.chart('stats1', {
                title: {
                    text: 'Dados do mês',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Citywatch log',
                    x: -20
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                        text: 'Temperature (°C)'
                    },
                    plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                },
                tooltip: {
                    valueSuffix: '°C'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                        name: 'Tokyo',
                        data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
                    }, {
                        name: 'New York',
                        data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
                    }, {
                        name: 'Berlin',
                        data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
                    }, {
                        name: 'London',
                        data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
                    }]
            });
        });
        Highcharts
        var colors = Highcharts.getOptions().colors,
                categories = ['MSIE', 'Firefox', 'Chrome', 'Safari', 'Opera'],
                data = [{
                        y: 56.33,
                        color: colors[0],
                        drilldown: {
                            name: 'MSIE versions',
                            categories: ['MSIE 6.0', 'MSIE 7.0', 'MSIE 8.0', 'MSIE 9.0', 'MSIE 10.0', 'MSIE 11.0'],
                            data: [1.06, 0.5, 17.2, 8.11, 5.33, 24.13],
                            color: colors[0]
                        }
                    }, {
                        y: 10.38,
                        color: colors[1],
                        drilldown: {
                            name: 'Firefox versions',
                            categories: ['Firefox v31', 'Firefox v32', 'Firefox v33', 'Firefox v35', 'Firefox v36', 'Firefox v37', 'Firefox v38'],
                            data: [0.33, 0.15, 0.22, 1.27, 2.76, 2.32, 2.31, 1.02],
                            color: colors[1]
                        }
                    }, {
                        y: 24.03,
                        color: colors[2],
                        drilldown: {
                            name: 'Chrome versions',
                            categories: ['Chrome v30.0', 'Chrome v31.0', 'Chrome v32.0', 'Chrome v33.0', 'Chrome v34.0',
                                'Chrome v35.0', 'Chrome v36.0', 'Chrome v37.0', 'Chrome v38.0', 'Chrome v39.0', 'Chrome v40.0', 'Chrome v41.0', 'Chrome v42.0', 'Chrome v43.0'
                            ],
                            data: [0.14, 1.24, 0.55, 0.19, 0.14, 0.85, 2.53, 0.38, 0.6, 2.96, 5, 4.32, 3.68, 1.45],
                            color: colors[2]
                        }
                    }, {
                        y: 4.77,
                        color: colors[3],
                        drilldown: {
                            name: 'Safari versions',
                            categories: ['Safari v5.0', 'Safari v5.1', 'Safari v6.1', 'Safari v6.2', 'Safari v7.0', 'Safari v7.1', 'Safari v8.0'],
                            data: [0.3, 0.42, 0.29, 0.17, 0.26, 0.77, 2.56],
                            color: colors[3]
                        }
                    }, {
                        y: 0.91,
                        color: colors[4],
                        drilldown: {
                            name: 'Opera versions',
                            categories: ['Opera v12.x', 'Opera v27', 'Opera v28', 'Opera v29'],
                            data: [0.34, 0.17, 0.24, 0.16],
                            color: colors[4]
                        }
                    }, {
                        y: 0.2,
                        color: colors[5],
                        drilldown: {
                            name: 'Proprietary or Undetectable',
                            categories: [],
                            data: [],
                            color: colors[5]
                        }
                    }],
                browserData = [],
                versionsData = [],
                i,
                j,
                dataLen = data.length,
                drillDataLen,
                brightness;


        // Build the data arrays
        for (i = 0; i < dataLen; i += 1) {

            // add browser data
            browserData.push({
                name: categories[i],
                y: data[i].y,
                color: data[i].color
            });

            // add version data
            drillDataLen = data[i].drilldown.data.length;
            for (j = 0; j < drillDataLen; j += 1) {
                brightness = 0.2 - (j / drillDataLen) / 5;
                versionsData.push({
                    name: data[i].drilldown.categories[j],
                    y: data[i].drilldown.data[j],
                    color: Highcharts.Color(data[i].color).brighten(brightness).get()
                });
            }
        }

        // Create the chart
        Highcharts.chart('pie', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Browser market share, January, 2015 to May, 2015'
            },
            subtitle: {
                text: 'Source: <a href="http://netmarketshare.com/">netmarketshare.com</a>'
            },
            yAxis: {
                title: {
                    text: 'Total percent market share'
                }
            },
            plotOptions: {
                pie: {
                    shadow: false,
                    center: ['50%', '50%']
                }
            },
            tooltip: {
                valueSuffix: '%'
            },
            series: [{
                    name: 'Browsers',
                    data: browserData,
                    size: '60%',
                    dataLabels: {
                        formatter: function () {
                            return this.y > 5 ? this.point.name : null;
                        },
                        color: '#ffffff',
                        distance: -30
                    }
                }, {
                    name: 'Versions',
                    data: versionsData,
                    size: '80%',
                    innerSize: '60%',
                    dataLabels: {
                        formatter: function () {
                            // display only if larger than 1
                            return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + '%' : null;
                        }
                    }
                }]
        });
    </script>
</div>
