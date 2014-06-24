<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Ошибка',
);
?>

<!--<div class="error alert alert-error">-->
<div class="error" style="color: #b94a48; margin-top: 50px; margin-bottom: 50px;">
    <h2>Ошибка <?php echo $code; ?></h2>
    <?php echo CHtml::encode($message); ?>
</div>