<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'orders-update-form',
	'type'=>'horizontal',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>
    
	
	<!--p class="note">Fields with <span class="required">*</span> are required.</p-->

	<?php echo $form->errorSummary($model); ?>
	
    <fieldset>
	    <table>
	        <tr>
		        <td style="text-align: center; "><strong>Заказчик</strong></td>
		        <td style="text-align: center; "><strong>Содержание заказа</strong></td>
		        <td style="text-align: center; "><strong>Информация о заказе</strong></td>
	        </tr>
	        <tr>
	            <td valign="top">
	                <?php 
	                echo $form->textFieldRow($model, 'fio', array('class'=>'input-large')); 
	                echo $form->textFieldRow($model, 'phone', array('class'=>'input-large')); 
	                echo $form->textFieldRow($model, 'email', array('class'=>'input-large')); 
	                echo $form->textFieldRow($model, 'index', array('class'=>'input-large')); 
	                echo $form->textFieldRow($model, 'city', array('class'=>'input-large')); 
	                echo $form->textFieldRow($model, 'street', array('class'=>'input-large')); 
	                echo $form->textFieldRow($model, 'house', array('class'=>'input-large')); 
	                echo $form->textFieldRow($model, 'office', array('class'=>'input-large')); 
	                ?>
	            </td>
	            <td valign="top">
	                <?php
	                //echo $form->textFieldRow($model, 'comment', array('class'=>'input-medium')); 
	                //echo $form->textAreaRow($model, 'comment', array('class'=>'span8', 'rows'=>5)); 
	                echo $form->textAreaRow($model, 'comment', array('class'=>'input-medium', 'rows'=>5)); 
	                echo $form->textFieldRow($model, 'playpen_type', array('class'=>'input-medium')); 
	                echo $form->textFieldRow($model, 'count', array('class'=>'input-medium')); 
	                echo $form->textFieldRow($model, 'pillow', array('class'=>'input-medium')); 	
	                ?>
	            </td>
	            <td valign="top">
	                <?php
	                echo $form->dropDownListRow($model, 'status_id', Statuses::model()->StatusList(), array('class'=>'input-medium')); 	
	                echo $form->textFieldRow($model, 'payment_type', array('class'=>'input-medium')); 
	                echo $form->textFieldRow($model, 'deliver_type', array('class'=>'input-medium'));
                    echo $form->textFieldRow($model, 'costOrder', array('class'=>'input-medium'));
                    echo $form->textFieldRow($model, 'costDelivery', array('class'=>'input-medium'));
                    echo $form->textFieldRow($model, 'costSummary', array('class'=>'input-medium'));
                    ?>
	                
	            </td>
            </tr>
        </table> 
	</fieldset>
    
	<div class="form-actions">
        <?php 
        $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить изменения')); 
        ?>
	</div>
	
	<?php $this->endWidget(); ?>

</div><!-- form -->