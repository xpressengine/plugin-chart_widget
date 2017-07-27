<?php

namespace Xpressengine\Plugins\ChartWidget\Skins;

use Xpressengine\Skin\GenericSkin;
use XeFrontend;
use Xpressengine\Plugins\ChartWidget\Plugin;

class WidgetSkin extends GenericSkin
{
    protected static $path = 'chart_widget/skins/widget';

    public function render()
    {
        XeFrontend::css([
            Plugin::asset('assets/css/popup.css'),
            asset('/assets/vendor/bootstrap/css/bootstrap.min.css'),
            asset('/assets/vendor/XEIcon/xeicon.min.css'),
            asset('assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'),
        ])->appendTo('head')->load();

        XeFrontend::js([
            Plugin::asset('assets/js/chartSetting.js'),
            asset('/assets/core/xe-ui-component/js/xe-chart.js'),
            asset('/assets/vendor/bootstrap/js/bootstrap.min.js'),
            asset('assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js'),
        ])->appendTo('head')->load();

        return parent::render();
    }
}