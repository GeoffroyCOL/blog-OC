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
        $this->numberPage = $this->numberPost % $this->numberPerPost <= 0 ? $number : $number + 1;
    }
    
    /**
     * generateHTML
     *
     * @return string
     */
    public function generateHTML(): string
    {
        if ($this->numberPage == 0) {
            return '';
        }

        $html = '<nav class="mt-3" aria-label="Page navigation"><ul class="pagination justify-content-center justify-content-md-start">';

        if ($this->numeroPage !== 1) {
            $html .= '<li class="page-item">
                <a aria-label="Previous" class="page-link" href="' . $this->url . '?page=' . ($this->numeroPage - 1) . '"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($compteur = 1; $compteur <= $this->numberPage; $compteur++) {
            if ($compteur === $this->numeroPage) {
                $html .= '<li class="page-item active"><a class="page-link">'. $compteur .'</a></li>';
            } else {
                $html .= '<li class="page-item"><a class="page-link" href="' . $this->url . '?page=' . $compteur . '">'. $compteur .'</a></li>';
            }
        }

        if ($this->numeroPage !== $this->numberPage) {
            $html .= '<li class="page-item">
                <a aria-label="Next" class="page-link" href="' . $this->url . '?page=' . ($this->numeroPage + 1) . '"><span aria-hidden="true">&raquo;</span></a></li>';
        }

        $html .= '</ul></nav>';

        return $html;
    }
}
