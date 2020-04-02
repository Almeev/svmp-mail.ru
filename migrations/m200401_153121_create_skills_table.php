<?php

use yii\db\Migration;
use app\models\Skills;

/**
 * Handles the creation of table `{{%skills}}`.
 */
class m200401_153121_create_skills_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%skills}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Навык'),
        ]);
        $array_skills = ['Читать', 'Писать', 'Переводить'];
        foreach ($array_skills as $skill){
            $new_skill = new Skills();
            $new_skill->name = $skill;
            $new_skill->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%skills}}');
    }
}
