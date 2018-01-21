<?php

namespace App\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class User extends Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(column="username", type="string", length=64, nullable=false)
     */
    public $username;

    /**
     *
     * @var string
     * @Column(column="password", type="string", length=64, nullable=false)
     */
    public $password;

    /**
     *
     * @var integer
     * @Column(column="type", type="integer", length=3, nullable=false)
     */
    public $type;

    /**
     *
     * @var string
     * @Column(column="nickname", type="string", length=32, nullable=false)
     */
    public $nickname;

    /**
     *
     * @var string
     * @Column(column="avatar", type="string", length=1000, nullable=false)
     */
    public $avatar;

    /**
     *
     * @var string
     * @Column(column="email", type="string", length=64, nullable=false)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(column="mobile", type="string", length=32, nullable=false)
     */
    public $mobile;

    /**
     *
     * @var string
     * @Column(column="created_at", type="string", nullable=true)
     */
    public $created_at;

    /**
     *
     * @var string
     * @Column(column="updated_at", type="string", nullable=true)
     */
    public $updated_at;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model' => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("admin");
        $this->setSource("user");
        $this->hasManyToMany(
            'id',
            UserRole::class,
            'user_id',
            'role_id',
            Role::class,
            'id',
            [
                'reusable' => true,
                'alias' => 'roles'
            ]
        );
        parent::initialize();
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return User[]|User|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return User|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'user';
    }
}
