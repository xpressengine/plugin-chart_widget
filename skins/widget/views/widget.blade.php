
<div id="charWrapper_{{ $seq }}"></div>

<script type="text/javascript">
    $(function () {
        var chartType = '{!! array_get($setting, 'chart_type', '') !!}';
        var title = '{!! array_get($setting, 'chart_title', '') !!}';
        var xAxisLabel = '{!! array_get($setting, 'chart_xaxis_label', '') !!}';
        var yAxisLabel = '{!! array_get($setting, 'chart_yaxis_label', '') !!}';
        var data = "{!! array_get($setting, 'chart_data', '') !!}"? JSON.parse("{!! array_get($setting, 'chart_data', '') !!}".replace(/'/g, '"')) : [];
        var colors = "{!! array_get($setting, 'chart_colors', '') !!}"? JSON.parse("{!! array_get($setting, 'chart_colors', '') !!}".replace(/'/g, '"')) : [];
        var columns = "{!! array_get($setting, 'chart_columns', '') !!}"? JSON.parse("{!! array_get($setting, 'chart_columns', '') !!}".replace(/'/g, '"')) : [];
        var legends = "{!! array_get($setting, 'chart_legends', '') !!}"? JSON.parse("{!! array_get($setting, 'chart_legends', '') !!}".replace(/'/g, '"')) : [];
        var width = '{!! array_get($setting, 'chart_width', '') !!}';
        var height = '{!! array_get($setting, 'chart_height', '') !!}';
        var fullWidth = '{!! array_get($setting, 'chart_full_width', false) !!}';

        var useTooltip = "{!! array_get($setting, 'chart_use_tooltip', false) !!}";
        var xLabelRotate = "{!! array_get($setting, 'chart_xlabel_rotate', '') !!}";
        var xLabelMultiline = "{!! array_get($setting, 'chart_xlabel_multiline', '') !!}";

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

        var chartData = [];

        for(var i = 0, max = legends.length; i < max; i += 1) {
            var subData = data[i].slice(0);
            subData.unshift(legends[i]);

            chartData.push(subData);
        }

        if(useTooltip == 'true') {
            customOptions.tooltip.show = true;
        }

        if(xLabelRotate) {
            customOptions.axis.x.tick = {
                rotate: xLabelRotate
            }
        }

        if(xLabelMultiline == 'true') {
            if(customOptions.axis.x.hasOwnProperty('tick')) {
                customOptions.axis.x.tick.multiline = true;
            } else {
                customOptions.axis.x.tick = {
                    multiline: true
                };
            }
        }

        var size = {};

        if(!JSON.parse(fullWidth) && width) {
            size.width = width;
        }

        if(height) {
            size.height = height;
        }

        customOptions.size = size;

        var chart = new XeChart(chartType, {
            selector: '#charWrapper_{{ $seq }}',
            data: chartData,
            customOptions: customOptions
        });

        chart.draw();
    });
</script>