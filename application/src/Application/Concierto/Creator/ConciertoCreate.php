<?php declare(strict_types=1);

namespace App\Application\Concierto\Creator;

use App\Domain\Bus\DomainBus;
use App\Domain\Concierto\Concierto;
use App\Domain\Concierto\ConciertoRepository;
use App\Domain\Exception\DateFormatException;
use App\Domain\Exception\FieldRequiredException;
use App\Domain\Grupo\GrupoNotFoundException;
use App\Domain\Grupo\GrupoRepository;
use App\Domain\MedioPublicitario\MedioNotFoundException;
use App\Domain\MedioPublicitario\MedioPublicitarioRepository;
use App\Domain\Promotor\Promotor;
use App\Domain\Promotor\PromotorNotFoundException;
use App\Domain\Promotor\PromotorRepository;
use App\Domain\Recinto\Recinto;
use App\Domain\Recinto\RecintoNotFoundException;
use App\Domain\Recinto\RecintoRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ConciertoCreate extends AbstractController
{
    private const DATE_INPUT_FORMAT = 'd/m/Y';
    //
    private const NOMBRE_JSON_KEY = 'nombre';
    private const FECHA_JSON_KEY = 'fecha';
    private const ESPECTADORES_JSON_KEY = 'numero_espectadores';
    private const PROMOTOR_JSON_KEY = 'promotor_id';
    private const RECINTO_JSON_KEY = 'recinto_id';
    private const GRUPOS_JSON_KEY = 'grupos';
    private const MEDIOS_JSON_KEY = 'medios';
    //
    private const FIELD_REQUIRED = "%s es obligatorio";
    private const DATE_FORMAT_ERROR = 'Formato de fecha incorrecto';
    private const PROMOTOR_NOT_FOUND_ERROR = 'No se ha localizado el promotor';
    private const RECINTO_NOT_FOUND_ERROR = 'Recinto no encontrado';
    private const GRUPO_NOT_FOUND = 'No se ha encontrado el grupo';
    private const MEDIO_NOT_FOUND = 'Medio no encontrado';

    private ConciertoRepository $repoConcierto;
    private RecintoRepository $repoRecinto;
    private GrupoRepository $repoGrupo;
    private PromotorRepository $repoPromotor;
    private MedioPublicitarioRepository $repoMedio;
    private DomainBus $domainBus;

    public function __construct(
        ConciertoRepository $repoConcierto,
        RecintoRepository $repoRecinto,
        GrupoRepository $repoGrupo,
        PromotorRepository $repoPromotor,
        MedioPublicitarioRepository $repoMedio,
        DomainBus $domainBus
    ) {
        $this->repoConcierto = $repoConcierto;
        $this->repoRecinto = $repoRecinto;
        $this->repoGrupo = $repoGrupo;
        $this->repoPromotor = $repoPromotor;
        $this->repoMedio = $repoMedio;
        $this->domainBus = $domainBus;
    }

    public function dispatch(array $conciertoData): void
    {
        $nombre = (string) $this->getValue($conciertoData, self::NOMBRE_JSON_KEY);
        $numeroEspectadores = (int) $this->getValue($conciertoData, self::ESPECTADORES_JSON_KEY, 0);
        $fechaInput = (string) $this->getValue($conciertoData, self::FECHA_JSON_KEY);
        $promotorId = (string) $this->getValue($conciertoData, self::PROMOTOR_JSON_KEY);
        $recintoId = (string) $this->getValue($conciertoData, self::RECINTO_JSON_KEY);
        $grupoList = (array) $this->getValue($conciertoData, self::GRUPOS_JSON_KEY, []);
        $medioList = (array) $this->getValue($conciertoData, self::MEDIOS_JSON_KEY, []);

        $fecha = $this->getValidDateOrFail($fechaInput);
        $promotor = $this->getValidPromotorOrFail($promotorId);
        $recinto = $this->getValidRecintoOrFail($recintoId);
        $grupos = $this->getValidGruposOrFail($grupoList);
        $medios = $this->getValidMediosOrFail($medioList);

        $newConcierto = new Concierto($nombre, $promotor, $recinto, $numeroEspectadores, $fecha, $grupos, $medios);
        $this->repoConcierto->save($newConcierto);

        $this->domainBus->dispatch(new ConciertoCreatedEvent($newConcierto));
    }

    /**
     * @param  ?mixed $default  !null is optional
     * @return mixed
     */
    private function getValue(array $data, string $key, $default = null)
    {
        if (!array_key_exists($key, $data)) {
            if (null === $default) {
                throw new FieldRequiredException(sprintf(self::FIELD_REQUIRED, $key));
            }
            return $default;
        }
        return $data[$key];
    }

    private function getValidDateOrFail(string $dateValue): DateTimeImmutable
    {
        $date = DateTimeImmutable::createFromFormat(self::DATE_INPUT_FORMAT, $dateValue);
        if (false === $date) {
            throw new DateFormatException(self::DATE_FORMAT_ERROR);
        }
        return $date;
    }

    private function getValidPromotorOrFail(string $promotorId): Promotor
    {
        $promotor = $this->repoPromotor->obtainById($promotorId);
        if (null === $promotor) {
            throw new PromotorNotFoundException(self::PROMOTOR_NOT_FOUND_ERROR);
        }
        return $promotor;
    }

    private function getValidRecintoOrFail(string $recintoId): Recinto
    {
        $recinto = $this->repoRecinto->obtainById($recintoId);
        if (null === $recinto) {
            throw new RecintoNotFoundException(self::RECINTO_NOT_FOUND_ERROR);
        }
        return $recinto;
    }

    private function getValidGruposOrFail(array $grupos): array
    {
        $validGrupos = [];
        foreach ($grupos as $grupoId) {
            $grupoFound = $this->repoGrupo->obtainById($grupoId);
            if (null === $grupoFound) {
                throw new GrupoNotFoundException(self::GRUPO_NOT_FOUND);
            }
            $validGrupos[] = $grupoFound;
        }
        return $validGrupos;
    }

    private function getValidMediosOrFail(array $medios): array
    {
        $validMedios = [];
        foreach ($medios as $medioId) {
            $medioFound = $this->repoMedio->obtainById($medioId);
            if (null === $medioFound) {
                throw new MedioNotFoundException(self::MEDIO_NOT_FOUND);
            }
            $validMedios[] = $medioFound;
        }
        return $validMedios;
    }
}