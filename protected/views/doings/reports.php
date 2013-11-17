<?php
/* @var $this DoingsController */
/* @var $reports */


$this->menu = array(
    array('label' => 'Список действий', 'url' => array('Index')),
    array('label' => 'Новое действие', 'url' => array('Create')),
    array('label' => 'Корзина', 'url' => array('Basket')),
    array('label' => 'Отчеты', 'url' => array('Reports')),
    // array('label'=>'Manage Doings', 'url'=>array('admin')),
);
?>

<h1>Отчеты</h1>

<?


$this->Widget('ext.highcharts.HighchartsWidget', array(
        'options'=>array(
            'title' => array('text' => 'Тенденция по базовым типам'),
            'xAxis' => array(
                'type' => 'datetime',
                'dateTimeLabelFormats' => array(
                    'month' => '%e. %b',
                    'year' => '%b'
                ),
            ),
            'yAxis' => array(
                'title' => array('text' => 'Активность'),
                'min' => 0,
                'showFirstLabel' => false,
            ),
            'series' => array(
                array(
                    'name' => 'Обязанности',
                    'color' => 'red',
                    'marker' => array(
                        'symbol' => 'square',
                    ),
                    'data' => $reports['1'],
                ),
                array(
                    'name' => 'Досуг',
                    'color' => 'blue',
                    'marker' => array(
                        'symbol' => 'diamond',
                    ),
                    'data' => $reports['2']
                ),
                array(
                    'name' => 'Цели',
                    'color' => 'green',
                    'marker' => array(
                        'symbol' => 'triangle',
                    ),
                    'data' => $reports['3']
                ),

            )
        )
    ));
?>
