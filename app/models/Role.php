<?php

namespace App\Models;

class Role extends Model
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
     * @Column(column="role_name", type="string", length=32, nullable=false)
     */
    public $role_name;

    /**
     *
     * @var string
     * @Column(column="role_desc", type="string", length=1000, nullable=false)
     */
    public $role_desc;

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
        $this->setSource("role");
        $this->hasManyToMany(
            'id',
            RoleRouter::class,
            'role_id',
            'router_id',
            Router::class,
            'id',
            [
                'reusable' => true,
                'alias' => 'routers'
            ]
        );
        parent::initialize();
    }

    public function routers($pageIndex, $pageSize, $searchText)
    {
        $router = Router::class;
        $params = [];
        $params['offset'] = $pageIndex * $pageSize;
        $params['limit'] = $pageSize;
        if (!empty($searchText)) {
            $params['conditions'] = "([{$router}].[name] like :name: OR [{$router}].[route] like :route:)";
            $params['bind'] = [
                'name' => '%' . $searchText . '%',
                'route' => '%' . $searchText . '%',
            ];
        }
        $this->hasManyToMany(
            'id',
            RoleRouter::class,
            'role_id',
            'router_id',
            Router::class,
            'id',
            [
                'reusable' => true,
                'alias' => 'routers',
                'params' => $params
            ]
        );

        return $this->routers;
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Role[]|Role|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Role|\Phalcon\Mvc\Model\ResultInterface
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
        return 'role';
    }
}
