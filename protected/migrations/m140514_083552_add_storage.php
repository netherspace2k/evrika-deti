<?php

class m140514_083552_add_storage extends CDbMigration
{
	public function up()
	{
        $this->createTable('products', array(
            'playpen_type'=>'VARCHAR(255) NOT NULL',
            'count'=>'INT(11) NOT NULL DEFAULT 0',
            'PRIMARY KEY (playpen_type)'
            ),
            'ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci'
        );
        $this->insert('products', array('playpen_type'=>'0-3'));
        $this->insert('products', array('playpen_type'=>'3+'));
	}

	public function down()
	{
		$this->dropTable('products');
	}

}