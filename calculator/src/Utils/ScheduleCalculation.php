<?php
/**
 * Created by PhpStorm.
 * User: zakirovigor
 * Date: 05.05.2018
 * Time: 6:29
 */

namespace App\Utils;


use App\Entity\Calculation;
use App\Entity\RepaymentSchedule;
use DateInterval;

class ScheduleCalculation
{
    /**
     * @param Calculation $calculation
     * @return \Generator|RepaymentSchedule[]
     */
    public function make(Calculation $calculation): \Generator
    {
        $lastRemainingDebt = $calculation->getSum();
        $monthPayment = $this->getMonthPayment($calculation);
        for ($i = 1; $i <= $calculation->getMonths(); $i++) {
            $repaymentSchedule = new RepaymentSchedule();

            $repaymentSchedule->setGeneralSum($monthPayment);
            $repaymentSchedule->setIdCalculation($calculation);
            $intervalSpec = sprintf('P%dM', $i);
            try {
                $repaymentSchedule->setRepaymentDate($calculation->getFirstPaymentDate()->add(new DateInterval($intervalSpec)));
            }
            catch (\Exception $e) {
                //pass
            }
            $repaymentSchedule->setRepaymentIndex($i);
            $repaymentSchedule->setPercent($lastRemainingDebt * $calculation->getRate() / 100 / 12);
            $repaymentSchedule->setMainDebt($monthPayment - $repaymentSchedule->getPercent());
            $repaymentSchedule->setRemainingDebt($lastRemainingDebt);
            $lastMainDebt = $repaymentSchedule->getMainDebt();
            $lastRemainingDebt -= $lastMainDebt;

            yield $repaymentSchedule;
        }
    }

    private function getMonthPayment(Calculation $calculation): float
    {
        $monthRate = $calculation->getRate() / 100 / 12;
        return $calculation->getSum() *
            ($monthRate + ($monthRate / (((1 + $monthRate) ** $calculation->getMonths()) - 1)));
    }
}