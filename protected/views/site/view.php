<?php
/* @var $order current order */
	
?>

<?php 
//print_r($order);
?>
<div>
	<h3>Контакты</h3>
	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('id')); ?></b>
		: <b><?php
		echo $order->id;
		?></b>
	</p>

	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('index')); ?></b>
		: <b><?php
		echo $order->index;
		?></b>
	</p>

	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('fio')); ?></b>
		: <b><?php
		echo CHtml::encode($order->fio);
		?></b>
	</p>

	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('phone')); ?></b>
		: <b><?php
		echo CHtml::encode($order->phone);
		?></b>
	</p>

	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('email')); ?></b>
		: <b><?php
		echo CHtml::encode($order->email);
		?></b>
	</p>

	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('playpen_type')); ?></b>
		: <b><?php
		echo CHtml::encode($order->playpen_type);
		?></b>
	</p>

	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('count')); ?></b>
		: <b><?php
		echo CHtml::encode($order->count);
		?></b>
	</p>

	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('status')); ?></b>
		: <b><?php
		echo CHtml::encode($order->status->status_name);
		?></b>
	</p>

</div>

<div>
	<h3>Заказ</h3>
	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('pillow')); ?></b>
		: <b><?php
		echo CHtml::encode($order->pillow);
		?></b>
	</p>
	
	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('deliver_type')); ?></b>
		: <b><?php
		echo CHtml::encode($order->deliver_type);
		?></b>
	</p>	
	
	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('payment_type')); ?></b>
		: <b><?php
		echo CHtml::encode($order->payment_type);
		?></b>
	</p>
	
	<p>
		<?php 
		echo 'стоимость товара'; 
		echo 'стоимость доставки'; 
		echo 'общая стоимость заказа'; 
		?>
	</p>
	
</div>

<div>
<h3>Адрес доставки</h3>
	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('index')); ?></b>
		: <b><?php
		echo CHtml::encode($order->index);
		?></b>
	</p>
	
	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('city')); ?></b>
		: <b><?php
		echo CHtml::encode($order->city);
		?></b>
	</p>
	<p>
		<?php echo CHtml::encode($order->getAttributeLabel('street')); ?></b>
		: <b><?php
		echo CHtml::encode($order->street);
		?></b>
	</p>
		<p>
		<?php echo CHtml::encode($order->getAttributeLabel('house')); ?></b>
		: <b><?php
		echo CHtml::encode($order->house);
		?></b>
	</p>
		<p>
		<?php echo CHtml::encode($order->getAttributeLabel('office')); ?></b>
		: <b><?php
		echo CHtml::encode($order->office);
		?></b>
	</p>
</div>

<?php
	echo CHtml::link('Редактировать заказ', Yii::app()->createUrl('site/update', array('id'=>$order->id)));
?>
<br/><br/>
<hr/>

<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'contact-form',
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			'validateOnSubmit'=>false,
		),
)); 
?>


	<?php echo $form->errorSummary($model); ?>
	<div class="contact-body">
		<div class="row">
			<?php 
			echo $form->labelEx($model,'name');
			echo $form->textField($model,'name',
				array(
					'value' => empty($model->isNewRecord) ? 'Admin' : null, 
					'onfocus' => "if (this.value=='Admin') this.value='';", 
					'onblur' => "if (this.value==''){this.value='Admin'}"
				)
			); 
			echo $form->error($model,'name'); 
			?>
		</div>

		<div class="row">
			<?php 
			echo $form->labelEx($model,'email');
			echo $form->textField($model,'email'
				/*array(
					//'value' => $model->email,
					//'value' => empty($model->email) ? null : $model->email,
					//'onfocus' => "if (this.value=='') this.value='sa_id@mail.ru';", 
					//'onblur' => "if (this.value==''){this.value=$model->email}"
				)*/
			);
			echo $form->error($model,'email'); 
			?>
		</div>
	</div>

	<div class="row body-text">
		<?php 
			echo $form->labelEx($model,'body'); 
			$model->body ='Здраствуйте, '.$order->fio.'.<br><br>';
			$model->body.='Вы оставили заказ на нашем сайте evrika-deti.ru.<br>'; 
			$model->body.='Ваш уникальный номер заказа '.$order->id.'. Сохраняйте его в теме при переписке.<br><br>';
			$model->body.='Вы заказали:<br>';
			$model->body.='- кол-во манежей 0-3: '.(($order->playpen_type=='0-3')?$order->count:'0').'<br>';
			$model->body.='- кол-во манежей 3+: '.(($order->playpen_type=='3+')?$order->count:'0').'<br>';
			$model->body.='- подушки для авто: '.$order->pillow.'<br>';
			$model->body.='Общая сумма заказа: '.'<br>';
			$model->body.='Стоимость доставки в г. Москва: '.'<br>';
			$model->body.='Общая стоимость к оплате: '.'<br><br>';
			$model->body.='Просим Вас проверить все данные и подтвердить заказ.<br>';
			$model->body.='Индекс: '.$order->index.'<br>';
			$model->body.='Город: '.$order->city.'<br>';
			$model->body.='Улица: '.$order->street.'<br>';
			$model->body.='Улица: '.$order->house.'<br>';
			$model->body.='Квартира: '.$order->office.'<br>';
			$model->body.='<br>Отдел продаж.';

			echo $form->textArea(
				$model,
				'body',
				array('rows'=>6, 'cols'=>50, 
					'value' => $model->body, 
					'onblur' => "if (this.value==''){this.value='Новый текст'}"
				)
			); 
			echo $form->error($model,'body'); 
		?>
		</div>


	<?php 
	/*
	if(CCaptcha::checkRequirements()): ?>
	<div class="row captcha">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode',array('value' => empty($model->isNewRecord) ? 'Буквы с картинки' : null, 'onfocus' => "if (this.value=='Буквы с картинки') this.value='';", 'onblur' => "if (this.value==''){this.value='Буквы с картинки'}")); ?>
		</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; 
	*/
	?>

	<div class="row yarr">
		<?php echo CHtml::submitButton('YARR!'); ?>
	</div>

<?php $this->endWidget(); ?>