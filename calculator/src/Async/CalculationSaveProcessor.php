<?php
/**
 * Created by PhpStorm.
 * User: zakirovigor
 * Date: 06.05.2018
 * Time: 1:04
 */

namespace App\Async;


use App\Entity\Calculation;
use App\Utils\ScheduleCalculation;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Enqueue\Client\TopicSubscriberInterface;
use Interop\Queue\PsrContext;
use Interop\Queue\PsrMessage;
use Interop\Queue\PsrProcessor;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CalculationSaveProcessor implements PsrProcessor, TopicSubscriberInterface
{
    /** @var ContainerInterface */
    private $container;
    /** @var LoggerInterface */
    private $logger;
    /** @var ScheduleCalculation */
    private $scheduleCalculation;

    public function __construct(ContainerInterface $container, LoggerInterface $logger, ScheduleCalculation $scheduleCalculation)
    {
        $this->logger = $logger;
        $this->container = $container;
        $this->scheduleCalculation = $scheduleCalculation;
    }

    /**
     * @param PsrMessage $message
     * @param PsrContext $context
     * @return object|string
     * @throws \Exception
     */
    public function process(PsrMessage $message, PsrContext $context)
    {
        $calculationMessage = json_decode($message->getBody(), true);

        if (!$this->container->has('doctrine')) {
            $this->logger->error('The DoctrineBundle is not registered in your application. Try running "composer require symfony/orm-pack".');
            return self::REQUEUE;
        }

        /** @var Registry $doctrine */
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();

        $calculation = new Calculation();
        $calculation->setTypePayment($calculationMessage['type_payment']);
        $calculation->setRate($calculationMessage['rate']);
        $calculation->setSum($calculationMessage['sum']);
        $calculation->setFirstPaymentDate(
            (new \DateTimeImmutable)->setTimestamp($calculationMessage['first_payment_date_timestamp']));
        $calculation->setMonths($calculationMessage['months']);

        $em->persist($calculation);
        $em->flush();

        foreach ($this->scheduleCalculation->make($calculation) as $repaymentSchedule) {
            $em->persist($repaymentSchedule);
        }

        $em->flush();
        return self::ACK;
    }

    public static function getSubscribedTopics(): array
    {
        return ['calculation.save'];
    }

}