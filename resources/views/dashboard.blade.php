<x-app-layout>
    <livewire:dashboard />
</x-app-layout>

<script>
    document.querySelectorAll('#card-drop-down-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            icon.classList.add('rotate-180');
            icon.nextElementSibling.classList.toggle('hidden');
        })
    })

    document.querySelectorAll('#card-drop-down-icon').forEach(dropDown => {
        dropDown.addEventListener('blur', function() {
            dropDown.nextElementSibling.classList.add('hidden');
            dropDown.classList.remove('rotate-180');
        })
    })

    document.querySelectorAll('#monthly-drop-down-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            icon.classList.add('rotate-180');
            icon.nextElementSibling.classList.toggle('hidden');
        })
    })

    document.querySelectorAll('#monthly-drop-down-icon').forEach(dropDown => {
        dropDown.addEventListener('blur', function() {
            dropDown.nextElementSibling.classList.add('hidden');
            dropDown.classList.remove('rotate-180');
        })
    })


    const donationVlevyChartData = {
        series: [{
                name: "Donations",
                data: [1432, 1567, 1389, 1478, 1523, 1445, 1298, 1534, 1476, 1390, 1512, 1467],
                color: "#C81E1E",
            },
            {
                name: "Levy",
                data: [892, 1243, 567, 934, 1532, 789, 1345, 645, 1123, 876, 1654, 432],
                color: "#000",
            }
        ],
        chart: {
            height: 300,
            maxWidth: "100%",
            type: "area",
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        tooltip: {
            enabled: true,
            x: {
                show: false,
            },
        },
        legend: {
            show: true
        },
        fill: {
            type: "gradient",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 6,
        },
        grid: {
            show: false,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: 0
            },
        },
        xaxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec',
            ],
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: true,
            },
        },
        yaxis: {
            show: false,
            labels: {
                formatter: function(value) {
                    return 'GH₵' + value;
                }
            }
        },
    }

    const donutData = () => {
        return {
            series: [1, 2],
            colors: ['#C81E1E', '#000000'],
            chart: {
                height: 300,
                width: "100%",
                type: "donut",
            },
            stroke: {
                colors: ["transparent"],
                lineCap: "",
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                offsetY: 20,
                            },
                            total: {
                                showAlways: true,
                                show: true,
                                label: "Total Amount",
                                formatter: function(w) {
                                    const sum = w.globals.seriesTotals.reduce((a, b) => {
                                        return a + b
                                    }, 0)
                                    return 'GH₵' + sum
                                },
                            },
                            value: {
                                show: true,
                                offsetY: -20,
                                formatter: function(value) {
                                    return value
                                },
                            },
                        },
                        size: "80%",
                    },
                },
            },
            grid: {
                padding: {
                    top: -2,
                },
            },
            labels: ["Male", "Female"],
            dataLabels: {
                enabled: false,
            },
            legend: {
                position: "bottom",
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    },
                },
            },
            xaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
        }
    }

    const lineChartData = {
        series: [{
                name: 'Male',
                group: 'male',
                data: [48000, 50000, 40000]
            },
            {
                name: 'Female',
                group: 'female',
                data: [20000, 40000, 25000]
            }
        ],
        chart: {
            type: 'bar',
            height: 400,
            stacked: false,
            width: "100%",
            background: 'transparent',
            toolbar: {
                show: false
            }
        },
        stroke: {
            width: 0
        },
        dataLabels: {
            enabled: true,
            formatter: (val) => {
                return `${(val / 1000).toFixed(1)}K`
            },
            style: {
                fontSize: '12px',
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                columnWidth: "60%", 
                distributed: false,
                dataLabels: {
                    position: "center"
                },
            },
        },
        xaxis: {
            categories: ['18-30', '31-45', '46+'],
            labels: {
                formatter: (val) => {
                    return `${(val / 1000).toFixed(1)}K`
                },
                style: {
                    fontSize: '12px',
                }
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            labels: {
                style: {
                    fontSize: '12px',
                }
            }
        },
        grid: {
            borderColor: '#f1f1f1',
            xaxis: {
                lines: {
                    show: true
                }
            },
            yaxis: {
                lines: {
                    show: false
                }
            }
        },
        fill: {
            opacity: 1
        },
        colors: ['#000', '#C81E1E'], 

        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '13px',
            markers:{
                shape: 'circle',
            }
        }
    }



    window.addEventListener('load', function() {
        if (document.getElementById("labels-chart") && typeof ApexCharts !== 'undefined') {

            let chart = new ApexCharts(document.getElementById("labels-chart"), donationVlevyChartData);
            chart.render();

            chart = new ApexCharts(document.getElementById("donut-chart"), donutData());
            chart.render();

            chart = new ApexCharts(document.getElementById("line-chart"), lineChartData);
            chart.render();
        }

        const getAllSpans = document.querySelectorAll("span");
        
        getAllSpans.forEach(span => {
            if(span.classList.contains('apexcharts-legend-marker')){
                span.style.borderRadius = '999px';
            }
        });

    });
</script>
