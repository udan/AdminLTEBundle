<?php
/**
 * ShowUserEvent.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace udan\AdminLTEBundle\Event;


use udan\AdminLTEBundle\Model\UserInterface;

class ShowUserEvent extends  ThemeEvent {

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @param \udan\AdminLTEBundle\Model\UserInterface $user
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return \udan\AdminLTEBundle\Model\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }


}
