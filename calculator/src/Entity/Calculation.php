<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CalculationRepository")
 */
class Calculation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type_payment;

    /**
     * @ORM\Column(type="integer")
     */
    private $months;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    /**
     * @ORM\Column(type="date")
     */
    private $first_payment_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RepaymentSchedule", mappedBy="id_calculation", orphanRemoval=true)
     */
    private $repaymentSchedules;

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

    public function getFirstPaymentDate(): ?\DateTimeInterface
    {
        return $this->first_payment_date;
    }

    public function setFirstPaymentDate(\DateTimeInterface $first_payment_date): self
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
}
