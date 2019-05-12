<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/05/12
 * Time: 20:56
 */

namespace frontend\models;


class SeekerUpdatePicture extends Seeker
{

    /**
     * This is the model class to update seeker.
     *
     * @property int $seeker_id
     * @property string $firstname
     * @property string $lastname
     * @property string $picture
     * @property string $email
     * @property string $password

     * @property string $dob
     * @property string $gender
     * @property int $phone
     * @property string $address
     * @property int $job_type_id
     * @property string $experience
     * @property int $views
     * @property string $time
     *

     *
     *
     * @property SeekerJobType[] $seekerJobTypes
     */

    public function rules()
    {
        return [
            [['picture'], 'required'],
            [['picture'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

}