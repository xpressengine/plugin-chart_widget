<style type="text/css">
    .chart-table tbody tr td {
        line-height: 2;
    }

    .colorpicker-2x .colorpicker-saturation {
        width: 200px;
        height: 200px;
    }

    .colorpicker-2x .colorpicker-hue,
    .colorpicker-2x .colorpicker-alpha {
        width: 30px;
        height: 200px;
    }

    .colorpicker-2x .colorpicker-color,
    .colorpicker-2x .colorpicker-color div {
        height: 30px;
    }
</style>

<div class="chart-setting-wrapper container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default" style="height: 850px">
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label class="">그래프 선택</label>
                            <div class="">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">Line</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">그래프 선택</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" data-type="line">Line</a></li>
                                        <li><a href="#" data-type="bar">Bar</a></li>
                                        <li><a href="#" data-type="area">Area</a></li>
                                        <li><a href="#" data-type="spline">Spline</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" data-type="pie">Pie</a></li>
                                        <li><a href="#" data-type="donut">Donut</a></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="chart_type" />
                            </div>
                        </div>
                        <hr/>

                        <div class="form-group">
                            <label class="">차트명</label>
                            <input type="text" class="form-control" id="chart_name" placeholder="차트에 삽입될 제목을 입력하세요.">
                        </div>

                        <hr />
                        <div class="form-group">
                            <label class="">차트 사이즈 <small>( 가로 넓이 100% <input type="checkbox" value="y" class="checkFullWidth" /> )</small></label>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" id="chart_width" placeholder="가로" />
                                        <span class="form-control-feedback">px</span>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" id="chart_height" placeholder="세로" />
                                        <span class="form-control-feedback">px</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="sub-wrap">
                            <!-- x, y legend position, name -->
                            <div class="form-group">
                                <label class="">X축명</label>
                                <input type="text" class="form-control" id="xAxisLabel">
                            </div>

                            <div class="form-group">
                                <label class="">Y축명</label>
                                <input type="text" class="form-control" id="yAxisLabel">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="chartPreview"></div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button type="button" class="btn btn-default btn-sm btnOpenCol">
                        <i class="xi-plus-min"></i> 범주 추가
                    </button>
                    <button type="button" class="btn btn-default btn-sm btnOpenRow">
                        <i class="xi-plus-min"></i> 범례 추가
                    </button>
                </div>
                <div class="panel-body" style="min-height: 350px;max-height: 350px;overflow-y: auto;">
                    <table class="table table-bordered table-striped chart-table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalColumn" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">범주 추가</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="">범주명 (X, 가로축)</label>
                    <input type="text" class="form-control" id="categoryName" placeholder="범주명을 입력하세요.">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary btnAddColumn">추가</button>
            </div>
        </div>

    </div>
</div>

<div id="modalRow" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">범례 추가</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="">범례명</label>
                    <input type="text" class="form-control" id="row_name" placeholder="범례명을 입력하세요.">
                </div>
                <div class="form-group">
                    <label class="">색상</label>
                    <div data-selector="colorpicker" data-format="alias" class="input-group colorpicker-component">
                        <span class="input-group-addon"><i></i></span>
                        <input type="text" id="row_color" class="form-control" name="column_color" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="">데이터 <small>( 콤마단위로 입력해주세요. ex. 10, 20, 30 )</small></label>
                    <input type="text" class="form-control" id="chart_data" placeholder="0,10,20,30">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary btnAddRow">추가</button>
            </div>
        </div>

    </div>
</div>


<script>
    var ChartSetting = (function () {
        var _this;
        var chartType = 'line';
        var columns = [];
        var rows = [];
        var colors = [];
        var legends = [];
        var title = '';

        var chartPreview;

        return {
            init: function () {
                _this = this;

                this.cache();
                this.bindEvent();

                this.setting();
                this.drawChart();

                return this;
            },
            cache: function () {
                this.$dropdownToggle = $('.dropdown-menu');
                this.$checkFullWidth = $('.checkFullWidth');
                this.$chart_name = $('#chart_name');
                this.$chart_width = $('#chart_width');
                this.$chart_height = $('#chart_height');
                this.$chartTable = $('.chart-table');
                this.$btnOpenCol = $('.btnOpenCol');
                this.$btnOpenRow = $('.btnOpenRow');
                this.$btnAddColumn = $('.btnAddColumn');
                this.$btnAddRow = $('.btnAddRow');
                this.$chartTable = $('.chart-table');
                this.$categoryName = $('#categoryName');
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

                    if(['pie', 'donut'].indexOf(chartType) !== -1) {
                        $('.sub-wrap').hide();
                    } else {
                        $('.sub-wrap').show();
                    }

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
                });

                this.$btnOpenCol.on('click', function () {
                    $('#modalColumn').modal();
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

                    _this.addColumn(colName);

                    $('#modalColumn').modal('hide');

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

                        console.log(rowIndex, rows);

                        _this.drawChart();
                    }
                });

                $(document).on('click', '.btnModifyRow', function () {
                    var $this = $(this);
                    var rowIndex = $this.parents('tbody').find('tr').index($this.closest('tr'));


                });

            },
            setting: function () {
                if(!_this.$checkFullWidth.prop('checked')) {
                    _this.$checkFullWidth.prop('checked', true).trigger('change');
                }

                /**
                 * default data setting
                 * */
            },
            drawChart: function () {
                var customOptions = {
                    axis: {
                        x: {
                            type: 'category',
                            categories: columns
                        }
                    },
                    color: {
                        pattern: colors
                    },
                    title: {
                        text: title
                    }
                };

                var data = [];

                for(var i = 0, max = legends.length; i < max; i += 1) {
                    var subData = rows[i].slice(0);
                    subData.unshift(legends[i]);

                    data.push(subData);
                }

                chartPreview = new XeChart(chartType, {
                    selector: '#chartPreview',
                    data: data,
                    customOptions: customOptions
                });

                chartPreview.draw();
            },
            addColumn: function (colName) {
                if(columns.length === 0) {
                    _this.$chartTable.find('thead tr').append('<th class="text-center">범례</th><th class="text-center">' + colName + '</th><th>&nbsp;</th>');
                } else {
                    _this.$chartTable.find('thead tr').find('th').last().before('<th class="text-center">' + colName + '</th>');
                }

                columns.push(colName);

                if(rows.length > 0) {
//                    for(var i = 0, max = rows.length; i < max; i += 1) {
//                        rows[i].push(0);
//                    }

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
                temp += '<td>' + name + '</td>';
                for(var i = 0, max = columns.length; i < max; i += 1) {
                    temp += '<td class="text-center">' + data[i] + '</td>'
                }
                temp += '<td>' +
                            '<button type="button" class="btn btn-warning btn-sm glyphicon glyphicon-trash btnDeleteRow"></button> ' +
                            '<button type="button" class="btn btn-success btn-sm glyphicon glyphicon-pencil btnModifyRow"></button>' +
                        '</td>';
                temp += '</tr>';

                this.$chartTable.find('tbody').append(temp);
            },
            getTemplateByType: function (chartType) {

                var template = '';

                switch(chartType) {
                    case 'line':
                        template = [
                            '<div class="form-group">',
                                '<label class="">데이터</label>',
                                '<input type="text" class="form-control" id="chart_data" placeholder="Y축 ">',
                            '</div>',
                        ];
                        break;

                    case 'bar':
                        break;

                    case 'area':
                        break;

                    case 'spline':
                        break;

                    case 'pie':
                        break;

                    case 'donut':
                        break;
                }
            }
        }.init();
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
</script>