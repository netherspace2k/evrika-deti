<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php
/*$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Primary',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
));*/

//$this->widget('zii.widgets.grid.CGridView', array(
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'orders-grid',
    'type'=>'striped bordered condensed',
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
		/*array(
		    'name'=>'status',
		    'type'=>'raw',
		    'value'=>'isset($data->status) ? $data->status->status_name : ""',
		    //'filter'=>false,
		),*/

        array(
            'header'=>'Статус',
            'type'=>'raw',
            //'value' => '($data->activation == 1) ? "Активен" : CHtml::dropdownList("activationtype", "", $list, array("id"=>"acttype".$data->id, "name"=>"acttype".$data->id))',
            //'value' => '($data->activation == 1) ? "Активен" : CHtml::dropdownList("activationtype", "", CHtml::listData(ActivcationTypes::model()->findAll(array("condition"=>"id > 1", "order"=>"fulldays")), "id", "name"), array("id"=>"acttype".$data->id, "name"=>"acttype".$data->id))',
            'value' => 'CHtml::dropdownList("status", $data->status_id, CHtml::listData(Statuses::model()->findAll(), "id", "status_name"), array("empty"=>"", "id"=>"status_".$data->id, "name"=>"status_".$data->id))',
        ),
        
        /*array(
            'header'=>'Действие',
            'type'=>'html',
            //'value' => 'Yii::app()->controller->widget("bootstrap.widgets.TbButton", array("label"=>"Primary", "type"=>"primary", "size"=>"large", ))',
            'value' => 'CHtml::link("Изменить", "", array("class"=>"btn btn-small"))',
        ), */
        
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{status}',
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