<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\City;
use Faker\Factory;
use app\models\Skills;
use app\models\UserSkils;


/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string|null $name Имя пользователя
 * @property int|null $city_id
 *
 * @property City $city
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя пользователя',
            'city_id' => 'City ID',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
    public function getSkills() 
    {
        $skills_arrray = UserSkils::findAll(['user_id' => $this->id]);
        return  ArrayHelper::getColumn($skills_arrray, 'skill.name');
    }
    public function createUser() 
    {
        $cities = City::find()->all();
        $city_id = $cities[rand(0,count($cities)-1)]->id;
        
        $skills = Skills::find()->all();
        $count_skills = rand(0,count($skills));
        $skills_arrray = [];
        if($count_skills != 1 && $count_skills){
            $skills_arrray = array_rand($skills, $count_skills);
        }
        
        if($count_skills == 1){
            $skills_arrray[] = array_rand($skills, $count_skills);
        }
        
        $faker = Factory::create();
        $user_name = $faker->name;
        $this->name = $user_name;
        $this->city_id = $city_id;
        $this->save();
        foreach ($skills_arrray as $skill_key){
            $user_skill = new UserSkils();
            $user_skill->user_id = $this->id;
            $user_skill->skill_id = $skills[$skill_key]->id;
            $user_skill->save();
        }
        
        return true;
    }
}
