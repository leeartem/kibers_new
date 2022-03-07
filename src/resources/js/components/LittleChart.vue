<template>
  <div :id="'little_chart-graph-'+this.id" class="little_chart-graph"></div>
</template>

<script>
export default {
  data() {
    return {
      spark: [],
      color: '#00b053',
    }
  },
  props: {
      id: {
          type: String,
          default: "NULL"
      },
      changeNegative: {
          type: Number,
          default: "NULL"
      },
      sparkline: {
          type: Array,
          default: "NULL"
      },
  },
  mounted() {
    if (this.changeNegative==1) {
        this.color = '#eb0a25'
    }
    var options = {
          series: [{
          name: 'series1',
          data: this.sparkline,
        }],
          chart: {
          height: 80,
          width: 65,
          type: 'area'
        },
        stroke: {
            width: 1,
            colors: [this.color]
        },
        dataLabels: {
          enabled: false
        },
        // stroke: {
        //   curve: 'smooth'
        // },
        yaxis: {
            show: false,
        },
        xaxis: {
            labels: {
                show: false
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
        },
        grid: {
            show: false,
        },
        tooltip: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
        fill: {
            colors: [this.color],
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.1,
                opacityTo: 0.5,
                stops: [0, 95]
            }
        },
        };
    var chart = new ApexCharts(document.querySelector("#little_chart-graph-"+this.id), options);
    chart.render();
  },
}
</script>

<style>
    .apexcharts-toolbar {
        display: none !important;
    }
    .little_chart-graph {
        width: 100px;
        height: 20px;
        display: flex;
        overflow: hidden;
        min-height: 30px !important;
        align-items: center;
    }
    .little_chart-graph > div {
        margin-left: -6px;
        /* margin-top: -25px; */
    }
</style>