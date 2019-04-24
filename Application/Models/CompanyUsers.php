<?php

namespace CqrsPlayground\Application\Models;

use Phalcon\Validation\Validator\Email as EmailValidator;

/**
 * CompanyUsers
 * 
 * @package CqrsPlayground\Application\Models
 * @autogenerated by Phalcon Developer Tools
 * @date 2019-04-24, 14:12:10
 */
class CompanyUsers extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(column="username", type="string", length=20, nullable=false)
     */
    public $username;

    /**
     *
     * @var string
     * @Column(column="created", type="string", nullable=true)
     */
    public $created;

    /**
     *
     * @var string
     * @Column(column="updated", type="string", nullable=true)
     */
    public $updated;

    /**
     *
     * @var string
     * @Primary
     * @Column(column="id", type="string", length=36, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(column="company_id", type="string", length=36, nullable=false)
     */
    public $company_id;

    /**
     *
     * @var string
     * @Column(column="name", type="string", length=55, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(column="email", type="string", length=255, nullable=false)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(column="phone", type="string", length=45, nullable=true)
     */
    public $phone;

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
                    'model'   => $this,
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
        $this->setSchema("cqrs_playground");
        $this->setSource("company_users");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CompanyUsers[]|CompanyUsers|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CompanyUsers|\Phalcon\Mvc\Model\ResultInterface
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
    public function getSource(): string
    {
        return 'company_users';
    }

}
