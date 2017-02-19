<?php

namespace StudyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class StatusType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('status', TextareaType::class, array(
                    'label' => false,'attr' => array('class' => 'user-information_how-are-you'),
                ))
                ->add('Добавить', SubmitType::class, array(
                    'attr' => array('class' => 'user-information_how-are-you_send')
                ));
    }

}
