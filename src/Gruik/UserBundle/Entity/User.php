<?php

namespace Gruik\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User implementation
 *
 * @author  grena <hello@grena.fr>
 * @license https://opensource.org/licenses/GPL-3.0  GNU General Public License v3.0 (GPL-3.0)
 */
class User extends BaseUser implements UserInterface
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $github_id;

    /** @var string */
    protected $github_access_token;

    /** @var string */
    protected $profilePicture;

    /**
     * {@inheritdoc}
     */
    public function getGithubId()
    {
        return $this->github_id;
    }

    /**
     * {@inheritdoc}
     */
    public function setGithubId($github_id)
    {
        $this->github_id = $github_id;
    }

    /**
     * {@inheritdoc}
     */
    public function getGithubAccessToken()
    {
        return $this->github_access_token;
    }

    /**
     * {@inheritdoc}
     */
    public function setGithubAccessToken($github_access_token)
    {
        $this->github_access_token = $github_access_token;
    }

    /**
     * {@inheritdoc}
     */
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    /**
     * {@inheritdoc}
     */
    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;
    }
}
