<?php

namespace UserBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@User/Default/index.html.twig');
    }


    public function inscriptionAction(Request $request)
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('Cin', TextType::class)
            ->add('Nom', TextType::class, array('attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('Prenom', TextType::class)
            ->add('Num_tel', TextType::class)
            ->add('Sexe', ChoiceType::class, array('choices' => array('Homme' => 'Homme', 'Femme' => 'Femme')))
            ->add('Date_naissance', DateType::class, array('data' => new \DateTime(), 'widget' => 'single_text'))
            ->add('Adresse', TextType::class)
            ->add('Poste', TextType::class, array('attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('Civilite', ChoiceType::class, array('choices' => array('Monsieur' => 'Monsieur', ' Madame' => ' Madame', 'Mademoiselle' => 'Mademoiselle')))
            ->add('Pays', TextType::class, array('attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('Ville', TextType::class, array('attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('Code_postal', TextType::class)
            ->add('Photo', FileType::class, array('data_class' => null, 'required' => True))
            ->add('roles', ChoiceType::class, array('multiple' => true, 'choices' => array('Admin' => 'ROLE_ADMIN', 'Acheteur' => 'ROLE_ACHETEUR', 'Vendeur' => 'ROLE_VENDEUR', 'Chef d equipe' => 'ROLE_CHEF_EQUIPE', 'Reparateur' => 'ROLE_Reparateur')))
            ->add('Username', TextType::class, array('attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('Email', EmailType::class)
            ->add('Password', PasswordType::class, ['required' => True])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Photo = $user->getPhoto();
            if ($Photo) {
                $fileName = md5(uniqid()) . '.' . $Photo->guessExtension();

                try {
                    $Photo->move(
                        $this->getParameter('Photo_directory'),
                        $fileName
                    );
                } catch (FileException $e) {

                }
                $user->setPhoto($fileName);
            }


            $user->setCin($form['Cin']->getData());
            $user->setNom($form['Nom']->getData());
            $user->setPrenom($form['Prenom']->getData());
            $user->setNumtel($form['Num_tel']->getData());
            $user->setSexe($form['Sexe']->getData());
            $user->setDateNaissance($form['Date_naissance']->getData());
            $user->setAdresse($form['Adresse']->getData());
            $user->setPoste($form['Poste']->getData());
            $user->setCivilite($form['Civilite']->getData());
            $user->setPays($form['Pays']->getData());
            $user->setVille($form['Ville']->getData());
            $user->setCodepostal($form['Code_postal']->getData());
            $user->setPhoto($fileName);
            $user->setRoles($form['roles']->getData());

            $user->setUsername($form['Username']->getData());
            $user->setEmail($form['Email']->getData());
            $user->setPlainPassword($form['Password']->getData());
            $user->setEnabled(true);
            $em = $this->getDoctrine()->getEntityManager();

            $message = \Swift_Message::newInstance()
                ->setSubject('Connexion')
                ->setFrom($this->getParameter('mailer_user'))
                ->setTo($user->getEmail())
                ->setBody($this->renderView('Emails/registration.html.twig',
                    ['user' => $user, 'password' => $form['Password']->getData()]
                ), 'text/html');
            $this->get('mailer')->send($message);
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'les données ajoutées avec succés');

        }
        return $this->render('@User/Default/inscription.html.twig', array('form' => $form->createView()));
    }


}
