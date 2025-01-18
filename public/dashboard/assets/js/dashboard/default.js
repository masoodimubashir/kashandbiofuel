const monthlyChartOption = {
  series: [
    {
      name: 'Good',
      data: [170, 250, 350, 150, 230, 120, 330, 350, 280, 300, 250, 110],
    },
    {
      name: 'Very Good',
      data: [290, 180, 120, 290, 370, 250, 230, 200, 140, 220, 220, 330],
    },
  ],
  colors: [KabulAdminConfig.primary , KabulAdminConfig.secondary],
  chart: {
    type: 'bar',
    height: 260,
    width: '100%',
    offsetY: 10,
    offsetX: 0,
    toolbar: {
      show: false,
    },
  },
  plotOptions: {
    bar: {
      horizontal: false,
      dataLabels: {
        position: 'top',
      },
    },
  },

  grid: {
    show: false,
    padding: {
      left: -8,
      right: 0,
    },
  },
  dataLabels: {
    enabled: false,
  },
  plotOptions: {
    bar: {
      horizontal: false,
      borderRadius: 8,
      columnWidth: '45%',
      barHeight: '100%',
      s̶t̶a̶r̶t̶i̶n̶g̶S̶h̶a̶p̶e̶: 'rounded',
      e̶n̶d̶i̶n̶g̶S̶h̶a̶p̶e̶: 'rounded',
    },
  },

  stroke: {
    show: true,
    width: 1,
    colors: ['#fff'],
  },
  tooltip: {
    shared: true,
    intersect: false,
    x: {
      show: true,
      format: 'dd MMM',
      formatter: undefined,
    },
    y: {
      show: false,
    },
  },
  yaxis: {
    show: false,
    min: 0,
    max: 400,
    logBase: 100,
    tickAmount: 4,
  },
  xaxis: {
    show: false,
    labels: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  legend: {
    show: false,
  },
};

const monthlyChartChartEl = new ApexCharts(document.querySelector('#monthlyChart'), monthlyChartOption);
monthlyChartChartEl.render();


var optionsoverview = {
series: [
  {
    name: "Successfully Sold",
    type: "area",
    data: [45, 30, 28, 35, 25, 30, 40],
  },
  {
    name: "Product Viewer", 
    type: "area", 
    data: [30, 42, 37, 25, 34, 38, 27],
  },
],
chart: {
  height: 340,
  type: "line",
  stacked: false,
  toolbar: {
    show: false, 
  },
  dropShadow: {
    enabled: true,
    top: 2,
    left: 0,
    blur: 4,
    color: "#000",
    opacity: 0.08,
  },
},
stroke: {
  width: [2, 2, 2],  
  curve: "straight",
},
grid: {
  show: true,
  borderColor: "var(--chart-border)", 
  strokeDashArray: 0,
  position: "back",
  xaxis: {
    lines: {
      show: false,
    },
  },
  yaxis: {
    lines: {
      show: true,
    },
  },
},
colors: [KabulAdminConfig.primary ,KabulAdminConfig.secondary],
fill: {
  type: "gradient",
  gradient: {
    shade: "light",
    type: "vertical",
    opacityFrom: 0.4,
    opacityTo: 0, 
    stops: [0, 100],
  },
}, 
labels: [
  "Sun",
  "Mon",
  "Tue",
  "Wed",
  "Thu",
  "Fri",
  "Sat",
],
markers: {
  size: 5
},
xaxis: {
  type: "category",
  tickAmount: 4,
  tickPlacement: "between",
  tooltip: {
    enabled: false,
  },
  axisTicks: {
    show: false,
  },
  labels: {
    style: {
        fontFamily: 'Outfit, sans-serif',
        fontWeight: 500,
        colors: '#8D8D8D',
    },
},
},
legend: {
  show: true,
},
yaxis: {
  tickAmount: 4,
  min: 10,
  max: 60,
  show: true,
  min: 0,
  labels: {
    formatter: function (val) {
      return "$" + val + "k" + "";
    },
    style: {
      fontFamily: 'Outfit, sans-serif',
      fontWeight: 500,
      colors: '#3D434A',
   },
  },
},
tooltip: {
  shared: false,
  intersect: false,
},
xaxis: {
  axisTicks: {
    show: false,
  },
  axisBorder: {
    show: false,
  },
},
responsive: [
  {
    breakpoint: 1451,
    options: {
      chart: {
        height: 360,
      }
    }
  },
  {
    breakpoint: 1200,
    options: {
      chart: {
        height: 300,
      }
    }
  },
]
};

var chartoverview = new ApexCharts(
document.querySelector("#orderoverview"),
optionsoverview
);
chartoverview.render();

var options = {
series: [{
    name: 'TEAM A',
    type: 'area',
    data: [20, 50, 60, 180, 90, 340, 120, 250, 190, 100, 180, 380, 190, 220, 100, 90, 140, 70, 130, 90, 100, 50, 0]
}, {
    name: 'TEAM B',
    type: 'line',
    data: [20, 70, 30, 100, 120, 220, 250, 100, 200, 300, 330, 270, 300, 200, 180, 220, 130, 300, 220, 180, 40, 70, 0]
}],
chart: {
    height: 292,
    type: 'line',
    toolbar: {
        show: false,
    },
    dropShadow: {
        enabled: true,
        top: 4,
        left: 1,
        blur: 8,
        opacity: 0.1,
        color: "#678f44"
    },

},
stroke: {
    curve: 'smooth',
    width: [3, 3],
    dashArray: [0, 4]

},
grid: {
    show: true,
    borderColor: 'rgba(106, 113, 133, 0.30)',
    strokeDashArray: 3,
},
fill: {
    type: 'solid',
    opacity: [0, 1],
},

labels: ['Jan', '', 'Feb', '', 'Mar', '', 'Apr', '', 'May', '', 'Jun', '', 'Jul', '', 'Aug', '', 'Sep', '', 'Oct', '', 'Nov', '', 'Dec'],
markers: {
    size: [3, 0],
    colors: ['#3D434A'],
    strokeWidth: [0, 0],
},
tooltip: {
    shared: true,
    intersect: false,
    y: {
        formatter: function (y) {
            if (typeof y !== "undefined") {
                return y.toFixed(0) + " points";
            }
            return y;
        }
    }
},
annotations: {
    xaxis: [{
        x: 550,
        strokeDashArray: 5,
        borderWidth: 3,
        borderColor: '#7a4bc369',
    },
    ],
    points: [{
        x: 550,
        y: 330,
        marker: {
            size: 8,
            fillColor: KabulAdminConfig.primary,
            strokeColor: "#ffffff",
            strokeWidth: 4,
            radius: 5,
        },
        label: {
            borderWidth: 1,
            offsetY: 0,
            text: '32.10k',
            style: {
                fontSize: '14px',
                fontWeight: '600',
                fontFamily: 'Outfit, sans-serif',
            }
        }
    }],
},
legend: {
    show: false,
},
colors: [KabulAdminConfig.primary, '#8D8D8D'],
xaxis: {
    labels: {
        style: {
            fontFamily: 'Outfit, sans-serif',
            fontWeight: 500,
            colors: '#8D8D8D',
        },
    },
    axisBorder: {
        show: false
    },
},
yaxis: {
    labels: {
        formatter: function (value) {
            return value + "k";
        },
        style: {
            fontFamily: 'Outfit, sans-serif',
            fontWeight: 500,
            colors: '#3D434A',
        },
    },
},
responsive: [
    {
      breakpoint: 1727,
      options: {
        chart: {
          height: 350,
        }
      }
    },
    {
      breakpoint: 1650,
      options: {
        chart: {
          height: 380,
        }
      }
    },
    {
      breakpoint: 1200,
      options: {
        chart: {
          height: 300,
        }
      }
    },
    {
      breakpoint: 1131,
      options: {
        chart: {
          height: 340,
        }
      }
    },
    {
        breakpoint: 576,
        options: {
            series: [{
                name: 'TEAM A',
                type: 'area',
                data: [0, 50, 60, 180, 90, 340, 120, 250, 190, 100, 180, 380, 190, 220, 100, 90, 140]
            }, {
                name: 'TEAM B',
                type: 'line',
                data: [0, 70, 30, 100, 120, 220, 250, 100, 200, 300, 330, 270, 300, 200, 180, 220, 130]
            }],
        }
    },
]
};
var chart = new ApexCharts(document.querySelector("#chart-dash-2-line"), options);
chart.render();