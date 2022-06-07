<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
 *
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    /* L'argument ManagerRegistry $registry indique à Symfony d' injecter le service Doctrine dans la méthode du contrôleur. */
    {
        parent::__construct($registry, Produit::class);
    }

    public function add(Produit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity); 

        /* L'appel persist($entity) indique à Doctrine de "gérer" l'objet $entity. Cela n'entraîne pas l'envoi d'une requête à la base de données.*/

        if ($flush) {
            $this->getEntityManager()->flush();
           /*  Lorsque la méthode flush() est appelée, Doctrine parcourt tous les objets qu'il gère pour voir s'ils doivent être conservés dans la base de données. Si l'objet n'existent pas dans la base de données, le gestionnaire d'entités exécute une requête INSERT, créant une nouvelle ligne dans la table produit. */
        }
    }

    public function remove(Produit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function collectionFemme(){

        return $this->createQueryBuilder('a')
        ->andWhere('a.category = 1')
        ->orderBy('a.createdAt','DESC')
        ->getQuery()
        ->getResult();
    }
    
    public function femmeWax(){

        return $this->createQueryBuilder('a')
        ->andWhere('a.category = 3')
        ->orderBy('a.created_at','DESC')
        ->getQuery()
        ->getResult();
    }
    public function femmeBazin(){

        return $this->createQueryBuilder('a')
        ->andWhere('a.category = 4')
        ->orderBy('a.created_at','DESC')
        ->getQuery()
        ->getResult();
    }

    public function filleBazin(){

        return $this->createQueryBuilder('a')
        ->andWhere('a.category = 8')
        ->orderBy('a.created_at','DESC')
        ->getQuery()
        ->getResult();
    }

//    /**
//     * @return Produit[] Returns an array of Produit objects
//     */

//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Produit
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
