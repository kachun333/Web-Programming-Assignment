var demo, options, code, data, stars, easingFunctions,
	useOnComplete = false,
	useEasing = true,
	easingFn = null,
	useGrouping = true;

window.onload = function() {
	var codeVisualizer = codeVisualizer,
		easingFnsDropdown = document.getElementById('easingFnsDropdown'),
		errorSection = document.getElementById('errorSection');

	cnt = new CountUp('counter', 0, 100);
	cnt.start();
};


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
