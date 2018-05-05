<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RepaymentScheduleRepository")
 */
class RepaymentSchedule
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Calculation", inversedBy="repaymentSchedules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_calculation;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type_payment = self::TYPE_PAYMENT_ANNUITY;

    /**
     * @ORM\Column(type="integer")
     */
    private $repayment_index;

    /**
     * @ORM\Column(type="date")
     */
    private $repayment_date;

    /**
     * @ORM\Column(type="float")
     */
    private $main_debt;

    /**
     * @ORM\Column(type="float")
     */
    private $percent;

    /**
     * @ORM\Column(type="float")
     */
    private $general_sum;

    /**
     * @ORM\Column(type="float")
     */
    private $remaining_debt;

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

    public function getIdCalculation(): ?Calculation
    {
        return $this->id_calculation;
    }

    public function setIdCalculation(?Calculation $id_calculation): self
    {
        $this->id_calculation = $id_calculation;

        return $this;
    }

    public function getRepaymentIndex(): ?int
    {
        return $this->repayment_index;
    }

    public function setRepaymentIndex(int $repayment_index): self
    {
        $this->repayment_index = $repayment_index;

        return $this;
    }

    public function getRepaymentDate(): ?\DateTimeInterface
    {
        return $this->repayment_date;
    }

    public function setRepaymentDate(\DateTimeInterface $repayment_date): self
    {
        $this->repayment_date = $repayment_date;

        return $this;
    }

    public function getMainDebt(): ?float
    {
        return $this->main_debt;
    }

    public function setMainDebt(float $main_debt): self
    {
        $this->main_debt = $main_debt;

        return $this;
    }

    public function getPercent(): ?float
    {
        return $this->percent;
    }

    public function setPercent(float $percent): self
    {
        $this->percent = $percent;

        return $this;
    }

    public function getGeneralSum(): ?float
    {
        return $this->general_sum;
    }

    public function setGeneralSum(float $general_sum): self
    {
        $this->general_sum = $general_sum;

        return $this;
    }

    public function getRemainingDebt(): ?float
    {
        return $this->remaining_debt;
    }

    public function setRemainingDebt(float $remaining_debt): self
    {
        $this->remaining_debt = $remaining_debt;

        return $this;
    }
}
