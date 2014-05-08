<?php
/* @var $this SiteController */
/* @var $dataProvider Orders */


$this->pageTitle=Yii::app()->name;
?>

<h1><?php echo $pageHeader; ?></h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
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
		    'value'=>'$data->status->status_name',
		    //'filter'=>false,
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
	/*
	'columns'=>array(
		'id',
		array(
		    'name'=>'author',
		    'type'=>'raw',
		    //'value'=>'$data->author->username',
		    'value'=>'$data->author->UserProfile',
		    //'filter'=>false,
		),
    array(
        'name'=>'title',
        'type'=>'raw',
        'value'=>'CHtml::link(CHtml::encode($data->title), $data->url)'
    ),			
    array(
        'name'=>'status',
        'value'=>'Lookup::item("PostStatus",$data->status)',
        'filter'=>Lookup::items('PostStatus'),
    ),
    array(
        'name'=>'category',
        'value'=>'$data->category->name',
        'filter'=>Category::model()->CategoryList,
    ),
		'content',
		//'tags',
    array(
		    'name'=>'create_time',
		    'type'=>'date', //variants 'datetime', 'time'
		    'filter'=>false,
		),
		array(
		    'name'=>'date_start',
		    'type'=>'date', //variants 'datetime', 'time'
		    'filter'=>true,
		),

		array(
			'class'=>'CButtonColumn',
		),
		
	),*/
)); ?>




