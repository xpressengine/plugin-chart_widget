<?php
return [
    'chart' => [
//        'section' => [
//            'class' => 'setting-section',
//            'title' => '설정'
//        ],
        'fields' => [
            'chart_type' => [
                '_type' => 'select',
                'label' => '차트 타입',
                'options' => [
                    'line' => 'Line Chart',
                    'bar' => 'Bar Chart',
                    'pie' => 'Pie Chart',
                    'donut' => 'Dount Chart',
                    'area' => 'Area Chart',
                    'spline' => 'Spline Chart',
                ]
            ]
        ]
    ],
    'support' => [
        'mobile' => true,
        'desktop' => true
    ]
];
