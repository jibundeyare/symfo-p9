<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\User;
use App\Entity\Writer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Writer>
 *
 * @method Writer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Writer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Writer[]    findAll()
 * @method Writer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WriterRepository extends ServiceEntityRepository
{
    use ProfileTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Writer::class);
    }

    public function add(Writer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Writer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByUser(User $user): ?Writer
    {
        return $this->__findByUser($user);
    }

    public function isAuthor(Writer $writer, Article $article): bool
    {
        // la requête renvoie un objet de type writer ou une valeur nulle
        // en convertissant cette valeur en booléen, cela permet de renvoyer :
        // - une valeur true si le rédacteur et l'article sont liés
        // - une valeur false si le rédacteur et l'article ne sont pas liés
        return (bool) $this->createQueryBuilder('w')
            // demande de jointure qui exclut les rédacteurs sans article
            ->innerJoin('w.articles', 'a')
            // sélection du rédacteur passé en paramètre
            ->andWhere('w.id = :writerId')
            // sélection de l'article passé en paramètre
            ->andWhere('a.id = :articleId')
            ->setParameter('writerId', $writer->getId())
            ->setParameter('articleId', $article->getId())
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

//    /**
//     * @return Writer[] Returns an array of Writer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Writer
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
