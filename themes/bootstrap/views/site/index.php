<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->endWidget(); ?>

<p>You may change the content of this page by modifying the following two files:</p>

<ul>
    <li>View file: <code><?php echo __FILE__; ?></code></li>
    <li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
    the <a href="http://www.yiiframework.com/doc/">documentation</a>.
    Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
    should you have any questions.</p>

<?php
//$this->widget('zii.widgets.grid.CGridView', array(
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'grid',
	//'dataProvider'=>$model->search(),
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	//http://www.yiiframework.com/doc/api/1.1/CDataColumn
	//'type' see here:www.yiiframework.com/doc/api/1.1/CFormatter
	'columns'=>array(
		array(
		    'name'=>'id',
		    'type'=>'raw',
		    'value'=>'CHtml::link(CHtml::encode($data->id), $data->url)',
		    //'filter'=>false,
		),
		'city',
		'fio',
		'phone',
		'email',
		'playpen_type',
		'count',
		array(
		    'name'=>'status',
		    'type'=>'raw',
		    'value'=>'isset($data->status) ? $data->status->status_name : ""',
		    //'filter'=>false,
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
	
)); ?>