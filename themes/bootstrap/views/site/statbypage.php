<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h3>Статистика по источникам</h3>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'count-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
            'name'=>'orderpage',
            'type'=>'raw',
            'header'=>'Источник',
        ),  
        array(
            'name'=>'count',
            'header'=>'Количество',
        ),
    ),    
));

?>