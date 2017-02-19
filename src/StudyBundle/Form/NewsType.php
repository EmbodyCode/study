<?php
namespace StudyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'Титульник'))
            ->add('shortText',null, array('label' => 'Короткий текст '))
            ->add('fullNewsText',null, array('label' => 'Полный текст'))
            ->add('Type', ChoiceType::class, array(
                'label' => 'Тип новости',
                'choices'  => array(
        'Обычная' => 'neutral',
        'Хорошая' => 'good',
        'Плохая' => 'bad',
    ),
    'choices_as_values' => true))
            ->add('Добавить', SubmitType::class)
        ;
    }
}

