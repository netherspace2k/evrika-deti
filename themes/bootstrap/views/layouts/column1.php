<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content">

<?php
$allStatuses =  Orders::model()->StatusCount();
//print_r($s);
$items = array();
$items[0] = array(
	'label'=>"Новые заказы",
	'url'=>Yii::app()->createUrl('site/index'),
);
foreach ($allStatuses as $key=>$value)
{
	$items[$key]=array(
		'label'=>CHtml::encode($value),
		'url'=>Yii::app()->createUrl('site/index',array('status'=>$key)),
		//'active'=>true
	);
}

/*
foreach ($s as $key=>$value)
{
	echo CHtml::link(
		CHtml::encode($value), 
		Yii::app()->createUrl(
			'site/index',
			array('status'=>$key)
		)
	);	
}*/ 

$this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    /*
    'items'=>array(
        array('label'=>'Home', 'url'=>'#', 'active'=>true),
        array('label'=>'Profile', 'url'=>'#'),
        array('label'=>'Messages', 'url'=>'#'),
    */
    'items'=>$items
)); 
?>

<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>