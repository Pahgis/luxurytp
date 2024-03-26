<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('firstname')
            ->add('lastname')
            ->add('adress')
            ->add('country')
            ->add('nationality' , ChoiceType::class, [
                'choices' =>  [
                    'france' =>'Francaise',
                    'UK' =>'Anflaise',
                    'Grolandais' =>'Grolandaise',
                ]
                ])
            ->add('passport')
            ->add('passport_file')
            ->add('cv', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File()
                ],
            ])
            ->add('profil_picture', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image()
                ],
            ])
            ->add('currentLocation')
            ->add('birth_date', null, [
                'widget' => 'single_text',
            ])
            ->add('placeOfBirth')
            ->add('email')
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'required' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('availability')
            ->add('jobCategory')
            ->add('shortDescription')
            ->add('notes')
            ->add('gender', ChoiceType::class, [
                'choices' =>  [
                    'homme' =>'homme',
                    'femme' =>'femme',
                ]
            ])
            ->add('experience', ChoiceType::class, [
                'choices' =>  [
                    '0 - 6 month' =>'0 - 6 month',
                    '6 month - 1 year' =>'6 month - 1 year',
                    '1 - 2 years' =>'1 - 2 years',
                    '2+ years' =>'2+ years',
                    '5+ years' =>'5+ years',
                    '10+ years' =>'10+ years',
                ]
            ])
          
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}


