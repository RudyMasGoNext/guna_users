<?php

namespace Controller\accounts;

use Repository\UsersRepo;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class AccountsController (PHP version 8.5)
 *
 * @author Rudy Mas <rudy.mas@rudymas.be>
 * @copyright 2026 Rudy Mas (https://rudymas.be)
 * @license https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version 2026.02.03.0
 * @package Tigress\Users
 */
class AccountsController
{
    /**
     * @throws LoaderError
     */
    public function __construct()
    {
        TWIG->addPath('vendor/guna/users/src/views');
        TRANSLATIONS->load(SYSTEM_ROOT . '/vendor/guna/users/translations/translations.json');
    }

    /**
     * Edit account
     *
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function edit(): void
    {
        $usersRepo = new UsersRepo();
        $usersRepo->loadById($_SESSION['user']['id']);

        if ($usersRepo->isEmpty()) {
            $_SESSION['error'] = __('The account you are trying to edit does not exist.');
            TWIG->redirect('/login');
        }

        TWIG->render('accounts/edit.twig', [
            'user' => $usersRepo->current(),
        ]);
    }
}