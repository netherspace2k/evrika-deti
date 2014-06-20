<?php

class m140620_062301_orders_add_timefield extends CDbMigration
{
	public function up()
	{
        $this->addColumn('orders', 'time', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP after id');
	}

	public function down()
	{
		$this->dropColumn('orders', 'time');
	}
}