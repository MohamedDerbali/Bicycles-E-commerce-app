<?php

namespace AdminBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
class DashboardController extends Controller
{
    public function indexAction()
    {




        return $this->render('@Admin/accueil.html.twig');
    }
    public function AfficherUserAction()
    {




        return $this->render('@Admin/Default/user.html.twig');
    }




}