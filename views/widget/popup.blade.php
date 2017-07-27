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
            <div class="panel panel-default" style="height: 850px;position:relative">
                <div class="panel-body">
                    <form>
                        <div class="form-group" id="chartTypeDropdown">
                            <label class="">그래프 선택</label>
                            <div class="clearfix">
                                <div class="btn-group pull-left">
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
                                <input type="hidden" name="chart_type" id="chart_type" value="line" />

                                <button type="button" class="btn btn-success btn-sm btnLoadSample pull-right">Demo 보기</button>
                            </div>
                        </div>
                        <hr/>

                        <div class="form-group">
                            <label class="">차트 타이틀</label>
                            <input type="text" class="form-control" id="chart_name" placeholder="차트에 삽입될 제목을 입력하세요.">
                        </div>

                        <hr />
                        <div class="form-group">
                            <label class="">차트 사이즈 <small>( 가로 넓이 100% <input type="checkbox" value="y" id="checkFullWidth" class="checkFullWidth" /> )</small></label>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" id="chart_width" name="chart_width" placeholder="가로" />
                                        <span class="form-control-feedback">px</span>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" id="chart_height" name=chart_height placeholder="세로" />
                                        <span class="form-control-feedback">px</span>
                                    </div>
                                </div>
                            </div>
                            <small>현재 사이즈 <span class="chart_size">400x300</span></small>
                        </div>

                        <hr />
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" id="chart_use_tooltip" name="chart_use_tooltip" />Tooltip 사용</label>
                            </div>
                        </div>

                        <hr />
                        <div class="sub-wrap">
                            <!-- x, y legend position, name -->
                            <div class="form-group">
                                <label class="">X축 Label</label>
                                <input type="text" class="form-control" id="xAxisLabel" name="xAxisLabel" placeholder="X축명을 입력하세요.">
                            </div>

                            <div class="form-group">
                                <label class="">Y축 Label</label>
                                <input type="text" class="form-control" id="yAxisLabel" name="yAxisLabel" placeholder="Y축명을 입력하세요.">
                            </div>

                            <div class="form-group">
                                <label class="">범주명 회전값 <small>( 숫자 입력 )</small></label>
                                <div class="form-group has-feedback">
                                    <input type="number" class="form-control" id="xLabelRotate" name=xLabelRotate placeholder="숫자만 입력해 주세요.">
                                    <span class="form-control-feedback">˚</span>
                                </div>
                            </div>

                            <hr />
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" id="xLabelMultiline" name="xLabelMultiline" />범주 Multiline</label>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="panel-fixed-footer">
                    <button type="button" class="btn btn-primary btnCompleteSettings" style="width: 100%">설정 완료</button>
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
                    <div id="colorpickerRow" data-selector="colorpicker" data-format="alias" class="input-group colorpicker-component">
                        <span class="input-group-addon"><i></i></span>
                        <input type="text" id="row_color" class="form-control" name="row_color" />
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

<div id="modalModifyColumn" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">범주 수정</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="">범주명 (X, 가로축)</label>
                    <input type="text" class="form-control" id="categoryNameMod" placeholder="범주명을 입력하세요.">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary btnModColumn">수정</button>
                <input type="hidden" id="columnNum" />
            </div>
        </div>

    </div>
</div>

<div id="modalRowModify" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">범례 수정</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="">범례명</label>
                    <input type="text" class="form-control" id="row_name_mod" placeholder="범례명을 입력하세요.">
                </div>
                <div class="form-group">
                    <label class="">색상</label>
                    <div id="colorpickerRowMod" data-selector="colorpicker" data-format="alias" class="input-group colorpicker-component">
                        <span class="input-group-addon"><i></i></span>
                        <input type="text" id="row_color_mod" class="form-control" name="row_color_mod" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="">데이터 <small>( 콤마단위로 입력해주세요. ex. 10, 20, 30 )</small></label>
                    <input type="text" class="form-control" id="chart_data_mod" placeholder="0,10,20,30">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary btnModify">수정</button>
                <input type="hidden" id="rowNum" />
            </div>
        </div>

    </div>
</div>