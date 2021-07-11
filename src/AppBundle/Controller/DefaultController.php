<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Entity\User;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class DefaultController extends Controller
{

    public function AccesAction(Request $request)
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_homepage');

        } else if ($this->isGranted('ROLE_ACHETEUR')) {
            return $this->redirectToRoute('homepage');
        } else if ($this->isGranted('ROLE_VENDEUR')) {
            return $this->redirectToRoute('office_agent_homepage');
        } else if ($this->isGranted('ROLE_CHEF_EQUIPE')) {
            return $this->redirectToRoute('chef_service_homepage');


        }

}}