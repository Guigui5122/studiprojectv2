<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('content', options: [
                'label' => 'Contenu',
            ])
            ->add('state', options: [
                'label' => 'Statut'
            ])
            ->add('sensible', ChoiceType::class, options: [
                'label' => 'Article sensible',
                'expanded' => false,
                'multiple' => false,
                'choices' => [
                    'oui' => true,
                    'non' => false
                ]
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Commentaire',
                'mapped' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer l\'article'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
