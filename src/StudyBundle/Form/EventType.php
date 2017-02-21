<?php

namespace StudyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('avatarFile', VichImageType::class, [
                'required' => true, 'label' => 'Картинка'
            ])
                ->add('title', null, array('label' => 'Титульник'))
                ->add('date', null, array('label' => 'Дата события '))
                ->add('Сохранить', SubmitType::class)
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
                array(
                    'data_class' => 'StudyBundle\Entity\Events',
                )
        );
    }

}
