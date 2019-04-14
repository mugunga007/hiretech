<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/01/08
 * Time: 6:10
 */

namespace frontend\models;
use frontend\models\Seeker;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use frontend\models\JobType;
use Yii;

class SeekerSearchForm extends Model
{

public $address;
public $jobtypeid;
public $min_age;
public $max_age;
public $gender;
public $provider_job_id;

    /**
     * @return mixed
     */
    public function getProviderJobId()
    {
        return $this->provider_job_id;
    }

    /**
     * @param mixed $provider_job_id
     */
    public function setProviderJobId($provider_job_id)
    {
        $this->provider_job_id = $provider_job_id;
    }




    /**
     * @return mixed
     */
    public function getMinAge()
    {
        return $this->min_age;
    }

    /**
     * @param mixed $min_age
     */
    public function setMinAge($min_age)
    {
        $this->min_age = $min_age;
    }

    /**
     * @return mixed
     */
    public function getMaxAge()
    {
        return $this->max_age;
    }

    /**
     * @param mixed $max_age
     */
    public function setMaxAge($max_age)
    {
        $this->max_age = $max_age;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }


//public $searchjobtype;
    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getJobtypeid()
    {
        return $this->jobtypeid;
    }

    /**
     * @param mixed $jobtypeid
     */
    public function setJobtypeid($jobtypeid)
    {
        $this->jobtypeid = $jobtypeid;
    }


    public function rules()
    {
        return [
        [['address','gender','provider_job_id'],'safe'],
            [['min_age','max_age'],'required','message'=>'Must fill age range'],
        [['jobtypeid'],'required','message'=>'You have to select a job type'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'address' => Yii::t('app', 'Address'),
            'jobtypeid' => Yii::t('app', 'Job Type'),
            'min_age' => Yii::t('app', 'From'),
            'max_age' => Yii::t('app', 'To'),
            'gender' => Yii::t('app', 'Gender'),

        ];
    }

  /*
    public function searchformresult($params){


        $query = Seeker::find();

        $model = new ActiveDataProvider([
            'query'=>$query,
            'pagination'=>[
                'pageSize'=>2
            ]
        ]);
        if($this->load($params) && $this->validate())
            return $model;

        $query ->join('join','seeker_job_type','seeker_job_type.seeker_id = seeker.seeker_id')
                    ->where(['seeker_job_type.job_type_id'=>$this->jobtypeid])
                    ->AndWhere(['like',
                        'seeker.address',
                        ['seeker.address'=>$this->address]
                    ]);






        return $model;
    }

*/

}