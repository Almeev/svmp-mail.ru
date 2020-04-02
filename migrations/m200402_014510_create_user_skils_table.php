<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_skils}}`.
 */
class m200402_014510_create_user_skils_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_skils}}', [
            'user_id' => $this->integer(),
            'skill_id' => $this->integer(),
        ]);
        $this->createIndex(
            'idx-user_skils-user_id',
            '{{%user_skils}}',
            'user_id'
        );
        $this->addForeignKey(
            'fk-user_skils-user_id',
            '{{%user_skils}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-user_skils-skill_id',
            '{{%user_skils}}',
            'skill_id'
        );
        $this->addForeignKey(
            'fk-user_skils-skill_id',
            '{{%user_skils}}',
            'skill_id',
            '{{%skills}}',
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
            'fk-user_skils-user_id',
            '{{%user_skils}}'
        );
        $this->dropIndex(
            'idx-user_skils-user_id',
            '{{%user_skils}}'
        );
        $this->dropForeignKey(
            'fk-user_skils-skill_id',
            '{{%user_skils}}'
        );
        $this->dropIndex(
            'idx-user_skils-skill_id',
            '{{%user_skils}}'
        );
        $this->dropTable('{{%user_skils}}');
    }
}
