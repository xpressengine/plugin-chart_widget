$(function () {
	var customOptions = {
		axis: {
			x: {
				type: 'category',
				categories: ['상품1', '상품2','상품3','상품4','상품5','상품6']
			}
		}
	};

	var data = [
		['data1', 300, 350, 300, 0, 0, 0],
		['data2', 130, 100, 140, 200, 150, 50]
	];

	var chartPreview = new XeChart('bar', {
		selector: '#chartPreview',
		data: data,
		customOptions: customOptions
	});

	//chartPreview.draw();

})