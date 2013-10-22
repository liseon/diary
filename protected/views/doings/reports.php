<?php
/* @var $this DoingsController */
/* @var $reports */

$this->breadcrumbs = array(
    'Действия',
);

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
print_r($reports);
$this->Widget(
    'ext.highcharts.HighchartsWidget',
    array(
        'options' => array(
            'title' => array('text' => 'Тенденция по базовым типам'),
            'xAxis' => array(
                'type' =>'datetime',
                'dateTimeLabelFormats' => [ // don't display the dummy year
                    'month' => '%e. %b',
                    'year' => '%b'
                ],
            ),
            'yAxis' => array(
                'title' => array('text' => 'Активность', 'min'=>0),
                'labels' => [
                            'align' => 'left',
                            'x' => 3,
                            'y' => 16,
                            'formatter' => 'function() {
                                                return Highcharts.numberFormat(this.value, 0);
                                            }',
                ],
                'showFirstLabel' => false,
            ),
            'series' => array(
                array('name' => 'Обязанности', 'data' => $reports['1']),
                array('name' => 'Досуг', 'data' => $reports['2']),
                array('name' => 'Цели', 'data' => $reports['3']),
            )
        )
    )
);
?>
