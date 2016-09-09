<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 12/08/16
 * Time: 11:10
 */

namespace AppBundle\Controller;


use AppBundle\Service\BlogManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MainController extends Controller{

    /**
     * @Route("/blog", name="blogIndex")
     */
    public function blogIndexAction(){

        $bm = new BlogManager($this->getDoctrine()->getManager(),
            $this->get('markdown.parser'));
        $articles = $bm->getAllPublishedArticles();

        return $this->render('V2/blogIndex.html.twig',[
            'title' => 'Blog | Upsters',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/blog/{articleName}", name="blog_article")
     */
    public function showArticleAction($articleName){

        $bm = new BlogManager($this->getDoctrine()->getManager(),
            $this->get('markdown.parser'));
        $article = $bm->getArticleIfPublished($articleName);

        $rel = $bm->getRelatedArticles(null);

        if (!$article){
            throw $this->createNotFoundException('Cet article n\'existe pas encore !');
        }

        return $this->render('V2/blogArticle.html.twig',[
            'title' => 'Entreprenons ensemble | Upsters',
            'article' => $article,
            'related' => $rel
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function indexAction(){

        //DUMMY SERVICE
        $pitch1 = "Je suis spécialisé dans l’accompagnement des startups dans leur phase de lancement
";
        $service1 = array(
            'name' => 'Pierre Poizat',
            'category' => 'incubateur',
            'categoryName' => 'Incubateur',
            'photoUrl' => 'images/home_pictos/ppoiz.jpg',
            'pitch' => $pitch1,
            'recom' => 15
        );

        $pitch2 = "Je suis spécialisé dans l’accompagnement comptable des startups !";

        $service2 = array(
            'name' => 'Pierre Bonsaquet',
            'category' => 'comptabilite',
            'categoryName' => 'Comptablité',
            'photoUrl' => 'images/bigard.png',
            'pitch' => $pitch2,
            'recom' => 21
        );

        $pitch3 = "Back end et Front end, le code n’a plus de secret pour moi :)
";
        $service3 = array(
            'name' => 'Pierre Portejoie',
            'category' => 'dev',
            'categoryName' => 'Développement',
            'photoUrl' => 'images/home_pictos/pierreporte.jpg',
            'pitch' => $pitch3,
            'recom' => 9
        );

        //DUMMY CATEGORY
        $cat1 = array(
            'name' => 'coworking',
            'displayName' => 'Coworking',
            'pitch' => 'Il est temps de sortir de son canapé !
Trouvez ici l’espace le plus approprié à votre activité et faites de nouvelles rencontres.
'
        );
        $cat2 = array(
            'name' => 'comptabilite',
            'displayName' => 'Comptabilité',
            'pitch' => 'L\'allergie aux bilans comptables et aux déclarations de TVA ne vous quittent pas ? Il serait sage de consulter un
expert comptable.
'
        );
        $cat3 = array(
            'name' => 'autres',
            'displayName' => 'Prototypage',
            'pitch' => 'Parce que tout n’est pas que numérique! Il existe des lieux magiques où l’on peut réaliser un prototype de ses (brillantes) idées.
'
        );
        $cat4 = array(
            'name' => 'juridique',
            'displayName' => 'Juridique',
            'pitch' => '“Aller directement en prison, ne passez pas par la case départ et ne touchez pas les 20 000 €” 
Peut être auriez vous dû demander un petit conseil avant  !
'
        );
        $cat5 = array(
            'name' => 'marketing',
            'displayName' => 'Marketing',
            'pitch' => 'Pour ne plus être le/a seul/e à croire en votre produit ! Laissez les pro habiller la mariée et toucher vos cibles les plus fines.'
        );
        $cat6 = array(
            'name' => 'graphisme',
            'displayName' => 'Web Design',
            'pitch' => 'Il faut de tout pour faire un site ! Et surtout des développeurs, designers et graphistes très compétents. 
            En plus ceux là, on les aime bien.'
        );

        //DUMMY FORUM POST
        $post1 = array(
            'title' => 'TRAVAILLER POUR UNE STARTUP GRATUITEMENT TOUT EN TOUCHANT LES ASSEDIC ?',
            'date' => '01/01/2017',
            'name' => 'Claire Machin',
            'photoUrl' => 'images/images_forum/face-1.png',
            'content' => "Oui c'est tout à fait possible. Il faut pour cela prendre rendez-vous avec Pôle Emploi pour en discuter avec "
        );
        $post2 = array(
            'title' => 'QUI SONT LES INFLUENCEURS DE L’ÉCOSYSTÈME STARTUP FRANÇAIS ?',
            'date' => '01/01/2017',
            'name' => 'Steven Truc',
            'photoUrl' => 'images/images_forum/face-2.png',
            'content' => "Imaginez que vous vouliez faire buzzer votre dernier projet. Voici une liste des personnes à contacter absolument. Spontanément, je pense à",
        );
        $post3 = array(
            'title' => 'CRÉER UN SOCIÉTÉ À L’ÉTRANGER POUR UNE ACTIVITÉ EN FRANCE ?',
            'date' => '01/01/2017',
            'name' => 'Jules Bidule',
            'photoUrl' => 'images/images_forum/face-3.png',
            'content' => "Créer une entreprise à l'étranger uniquement pour une activité en France n'aurait pas vraiment d'intérêt. Cela ne dispense pas",
        );

        //DUMMY TESTIMONIAL
        $testimonial1 = array(
            'name' => 'Patrick Sébastien',
            'photoUrl' => 'images/images_forum/face-1.png',
            'content' => "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who "
        );
        $testimonial2 = array(
            'name' => 'Patrick Sébastien',
            'photoUrl' => 'images/images_forum/face-2.png',
            'content' => "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who "
        );
        $testimonial3 = array(
            'name' => 'Patrick Sébastien',
            'photoUrl' => 'images/images_forum/face-3.png',
            'content' => "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who "
        );

        //DUMMY DATA
        $user = array(
            'name' => 'Julie',
            'messages' => rand(0,9)
        );
        $listing_extracts = array($service1, $service2, $service3);
        $categories = array($cat1, $cat2, $cat3, $cat4, $cat5, $cat6);
        $forum_posts = array($post1, $post2, $post3);
        $testimonials = array($testimonial1, $testimonial2, $testimonial3);

        return $this->render('V2/index.html.twig',[
            'title' => 'Entreprenons ensemble | Upsters',
            'listingExtracts' => $listing_extracts,
            'categories' => $categories,
            'forumPosts' => $forum_posts,
            'testimonials' => $testimonials
        ]);
    }
}