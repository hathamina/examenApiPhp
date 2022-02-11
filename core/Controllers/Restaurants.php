<?php

namespace Controllers;

class Restaurant extends AbstractController
{

    protected $defaultModelName = \Models\Restaurant::class;


    public function index()
    {
        return $this->json($this->defaultModel->findAll() );
    }


    public function new(){

        $request = $this->post('json', ['name'=>'text', 'adress'=>'text', 'city'=>'text']);

        if(!$request){
            return $this->json('il ya une faute');
        }


        $restaurant = new \Models\Restaurant();
        $restaurant->setName($request['name']);
        $restaurant->setadress($request['adress']);
        $restaurant->setcity($request['city']);
        $this->defaultModel->save($restaurant);

        return $this->json("bravo");
    }

    /**
     * fonction pour une requete de type DELETE
     * @return void
     */
    public function suppr(){

        $request = $this->delete('json', ['id'=>'number']);
        if(!$request){

            return $this->json("requete mal soumise", "delete");
        }

        $restaurant = $this->defaultModel->findById($request['id']);
        if(!$restaurant){

            return $this->json("ce rastaurant n'existe pas", "delete");
        }

        $this->defaultModel->remove($restaurant);

        return $this->json("ce restaurant est bien supprimé", "delete");
    }

}