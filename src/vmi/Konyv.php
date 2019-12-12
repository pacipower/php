<?php


namespace vmi;


class Konyv
{
    private $cim;
    private $szerzo;
    private $kategoria;
    private $kiado;
    private $oldalak_szama;

    /**
     * @return mixed
     */
    public function getCim()
    {
        return $this->cim;
    }

    /**
     * @param mixed $cim
     */
    public function setCim($cim)
    {
        $this->cim = $cim;
    }

    /**
     * @return mixed
     */
    public function getSzerzo()
    {
        return $this->szerzo;
    }

    /**
     * @param mixed $szerzo
     */
    public function setSzerzo($szerzo)
    {
        $this->szerzo = $szerzo;
    }

    /**
     * @return mixed
     */
    public function getKategoria()
    {
        return $this->kategoria;
    }

    /**
     * @param mixed $kategoria
     */
    public function setKategoria($kategoria)
    {
        $this->kategoria = $kategoria;
    }

    /**
     * @return mixed
     */
    public function getKiado()
    {
        return $this->kiado;
    }

    /**
     * @param mixed $kiado
     */
    public function setKiado($kiado)
    {
        $this->kiado = $kiado;
    }

    /**
     * @return mixed
     */
    public function getOldalakSzama()
    {
        return $this->oldalak_szama;
    }

    /**
     * @param mixed $oldalak_szama
     */
    public function setOldalakSzama($oldalak_szama)
    {
        $this->oldalak_szama = $oldalak_szama;
    }
}