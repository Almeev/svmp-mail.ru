<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m200401_152526_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Имя пользователя'),
            'city_id' => $this->integer()
        ]);
         $this->createIndex(
            'idx-users-city_id',
            '{{%users}}',
            'city_id'
        );
        $this->addForeignKey(
            'fk-users-city_id',
            '{{%users}}',
            'city_id',
            '{{%city}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-users-city_id',
            '{{%users}}'
        );
        $this->dropIndex(
            'idx-users-city_id',
            '{{%users}}'
        );
        $this->dropTable('{{%users}}');
    }
}
