<?php
/**
 * FormDemoModelType.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FormDemoModelType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options = array(
            'opt1' => 'This is option 1',
            'opt2' => 'This is option 2',
            'opt3' => 'This is option 3',
        );

        $choices = array(
            'choice1' => 'This is choice 1',
            'choice2' => 'This is choice 2',
            'choice3' => 'This is choice 3',
        );

        $builder->add('name', 'text', array(
            'attr'             => array( 'data-bind' => 'name' ))
            )
                ->add('gender', 'choice', array(
                    'choices'  => array('m' => 'male', 'f' => 'female'),
                    'attr'     => array( 'data-bind' => 'gender' ),
                    ))
                ->add('someOption', 'choice', array(
                    'choices'  => $options,
                    'expanded' => true,
                    'attr'     => array( 'data-bind' => 'someOption' )
                    ))
                ->add('someChoices', 'choice', array(
                    'choices'  => $choices,
                    'expanded' => true,
                    'multiple' => true,
                    'attr'     => array( 'data-bind' => 'someChoices' )
                    ))
                ->add('username',null, array(
                    'attr'     => array( 'data-bind' => 'username' )
                    ))
                ->add('email', null, array(
                    'attr'     => array( 'data-bind' => 'email' )
                ))
                ->add('termsAccepted','checkbox', array(
                    'attr'     => array( 'data-bind' => 'termsAccepted' )
                ))
                ->add('message', 'textarea',array(
                    'attr'     => array( 'data-bind' => 'message' )
                ))
                ->add('price', null, array(
                    'attr'     => array( 'data-bind' => 'price' )
                ))
                ->add('date', 'date', array(
                    'widget'   => 'single_text',
                    'attr'     => array( 'data-bind' => 'date' )
                    ))
                ->add('time', 'time', array(
                    'widget'   => 'single_text',
                    'attr'     => array( 'data-bind' => 'time' )
                    ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Avanzu\AdminThemeBundle\Model\FormDemoModel',
            ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'form_demo';
    }
}
