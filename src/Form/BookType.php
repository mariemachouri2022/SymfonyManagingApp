<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Author;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ref')
            ->add('title')
            ->add('category',ChoiceType::class,[
                'choices'=> [
                    "Science"=>'science',
                    "Art"=>'art',
                    "Sport"=>'sport'
                ],
                'expanded'=>false,
                'multiple'=>false //radio button multiple:false w expanded:true ,, checkbox: expanded:false , multiple:true
            ])
            ->add('publicationDate')
          //  ->add('published')
            ->add('idAuthor',EntityType::class,[
                'class'=>Author::class,
                'choice_label'=>'username'
            ])
            ->add('Submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
