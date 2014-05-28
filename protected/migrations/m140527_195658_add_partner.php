<?php

class m140527_195658_add_partner extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->addColumn('users', 'superuser', 'INT(1) NOT NULL DEFAULT 0');
        $this->update('users', array('superuser'=>1), 'username = :username', array(':username'=>'admin'));
        $this->execute('insert into users(username, password) select distinct orders.page, orders.page from orders where coalesce(page, "") <> ""');
	}

	public function safeDown()
	{
        $this->dropColumn('users', 'superuser');
	}
	
}