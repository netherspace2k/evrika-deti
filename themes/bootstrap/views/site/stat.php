<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h3>Статистика</h3>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'orders-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataCount,
    'columns'=>array(
        array(
            'name'=>'status_name',
            'header'=>'Раздел',
            //'type'=>'raw',
            //'value'=>'CHtml::link(CHtml::encode($data->id), $data->url)',
            //'filter'=>false,
        ),  
        array(
            'name'=>'playpen_type',
            'header'=>'Тип манежа',
            //'type'=>'raw',
            //'value'=>'CHtml::link(CHtml::encode($data->id), $data->url)',
            //'filter'=>false,
        ),
        array(
            'name'=>'count',
            'header'=>'Количество',
            //'type'=>'raw',
            //'value'=>'CHtml::link(CHtml::encode($data->id), $data->url)',
            //'filter'=>false,
        ),
    ),    
));
?>