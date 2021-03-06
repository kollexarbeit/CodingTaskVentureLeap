<?php 
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Validator\Constraints as Assert;
use App\Config\EventType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Doctrine\ORM\Mapping as ORM;


/**
 * An event 
 * 
 * @ORM\Entity
 * 
 * */
#[
    ApiResource,
    ApiFilter(
        SearchFilter::class,
        properties: ['type' => SearchFilter::STRATEGY_EXACT]
    )
]
class Event {

    /** 
     * The id of the event 
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
    */
    private ?int $id = null;
    
    /** 
     * Time created
     * 
     * @ORM\Column(name="time_created", type="datetime")
    */
    #[Assert\NotNull]
    public ?\DateTimeInterface $timeCreated = null;

    /**
     * Time recorded
     * 
     * @ORM\Column(name="time_recorded", type="datetime")
    */
    private ?\DateTimeInterface $timeRecorded = null;

    /** 
     * Type: enum("info", "warning", "error") 
     * 
     * @ORM\Column(length=7)
    */
    #[Assert\Regex(
        pattern: '/info|warning|error/',
        message: 'Event type may only be "info", "warning", or "error"'
    )]
    public ?string $type;

    /** 
     * Event info
     * 
     * @ORM\Column(type="text")
     */
    #[Assert\NotBlank]
    public $details;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimeRecorded(): \DateTime
    {
        return $this->timeRecorded;
    }    

    public function __construct() {
        $this -> timeRecorded = new \DateTime();
    }
}

?>