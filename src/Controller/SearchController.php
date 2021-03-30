<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\VehiculeRepository;
use App\Repository\EnergyRepository;

class SearchController extends AbstractController
{
    private $marqueRepository;


    /**
     * @Route("/api/search", name="search")
     */
    // public function index(VehiculeRepository $vehiculeRepository, EnergyRepository $energyRepository): Response
    // {
       
    //     $filters = [
    //         'annee'=> [
    //             $vehiculeRepository->findMaxAndMinDate()[0]
    //         ],
    //         'energy'=> [$energyRepository->findAll()],
    //         'marque'=> ['peugeot'=>1]
    //     ];

    //     return $this->json($filters);
    // }



    /**
     * @Route("/api/vehicules/research/", name="vehicules-research", methods={"GET"})
     */
    public function researchVehicules(VehiculeRepository $vehiculeRepository, Request $request)
    {
        $research = $vehiculeRepository->findResearchVehicules(
            $request->query->get('model'),
            $request->query->get('brand'),
            $request->query->get('energy'),
            $request->query->get('minYear'),
            $request->query->get('maxYear'),
            $request->query->get('minKms'),
            $request->query->get('maxKms'),
            $request->query->get('minPrice'),
            $request->query->get('maxPrice'),
        );
        
        return $this->json($research, 200, [], ['groups' => 'display:vehicule']);
    }

}
