<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CalculationRepository")
 */
class Calculation
{
    public const TYPE_PAYMENT_ANNUITY = 1;
    public const TYPE_PAYMENT_DIFFERENTIAL = 2;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\Choice({1, 2})
     * @Assert\NotBlank()
     */
    private $type_payment = self::TYPE_PAYMENT_ANNUITY;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThan(0)
     * @Assert\LessThan(240)
     * @Assert\NotBlank()
     */
    private $months;

    /**
     * @ORM\Column(type="float")
     * @Assert\GreaterThan(0)
     * @Assert\NotBlank()
     */
    private $rate;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $first_payment_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RepaymentSchedule", mappedBy="id_calculation", orphanRemoval=true)
     */
    private $repaymentSchedules;

    /**
     * @ORM\Column(type="float")
     * @Assert\GreaterThan(0)
     * @Assert\NotBlank()
     */
    private $sum;

    public function __construct()
    {
        $this->repaymentSchedules = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTypePayment(): ?int
    {
        return $this->type_payment;
    }

    public function setTypePayment(int $type_payment): self
    {
        $this->type_payment = $type_payment;

        return $this;
    }

    public function getMonths(): ?int
    {
        return $this->months;
    }

    public function setMonths(int $months): self
    {
        $this->months = $months;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getFirstPaymentDate(): \DateTimeImmutable
    {
        return $this->first_payment_date;
    }

    public function setFirstPaymentDate(\DateTimeImmutable $first_payment_date): self
    {
        $this->first_payment_date = $first_payment_date;

        return $this;
    }

    /**
     * @return Collection|RepaymentSchedule[]
     */
    public function getRepaymentSchedules(): Collection
    {
        return $this->repaymentSchedules;
    }

    public function addRepaymentSchedule(RepaymentSchedule $repaymentSchedule): self
    {
        if (!$this->repaymentSchedules->contains($repaymentSchedule)) {
            $this->repaymentSchedules[] = $repaymentSchedule;
            $repaymentSchedule->setIdCalculation($this);
        }

        return $this;
    }

    public function removeRepaymentSchedule(RepaymentSchedule $repaymentSchedule): self
    {
        if ($this->repaymentSchedules->contains($repaymentSchedule)) {
            $this->repaymentSchedules->removeElement($repaymentSchedule);
            // set the owning side to null (unless already changed)
            if ($repaymentSchedule->getIdCalculation() === $this) {
                $repaymentSchedule->setIdCalculation(null);
            }
        }

        return $this;
    }

    public function getSum(): ?float
    {
        return $this->sum;
    }

    public function setSum(float $sum): self
    {
        $this->sum = $sum;

        return $this;
    }
}
