<?php
namespace StudyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('eventPictureFile')
            ->add('title', null, array('label' => 'Титульник'))
            ->add('date',null, array('label' => 'Дата события '))
            ->add('Сохранить', SubmitType::class)
        ;
    }
}

