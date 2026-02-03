<?php

namespace Controller\accounts;

use JetBrains\PhpStorm\NoReturn;
use Repository\UsersRepo;

/**
 * Class AccountsCrudController (PHP version 8.5)
 *
 * @author Rudy Mas <rudy.mas@rudymas.be>
 * @copyright 2026 Rudy Mas (https://rudymas.be)
 * @license https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version 2026.02.03.0
 * @package Tigress\Users
 */
class AccountsCrudController
{
    #[NoReturn]
    public function save(): void
    {
        $usersRepo = new UsersRepo();
        $usersRepo->loadById($_SESSION['user']['id']);
        $user = $usersRepo->current();
        $user->updateByPost($_POST);
        $usersRepo->save($user);
        $_SESSION['success'] = __('Your account has been updated successfully.');
        TWIG->redirect('/home');
    }
}