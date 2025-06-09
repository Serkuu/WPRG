<?php

class NoweAuto
{
    protected string $modelAuta;
    protected float $cenaEuro;
    protected float $aktualnyKursEuroPln;

    public function __construct(string $modelAuta, float $cenaEuro, float $aktualnyKursEuroPln)
    {
        $this->modelAuta = $modelAuta;
        $this->cenaEuro = $cenaEuro;
        $this->aktualnyKursEuroPln = $aktualnyKursEuroPln;
    }

    public function obliczCene(): float
    {
        return $this->cenaEuro * $this->aktualnyKursEuroPln;
    }
}

class AutoZDodatkami extends NoweAuto
{
    private float $alarm;
    private float $radio;
    private float $klimatyzacja;

    public function __construct(string $modelAuta, float $cenaEuro, float $aktualnyKursEuroPln, float $alarm, float $radio, float $klimatyzacja)
    {
        parent::__construct($modelAuta, $cenaEuro, $aktualnyKursEuroPln);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klimatyzacja = $klimatyzacja;
    }

    public function obliczCene(): float
    {
        $cenaPodstawowa = parent::obliczCene();
        $dodatki = $this->alarm + $this->radio + $this->klimatyzacja;

        return $cenaPodstawowa + $dodatki;
    }
}

class Ubezpieczenie extends AutoZDodatkami
{
    private float $procentWartosciUbezpieczenia;
    private int $liczbaLat;

    public function __construct(
        string $modelAuta,
        float $cenaEuro,
        float $aktualnyKursEuroPln,
        float $alarm,
        float $radio,
        float $klimatyzacja,
        float $procentWartosciUbezpieczenia,
        int $liczbaLat
    ) {
        parent::__construct($modelAuta, $cenaEuro, $aktualnyKursEuroPln, $alarm, $radio, $klimatyzacja);
        $this->procentWartosciUbezpieczenia = $procentWartosciUbezpieczenia;
        $this->liczbaLat = $liczbaLat;
    }

    public function obliczCene(): float
    {
        $cenaAutaZDodatkami = parent::obliczCene();
        $wartoscUbezpieczenia = $this->procentWartosciUbezpieczenia * ($cenaAutaZDodatkami * ((100 - $this->liczbaLat) / 100));

        return $cenaAutaZDodatkami + $wartoscUbezpieczenia;
    }
}

$auto = new Ubezpieczenie("Model X", 30000, 4.5, 500, 300, 700, 0.05, 3);

echo "Cena całkowita auta: " . $auto->obliczCene() . " PLN";
