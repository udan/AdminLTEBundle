<?php
/**
 * NavbarShowUserListener.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace udan\AdminLTEBundle\EventListener;


use udan\AdminLTEBundle\Event\ShowUserEvent;
use udan\AdminLTEBundle\Model\UserModel;

class NavbarShowUserDemoListener {

    public function onShowUser(ShowUserEvent $event) {

        $user = new UserModel();
        $user->setAvatar('')->setIsOnline(true)->setMemberSince(new \DateTime())->setUsername('Demo User');

        $event->setUser($user);
    }

}
