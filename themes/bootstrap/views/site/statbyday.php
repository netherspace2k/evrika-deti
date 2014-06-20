<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h3>Статистика по дням</h3>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'count-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    //'pager'=>array('class'=>'CLinkPager'),
    //'template'=>'{items}{pager}',
    //'summaryText'=>false,
    'columns'=>array(
        array(
            'name'=>'orderdate',
            'type'=>'date',
            'header'=>'Дата',
        ),  
        array(
            'name'=>'count',
            'header'=>'Количество',
        ),
    ),    
));

?>