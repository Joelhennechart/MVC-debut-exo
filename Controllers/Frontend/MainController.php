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
                'class' => 'form card p-3 w-50 mx-auto',
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
                'placeholder' => 'S3CR3T'
            ])
            ->endDiv()
            ->addButton('Connexion', [
                'type' => 'submit',
                'class' => 'btn btn-primary',
            ])
            ->endForm();

        $this->render('Frontend/login', [
            'form' => $form->createForm(),
        ]);
    }

    #[Route('register', '/register', ['GET', 'POST'])]
    public function register(): void
    {
        if(Form::validate($_POST, ['nom', 'prenom', 'email', 'password'])){
            
        }

    $form = (new Form())
        ->startForm('#', 'POST', [
            'class' => 'form card p-3 w-75 mx-auto',
        ])
        ->startDiv(['class' => 'mb-3 row'])
        ->startDiv(['class' => 'col-md-6'])
        ->addLabel('nom', 'Nom:', [
            'class' => 'form-label'
        ])
        ->addInput('text', 'nom', [
            'class' => 'form-control',
            'required' => true,
            'id' => 'nom',
            'placeholder' => 'Doe'
        ])
        ->endDiv()
        ->startDiv(['class' => 'col-md-6'])
        ->addLabel('prenom', 'Prénom:', [
            'class' => 'form-label'
        ])
        ->addInput('text', 'prenom', [
            'class' => 'form-control',
            'required' => true,
            'id' => 'prenom',
            'placeholder' => 'John',
        ])
        ->endDiv()
        ->endDiv()
        ->startDiv(['class' => 'mb-3'])
        ->addLabel('email', 'Email:', [
            'class' => 'form-label',
        ])
        ->addInput('email', 'email', [
            'class' => 'form-control',
            'id' => 'email',
            'required' => true,
            'placeholder' => 'john@exemple.com',
        ])
        ->endDiv()
        ->startDiv(['class' => 'mb-3'])
        ->addLabel('password', 'Mot de passe:', [
            'class' => 'form-label',
        ])
        ->addInput('password', 'password', [
            'class' => 'form-control',
            'id' => 'password',
            'required' => true,
            'placeholder' => 'S3CR3T',
        ])
        ->endDiv()
        ->addButton('S\'inscrire', [
            'class' => 'btn btn-primary mt-3'
        ])
        ->endForm();
        $this -> render('Frontend/register',[
            'form' => $form->createForm(),
        ]);
      
    }
}