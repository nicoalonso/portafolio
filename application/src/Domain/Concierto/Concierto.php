<?php declare(strict_types=1);

namespace App\Domain\Concierto;

use App\Domain\Grupo\Grupo;
use App\Domain\MedioPublicitario\MedioPublicitario;
use App\Domain\Promotor\Promotor;
use App\Domain\Recinto\Recinto;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;

class Concierto
{
    private const GRUPO_COMISSION_PERCENT = 0.1;

    private ConciertoId $id;
    private string $nombre;
    private Promotor $promotor;
    private Recinto $recinto;
    private int $numeroEspectadores;
    private DateTimeImmutable $fecha;
    private int $rentabilidad;

    /** @var Grupo[] */
    private $grupos;
    /** @var MedioPublicitario[] */
    private $medios;

    public function __construct(
        string $nombre,
        Promotor $promotor,
        Recinto $recinto,
        int $numeroEspectadores,
        DateTimeImmutable $fecha,
        array $grupoList = [],
        array $medioList = []
    ) {
        $this->id = ConciertoId::generate();
        $this->nombre = $nombre;
        $this->promotor = $promotor;
        $this->recinto = $recinto;
        $this->numeroEspectadores = $numeroEspectadores;
        $this->fecha = $fecha;
        $this->rentabilidad = 0;

        $this->grupos = new ArrayCollection();
        $this->medios = new ArrayCollection();

        foreach ($grupoList as $grupo) {
            $this->grupos[] = $grupo;
        }
        foreach ($medioList as $medio) {
            $this->medios[] = $medio;
        }
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public function rentabilidad(): int
    {
        $gastos = $this->calcGastos();
        $beneficios = $this->calcBeneficios();
        $this->rentabilidad = $beneficios - $gastos;
        return $this->rentabilidad;
    }

    public function calcGastos(): int
    {
        $gastos = $this->recinto->costeAlquiler();
        $beneficios = $this->calcBeneficios();

        foreach ($this->grupos as $grupo) {
            $gastoGrupo = $grupo->cache() + ($beneficios * self::GRUPO_COMISSION_PERCENT);
            $gastos += $gastoGrupo;
        }
        return (int) $gastos;
    }

    public function calcBeneficios(): int
    {
        return $this->numeroEspectadores * $this->recinto->precioEntrada();
    }

    public function addGrupo(Grupo $grupo): void
    {
        $this->grupos[] = $grupo;
    }

    public function addMedio(MedioPublicitario $medio): void
    {
        $this->medios[] = $medio;
    }

    public function id(): string
    {
        return (string) $this->id;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function promotor(): Promotor
    {
        return $this->promotor;
    }

    public function recinto(): Recinto
    {
        return $this->recinto;
    }

    public function numeroEspectadores(): int
    {
        return $this->numeroEspectadores;
    }

    public function fecha(): DateTimeImmutable
    {
        return $this->fecha;
    }

    public function fechaWithFormat(string $format = DATE_ATOM): string
    {
        return $this->fecha->format($format);
    }

    public function grupos(): array
    {
        return $this->grupos->toArray();
    }

    public function medios(): array
    {
        return $this->medios->toArray();
    }
}