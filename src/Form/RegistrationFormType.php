<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
Use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=>'mail',
                'constraints'=>[
                    new Assert\NotBlank(['message'=>'L\'email ne peut pas être vide']),
                    new Assert\Email(['message'=>'Veuillez entrer un mail valide']),
                    new Assert\Length([
                        'max'=>'180',
                        'maxMessage'=>'L\'email ne peut pas dépasser {{ limit }} caractères'
                    ]),
                ],
            ])
            ->add('pseudo', TextType::class, [
                'label'=>'pseudo',
                'constraints'=>[
                    new Assert\NotBlank(['message'=>'Le nom d\'utilisateur ne peut pas rester vide']),
                    new Assert\Length([
                        'min'=>'8',
                        'max'=>'18',
                        'minMessage'=>'Le nom d\'utilisateur doit comprendre au moins 8 caractères',
                        'maxMessage'=>'Le nom d\'utilisateur ne peut comporter plus de 18 caractères',
                    ]),
                ],
            ])
            ->add('plainPassword',PasswordType::class,[
                'mapped'=>false,
                'label'=>'password',
                'constraints'=>[                
                    new Assert\NotBlank(['message'=>'Le mot de passe ne peut pas être vide']),
                    new Assert\Regex([
                        'pattern'=>'/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/',
                        'message'=>'Le mot de passe doit contenir au moins 12 caractères, une minuscule, une majuscule, un chiffre et un caractère spécial'
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
