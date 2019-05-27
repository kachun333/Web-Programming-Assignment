window.onload = function() {
  //graph
  var ctx1 = document.getElementById('canvas').getContext('2d');
  window.myPie = new Chart(ctx1, config1);
  var ctx2 = document.getElementById('chart-area').getContext('2d');
  window.myPie = new Chart(ctx2, config2);
  var ctx3 = document.getElementById('chart-area2').getContext('2d');
  window.myPie = new Chart(ctx3, config3);

  var cnt1 = new CountUp('counter1', 0, document.getElementById("counter1").textContent);
  var cnt2 = new CountUp('counter2', 0, document.getElementById("counter2").textContent);
  var cnt3 = new CountUp('counter3', 0, document.getElementById("counter3").textContent);
  var cnt4 = new CountUp('counter4', 0, document.getElementById("counter4").textContent);
	cnt1.start();
  cnt2.start();
  cnt3.start();
  cnt4.start();

};


var config1 = {
  type: 'line',
  data: {
    labels: monthLabel,
    datasets: [{
      label: 'Books Own',
      backgroundColor: window.chartColors.red,
      borderColor: window.chartColors.red,
      data: bookData,
      fill: false,
    }, {
      label: 'Loans Activity',
      fill: false,
      backgroundColor: window.chartColors.blue,
      borderColor: window.chartColors.blue,
      data: loanData,
    }]
  },
  options: {
    responsive: true,
    /*title: {
      display: true,
      text: ''
    },*/
    tooltips: {
      mode: 'index',
      intersect: false,
    },
    hover: {
      mode: 'nearest',
      intersect: true
    },
    scales: {
      xAxes: [{
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Month'
        }
      }],
      yAxes: [{
        display: true,
        scaleLabel: {
          display: false, // axis varries according to data
          labelString: 'Value'
        }
      }]
    }
  }
};

var config2 = {
  type: 'pie',
  data: {
    datasets: [{
      data: chartData2,
      backgroundColor: [
        window.chartColors.red,
        window.chartColors.orange,
        window.chartColors.yellow,
        window.chartColors.green,
        window.chartColors.blue,
      ],
      label: 'Dataset 1'
    }],
    labels: chartLabel2
  },
  options: {
    responsive: true
  }
};

var config3 = {
  type: 'pie',
  data: {
    datasets: [{
      data: chartData3,
      backgroundColor: [
        window.chartColors.red,
        window.chartColors.orange,
        window.chartColors.yellow,
        window.chartColors.green,
        window.chartColors.blue,
      ],
      label: 'Dataset 1'
    }],
    labels: chartLabel3
  },
  options: {
    responsive: true
  }
};
