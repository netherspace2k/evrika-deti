<?php

class m140514_145020_add_deliveryid extends CDbMigration
{
	public function up()
	{
        $this->addColumn('orders', 'delivery_id', 'VARCHAR(30) DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('orders', 'delivery_id');
	}

}