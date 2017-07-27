<div class="hidden-area">
    <input type="hidden" name="chart_type" value="{{ array_get($args, 'chart_type', '') }}" />
    <input type="hidden" name="chart_title" value="{{ array_get($args, 'chart_title', '') }}" />
    <input type="hidden" name="chart_xaxis_label" value="{{ array_get($args, 'chart_xaxis_label', '') }}" />
    <input type="hidden" name="chart_yaxis_label" value="{{ array_get($args, 'chart_yaxis_label', '') }}" />
    <input type="hidden" name="chart_data" value="{{ array_get($args, 'chart_data', '') }}" />
    <input type="hidden" name="chart_colors" value="{{ array_get($args, 'chart_colors', '') }}" />
    <input type="hidden" name="chart_columns" value="{{ array_get($args, 'chart_columns', '') }}" />
    <input type="hidden" name="chart_legends" value="{{ array_get($args, 'chart_legends', '') }}" />
    <input type="hidden" name="chart_width" value="{{ array_get($args, 'chart_width', '') }}" />
    <input type="hidden" name="chart_height" value="{{ array_get($args, 'chart_height', '') }}" />
    <input type="hidden" name="chart_full_width" value="{{ array_get($args, 'chart_full_width', '') }}" />

    <input type="hidden" name="chart_use_tooltip" value="{{ array_get($args, 'chart_use_tooltip', '') }}" />
    <input type="hidden" name="chart_xlabel_rotate" value="{{ array_get($args, 'chart_xlabel_rotate', '') }}" />
    <input type="hidden" name="chart_xlabel_multiline" value="{{ array_get($args, 'chart_xlabel_multiline', '') }}" />

    <button type="button" class="btn_popup xe-btn xe-btn-primary" style="width: 100%">차트 상세 설정</button>
</div>

<script type="text/javascript">
    $('.btn_popup').on('click', function () {
        var data = "{!! array_get($args, 'chart_data', '') !!}"? JSON.parse("{!! array_get($args, 'chart_data', '') !!}".replace(/'/g, '"')) : [];
        var colors = "{!! array_get($args, 'chart_colors', '') !!}"? JSON.parse("{!! array_get($args, 'chart_colors', '') !!}".replace(/'/g, '"')) : [];
        var columns = "{!! array_get($args, 'chart_columns', '') !!}"? JSON.parse("{!! array_get($args, 'chart_columns', '') !!}".replace(/'/g, '"')) : [];
        var legends = "{!! array_get($args, 'chart_legends', '') !!}"? JSON.parse("{!! array_get($args, 'chart_legends', '') !!}".replace(/'/g, '"')) : [];
        var popChart = window.open('{{ route('chart_widget::popup') }}', 'createPopup', "width=950,height=900,directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no");

        popChart.chartSettings = true;
        popChart.onload = function () {
            popChart.ChartSetting.init({
                chartType: "{!! array_get($args, 'chart_type', '') !!}",
                title: "{!! array_get($args, 'chart_title', '') !!}",
                xAxisLabel: "{!! array_get($args, 'chart_xaxis_label', '') !!}",
                yAxisLabel: "{!! array_get($args, 'chart_yaxis_label', '') !!}",
                data: data,
                colors: colors,
                columns: columns,
                legends: legends,
                width: "{!! array_get($args, 'chart_width', '') !!}",
                height: "{!! array_get($args, 'chart_height', '') !!}",
                fullWidth: "{!! array_get($args, 'chart_full_width', false) !!}",
                useTooltip: "{!! array_get($args, 'chart_use_tooltip', false) !!}",
                xLabelRotate: "{!! array_get($args, 'chart_xlabel_rotate', '') !!}",
                xLabelMultiline: "{!! array_get($args, 'chart_xlabel_multiline', '') !!}",
            });
        };
    });
</script>