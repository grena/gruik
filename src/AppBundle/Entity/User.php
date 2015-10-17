<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $github_id;

    /** @var string */
    protected $github_access_token;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getGithubId()
    {
        return $this->github_id;
    }

    /**
     * @param string $github_id
     */
    public function setGithubId($github_id)
    {
        $this->github_id = $github_id;
    }

    /**
     * @return string
     */
    public function getGithubAccessToken()
    {
        return $this->github_access_token;
    }

    /**
     * @param string $github_access_token
     */
    public function setGithubAccessToken($github_access_token)
    {
        $this->github_access_token = $github_access_token;
    }
}
