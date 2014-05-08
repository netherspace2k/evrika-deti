<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content">

<div style='orders_menu'>
<?php
$s =  Orders::model()->StatusCount();
//print_r($s);
foreach ($s as $key=>$value)
{
	echo CHtml::link(
		CHtml::encode($value), 
		Yii::app()->createUrl(
			'site/index',
			array('status'=>$key)
		)
	);	
} 
?>
</div>


	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>