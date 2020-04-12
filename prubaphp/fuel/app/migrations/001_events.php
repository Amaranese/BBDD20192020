<?php
namespace Fuel\Migrations;

class Example
{

    function up()
    {
        \DBUtil::create_table('posts', array(
            'id' => array('type' => 'int', 'constraint' => 5, 'auto_increment' => true),
            'titulo' => array('type' => 'varchar', 'constraint' => 100),
            'descripcion' => array('type' => 'text'),
            'fecha' => array('type' => 'varchar', 'constraint' => 100),
             'id_users' => array('type' => 'int', 'constraint' => 5, 'auto_increment' => true),
        ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('posts');
    }
}