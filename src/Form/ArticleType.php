<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Tag;
use App\Entity\Writer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('body')
            ->add('published_at')
            ->add('tags', EntityType::class, [
                // looks for choices from this entity
                'class' => Tag::class,

                // uses the User.username property as the visible option string
                'choice_label' => function (Tag $object) {
                    return "{$object->getName()} ({$object->getId()})";
                },

                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('category', EntityType::class, [
                // looks for choices from this entity
                'class' => Category::class,

                // uses the User.username property as the visible option string
                'choice_label' => function (Category $object) {
                    return "{$object->getName()} ({$object->getId()})";
                },

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                'expanded' => true,
            ])
            ->add('writer', EntityType::class, [
                // looks for choices from this entity
                'class' => Writer::class,

                // uses the User.username property as the visible option string
                'choice_label' => function (Writer $object) {
                    return "{$object->getUser()->getEmail()} ({$object->getUser()->getId()})";
                },

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                'expanded' => true,
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
