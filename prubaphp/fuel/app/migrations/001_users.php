<?php
namespace Fuel\Migrations;

class Example
{

    function up()
    {
        \DBUtil::create_table('posts', array(
            'id' => array('type' => 'int', 'constraint' => 5, 'auto_increment' => true),
            'nombre' => array('type' => 'varchar', 'constraint' => 100),
            'email' => array('type' => 'varchar', 'constraint' => 100),
            'contraseña' => array('type' => 'varchar', 'constraint' => 100),
        ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('posts');
    }
}