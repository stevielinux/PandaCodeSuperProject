<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=>'email',
                'constraints'=>[
                    new Assert\NotBlank(['message'=>'Veuillez entrer votre mail']),
                ]
            ])
            ->add('pseudo', TextType::class,[
                'label'=>'pseudo',
                'constraints'=>[
                    new Assert\NotBlank(['message'=>'Veuillez entrer votre pseudo svp']),
                    new Assert\Email(['message'=>'Veuillez entrer un mail valide']),
                ]
                
            ])
            ->add('password', PasswordType::class,[
                'label'=>'password',
                'constraints'=>[
                    new Assert\NotBlank(['message'=>'Le mot de passe doit être entré']),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
