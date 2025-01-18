    //  Traffic chart start
    var admissionRatioOption = {
      series: [
          {
              name: '',
              data: [30, 29.31, 29.7, 29.7, 31.32, 31.65, 31.13, 29.8, 31.79, 31.67, 32.39, 30.63, 32.89, 31.99, 31.23, 31.57, 30.84, 31.07, 31.41, 31.17, 34, 34.50, 34.50, 32.53, 31.37, 32.43, 32.44, 30.2,
                  30.14, 30.65, 30.4, 30.65, 31.43, 31.89, 31.38, 30.64, 31.02, 30.33, 32.95, 31.89, 30.01, 30.88, 30.69, 30.58, 32.02, 32.14, 30.37, 30.51, 32.65, 32.64, 32.27, 32.1, 32.91, 30.65, 30.8, 31.92
              ],
          },
      ],
      chart: {
          type: 'area',
          height: 90,
          offsetY: -10,
          offsetX: 0,
          toolbar: {
              show: false,
          },
      },
      stroke: {
          width: 2,
          curve: 'smooth'
      },
      grid: {
          show: false,
          borderColor: 'var(--light)',
          padding: {
              top: 5,
              right: 0,
              bottom: -30,
              left: 0,
          },
      },
      fill: {
          type: "gradient",
          gradient: {
              shadeIntensity: 1,
              opacityFrom: 0.5,
              opacityTo: 0.1,
              stops: [0, 90, 100]
          }
      },
      dataLabels: {
          enabled: false,
      },
      colors: [KabulAdminConfig.primary],
      xaxis: {
          labels: {
              show: false,
          },
          tooltip: {
              enabled: false,
          },
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
      yaxis: {
          opposite: false,
          min: 29,
          max: 35,
          logBase: 100,
          tickAmount: 4,
          forceNiceScale: false,
          floating: false,
          decimalsInFloat: undefined,
          labels: {
              show: false,
              offsetX: -12,
              offsetY: -15,
              rotate: 0,
          },
      },
      legend: {
          horizontalAlign: 'left',
      },
  };

  var admissionRatio = new ApexCharts(document.querySelector('#admissionRatio'), admissionRatioOption);
  admissionRatio.render();
  // ==============================
  var admissionRatioOption = {
      series: [
          {
              name: '',
              data: [30, 32.31, 31.47, 30.69, 29.32, 31.65, 31.13, 31.77, 31.79, 31.67, 32.39, 32.63, 32.89, 31.99, 31.23, 31.57, 30.84, 31.07, 31.41, 31.17, 32.37, 32.19, 32.51, 32.53, 31.37, 30.43, 30.44, 30.2,
                  30.14, 30.65, 30.4, 30.65, 31.43, 31.89, 31.38, 30.64, 30.02, 30.33, 30.95, 31.89, 31.01, 30.88, 30.69, 30.58, 32.02, 32.14, 32.37, 32.51, 32.65, 32.64, 32.27, 32.1, 32.91, 33.65, 33.8, 33.92
              ],
          },
      ],
      chart: {
          type: 'area',
          height: 90,
          offsetY: -10,
          offsetX: 0,
          toolbar: {
              show: false,
          },
      },
      stroke: {
          width: 2,
          curve: 'smooth'
      },
      grid: {
          show: false,
          borderColor: 'var(--light)',
          padding: {
              top: 5,
              right: 0,
              bottom: -30,
              left: 0,
          },
      },
      fill: {
          type: "gradient",
          gradient: {
              shadeIntensity: 1,
              opacityFrom: 0.5,
              opacityTo: 0.1,
              stops: [0, 80, 100]
          }
      },
      dataLabels: {
          enabled: false,
      },
      colors: [KabulAdminConfig.secondary],
      xaxis: {
          labels: {
              show: false,
          },
          tooltip: {
              enabled: false,
          },
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
      yaxis: {
          opposite: false,
          min: 29,
          max: 35,
          logBase: 100,
          tickAmount: 4,
          forceNiceScale: false,
          floating: false,
          decimalsInFloat: undefined,
          labels: {
              show: false,
              offsetX: -12,
              offsetY: -15,
              rotate: 0,
          },
      },
      legend: {
          horizontalAlign: 'left',
      },
      responsive: [

      ],
  };

  var admissionRatio = new ApexCharts(document.querySelector('#order-value'), admissionRatioOption);
  admissionRatio.render();
  // ======================================
  var admissionRatioOption = {
      series: [
          {
              name: '',
              data: [30, 29.31, 29.7, 29.7, 31.32, 31.65, 31.13, 29.8, 31.79, 31.67, 32.39, 30.63, 32.89, 31.99, 31.23, 31.57, 30.84, 31.07, 31.41, 31.17, 34, 34.50, 34.50, 32.53, 31.37, 32.43, 32.44, 30.2,
                  30.14, 30.65, 30.4, 30.65, 31.43, 31.89, 31.38, 30.64, 31.02, 30.33, 32.95, 31.89, 30.01, 30.88, 30.69, 30.58, 32.02, 32.14, 30.37, 30.51, 32.65, 32.64, 32.27, 32.1, 32.91, 30.65, 30.8, 31.92
              ],
          },
      ],
      chart: {
          type: 'area',
          height: 90,
          offsetY: -10,
          offsetX: 0,
          toolbar: {
              show: false,
          },
      },
      stroke: {
          width: 2,
          curve: 'smooth'
      },
      grid: {
          show: false,
          borderColor: 'var(--light)',
          padding: {
              top: 5,
              right: 0,
              bottom: -30,
              left: 0,
          },
      },
      fill: {
          type: "gradient",
          gradient: {
              shadeIntensity: 1,
              opacityFrom: 0.5,
              opacityTo: 0.1,
              stops: [0, 90, 100]
          }
      },
      dataLabels: {
          enabled: false,
      },
      colors: ['#FFAA05'],
      xaxis: {
          labels: {
              show: false,
          },
          tooltip: {
              enabled: false,
          },
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
      yaxis: {
          opposite: false,
          min: 29,
          max: 35,
          logBase: 100,
          tickAmount: 4,
          forceNiceScale: false,
          floating: false,
          decimalsInFloat: undefined,
          labels: {
              show: false,
              offsetX: -12,
              offsetY: -15,
              rotate: 0,
          },
      },
      legend: {
          horizontalAlign: 'left',
      },
      responsive: [

      ],
  };

  var admissionRatio = new ApexCharts(document.querySelector('#daily-value'), admissionRatioOption);
  admissionRatio.render();
  // ======================================
  var admissionRatioOption = {
      series: [
          {
              name: '',
              data: [29, 30.31, 30.7, 31.69, 31.32, 31.65, 31.13, 31.77, 31.79, 31.67, 32.39, 32.63, 32.89, 31.99, 31.23, 31.57, 30.84, 31.07, 31.41, 31.17, 32.37, 32.19, 32.51, 32.53, 31.37, 30.43, 30.44, 30.2,
                  30.14, 30.65, 30.4, 30.65, 31.43, 31.89, 31.38, 30.64, 30.02, 30.33, 30.95, 31.89, 31.01, 30.88, 30.69, 30.58, 32.02, 32.14, 32.37, 32.51, 32.65, 32.64, 32.27, 32.1, 32.91, 33.65, 33.8, 33.92
              ],
          },
      ],
      chart: {
          type: 'area',
          height: 90,
          offsetY: -10,
          offsetX: 0,
          toolbar: {
              show: false,
          },
      },
      stroke: {
          width: 2,
          curve: 'smooth'
      },
      grid: {
          show: false,
          borderColor: 'var(--light)',
          padding: {
              top: 5,
              right: 0,
              bottom: -30,
              left: 0,
          },
      },
      fill: {
          type: "gradient",
          gradient: {
              shadeIntensity: 1,
              opacityFrom: 0.5,
              opacityTo: 0.1,
              stops: [0, 90, 100]
          }
      },
      dataLabels: {
          enabled: false,
      },
      colors: ['#FC4438'],
      xaxis: {
          labels: {
              show: false,
          },
          tooltip: {
              enabled: false,
          },
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
      yaxis: {
          opposite: false,
          min: 29,
          max: 35,
          logBase: 100,
          tickAmount: 4,
          forceNiceScale: false,
          floating: false,
          decimalsInFloat: undefined,
          labels: {
              show: false,
              offsetX: -12,
              offsetY: -15,
              rotate: 0,
          },
      },
      legend: {
          horizontalAlign: 'left',
      },
      responsive: [

      ],
  };

  var admissionRatio = new ApexCharts(document.querySelector('#daily-revenue'), admissionRatioOption);
  admissionRatio.render();
  var options = {
    series: [
      {
        name: "Earning",
        data: [78, 45, 60, 78, 78, 45, 25, 50 ,60, 60, 78, 40],
      },
      {
        name: "Expense",
        data: [-70, -70, -40, -30, -70, -30, -25, -45, -40, -50, -70, -50],
      },
    ],
    chart: {
      type: "bar",
      height: 323,
      stacked: true,
      toolbar: {
        show: false,
      },
    },
    colors: [KabulAdminConfig.primary, KabulAdminConfig.secondary],
    plotOptions: {
      bar: {
        columnWidth: "70%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    stroke: {
      width: 10,
      colors: ["var(--white)"],
    },
    grid: {
      show: false,
      xaxis: {
        lines: {
          show: true,
        },
      },
      yaxis: {
        lines: {
          show: false,
        },
      },
    },
    yaxis: {
        labels: {
          formatter: function (val) {
            return + val ;
          },
          style: {
            fontSize: "14px",
            colors: "$black",
            fontWeight: 500,
            fontFamily: "Lexend, sans-serif",
          },
        },
      },
    xaxis: {
    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct" , "Nov" , "Dec"],
    labels: {
        style: {
          fontSize: "13px",
          colors: "#959595",
          fontFamily: "Lexend, sans-serif",
        },
    },
      axisBorder: {
        show: true,
      },
      axisTicks: {
        show: false,
      },
    },
    responsive: [
      {
        breakpoint: 1501,
        options: {
          chart: {
            height: 298,
          },
        },
      },
      {
        breakpoint: 480,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "150%",
            },
          },
        },
      },
    ],
    tooltip: {
      custom: function ({ series, seriesIndex, dataPointIndex,}) {
        return '<div class="apex-tooltip p-2">' + '<span>' + '<span class="bg-primary">' + '</span>' + 'Revenue' + '<h3>' + '$'+ series[seriesIndex][dataPointIndex] + '<h3/>'  + '</span>' + '</div>';
      },
  },
  };
  var chart = new ApexCharts(document.querySelector("#revenue-chart"), options);
  chart.render();

  var options3 = {
    series: [
      {
        name: "Total",
        data: [10, 5, 10, 7, 40, 20, 30, 27, 40]
      },
    ],
    chart: {
      type: "area",
      toolbar: {
        show: false,
      },
    },
    colors: [KabulAdminConfig.primary],
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.4,
        opacityTo: 0.2,
        stops: [0, 100, 100]
      }
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 2,
      curve: "smooth",
    },
    grid: {
      show: false,
    },
    tooltip: {
      x: {
        show: false,
      },
      y: {
        show: false,
      },
      z: {
        show: false,
      },
      marker: {
        show: false,
      },
    },
    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      tooltip: {
        enabled: false,
      },
    },
    yaxis: {
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
  };
  var chart3 = new ApexCharts(document.querySelector("#monthlychart"), options3);
  chart3.render();
  var options = {
    series: [
      {
        name: "This Month ",
        type: "area",
        data: [215, 260, 360, 420, 320, 280, 360]
      },
      {
        name: "This Month",
        type: "area",
        data: [90, 130, 280, 350, 400, 350, 400],
      },
    ],
    chart: {
      height: 307,
      type: "area",
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: [3, 3],
      curve: "straight",
      dashArray: [0, 6],
    },
    colors: [ KabulAdminConfig.secondary , KabulAdminConfig.primary ],
    markers: {
      discrete: [{
        seriesIndex: 0,
        dataPointIndex: 0,
        fillColor: "#fff",
        strokeColor: KabulAdminConfig.secondary,
        size: 5,
        shape: "circle"
      },
      {
        seriesIndex: 0,
        dataPointIndex: 1,
        fillColor: "#fff",
        strokeColor: KabulAdminConfig.secondary,
        size: 5,
        shape: "circle"
      },
      {
        seriesIndex: 0,
        dataPointIndex: 2,
        fillColor: "#fff",
        strokeColor: KabulAdminConfig.secondary,
        size: 5,
        shape: "circle"
      },
      {
        seriesIndex: 0,
        dataPointIndex: 3,
        fillColor: "#fff",
        strokeColor: KabulAdminConfig.secondary,
        size: 5,
        shape: "circle"
      },
      {
        seriesIndex: 0,
        dataPointIndex: 4,
        fillColor: "#fff",
        strokeColor: KabulAdminConfig.secondary,
        size: 5,
        shape: "circle"
      },
      {
        seriesIndex: 0,
        dataPointIndex: 5,
        fillColor: "#fff",
        strokeColor: KabulAdminConfig.secondary,
        size: 5,
        shape: "circle"
      },
      {
        seriesIndex: 0,
        dataPointIndex: 6,
        fillColor: "#fff",
        strokeColor: KabulAdminConfig.secondary,
        size: 5,
        shape: "circle"
      },
      ],
    },
    xaxis: {
      categories: [
        "Mon",
        "Tue",
        "Wed",
        "Thu",
        "Fri",
        "Sat",
        "Sun",
      ],
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        style: {
          fontSize: "13px",
          colors: "#959595",
          fontFamily: "Lexend, sans-serif",
        },
      },
    },
    yaxis: {
      labels: {
        formatter: function (val) {
          return val + "" + "k";
        },
        style: {
          fontSize: "14px",
          colors: "$black",
          fontWeight: 500,
          fontFamily: "Lexend, sans-serif",
        },
      },
    },
    fill: {
      colors: [ KabulAdminConfig.secondary , KabulAdminConfig.primary ],
      type: ["gradient", "gradient"],
      gradient: {
        shade: "light",
        type: "vertical",
        opacityFrom: 0.5,
        opacityTo: 0.1,
        stops: [0, 100 , 0 , 0],
      },
    },
    grid: {
      borderColor: "#f1f1f1",
    },
    legend: {
      show: false,
    },
    tooltip: {
      custom: function ({ series, seriesIndex, dataPointIndex,}) {
        return '<div class="apex-tooltip p-2">' + '<span>' + '<span class="bg-primary">' + '</span>' + 'Deliveries' + '<h3>' + '$'+ series[seriesIndex][dataPointIndex] + '<h3/>'  + '</span>' + '</div>';
      },
    },
  };
  var chart = new ApexCharts(document.querySelector("#company-viewchart"), options);
  chart.render();