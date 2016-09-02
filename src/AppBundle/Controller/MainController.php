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
        $pitch1 = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
        $service1 = array(
            'name' => 'Jean-Marie Bigard',
            'category' => 'comptabilite',
            'categoryName' => 'Comptablité',
            'photoUrl' => 'images/bigard.png',
            'pitch' => $pitch1,
            'recom' => rand(1,99)
        );

        //DUMMY CATEGORY
        $cat1 = array(
            'name' => 'coworking',
            'displayName' => 'Coworking',
            'pitch' => 'Trouvez les espaces de coworking les plus appréciés des entrepreneurs dans votre secteur.'
        );
        $cat2 = array(
            'name' => 'comptabilite',
            'displayName' => 'Comptabilité',
            'pitch' => 'TTrouvez la personne qu’il vous faut pour cajoler vos finances'
        );
        $cat3 = array(
            'name' => 'autres',
            'displayName' => 'Prototypage',
            'pitch' => 'Réalisez un exemplaire de votre produit, qu’il soit électronique, plastique, mécanique, ...'
        );
        $cat4 = array(
            'name' => 'juridique',
            'displayName' => 'Juridique',
            'pitch' => 'Trouvez l’expert qui éclairera enfin vos démarches juridiques avec ses conseils bienvenus.'
        );
        $cat5 = array(
            'name' => 'marketing',
            'displayName' => 'Marketing',
            'pitch' => 'Exister online ou offline n’est pas du tout évident ! Place aux professionnels du Marketing.'
        );
        $cat6 = array(
            'name' => 'graphisme',
            'displayName' => 'Web Design',
            'pitch' => 'Trouvez ici les développeurs, designers, et graphistes les plus aimés des entrepreneurs.'
        );

        //DUMMY FORUM POST
        $post1 = array(
            'title' => 'Titre de la conversation',
            'date' => '01/01/2017',
            'name' => 'Jean Dujardin',
            'photoUrl' => 'images/images_forum/face-1.png',
            'content' => "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. ",
        );
        $post2 = array(
            'title' => 'Titre de la conversation',
            'date' => '01/01/2017',
            'name' => 'Jean Dujardin',
            'photoUrl' => 'images/images_forum/face-2.png',
            'content' => "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. ",
        );
        $post3 = array(
            'title' => 'Titre de la conversation',
            'date' => '01/01/2017',
            'name' => 'Jean Dujardin',
            'photoUrl' => 'images/images_forum/face-3.png',
            'content' => "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. ",
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
        $listing_extracts = array($service1, $service1, $service1);
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