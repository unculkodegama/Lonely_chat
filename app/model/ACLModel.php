<?php

namespace App\Model;

use Nette;

class ACLModel {
/*
    private $acl;

    public function __construct() {
        $this->acl = new Nette\Security\Permission;
        $this->acl->addRole('guest');
        $this->acl->addRole('member');
        $this->acl->addRole('admin', 'member');

        //presenters
        $this->acl->addResource('account');
        $this->acl->addResource('basepage');
        $this->acl->addResource('chatpage');
        $this->acl->addResource('message');
        $this->acl->addResource('sign');

        //povolenia
        $this->acl->allow('guest', 'sign', ['default', 'up']);
        $this->acl->allow('member', 'sign', 'out');
        $this->acl->allow('member', 'chatpage', 'default');
        $this->acl->allow('member', 'account', 'default');
        $this->acl->allow('member', 'basepage', 'default');
        $this->acl->allow('member', 'message', 'default');
    }

    function isAllowed($role, $res, $priv) {
        return $this->acl->isAllowed($role, $res, $priv);
    }
*/
}
