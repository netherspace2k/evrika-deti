<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content">

<?php
if (($this->action->id=='index') or  ($this->action->id=='view'))
{
	//вывести уникальную ссылку для партнёра
    if (Yii::app()->user->role == "partner") {
        $username = Yii::app()->user->name; 
        echo CHtml::openTag('div', array('class'=>"alert in alert-block fade alert-warning"));
        echo CHtml::link('×', '', array('class'=>"close", 'data-dismiss'=>"alert"));
        echo "Ваша уникальная ссылка <strong>http://www.evrika-deti.ru/?pr=$username</strong>";
        echo CHtml::closeTag('div');
    }
    
    $allStatuses =  Orders::model()->StatusCount();
	$items = array();
	$isStatus = isset($_GET['status']);

	$countNew = Orders::model()->new()->count();
	$items[0] = array(
		'label'=>"Новые заказы ($countNew)" ,
		'url'=>Yii::app()->createUrl('site/index'),
	    'active'=>!$isStatus,
	);
	foreach ($allStatuses as $key=>$value) {
		$items[$key]=array(
			'label'=>CHtml::encode($value),
			'url'=>Yii::app()->createUrl('site/index',array('status'=>$key)),
			'active'=>$isStatus && ($_GET['status'] == $key),
		);
	}

	$this->widget('bootstrap.widgets.TbMenu', array(
	    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
	    'stacked'=>false, // whether this is a stacked menu
	    'items'=>$items
	)); 
}

?>

<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>