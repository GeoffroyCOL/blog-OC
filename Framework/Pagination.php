<?php

namespace Framework;

class Pagination
{
    private int $numberPerPost; // Le nombre de post par page
    private int $numeroPage; // Le numero de la page
    private int $numberPost; // Le nombre total de post
    private int $numberPage; // Le nombre de page
    private string $url;

    public function setParams(int $numberPerPost, int $numeroPage, int $numberPost, string $url)
    {
        $this->numeroPage = $numeroPage;
        $this->numberPerPost = $numberPerPost;
        $this->numberPost = $numberPost;
        $this->url = $url;

        $this->setNumberPage();
    }
    
    /**
     * setNumberPage
     *
     * @return void
     */
    private function setNumberPage()
    {
        $number = intdiv($this->numberPost, $this->numberPerPost);
        $this->numberPage = $this->numberPost % $this->numberPerPost < 0 ? $number : $number + 1;
    }
    
    /**
     * generateHTML
     *
     * @return string
     */
    public function generateHTML(): string
    {
        if ($this->numberPage == 1) {
            return '';
        }

        $html = '<nav>';
        $html .= '<div><ul>';

        if ($this->numeroPage !== 1) {
            $html .= '<li><a href="' . $this->url . '?page=' . ($this->numeroPage - 1) . '">Précédent</a></li>';
        }

        for ($compteur = 1; $compteur <= $this->numberPage; $compteur++) {
            if ($compteur === $this->numeroPage) {
                $html .= '<li class="active"><span>'. $compteur .'</span></li>';
            } else {
                $html .= '<li><a href="' . $this->url . '?page=' . $compteur . '">'. $compteur .'</a></li>';
            }
        }

        if ($this->numeroPage !== $this->numberPage) {
            $html .= '<li><a href="' . $this->url . '?page=' . ($this->numeroPage + 1) . '">Suivant</a></li></ul></div>';
        }

        $html .= '</nav>';

        return $html;
    }
}
