<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Component\User\UserFactory;
use App\Component\User\UserManager;
use App\Entity\User;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserCreatAction extends AbstractController
{
    public function __construct(
        private readonly UserFactory $userFactory,
        private readonly UserManager $userManager,
        private readonly ValidatorInterface $validator
    )
    {

    }
    public function __invoke(User  $data): User
    {
        $this->validator -> validate($data);
        $user = $this -> userFactory->create(
            $data->getEmail(),
            $data->getPassword()
        );

        $this->userManager->save($user, true);

        return $user;
    }
}