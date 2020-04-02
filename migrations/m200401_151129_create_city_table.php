<?php

use yii\db\Migration;
use app\models\City;

/**
 * Handles the creation of table `{{%city}}`.
 */
class m200401_151129_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Название города')
        ]);
        $array_city = ['Москва', 'Санкт-Петербург', 'Астана'];
        foreach ($array_city as $city){
            $new_city = new City();
            $new_city->name = $city;
            $new_city->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%city}}');
    }
}
