<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h3><?php echo $pageHeader; ?></h3>

<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'orders-grid',
    'type'=>'striped bordered condensed',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
		array(
		    'name'=>'id',
		    'type'=>'raw',
		    'value'=>'CHtml::link(CHtml::encode($data->id), $data->url)',
		    //'filter'=>false,
		),
		//'city',
        array(
            'name'=>'time',
            'type'=>'datetime',
            'header'=>'Дата',
        ),  
        
		'deliver_type',
		'fio',
		//'phone',
		//'email',
		'playpen_type',
		'count',
		'pillow',
		'page',
		'comment',
        array(
            'header'=>'Статус',
            'type'=>'raw',
            'visible'=>true, //Yii::app()->user->role == "admin",
            'value' => 'CHtml::dropdownList("status", $data->status_id, CHtml::listData(Statuses::model()->findAll(), "id", "status_name"), array("empty"=>"", "id"=>"status_".$data->id, "name"=>"status_".$data->id))',
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{status}',
            'visible'=>true, //Yii::app()->user->role == "admin",
            'buttons' => array(
                'status' => array(
                    'label'=>'Изменить',
                    //'visible'=>'(isset($data->activation) && $data->activation != 1)',
                    'url'=>'Yii::app()->controller->createUrl("status", array("id" => $data->id))',
                    //'imageUrl'=>'/images/switch_off.png',
                    'options'=>array(
                        'class'=>'btn btn-small change-status',
                        'value'=>'$data->id',
                    )
                ),
            ),
		),

        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}{update}{delete}',
            'buttons'=>array(
                'update'=>array(
                    'visible'=>'Yii::app()->user->role == "admin"',
                ),
                'delete'=>array(
                    'visible'=>'Yii::app()->user->role == "admin"',
                ),
            )
        ),
        
	),
	
)); 

$js = 'jQuery(".change-status").live("click", function(e) {
            act_object = $(this).parent().prev("td").children("select:first");
            statusid = act_object.attr("value");
            //act_name = act_object.children("option[value=" + statusid + "]").text();
            //isConfirmed = confirm("Активировать пользователя?\n" + act_name);
            //if (isConfirmed) 
            {
                jQuery.ajax({
                    type: "POST",
                    url: $(this).attr("href"),
                    data: "statusid=" + statusid,
                    dataType: "json",
                    success: function(data) {
                        $.fn.yiiGridView.update("orders-grid");
                    },
                    cache: false
                });
            }
            return false;
});
';
       
Yii::app()->getClientScript()->registerScript('activation', $js, CClientScript::POS_READY); 


?>