<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h3>Статистика</h3>

<h4>Количество</h4>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'count-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataCount,
    'columns'=>array(
        array(
            'name'=>'status_name',
            'header'=>'Раздел',
        ),  
        array(
            'name'=>'count',
            'header'=>'Количество',
        ),
    ),    
));
?>

<h4>Баланс</h4>
<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'balance-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataBalance,
    'columns'=>array(
        array(
            'name'=>'status_name',
            'header'=>'Раздел',
        ),  
        array(
            'name'=>'sum',
            'header'=>'Сумма',
        ),
    ),    
));
?>