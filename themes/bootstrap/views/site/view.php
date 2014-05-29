<?php
    /* @var $order current order */
?>

<div class="well">
    <div class=container>
        <div class=column1>
            <h5>Заказчик</h5>

            <div class="textarea1">
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('id')); ?>
                    : <b>
                        <?php echo $order->id;?>
                    </b>
                </p>
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('fio')); ?>
                    : <b>
                        <?php echo CHtml::encode($order->fio);?>
                    </b>
                </p>
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('phone')); ?>
                    : <b>
                        <?php echo CHtml::encode($order->phone);?>
                    </b>
                </p>
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('email')); ?>
                    : <b><?php
                        echo CHtml::encode($order->email);
                    ?></b>
                </p>
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('index')); ?>
                    : <b><?php                                                      
                        echo CHtml::encode($order->index);
                    ?></b>
                </p>
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('city')); ?>
                    : <b><?php
                        echo CHtml::encode($order->city);
                    ?></b>
                </p>
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('street')); ?>
                    : <b><?php echo CHtml::encode($order->street); ?></b>
                </p>
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('house')); ?>
                    : <b><?php echo CHtml::encode($order->house); ?></b>
                </p>
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('office')); ?>
                    : <b><?php echo CHtml::encode($order->office);?></b>
                </p>    
            </div></div>

        <div class="column1">
            <h5>Содержание заказа</h5>
            <div class="textarea1">
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('comment')); ?>
                    : <b><?php
                        echo CHtml::encode($order->comment);
                    ?></b>
                </p>
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('playpen_type')); ?>
                    : <b><?php
                        echo CHtml::encode($order->playpen_type);
                    ?></b>
                </p>
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('count')); ?>
                    : <b><?php
                        echo CHtml::encode($order->count);
                    ?></b>
                </p>
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('pillow')); ?>
                    : <b><?php
                        echo CHtml::encode($order->pillow);
                    ?></b>
                </p>

            </div></div>

        <div class="column1">
            <h5>Информация о заказе</h5>
            <div class="textarea1">
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('status')); ?>
                    : <b><?php
                        echo CHtml::encode(isset($order->status) ? $order->status->status_name : '');
                    ?></b>
                </p>
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('page')); ?>
                    : <b><?php
                        echo CHtml::encode($order->page);
                    ?></b>
                </p>    
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('delivery_id')); ?>
                    : <b><?php
                        echo CHtml::encode($order->delivery_id);
                    ?></b>
                </p>    
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('deliver_type')); ?>
                    : <b><?php
                        echo CHtml::encode($order->deliver_type);
                    ?></b>
                </p>	
                <p>
                    <?php echo CHtml::encode($order->getAttributeLabel('payment_type')); ?>
                    : <b><?php
                        echo CHtml::encode($order->payment_type);
                    ?></b>
                </p>
                <p>
                    Стоимость товара: <?php echo '<b>' . $order->costOrder . '</b>'; ?>
                </p>
                <p>
                    Стоимость доставки: <?php echo '<b>' . $order->costDelivery . '</b>'; ?>
                </p>
                <p>
                    Общая стоимость: <?php echo '<b>' . $order->costSummary . '</b>'; ?>
                </p>
            </div></div>

    </div></div>

<?php
    if (Yii::app()->user->role == "admin") {
        $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Изменить заказ',
            'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'', // null, 'large', 'small' or 'mini'
            'url'=>Yii::app()->createUrl('site/update', array('id'=>$order->id)),
        ));
    }
?>
<hr/>

<?php 
    //выводить форму отправки емейла только для админа
    if (Yii::app()->user->role == "admin")
    {
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'contact-form',
            'enableClientValidation'=>false,
            'clientOptions'=>array(
                'validateOnSubmit'=>false,
            ),
            'htmlOptions'=>array('class'=>'well'),
        )); 
        echo $form->errorSummary($model);

        echo $form->textFieldRow($model, 'email', array('class'=>'span10'));
        //$CR = "\n\r";
        $CR = "\n";
        $model->body ='Здраствуйте, '.$order->fio.'.' . $CR;
        $model->body.='Вы оставили заказ на нашем сайте evrika-deti.ru.' . $CR . $CR; 
        $model->body.='Ваш уникальный номер заказа '.$order->id.'. Сохраняйте его в теме при переписке.' . $CR . $CR;
        $model->body.='Вы заказали:' . $CR;
        $model->body.='- кол-во манежей 0-3: '.(($order->playpen_type=='0-3')?$order->count:'0') . $CR;
        $model->body.='- кол-во манежей 3+: '.(($order->playpen_type=='3+')?$order->count:'0') . $CR;
        $model->body.='- подушки для авто: '.$order->pillow . $CR;
        $model->body.='Общая сумма заказа: ' . $order->costOrder . $CR;
        $model->body.='Стоимость доставки в г. Москва: ' . $order->costDelivery . $CR;
        $model->body.='Общая стоимость к оплате: ' . $order->costSummary . $CR . $CR;
        $model->body.='Просим Вас проверить все данные и подтвердить заказ.' . $CR;
        $model->body.='Индекс: '.$order->index . $CR;
        $model->body.='Город: '.$order->city . $CR;
        $model->body.='Улица: '.$order->street . $CR;
        $model->body.='Улица: '.$order->house . $CR;
        $model->body.='Квартира: '.$order->office . $CR . $CR;
        $model->body.='Отдел продаж.';

        echo $form->textAreaRow($model, 'body', array('class'=>'span10', 'rows'=>20)); 

        $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Отправить письмо'));

        $this->endWidget(); 
    }
?>