<?php

namespace App\Presenters;

use Nette;
use App\Model;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter {
 /* Zatial vypnute pre jednoduchost uprav
    protected function startup() {
        parent::startup();

        $acl = new Model\ACLModel();
        $ctrl = strtolower($this->name);
        $act = strtolower($this->action);
        $user = $this->getUser();

        if (!$user->isLoggedIn()) {
//neprihlaseny
            if (!$acl->isAllowed('guest', $ctrl, $act)) {
                $this->flashMessage('Nemas opravneni');
                $this->redirect('Sign:default');
            }
        } else {
            $roles = $user->getIdentity()->getRoles();
            if (!$acl->isAllowed($roles[0], $ctrl, $act)) {
                $this->flashMessage('Nemas opravneni');
                $this->redirect('Basepage:default');
            }
        }
    }
*/
}
