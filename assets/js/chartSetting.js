var ChartSetting = (function () {
	var _this;
	var chartType = 'line';
	var columns = [];
	var rows = [];
	var colors = [];
	var legends = [];
	var title = '';
	var xAxisLabel = '';
	var yAxisLabel = '';
	var xLabelRotate = '';
	var xLabelMultiline = false;
	var useTooltip = false;

	var chartPreview;

	return {
		init: function (defaultOptions) {
			_this = this;

			this.cache();
			this.bindEvent();

			this.setting(defaultOptions);
			this.drawChart();

			if(!self.chartSettings) {
				alert('팝업을 다시 실행해 주세요.');
				self.close();
			}

			return this;
		},
		cache: function () {
			this.$dropdownToggle = $('.dropdown-menu');
			this.$checkFullWidth = $('.checkFullWidth');
			this.$chart_name = $('#chart_name');
			this.$chart_type = $('#chart_type');
			this.$chart_width = $('#chart_width');
			this.$chart_height = $('#chart_height');
			this.$chartTable = $('.chart-table');
			this.$btnOpenCol = $('.btnOpenCol');
			this.$btnOpenRow = $('.btnOpenRow');
			this.$btnAddColumn = $('.btnAddColumn');
			this.$btnAddRow = $('.btnAddRow');
			this.$categoryName = $('#categoryName');
			this.$chart_use_tooltip = $('#chart_use_tooltip');
			this.$xAxisLabel = $('#xAxisLabel');
			this.$yAxisLabel = $('#yAxisLabel');
			this.$xLabelRotate = $('#xLabelRotate');
			this.$xLabelMultiline = $('#xLabelMultiline');
			this.$btnLoadSample = $('.btnLoadSample');
			this.$btnModify = $('.btnModify');
			this.$btnCompleteSettings = $('.btnCompleteSettings');

		},
		bindEvent: function () {

			this.$chart_name.on('keyup', function (e) {
				var value = e.target.value;
				title = value;

				chartPreview.setTitle(title);
			});

			this.$dropdownToggle.find('li a').on('click', function () {
				var $this = $(this);

				$this.parents(".btn-group").find("button").eq(0).text($this.text());
				$this.parents(".btn-group").next().val($this.data('type'));
				chartType = $this.data('type');

				_this.$chart_type.val(chartType);

				if(['pie', 'donut'].indexOf(chartType) !== -1) {
					$('.sub-wrap').hide();
				} else {
					$('.sub-wrap').show();
				}

				_this.initFields();
				_this.drawChart();
			});

			this.$checkFullWidth.on('change', function () {
				var $this = $(this);

				if($this.prop('checked')) {
					_this.$chart_width.prop('disabled', true).val(100);
					_this.$chart_width.parent().find('.form-control-feedback').text('%');
				} else {
					_this.$chart_width.prop('disabled', false).val('');
					_this.$chart_width.parent().find('.form-control-feedback').text('px');
				}

				_this.drawChart();
			});

			this.$btnOpenCol.on('click', function () {
				if(['pie', 'donut'].indexOf(chartType) !== -1 && columns.length > 0) {
					alert('Pie, Donut 차트는 하나의 범주만 등록 됩니다.');
				} else {
					$('#modalColumn').modal();
				}
			});

			this.$btnOpenRow.on('click', function () {
				if(columns.length === 0) {
					alert('범주를 추가해 주세요.');
				} else {
					$('#modalRow').modal();
				}
			});

			this.$btnAddColumn.on('click', function () {
				var colName = $('#categoryName').val();
				if(!colName) {
					alert('범주명을 입력해 주세요.');
					return;
				}

				$('#modalColumn').modal('hide');

				_this.addColumn(colName);
				_this.drawChart();

			});

			this.$chart_use_tooltip.on('change', function () {
				useTooltip = $(this).is(':checked');

				_this.drawChart();
			});

			this.$btnAddRow.on('click', function () {
				var name = $('#row_name').val();
				var color = $('#row_color').val();
				var data = $('#chart_data').val();

				if(!name) {
					alert('범례명을 입력해주세요.');
					return;
				} else if(!color) {
					alert('색상을 선택해 주세요.');
					return;
				} else if(!data) {
					alert('데이터를 입력해 주세요.');
					return;
				}

				_this.addRow({
					name: name,
					color: color,
					data: data
				});

				_this.drawChart();

				$('#modalRow').modal('hide');
			});

			$('#chart_data').on('keydown', function (e) {
				if(e.keyCode === 13) {
					$('.btnAddRow').trigger('click');
				}
			});

			this.$categoryName.on('keydown', function (e) {
				if(e.keyCode === 13) {
					_this.$btnAddColumn.trigger('click');
				}
			});

			$('#modalColumn').on('shown.bs.modal', function () {
				_this.$categoryName.focus();
			});

			$('#modalRow').on({
				'shown.bs.modal': function () {
					$('#row_name').focus();
				},
				'hidden.bs.modal': function () {
					$('#row_name').val('');
					$('#colorpickerRow').colorpicker('setValue', '#000000');
					$('#row_color').val('#000000');
					$('#chart_data').val('');
				}
			});

			$(document).on('click', '.btnDeleteRow', function () {
				if(confirm('삭제 하시겠습니까?')) {
					var $this = $(this);
					var rowIndex = $this.parents('tbody').find('tr').index($this.closest('tr'));

					$this.closest('tr').remove();

					rows.splice(rowIndex, 1);
					legends.splice(rowIndex, 1);
					colors.splice(rowIndex, 1);

					_this.drawChart();
				}
			});

			$(document).on('click', '.btnModifyRow', function () {
				var $this = $(this);
				var rowIndex = $this.parents('tbody').find('tr').index($this.closest('tr'));

				var color = colors[rowIndex];
				var row = rows[rowIndex];
				var legend = legends[rowIndex];

				$('#row_name_mod').val(legend);
				$('#row_color_mod').val(color);
				$('#chart_data_mod').val(row.join());

				$('#colorpickerRowMod').colorpicker('setValue', color);
				$('#rowNum').val(rowIndex);

				$('#modalRowModify').modal();
			});

			this.$xAxisLabel.on('keyup', function (e) {
				xAxisLabel = e.target.value;

				chartPreview.setLabel({
					x: xAxisLabel,
					y: yAxisLabel,
				});
			});

			this.$yAxisLabel.on('keyup', function (e) {
				yAxisLabel = e.target.value;

				chartPreview.setLabel({
					x: xAxisLabel,
					y: yAxisLabel,
				});
			});

			this.$xLabelRotate.on('keyup', function (e) {
				var value = e.target.value;
				var reg = new RegExp(/[0-9]/g);

				if(reg.test(value)) {
					xLabelRotate = value;
				} else {
					xLabelRotate = '';
				}

				_this.drawChart();
			});

			this.$xLabelMultiline.on('change', function () {
				var $this = $(this);

				xLabelMultiline = $this.is(':checked');

				_this.drawChart();
			})

			this.$btnLoadSample.on('click', function () {
				_this.loadSampleData(chartType);
				_this.drawChart();
			});

			this.$btnModify.on('click', function () {
				var rowIndex = $('#rowNum').val();
				var rowName = $('#row_name_mod').val();
				var rowColor = $('#row_color_mod').val();
				var chartData = $('#chart_data_mod').val();

				if(['pie', 'donut'].indexOf(chartType) !== -1) {
					var dataSize = chartData.split(',').length;

					if(dataSize > 1) {
						alert('Pie, Donut 차트는 범례당 한개의 데이터만 입력됩니다.');
						return;
					}
				}

				_this.modifyRow(rowIndex, {
					name: rowName,
					color: rowColor,
					data: chartData
				});

				$('#modalRowModify').modal('hide');
			});

			$('#chart_width, #chart_height').on('keyup', function (e) {
				_this.drawChart();
			});

			this.$chartTable.on('mouseenter', 'thead th', function () {
				$(this).find('> div div.sub').addClass('show');
			});

			this.$chartTable.on('mouseleave', 'thead th', function () {
				$(this).find('> div div.sub').removeClass('show');
			});

			this.$chartTable.on('click', 'thead th a.btnDelColumn', function () {
				if(confirm("삭제하시겠습니까?")) {
					var $this = $(this);
					var thIndex = $this.closest('tr').find('th').index($this.closest('th'));
					var columnIndex = thIndex - 1;

					columns.splice(columnIndex, 1);

					rows.forEach(function (row, k) {
						row.splice(columnIndex, 1);
					});

					$this.closest('th').remove();

					_this.$chartTable.find('tbody tr').each(function () {
						var $this = $(this);

						$this.find('td').eq(thIndex).remove();
					});
				}
			});

			this.$chartTable.on('click', 'thead th a.btnModifyColumn', function () {
				var $this = $(this);
				var columnIndex = $this.closest('tr').find('th').index($this.closest('th')) - 1;

				$("#columnNum").val(columnIndex);

				$("#categoryNameMod").val(columns[columnIndex]);
				$("#modalModifyColumn").modal();
			});

			$('.btnModColumn').on('click', function () {
				var $this = $(this);
				var val = $("#categoryNameMod").val();
				var columnIndex = $("#columnNum").val();

				columns.splice(columnIndex, 1, val);

				_this.$chartTable.find('thead tr th').eq(parseInt(columnIndex, 10) + 1).find('> span').text(val);
				_this.drawChart();

				$("#modalModifyColumn").modal('hide');
			});

			this.$btnCompleteSettings.on('click', function () {
				if(confirm("차트 설정을 완료하시겠습니까?")) {

					window.opener.$('input[name=chart_type]').val(chartType);
					window.opener.$('input[name=chart_data]').val(JSON.stringify(rows));
					window.opener.$('input[name=chart_columns]').val(JSON.stringify(columns));
					window.opener.$('input[name=chart_legends]').val(JSON.stringify(legends));
					window.opener.$('input[name=chart_colors]').val(JSON.stringify(colors));
					window.opener.$('input[name=chart_title]').val(title);
					window.opener.$('input[name=chart_xaxis_label]').val(xAxisLabel);
					window.opener.$('input[name=chart_yaxis_label]').val(yAxisLabel);
					window.opener.$('input[name=chart_width]').val(_this.$chart_width.val());
					window.opener.$('input[name=chart_height]').val(_this.$chart_height.val());
					window.opener.$('input[name=chart_full_width]').val(_this.$checkFullWidth.is(':checked'));
					window.opener.$('input[name=chart_use_tooltip]').val(useTooltip);
					window.opener.$('input[name=chart_xlabel_rotate]').val(xLabelRotate);
					window.opener.$('input[name=chart_xlabel_multiline]').val(xLabelMultiline);

					self.close();
				}
			});
		},
		setting: function (defaultOptions) {
			if(!_this.$checkFullWidth.prop('checked')) {
				_this.$checkFullWidth.prop('checked', true).trigger('change');
			}

			_this.setFields(defaultOptions);
		},
		drawChart: function () {
			var customOptions = {
				axis: {
					x: {
						type: 'category',
						categories: columns,
						label: {
							text: xAxisLabel
						}
					},
					y: {
						label: {
							text: yAxisLabel
						}
					}
				},
				color: {
					pattern: colors
				},
				title: {
					text: title
				},
				tooltip: {
					show: false
				}
			};

			var data = [];

			for(var i = 0, max = legends.length; i < max; i += 1) {
				var subData = rows[i].slice(0);
				subData.unshift(legends[i]);

				data.push(subData);
			}

			if(JSON.parse(useTooltip)) {
				customOptions.tooltip.show = true;
			}

			if(xLabelRotate) {
				customOptions.axis.x.tick = {
					rotate: xLabelRotate
				}
			}

			if(customOptions.axis.x.hasOwnProperty('tick')) {
				customOptions.axis.x.tick.multiline = JSON.parse(xLabelMultiline);
			} else {
				customOptions.axis.x.tick = {
					multiline: JSON.parse(xLabelMultiline)
				};
			}

			chartPreview = new XeChart(chartType, {
				selector: '#chartPreview',
				data: data,
				customOptions: customOptions
			});

			chartPreview.draw();
			chartPreview.resize({
				width: $('#chart_width').val(),
				height: $('#chart_height').val() || 0
			}, $('#checkFullWidth').is(':checked'));

			$('.chart_size').text($('#chartPreview svg').width() + 'x' + $('#chartPreview svg').height());
		},
		addColumn: function (colName) {
			if(columns.length === 0) {
				_this.$chartTable.find('thead tr').append('<th class="text-center">범례</th><th class="text-center"><span>' + colName + '</span><div><div class="sub"><a href="#" class="btnModifyColumn"><span class="glyphicon glyphicon-edit"></span></a> <a href="#" class="btnDelColumn"><span class="glyphicon glyphicon-remove"></span></a></div></div></th><th>&nbsp;</th>');
			} else {
				_this.$chartTable.find('thead tr').find('th').last().before('<th class="text-center"><span>' + colName + '</span><div><div class="sub"><a href="#" class="btnModifyColumn"><span class="glyphicon glyphicon-edit"></span></a> <a href="#" class="btnDelColumn"><span class="glyphicon glyphicon-remove"></span></a></div></div></th>');
			}

			columns.push(colName);

			if(rows.length > 0) {
				_this.$chartTable.find('tbody tr').find('td:last()').before('<td class="text-center"></td>')
			}
		},
		/**
		 * @param {object} rows
		 * <pre>
		 *     name, color, data
		 * </pre>
		 * */
		addRow: function (row) {
			var name = row.name;
			var color = row.color;
			var data = row.data.replace(/ /g, '').split(',').splice(0, columns.length);

			rows.push(data);
			colors.push(color);
			legends.push(name);

			var temp = '<tr>';
			temp += '<td class="text-center" style="background:' + color + ';color:#ffffff">' + name + '</td>';
			for(var i = 0, max = columns.length; i < max; i += 1) {
				temp += '<td class="text-center">' + data[i] + '</td>';
			}
			temp += '<td>' +
				'<button type="button" class="btn btn-warning btn-sm glyphicon glyphicon-trash btnDeleteRow"></button> ' +
				'<button type="button" class="btn btn-success btn-sm glyphicon glyphicon-pencil btnModifyRow"></button>' +
				'</td>';
			temp += '</tr>';

			this.$chartTable.find('tbody').append(temp);
		},
		/**
		 * @param {number} rowIndex
		 * @param {object} row
		 * <pre>
		 *     - name
		 *     - color
		 *     - data
		 * </pre>
		 * */
		modifyRow: function (rowIndex, row) {
			var $tds = _this.$chartTable.find('tbody tr').eq(rowIndex).find('td');
			var data = row.data.replace(/ /g, '').split(',').splice(0, columns.length)

			rows.splice(rowIndex, 1, data);
			colors.splice(rowIndex, 1, row.color);
			legends.splice(rowIndex, 1, row.name);

			$tds.eq(0).css({background: row.color}).text(row.name);

			for(var i = 0, max = columns.length; i < max; i += 1) {
				$tds.eq(1 + i).text(data[i]);
			}

			_this.drawChart();
		},
		loadSampleData: function (chartType) {
			_this.initFields();

			switch(chartType) {
				case 'pie':
				case 'donut':
					_this.setFields({
						title: 'Sample Title',
						xAxisLabel: 'xAxisLabel',
						yAxisLabel: 'yAxisLabel',
						columns: ['col1'],
						data: [
							[300], [130], [80], [220], [50]
						],
						legends: ['data1', 'data2', 'data3', 'data4', 'data5'],
						colors: ['#1f77b4', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c'],
						useTooltip: true,
						fullWidth: true
					});

					break;
				case 'line':
				case 'area':
				case 'spline':
				case 'bar':
					_this.setFields({
						title: 'Sample Title',
						xAxisLabel: 'xAxisLabel',
						yAxisLabel: 'yAxisLabel',
						columns: ['col1', 'col2', 'col3', 'col4', 'col5', 'col6'],
						data: [
							[300, 350, 300, 100, 150, 400],
							[130, 100, 140, 200, 150, 50]
						],
						legends: ['data1', 'data2'],
						colors: ['#039be5', '#ef6c00'],
						useTooltip: true,
						xLabelRotate: 15,
						xLabelMultiline: true,
						fullWidth: true
					});

					break;
			}
		},
		setFields: function (params) {
			if(params.chartType) {
				var chartTypeName = _this.$dropdownToggle.find('li a[data-type=' + params.chartType + ']').text();
				_this.$dropdownToggle.parent().find('button').eq(0).text(chartTypeName);
				_this.$chart_type = params.chartType;

				chartType = params.chartType;
			}

			if(params.title) {
				title = params.title;
				_this.$chart_name.val(params.title);
			}

			if(params.hasOwnProperty('fullWidth') && ( !params.fullWidth || !JSON.parse(params.fullWidth) )) {
				_this.$checkFullWidth.prop('checked', false);
				_this.$checkFullWidth.trigger('change');
			} else {
				_this.$checkFullWidth.prop('checked', true);
				_this.$checkFullWidth.trigger('change');
			}

			if(params.width) {
				_this.$chart_width.val(params.width);
			}

			if(params.height) {
				_this.$chart_height.val(params.height);
			}

			if(params.columns && params.columns.length > 0) {
				for(var i = 0, max = params.columns.length; i < max; i += 1) {
					_this.addColumn(params.columns[i]);
				}
			}

			if(params.legends && params.colors && params.data) {
				for(var i = 0, max = params.legends.length; i < max; i += 1) {
					_this.addRow({
						name: params.legends[i],
						color: params.colors[i],
						data: params.data[i].join()
					});
				}
			}

			if(['pie', 'donut'].indexOf(params.chartType) == -1) {
				if(params.xAxisLabel) {
					xAxisLabel = params.xAxisLabel;
					_this.$xAxisLabel.val(params.xAxisLabel);
				}

				if(params.yAxisLabel) {
					yAxisLabel = params.yAxisLabel;
					_this.$yAxisLabel.val(params.yAxisLabel);
				}

				if(params.useTooltip && JSON.parse(params.useTooltip)) {
					useTooltip = true;
					_this.$chart_use_tooltip.prop('checked', true);
				}

				if(params.xLabelRotate) {
					xLabelRotate = params.xLabelRotate;
					_this.$xLabelRotate.val(xLabelRotate);
				}

				if(params.xLabelMultiline && JSON.parse(params.xLabelMultiline)) {
					xLabelMultiline = true;
					_this.$xLabelMultiline. prop('checked', true);
				}

			} else {
				$('.sub-wrap').hide();

			}

		},
		initFields: function () {
			title = '';
			_this.$chart_name.val('');

			xAxisLabel = '';
			_this.$xAxisLabel.val('');

			yAxisLabel = '';
			_this.$yAxisLabel.val('');

			_this.$chartTable.find('thead tr').empty();
			_this.$chartTable.find('tbody').empty();

			useTooltip = false;
			_this.$chart_use_tooltip.prop('checked', false);

			xLabelRotate = '';
			_this.$xLabelRotate.val('');

			xLabelMultiline = false;
			_this.$xLabelMultiline.prop('checked', false);

			columns = [];
			rows = [];
			legends = [];
			colors = [];
		}
	};
})();

$(function () {
	$('[data-selector=colorpicker]').colorpicker({
		color: '#000000',
		customClass: 'colorpicker-2x',
		align: 'left',
		colorSelectors: {
			'#000000': '#000000',     //black
			'#ffffff': '#ffffff',     //white
			'#FF0000': '#FF0000',       //red
			'#777777': '#777777',   //default
			'#337ab7': '#337ab7',   //primary
			'#5cb85c': '#5cb85c',   //success
			'#5bc0de': '#5bc0de',      //info
			'#f0ad4e': '#f0ad4e',   //warning
			'#d9534f': '#d9534f'     //danger
		},
		sliders: {
			saturation: {
				maxLeft: 200,
				maxTop: 200
			},
			hue: {
				maxTop: 200
			},
			alpha: {
				maxTop: 200
			}
		}
	});
});