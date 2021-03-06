<?php
/**
 * SidebarController.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace udan\AdminLTEBundle\Controller;


use udan\AdminLTEBundle\Event\ShowUserEvent;
use udan\AdminLTEBundle\Event\SidebarMenuEvent;
use udan\AdminLTEBundle\Event\ThemeEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SidebarController extends Controller
{

    public function userPanelAction()
    {

        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_SIDEBAR_USER)) {
            return new Response();
        }
        $userEvent = $this->getDispatcher()->dispatch(ThemeEvents::THEME_SIDEBAR_USER, new ShowUserEvent());

        return $this->render(
                    'udanAdminLTEBundle:Sidebar:user-panel.html.twig',
                        array(
                            'user' => $userEvent->getUser()
                        )
        );
    }

    /**
     * @return EventDispatcher
     */
    protected function getDispatcher()
    {
        return $this->get('event_dispatcher');
    }

    public function searchFormAction()
    {


        return $this->render('udanAdminLTEBundle:Sidebar:search-form.html.twig', array());
    }

    public function menuAction(Request $request)
    {

        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_SIDEBAR_SETUP_MENU)) {
            return new Response();
        }

        $event   = $this->getDispatcher()->dispatch(ThemeEvents::THEME_SIDEBAR_SETUP_MENU,new SidebarMenuEvent($request));

        return $this->render(
                    'udanAdminLTEBundle:Sidebar:menu.html.twig',
                        array(
                            'menu' => $event->getItems()
                        )
        );
    }
}
