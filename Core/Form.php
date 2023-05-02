<?php

namespace App\Core;

class Form
    {
    /**
    * Stock le code HTML du formulaire
    *
    * @var string
    */
    private string $formCode = '';

        /**
         * Validation du formulaire
         *
         * @param array $form issue de $_GET ou $_POST (tableau associatif)
         * @param array $champs les champs obligatoires pour valider le formulaire
         * @return boolean
         */
    public static function validate(array $form, array $champs): bool
        {
            // On parcour les champs obligeatoire
            foreach ($champs as $champ) {
                // si le champ est absent ou vide dans le formulaire 'nom' $_POST['nom']
                if (!isset($form[$champ]) || empty($form[$champ]) || strlen(trim($form[$champ])) == 0) {
                    return false;
                }}
            return true;
        }    
        /**
         * Ouvre la balise form HTML
         *
         * @param string $action action du formmulaire
         * @param string $methode methode utilisée par le formulaire
         * @param array $attributs attributs HTML à ajouter à la balise form
         * @return self
         */
    public function startForm(string $action = '#', string $methode = 'POST', array $attributs = []): self
        {
            //On crée la balise form
            $this->formCode .= "<form action=\"$action\" method=\"$methode\"";

            // On ajoute les attributs
            $this->formCode .= $attributs ? $this->addAttributes($attributs) . '>' : '>'; // ($attributs ? ... :) terner comme s'il avait écrit si $attribut : sinon '>' 
            return $this;
        }
    public function endForm(): self
        {
            $this->formCode .=  '</form>';
            return $this;
        }

    public function startDiv(array $attributs = []): self
        {
            $this->formCode .= '<div';

            $this->formCode .= $attributs ? $this->addAttributes($attributs) . '>' : '>';

            return $this;
        }

    public function endDiv(): self
        {
            $this->formCode .= '</div>';

            return $this;
        }

    public function addLabel(string $for, string $text, array $attributs = []): self
        {
            $this->formCode .= "<label for=\"$for\"";

            $this->formCode .= $attributs ? $this->addAttributes($attributs) : '';

            $this->formCode .= ">$text</label>";

            return $this;
        }

    public function addInput(string $type, string $name, array $attributs = []): self
        {
            $this->formCode .= "<input type=\"$type\" name=\"$name\"";

            $this->formCode .= $attributs ? $this->addAttributes($attributs) . '>' : '>';

            return $this;
        }

    public function addButton(string $text, array $attributs = []): self
        {
            $this->formCode .= '<button ';

            $this->formCode .= $attributs ? $this->addAttributes($attributs) : '';

            $this->formCode .= ">$text</button>";

            return $this;
        }

        /**
         *Ajoute les attributs HTML
         *
         * @param array $attributs exemple data = {'placeholder' => 'test', 'required' =>true}
         * @return string
         */
        public function addAttributes(array $attributs): string
        {
            //on ouvre unne chaine de caractéres vide
            $str = '';
            // on definit nos attributs courts
            $attrCourt = ['required', 'readonly', 'multiple', 'disable', 'checked', 'autofocus', 'novalidate', 'formnovalidate'];
            
            // On boucle suir le tableau d'attribut
            foreach ($attributs as $attribut => $value) {
                if (in_array($attribut, $attrCourt) && $value == true) {
                    // On est sur un attribut court
                    $str .= " $attribut";
                } else {
                    // On est sur un attribut long
                    $str .= " $attribut=\"$value\"";
                }
            }

            return $str;
        }

    /**
     * Génére le code HTML du formulaire
     *
     * @return string chaine de caractére du code HTML
     */
    public function createForm() : string
    {
        return $this->formCode;
        
    }
}