<?php

namespace App\Controllers\Frontend;

use App\Core\Route;
use App\Core\Controller;
use App\Models\PosteModel;


class PosteController extends Controller
{   // création de toutes les pages de la bdd render decompose le tableau. tableau associatif = tableau clé->valeur
    #[Route('poste.show', '/postes/details/([0-9]+)', ['GET'])]
    public function showPoste(int $id): void
    {   
        $poste = new PosteModel();

        $this->render('Frontend/Poste/show',[
            'poste' => $poste->find($id),
        ]);
    }

}