<?php

class m140513_212912_add_user extends CDbMigration
{
	public function up()
	{
        $this->createTable('users', array(
            'username'=>'varchar(20) NOT NULL',
            'password'=>'varchar(20) NOT NULL',
            'PRIMARY KEY(username)',
            ),
            'ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci'
        );
        $this->insert('users', array('username'=>'admin', 'password'=>'admin'));
	}

	public function down()
	{
		$this->dropTable('users');
	}

}