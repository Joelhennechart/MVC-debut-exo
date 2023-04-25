<?php
// controle toutes les pages
namespace App\Controllers\Frontend;

use App\Core\Route;
use App\Core\Controller;
use App\Core\Form;
use App\Models\PosteModel;

class MainController extends Controller
{
    #[Route('homepage', '/', ['GET'])]
    public function index(): void
    {
        $postes = new PosteModel();

        $this->render('Frontend/index', [
            'postes' => $postes->findAll(), //tableau valeur 'postes'
       ]);
    }
    
    #[Route('login', '/login', ['GET', 'POST'])]
    public function login(): void
    {
        $form = (new Form())
            ->startForm("#", "POST", [
                'class' => 'form card p-3 w-50 mx-auto', //w-50 mx-auto width 50% marging auto
                'id' => 'form-login',
            ])
            ->startDiv(['class' => 'mb-3'])
            ->addLabel('email', 'Email:', [  
               'class' => 'form-label',
               ])
            ->addInput('email', 'email', [
                'class' => 'form-control',
                'id' => 'email',
                'placeholder' => 'johnDo@exemple.com',
            ])
            ->endDiv()
            ->startDiv(['class' => 'mb-3'])
            ->addLabel('password', 'Mot de passe:', ['class' => 'form-label'])
            ->addInput('password', 'password', [
                'class' => 'form-control',
                'id' => 'password',
                'placeholder' => 'S3CR3T',
            ])
            ->endDiv()
            ->addButton('Connexion',[
                'type' => 'submit',
                'class' => 'btn btn-primary',
            ])
            ->endForm();

            $this->render('Frontend/login', [
                'form' => $form->createForm(),
            ]);
    }
}