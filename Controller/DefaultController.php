<?php

namespace udan\AdminLTEBundle\Controller;

use udan\AdminLTEBundle\Form\FormDemoModelType;
use udan\AdminLTEBundle\Model\FormDemoModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 *
 * @package udan\AdminLTEBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction() {
        return    $this->render('udanAdminLTEBundle:Default:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uiGeneralAction() {
        return $this->render('udanAdminLTEBundle:Default:index.html.twig');
    }

    public function uiIconsAction() {
        return $this->render('udanAdminLTEBundle:Default:index.html.twig');
    }

    public function formAction() {
        $form =$this->createForm( FormDemoModelType::class );
        return $this->render('udanAdminLTEBundle:Default:form.html.twig', array(
                'form' => $form->createView()
            ));
    }

    public function loginAction() {
        return $this->render('udanAdminLTEBundle:Default:login.html.twig');
    }
}
