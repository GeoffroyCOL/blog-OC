<?php

define('__ROOT__', dirname(__DIR__));

use Framework\Session\MessageFlash;

function escHtml(string $str)
{
    print_r(filter_var($str, FILTER_UNSAFE_RAW));
}

function escUrl(string $url)
{
    print_r(filter_var($url, FILTER_SANITIZE_URL));
}

function pathImage(string $path)
{
    print_r(filter_var('..' . $path, FILTER_SANITIZE_URL));
}

/**
 * activeNavigation
 *
 * Ajoute active à la class de la navigation
 *
 * @param  string $menu
 * @param  string $page
 * @return string
 */
function activeNavigation(string $menu, string $page)
{
    if (preg_match('#'. $menu .'#', $page)) {
        return 'active';
    }

    return '';
}

//Message flash
require_once '../Framework/Session/MessageFlash.php';
require_once '../Framework/Session/Session.php';

function showMessageFlash()
{
    return (new MessageFlash)->get('flash');
}

function limite_mot($chaine, $max=10)
{
    // on enlève les balises html
    $chaine = strip_tags($chaine);

    // on casse la chaine par les espaces et retourne un array avec chaque mot
    $expl = explode(" ", $chaine);

    // si l'array est plus grand que la valeur max
    if (count($expl) >= $max) {
        $i = 0;
        $chaine = "";

        // on boucle pour n'afficher que le nombre souhaité
        while ($i < $max) {
            // on ajoute le mot suivi d'un espace à la variable
            $chaine.= $expl[$i]." ";
            $i++;
        }
    }
    return $chaine . ' ...'; // on affiche la chaine
}

