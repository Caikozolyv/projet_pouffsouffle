<?php

namespace App\Entity;



class PropertySearch{

    /**
     * @var string|null
     *
     */

    private $listeCampus;

    /**
     * @var int|null
     *
     */

    private $dateMin;

    /**
     * @var string|null
     *
     */

    private $dateMax;

    /**
     * @var string|null
     *
     */

    private $search;

    /**
     * @var bool|null
     *
     */

    private $checkbox;

    /**
     * @return string|null
     */
    public function getlisteCampus(): ?string
    {
        return $this->listeCampus;
    }

    /**
     * @param string|null $listeCampus
     * @return PropertySearch
     */
    public function setlisteCampus(?string $listeCampus): PropertySearch
    {
        $this->listeCampus = $listeCampus;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDateMin(): ?int
    {
        return $this->dateMin;
    }

    /**
     * @param int|null $dateMin
     * @return PropertySearch
     */
    public function setDateMin(?int $dateMin): PropertySearch
    {
        $this->dateMin = $dateMin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateMax(): ?string
    {
        return $this->dateMax;
    }

    /**
     * @param string|null $dateMax
     * @return PropertySearch
     */
    public function setDateMax(?string $dateMax): PropertySearch
    {
        $this->dateMax = $dateMax;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * @param string|null $search
     * @return PropertySearch
     */
    public function setSearch(?string $search): PropertySearch
    {
        $this->search = $search;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCheckbox(): ?bool
    {
        return $this->checkbox;
    }

    /**
     * @param bool|null $checkbox
     * @return PropertySearch
     */
    public function setCheckbox(?bool $checkbox): PropertySearch
    {
        $this->checkbox = $checkbox;
        return $this;
    }




}