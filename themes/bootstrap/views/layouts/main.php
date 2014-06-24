<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php Yii::app()->bootstrap->register(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
</head>

<body>

<?php 
if (Yii::app()->user->role == "admin") {
    $itemsStat = array(
        'label'=>'Статистика', 
        'visible'=>!Yii::app()->user->isGuest,
        'items'=> array(
            array('label'=>'Общая', 'url'=>array('/site/statistic')),
            array('label'=>'По дням', 'url'=>array('/site/statbyday')),
            array('label'=>'По месяцам', 'url'=>array('/site/statbymonth')),
            array('label'=>'По источникам', 'url'=>array('/site/statbypage')),
        )
    );
} else {
    $itemsStat = array(
        'label'=>'Статистика', 
        'visible'=>!Yii::app()->user->isGuest,
        'url'=>array('/site/statistic')
    );
}

$this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Список заказов', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
                $itemsStat,
                array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

    <hr>
    <footer>
        <div class="row">
            <div class="span6">
                <p class="powered">
                    Разработано
                    <a href="http://www.yiiframework.com" target="_blank">Yii</a>
                    /
                    <a href="http://www.yiiframework.com/extension/bootstrap" target="_blank">Yii-Bootstrap</a>
                </p>
            </div>
            <div class="span6">
                <p class="copy"> © JSsoft 2014 </p>
            </div>
        </div>
    </footer>    
    
</div><!-- page -->

</body>
</html>
