<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Note;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note', TextType::class)
            // ->add('jour', DateType::class)
            ->add('observation', TextType::class)
            // ->add('etudiant', EntityType::class, [
            //     'class' => Etudiant::class,
            //     'choice_label' => 'nom',
            // ])
            ->add('valider', SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
