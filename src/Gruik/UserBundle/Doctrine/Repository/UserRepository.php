<?php

namespace Gruik\UserBundle\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Gruik\UserBundle\Repository\UserRepositoryInterface;

/**
 * @author  grena <hello@grena.fr>
 * @license https://opensource.org/licenses/GPL-3.0  GNU General Public License v3.0 (GPL-3.0)
 */
class UserRepository extends EntityRepository implements UserRepositoryInterface
{
}
