<?php

namespace Gruik\UserBundle\Entity;

use FOS\UserBundle\Model\UserInterface as BaseUserInterface;
use FOS\UserBundle\Model\GroupableInterface;

/**
 * User interface based on FOS UserBundle interfaces
 *
 * @author  grena <hello@grena.fr>
 * @license https://opensource.org/licenses/GPL-3.0  GNU General Public License v3.0 (GPL-3.0)
 */
interface UserInterface extends BaseUserInterface, GroupableInterface
{
    /**
     * @return string
     */
    public function getGithubId();

    /**
     * @param string $github_id
     */
    public function setGithubId($github_id);

    /**
     * @return string
     */
    public function getGithubAccessToken();

    /**
     * @param string $github_access_token
     */
    public function setGithubAccessToken($github_access_token);

    /**
     * @return string
     */
    public function getProfilePicture();

    /**
     * @param string $profilePicture
     */
    public function setProfilePicture($profilePicture);
}
