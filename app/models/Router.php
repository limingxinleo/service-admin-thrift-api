<?php

namespace App\Models;

class Router extends Model
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
     * @var integer
     * @Column(column="pid", type="integer", length=11, nullable=false)
     */
    public $pid;

    /**
     *
     * @var string
     * @Column(column="name", type="string", length=32, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(column="route", type="string", length=64, nullable=false)
     */
    public $route;

    /**
     *
     * @var integer
     * @Column(column="type", type="integer", length=4, nullable=false)
     */
    public $type;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("admin");
        $this->setSource("router");
        parent::initialize();
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Router[]|Router|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Router|\Phalcon\Mvc\Model\ResultInterface
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
        return 'router';
    }
}
