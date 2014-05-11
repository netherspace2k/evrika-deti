<?php

class m140510_192042_add_costfield extends CDbMigration
{
	public function safeUp()
	{
        $this->addColumn('orders', 'costOrder', 'FLOAT DEFAULT NULL');
        $this->addColumn('orders', 'costDelivery', 'FLOAT DEFAULT NULL');
        $this->addColumn('orders', 'costSummary', 'FLOAT DEFAULT NULL');
	}

	public function safeDown()
	{
        $this->dropColumn('orders', 'costOrder');
        $this->dropColumn('orders', 'costDelivery');
        $this->dropColumn('orders', 'costSummary');
	}

}