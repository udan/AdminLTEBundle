<?php

namespace Avanzu\AdminThemeBundle\Controller;

use Avanzu\AdminThemeBundle\Form\FormDemoModelType;
use Avanzu\AdminThemeBundle\Model\FormDemoModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 *
 * @package Avanzu\AdminThemeBundle\Controller
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
    public function dashboardAction()
    {
        return $this->render('AvanzuAdminThemeBundle:Default:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uiGeneralAction()
    {
        return $this->render('AvanzuAdminThemeBundle:Default:index.html.twig');
    }

    public function uiIconsAction()
    {
        return $this->render('AvanzuAdminThemeBundle:Default:index.html.twig');
    }

    public function formAction()
    {
        $form = $this->createForm(new FormDemoModelType());

        return $this->render(
                    'AvanzuAdminThemeBundle:Default:form.html.twig',
                        array(
                            'form' => $form->createView()
                        )
        );
    }

    public function marionetteAction()
    {
        $form = $this->createForm(new FormDemoModelType());

        return $this->render(
                    '@AvanzuAdminTheme/Default/marionette.html.twig',
                        array(
                            'form' => $form->createView(),
                        )
        );
    }

    public function fetchAction($id, Request $request)
    {
        $form = $this->createForm(new FormDemoModelType(), new FormDemoModel());
        return new JsonResponse($form->getViewData());
    }

    public function createAction(Request $request)
    {
        $form = $this->createForm(new FormDemoModelType(), new FormDemoModel());
        $form->submit($this->getJsonRequestData($request));
        if(! $form->isValid()) {
            return $this->createErrorResponse($form); // new JsonResponse($form->getErrors(true, true));
        }
        return new JsonResponse($form->getViewData());
    }

    public function updateAction($id, Request $request)
    {

    }

    public function deleteAction($id, Request $request)
    {

    }

    protected function getJsonRequestData(Request $request)
    {
        $data = array();
        if (false !== strpos($request->headers->get('Content-Type'), 'json')) {
            $data = json_decode($request->getContent(), true);
        }
        return $data;
    }



    protected function createErrorResponse(Form $form)
    {


        $errors   = array();
        foreach($form->getErrors(false) as $glob) {
            $errors['form'][] = $glob->getMessage();
        }
        foreach($form->all() as $name => $child) {
            foreach($child->getErrors(true, true) as $err) {
                $errors[$name][] = $err->getMessage();
            }
        }

        return new JsonResponse($errors, 400);
    }
}
