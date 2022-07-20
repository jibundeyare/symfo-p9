<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Page;
use App\Entity\Tag;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DbTestController extends AbstractController
{
    #[Route('/db/test/fixtures', name: 'app_db_test_fixtures')]
    public function fixtures(ManagerRegistry $doctrine): Response
    {
        // récupération du repository des catégories
        $repository = $doctrine->getRepository(Category::class);
        // récupération de la liste complète de toutes les catégories
        $categories = $repository->findAll();
        // inspection de la liste
        dump($categories);

        // récupération du repository des tags
        $repository = $doctrine->getRepository(Tag::class);
        // récupération de la liste complète de tous les tags
        $tags = $repository->findAll();
        // inspection de la liste
        dump($tags);

        // récupération du repository des articles
        $repository = $doctrine->getRepository(Article::class);
        // récupération de la liste complète de tous les articles
        $articles = $repository->findAll();

        foreach ($articles as $article) {
            // inspection de l'article
            dump($article);

            // récupération des tags de l'article
            $tags = $article->getTags();

            foreach ($tags as $tag) {
                // inspection du tag
                dump($tag);
            }
        }

        // récupération du repository des pages
        $repository = $doctrine->getRepository(Page::class);
        // récupération de la liste complète de toutes les pages
        $pages = $repository->findAll();
        // inspections de la liste des pages
        dump($pages);

        exit();
    }

    #[Route('/db/test/orm', name: 'app_db_test_orm')]
    public function orm(ManagerRegistry $doctrine): Response
    {
        // récupération du repository de l'entité Tag
        $repository = $doctrine->getRepository(Tag::class);

        // récupération de tous les objets de type Tag
        $tags = $repository->findAll();
        dump($tags);

        // récupération d'un objet à partir de son id
        $id = 1;
        $tag = $repository->find($id);
        dump($tag);

        // récupération de plusieurs objets à partir de son name
        $tags = $repository->findBy(['name' => 'carné']);
        dump($tags);

        // récupération d'un objet à partir de son name
        $tag = $repository->findOneBy(['name' => 'carné']);
        dump($tag);

        // récupération de l'Entity Manager
        $manager = $doctrine->getManager();

        if ($tag) {
            // suppression d'un objet
            $manager->remove($tag);
            $manager->flush();
        }

        // récupération d'un objet à partir de son id
        $id = 7;
        $tag = $repository->find($id);
        dump($tag->getName());

        // modification d'un objet
        $tag->setName('Foo bar baz');
        dump($tag->getName());

        // enregistrement de la modification dans la BDD
        $manager->flush();

        // création d'un nouvel objet
        $tag = new Tag();
        $tag->setName('le dernier tag');
        dump($tag);

        // demande d'enregistrement de l'objet dans la BDD
        $manager->persist($tag);
        $manager->flush();
        dump($tag);

        exit();
    }

    #[Route('/db/test/repository', name: 'app_db_test_repository')]
    public function repository(ArticleRepository $repository): Response
    {
        $articles = $repository->findAllSorted();
        dump($articles);

        exit();
    }
}
