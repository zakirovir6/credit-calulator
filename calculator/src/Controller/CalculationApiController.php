<?php

namespace App\Controller;

use App\Entity\Calculation;
use App\Kernel;
use App\Utils\ScheduleCalculation;
use Enqueue\Client\ProducerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;

class CalculationApiController extends Controller
{
    /**
     * @Route("/api", name="calculation_api", methods="POST")
     * @param Request $request
     * @param ScheduleCalculation $scheduleCalculation
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception
     */
    public function index(Request $request, ScheduleCalculation $scheduleCalculation): JsonResponse
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->json(['error' => 'there was an error during request'], 400);
        }

        $calculation = new Calculation();
        $calculation->setSum((float)$request->get('sum'));
        $firstPaymentDate = new \DateTimeImmutable($request->get('first_payment_date'));
        $calculation->setFirstPaymentDate($firstPaymentDate);
        $calculation->setMonths((int)$request->get('months'));
        $calculation->setRate((float)$request->get('rate'));

        /** @var ValidatorInterface $validator */
        $validator = $this->get('validator');
        $errors = $validator->validate($calculation);
        if (\count($errors)) {
            return $this->json(['error' => (string)$errors], 400);
        }

        $data = [];
        foreach ($scheduleCalculation->make($calculation) as $repaymentSchedule) {
            $type = '';
            switch ($repaymentSchedule->getTypePayment()) {
                case $repaymentSchedule::TYPE_PAYMENT_ANNUITY:
                    $type = 'Аннуитентный';
                    break;
                case $repaymentSchedule::TYPE_PAYMENT_DIFFERENTIAL:
                    $type = 'Дифференцированный';
                    break;
            }
            $data[] = [
                'repayment_index' => $repaymentSchedule->getRepaymentIndex(),
                'repayment_date' => $repaymentSchedule->getRepaymentDate()->format('d.m.Y'),
                'main_debt' => number_format($repaymentSchedule->getMainDebt(), 2, ',', ' '),
                'percent' => number_format($repaymentSchedule->getPercent(), 2, ',', ' '),
                'general_sum' => number_format($repaymentSchedule->getGeneralSum(), 2, ',', ' '),
                'remaining_debt' => number_format($repaymentSchedule->getRemainingDebt(), 2, ',', ' '),
                'type' => $type
            ];
        }

        /** @var EventDispatcher $dispatcher */
        $dispatcher = $this->get('event_dispatcher');
        $dispatcher->addListener(KernelEvents::TERMINATE, \Closure::bind(function(PostResponseEvent $event) use ($scheduleCalculation, $calculation) {
            /** @var ProducerInterface $producer */
            $producer = $this->get(ProducerInterface::class);

            $message = [
                'type_payment' => $calculation->getTypePayment(),
                'rate' => $calculation->getRate(),
                'sum' => $calculation->getSum(),
                'first_payment_date_timestamp' => $calculation->getFirstPaymentDate()->getTimestamp(),
                'months' => $calculation->getMonths()
            ];

            $producer->sendEvent('calculation.save', json_encode($message));
        }, $this));

        return $this->json(['error' => '', 'data' => $data]);
    }
}
