<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


class SearchSortie {

    /**
     * @ORM\Column(type="string", length=150)
     */

    private $listeCampus;


    /**
     * @ORM\Column(type="array", length=150)
     */

    private $checkbox;

    /**
     * @ORM\Column(type="string", length=150)
     */

    private $searchBar;

    /**
     * @ORM\Column(type="date")
     */

    private $dateMin;

    /**
     * @ORM\Column(type="date")
     */

    private $dateMax;

    /**
     * @return mixed
     */
    public function getListeCampus()
    {
        return $this->listeCampus;
    }

    /**
     * @param mixed $listeCampus
     * @return SearchSortie
     */
    public function setListeCampus($listeCampus)
    {
        $this->listeCampus = $listeCampus;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCheckbox()
    {
        return $this->checkbox;
    }

    /**
     * @param mixed $checkbox
     * @return SearchSortie
     */
    public function setCheckbox($checkbox)
    {
        $this->checkbox = $checkbox;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSearchBar()
    {
        return $this->searchBar;
    }

    /**
     * @param mixed $searchBar
     * @return SearchSortie
     */
    public function setSearchBar($searchBar)
    {
        $this->searchBar = $searchBar;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateMin()
    {
        return $this->dateMin;
    }

    /**
     * @param mixed $dateMin
     * @return SearchSortie
     */
    public function setDateMin($dateMin)
    {
        $this->dateMin = $dateMin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateMax()
    {
        return $this->dateMax;
    }

    /**
     * @param mixed $dateMax
     * @return SearchSortie
     */
    public function setDateMax($dateMax)
    {
        $this->dateMax = $dateMax;
        return $this;
    }






}