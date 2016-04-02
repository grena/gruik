<?php

namespace spec\Gruik\UserBundle\Security;

use FOS\UserBundle\Model\UserManagerInterface;
use Gruik\UserBundle\Entity\UserInterface;
use HWI\Bundle\OAuthBundle\OAuth\ResourceOwnerInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FOSUBUserProviderSpec extends ObjectBehavior
{
    public function let(
        UserManagerInterface $userManager,
        UserResponseInterface $response,
        ResourceOwnerInterface $resourceOwner
    ) {
        $resourceOwner->getName()->willReturn('github');
        $response->getResourceOwner()->willReturn($resourceOwner);

        $this->beConstructedWith($userManager, ['github' => 'github']);
    }

    public function it_creates_a_user_on_first_connection(
        $userManager,
        $response,
        UserInterface $user
    ) {
        $response->getUsername()->willReturn('bender');
        $response->getNickname()->willReturn('bender');
        $response->getEmail()->willReturn('bender@example.com');
        $response->getAccessToken()->willReturn('thisIsAToken');
        $response->getProfilePicture()->willReturn('http://picture.png');

        $userManager->findUserBy(Argument::cetera())->willReturn(null);
        $userManager->createUser()->shouldBeCalled()->willReturn($user);

        $user->setGithubId('bender')->shouldBeCalled();
        $user->setGithubAccessToken('thisIsAToken')->shouldBeCalled();
        $user->setUsername('bender')->shouldBeCalled();
        $user->setEmail('bender@example.com')->shouldBeCalled();
        $user->setPassword('bender')->shouldBeCalled();
        $user->setProfilePicture('http://picture.png')->shouldBeCalled();
        $user->setEnabled(true)->shouldBeCalled();

        $userManager->updateUser($user)->shouldBeCalled();

        $this->loadUserByOAuthUserResponse($response);
    }

    public function it_loads_the_user_on_connection(
        $userManager,
        $response,
        UserInterface $user
    ) {
        $response->getUsername()->willReturn('bender');
        $response->getAccessToken()->willReturn('thisIsAToken');

        $userManager->findUserBy(['github' => 'bender'])->willReturn($user);
        $user->setGithubAccessToken('thisIsAToken')->shouldBeCalled();

        $userManager->createUser()->shouldNotBeCalled();

        $this->loadUserByOAuthUserResponse($response);
    }

    public function it_updates_a_user_on_connection(
        $userManager,
        $response,
        UserInterface $user
    ) {
        $response->getUsername()->willReturn('bender');
        $response->getAccessToken()->willReturn('thisIsAToken');

        $userManager->findUserBy(['github' => 'bender'])->willReturn(null);

        $user->setGithubId('bender')->shouldBeCalled();
        $user->setGithubAccessToken('thisIsAToken')->shouldBeCalled();

        $userManager->updateUser($user)->shouldBeCalledTimes(1);

        $this->connect($user, $response);
    }

    public function it_updates_a_user_on_connection_and_disconnects_it_first(
        $userManager,
        $response,
        UserInterface $user
    ) {
        $response->getUsername()->willReturn('bender');
        $response->getAccessToken()->willReturn('thisIsAToken');

        $userManager->findUserBy(['github' => 'bender'])->willReturn($user);

        $user->setGithubId(null)->shouldBeCalled();
        $user->setGithubAccessToken(null)->shouldBeCalled();
        $user->setGithubId('bender')->shouldBeCalled();
        $user->setGithubAccessToken('thisIsAToken')->shouldBeCalled();

        $userManager->updateUser($user)->shouldBeCalledTimes(2);

        $this->connect($user, $response);
    }
}
