<?php

namespace Controller\accounts;

use JetBrains\PhpStorm\NoReturn;
use Random\RandomException;
use Repository\UsersRepo;
use Tigress\Core;

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
    public function __construct()
    {
        TRANSLATIONS->load(SYSTEM_ROOT . '/vendor/guna/users/translations/translations.json');
    }

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

    /**
     * Change the user's password
     *
     * @throws RandomException
     */
    #[NoReturn]
    public function changePassword(): void
    {
        if ($_POST['new_password'] !== $_POST['confirm_password']) {
            $_SESSION['error'] = __('The new password and its confirmation do not match.');
            TWIG->redirect('/account/edit');
        }

        $usersRepo = new UsersRepo();
        $usersRepo->loadById($_SESSION['user']['id']);
        $user = $usersRepo->current();
        $user->salt = SECURITY->createSalt();
        $user->authorized = SECURITY->createHash($_POST['new_password'], $user->salt);
        $usersRepo->save($user);
        TWIG->redirect('/account/edit');
    }
}