<?php
/**
 * NotificationListEvent.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace udan\AdminLTEBundle\Event;


use udan\AdminLTEBundle\Model\NotificationInterface;

/**
 * Class NotificationListEvent
 *
 * @package udan\AdminLTEBundle\Event
 */
class NotificationListEvent extends ThemeEvent
{

    /**
     * @var array
     */
    protected $notifications = array();

    protected $total = 0;

    /**
     * @return array
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @param NotificationInterface $notificationInterface
     *
     * @return $this
     */
    public function addNotification(NotificationInterface $notificationInterface)
    {
        $this->notifications[] = $notificationInterface;

        return $this;
    }

    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total == 0 ? sizeof($this->notifications) : $this->total;
    }



}
