<?php

define('__ROOT__', dirname(__DIR__));

use Framework\Session\MessageFlash;

/**
 * escHtml
 *
 * @param  mixed $str
 * @return void
 */
function escHtml(string $str)
{
    print_r(filter_var($str, FILTER_UNSAFE_RAW));
}

/**
 * escUrl
 *
 * @param  mixed $url
 * @return void
 */
function escUrl(string $url)
{
    print_r(filter_var($url, FILTER_SANITIZE_URL));
}

/**
 * pathImage
 *
 * @param  mixed $path
 * @return void
 */
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
function activeNavigation(string $menu, string $page): string
{
    if (preg_match('#'. $menu .'#', $page)) {
        return 'active';
    }

    return '';
}

//Message flash
require_once '../Framework/Session/MessageFlash.php';
require_once '../Framework/Session/Session.php';

/**
 * showMessageFlash
 *
 * @return array|null
 */
function showMessageFlash(): ?array
{
    return (new MessageFlash)->get('flash');
}

/**
 * limite_mot
 *
 * @param  string $chaine
 * @param  int $max
 * @return string
 */
function limite_mot(string $chaine, int $max=10): string
{
    // on enlève les balises html
    $chaine = strip_tags($chaine);

    // on casse la chaine par les espaces et retourne un array avec chaque mot
    $expl = explode(" ", $chaine);

    // si l'array est plus grand que la valeur max
    if (count($expl) >= $max) {
        $ident = 0;
        $chaine = "";

        // on boucle pour n'afficher que le nombre souhaité
        while ($ident < $max) {
            // on ajoute le mot suivi d'un espace à la variable
            $chaine.= $expl[$ident]." ";
            $ident++;
        }
    }
    return $chaine . ' ...'; // on affiche la chaine
}

