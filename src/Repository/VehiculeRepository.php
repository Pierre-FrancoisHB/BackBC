<?php

namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicule[]    findAll()
 * @method Vehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
    }

    // /**
    //  * @return Vehicule[] Returns an array of Vehicule objects
    //  */
    
    public function findMaxAndMinDate()
    {
        return $this->createQueryBuilder('v')
            ->select('MAX(v.year) as maxYear, MIN(v.year) as minYear')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findDistinctEnergy(){
        return $this->createQueryBuilder('v')
        ->select('DISTINCT(v.energy) as energy')
        ->getQuery()
        ->getResult()
    ;
    }
    
    /*
    public function findOneBySomeField($value): ?Vehicule
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findResearchVehicules(
        ?string $model, 
        ?string $brand, 
        ?string $energy, 
        ?string $minYear, 
        ?string $maxYear, 
        ?string $minKms, 
        ?string $maxKms, 
        ?string $minPrice,  
        ?string $maxPrice)

    {
//dd($model);

         $qb = $this->createQueryBuilder('v');
                           // We want to select with pagination by 7 Véhicules
         $qb->orderBy('v.id', 'DESC')     
         //    ->setMaxResults(7) -> how to convert in pagination  ??
         ;
         $qb->leftJoin('v.model', 'm')
            ->addSelect('m');
        if($model) {
          $qb->where('m.id = :idModel')
            ->setParameter('idModel', $model);
        }
            $qb->leftJoin('m.brand', 'b')
               ->addSelect('b')
               ->andWhere('b.id = :idBrand')
               ->setParameter('idBrand', $brand);
            $qb->leftJoin('v.photos', 'ph')
            ->addSelect('ph')
            ->andWhere('ph.mainPhoto = 1');
         $qb->leftJoin('v.energy', 'e')
            ->addSelect('e');
        if($energy) {
        $qb ->andWHERE('e.id = :idEnergy')
            ->setParameter('idEnergy', $energy);
        };
        
        if($minYear && $maxYear) {
            $qb -> andWhere('v.year BETWEEN :minYear AND :maxYear')
            ->setParameter('minYear', $minYear)
            ->setParameter('maxYear', $maxYear);
        };

        if($minKms && $maxKms) {
            $qb -> andWhere('v.kilometer BETWEEN :minKms AND :maxKms')
                ->setParameter('minKms', $minKms)
                ->setParameter('maxKms', $maxKms);
        };

        if($minPrice && $maxPrice) {
            $qb -> andWHERE('v.price BETWEEN :minPrice AND :maxPrice')
                ->setParameter('minPrice', $minPrice)
                ->setParameter('maxPrice', $maxPrice);
        }

        return $qb->getQuery()->getResult();
  

    //     // On fait une jointure entre modèle et marque
    //     $qb->leftJoin('m.brand', 'b')
    //        ->addSelect('b')
    //     ;  
    //     // On fait une jointure avec les photos en ne gardant que la photo principale
    //     $qb->leftJoin('v.photo', 'ph')
    //         ->addSelect('ph');
    //     //    //->where('ph.mainPhoto = 1')
    //     //;
    //     //// On fait une jointure avec le garage
    //     //$qb->leftJoin('v.garage', 'g')
    //     //    ->addSelect('g')
    //     //;        
    //     //// On fait une jointure entre garage et professionnel
    //     //$qb->leftJoin('g.professionnal', 'pr')
    //     //->addSelect('pr')
    //     //;  

    //     ;
    }


}