var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var config1 = {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [{
      label: 'Books Own',
      backgroundColor: window.chartColors.red,
      borderColor: window.chartColors.red,
      data: [
        5, 10, 20, 40, 50, 70,100
      ],
      fill: false,
    }, {
      label: 'Loans Activity',
      fill: false,
      backgroundColor: window.chartColors.blue,
      borderColor: window.chartColors.blue,
      data: [
        1,2,3,4,5,6,9
      ],
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
      data: [
        6,7,8,3
      ],
      backgroundColor: [
        window.chartColors.red,
        window.chartColors.orange,
        window.chartColors.yellow,
        window.chartColors.green,
        window.chartColors.blue,
      ],
      label: 'Dataset 1'
    }],
    labels: [
      'Fantasy',
      'Sci-Fi',
      'Mystery',
      'Romance',
    ]
  },
  options: {
    responsive: true
  }
};

var config3 = {
  type: 'pie',
  data: {
    datasets: [{
      data: [
        4,1,3,1
      ],
      backgroundColor: [
        window.chartColors.red,
        window.chartColors.orange,
        window.chartColors.yellow,
        window.chartColors.green,
        window.chartColors.blue,
      ],
      label: 'Dataset 1'
    }],
    labels: [
      'Fantasy',
      'Sci-Fi',
      'Mystery',
      'Romance',
    ]
  },
  options: {
    responsive: true
  }
};

window.onload = function() {
  //graph
  var ctx1 = document.getElementById('canvas').getContext('2d');
  var ctx2 = document.getElementById('chart-area').getContext('2d');
  var ctx3 = document.getElementById('chart-area2').getContext('2d');
  window.myLine = new Chart(ctx1, config1);
  window.myPie = new Chart(ctx2, config2)
  window.myPie = new Chart(ctx3, config3)

  var cnt1 = new CountUp('counter1', 0, document.getElementById("counter1").textContent);
  var cnt2 = new CountUp('counter2', 0, document.getElementById("counter2").textContent);
  var cnt3 = new CountUp('counter3', 0, document.getElementById("counter3").textContent);
  var cnt4 = new CountUp('counter4', 0, document.getElementById("counter4").textContent);
	cnt1.start();
  cnt2.start();
  cnt3.start();
  cnt4.start();
};

document.getElementsByClassName('className')

var demo, options, code, data, stars, easingFunctions,
	useOnComplete = false,
	useEasing = true,
	easingFn = null,
	useGrouping = true;

function createCountUp() {

	var startVal = document.getElementById('startVal').value;
	var endVal = document.getElementById('endVal').value;
	var decimals = document.getElementById('decimals').value,
		duration = document.getElementById('duration').value,
		prefix = document.getElementById('prefix').value,
		suffix = document.getElementById('suffix').value,
		easingFn = getEasingFn();

	options = {
		useEasing: useEasing,
		easingFn: typeof easingFn === 'undefined' ? null : easingFn,
		useGrouping: useGrouping,
		separator: document.getElementById('separator').value,
		decimal: document.getElementById('decimal').value,
		numerals: getNumerals()
	};
	if (prefix.length) options.prefix = prefix;
	if (suffix.length) options.suffix = suffix;

	demo = new CountUp('myTargetElement', startVal, endVal, decimals, duration, options);
	if (!demo.error) {
		errorSection.style.display = 'none';
		if (useOnComplete) {
			demo.start(methodToCallOnComplete);
		} else {
			demo.start();
		}
		updateCodeVisualizer();
	}
	else {
		errorSection.style.display = 'block';
		document.getElementById('error').innerHTML = demo.error;
		console.error(demo.error);
	}
}
