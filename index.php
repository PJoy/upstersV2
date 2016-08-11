<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 11/08/16
 * Time: 15:44
 */

?>
<html lang="fr">
<?php
/**
 * HEAD
 */
?>
<head>
    <title>Entreprenons ensemble | Upsters</title>
    <meta name="description" content="Annuaire entrepreueurial, les réseau social des startups, entreprenons ensemble !">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://use.fontawesome.com/1a855ebc8f.js"></script>
</head>

<?php
/**
 * BODY
 */
?>
<div class="container">
<section id="top-navbar">
    <div class="col-md-12">
        <div class="col-md-6">
            <!-- spacing -->
        </div>
        <div class="col-md-6">
            <div class="col-md-4" id="social-tab">
                <div class="col-md-4 text-center">
                    <i class="fa fa-facebook"></i>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fa fa-twitter"></i>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fa fa-comments"></i>
                </div>
            </div>
            <div class="col-md-4" id="notif-tab">
                <div class="col-md-4 text-center">
                    <i class="fa fa-bell"></i>
                </div>
                <div class="col-md-4 text-center">
                    <?php echo '<p>(4)</p>' ?>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fa fa-angle-up"></i>
                </div>
            </div>
            <div class="col-md-4 text-center" id="greet-tab">
                <?php echo '<p>Salut, <b>Julie</b></p>' ?>
            </div>
        </div>
    </div>
</section>
<section id="header">
    <div class="col-md-12">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#"><img src="assets/logo.png">
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Accueil</a></li>
                            <li><a href="#">Mon profil</a></li>
                            <li><a href="#">Médiathèque</a></li>
                            <li><a href="#">Recommander un prestataire</a></li>
                            <li><a href="#">Rechercher une startup</a></li>
                            <li><a href="#">Forum</a></li>
                        </ul>
                </div>
            </nav>
    </div>
</section>
<section id="map">
    <div class="col-md-12">
        <div class="col-md-8" id="search-form">
            <div style="position: relative; left: -50%;">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <input type="text"placeholder="Nom - Mot-clé">
            </div>
            <div class="col-md-4">
                <input type="text"placeholder="Ville">
            </div>
            <div class="col-md-3">
                <button class="btn orange-btn">Chercher</button>
            </div>
            <div class="col-md-1"></div>
            </div>
        </div>
    </div>
</section>
<section id="presentation">
    <div class="col-md-12">
        <div class="col-md-12 title-section">
            <h2>Que trouve-t-on sur Upsters ?</h2>
        </div>
        <div class="col-md-3 pres-item text-center">
            <i class="fa fa-5x fa-book"></i>
            <h3>Des prestataires qualifiés de confiance</h3>
            <p>Trouvez dans l'annuaire tous les prestataires dont vous avez besoin, triés
            selon les recommandations des entrepreneurs !</p>
        </div>
        <div class="col-md-3 pres-item text-center">
            <i class="fa fa-5x fa-building"></i>
            <h3>Toutes les ressources entrepreneuriales nécessaires</h3>
            <p>Participez à la médiathèque collaboratiqve en y inscivant les indispensables de l'entrepreneuriat !</p>
        </div>
        <div class="col-md-3 pres-item text-center">
            <i class="fa fa-5x fa-comments"></i>
            <h3>Un forum dédié à l'entrepreneuriat</h3>
            <p>Echangez entre entrepreneurs et profitez des réponses d'experts pour solutionner toutes vos questions !</p>
        </div>
        <div class="col-md-3 pres-item text-center">
            <i class="fa fa-5x fa-User"></i>
            <h3>Comparez-vous !</h3>
            <p>Qui se cache derrière chaque projet ? <br>
            Comparez votre personalité, le contexte dans lequel vous avez créé ou encore la vision de votre stratup !</p>
        </div>
        <div class="col-md-12 text-center" id="pres-cta">
            <button class="btn orange-btn">Je m'inscris</button>
        </div>
    </div>
</section>
<section id="listing-features">
    <div class="col-md-12">
        <div class="col-md-12 title-section">
            <h2>Extraits du listing</h2>
        </div>
        <div class="col-md-4 text-center">
            <div style="height: 150px"><p style="padding: 75px 0;">DUMMY CARD</p> </div>
        </div>
        <div class="col-md-4 text-center">
            <div style="height: 150px"><p style="padding: 75px 0;">DUMMY CARD</p> </div>
        </div>
        <div class="col-md-4 text-center">
            <div style="height: 150px"><p style="padding: 75px 0;">DUMMY CARD</p> </div>
        </div>
    </div>
</section>
<section id="categories">
    <div class="col-md-12">
        <div class="col-md-12 title-section">
            <h2>Retrouvez des professionels qualifiés</h2>
        </div>
        <div style="height: 250px;" class="text-center">
            <p style="padding-top: 100px">???</p>
        </div>

    </div>
</section>
<section id="medias">
    <div class="col-md-12 text-center" id="media-content">
        <div class="text-container">
        <i class="fa fa-5x fa-building"></i><br>
        <h2>Participez et profitez de la médiathèque</h2>
        <p><big>Trouvez une ressource utile pour vous : un article, un livre, un film...<br>
            Ajoutez les médias qui vous trouvez intéressants.</big></p>
        </div>
        <div class="btn-container">
        <div class="col-md-6">
            <button class="btn orange-btn-invert">Ajoutez un média</button>
        </div>
        <div class="col-md-6">
            <button class="btn orange-btn-invert">Consultez la médiathèque</button>
        </div>
        </div>
        <div class="layer">
        </div>

    </div>
</section>
<section id="news">
    <div class="col-md-12">
        <div class="col-md-12 title-section">
            <h2>Les news du forum</h2>
        </div>
        <div class="col-md-4 text-center">
            <div style="height: 150px"><p style="padding: 75px 0;">DUMMY CARD</p> </div>
        </div>
        <div class="col-md-4 text-center">
            <div style="height: 150px"><p style="padding: 75px 0;">DUMMY CARD</p> </div>
        </div>
        <div class="col-md-4 text-center">
            <div style="height: 150px"><p style="padding: 75px 0;">DUMMY CARD</p> </div>
        </div>

        <div class="col-md-12 text-center" id="btn-cta-container">
            <button class="btn orange-btn">Je m'inscris</button>
        </div>

    </div>
</section>
<section id="call-action">
    <div class="col-md-12 text-center">
        <div class="text-container">

        <h2>Vous proposez des services aux entrepreneurs ?</h2>
        <p><big>Enregistrez votre activité dans l'annuaire Upsters et faites vous recommander par des entrepreneurs</big></p>
</div>
        <div class="col-md-12 text-center" id="btn-cta-container">
            <button class="btn green-btn-invert">Enregistrez gratuitement votre activité</button>
        </div>
    </div>
</section>
<section id="testimonials">
    <div class="col-md-12">
        <div class="col-md-12 title-section">
            <h2>Ce qu'ils en disent</h2>
        </div>
        <div class="col-md-12" style="height: 45px">
            BLAH
        </div>
        <div class="col-md-12" style="height: 45px">
            BLAH
        </div>
        <div class="col-md-12" style="height: 45px">
            BLAH
        </div>
    </div>
</section>
<section id="footer">
    <div class="col-md-12 text-center">
        Upsters - Tous droits réservés<br>
        peace yo
    </div>
</section>
</div>
<?php
/**
 * SCRIPTS
 */
?>
<link href="style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</html>