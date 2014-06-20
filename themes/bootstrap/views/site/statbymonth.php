<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h3>Статистика по месяцам</h3>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'count-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
            'name'=>'orderdate',
            //'type'=>'date',
            'header'=>'Дата',
            'value'=>'Yii::app()->dateFormatter->format("yyyy MMMM", strtotime($data["orderdate"]))'
            //'value'=>'$data["orderdate"]'
        ),  
        array(
            'name'=>'count',
            'header'=>'Количество',
        ),
    ),    
));

?>