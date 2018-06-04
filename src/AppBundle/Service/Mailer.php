<?php
/**
 * Created by PhpStorm.
 * User: laiah
 * Date: 04/06/18
 * Time: 09:29
 */
namespace AppBundle\Service;

/**
 * Class Mailer
 * @package AppBundle\Service
 */
class Mailer
{
    protected $mailer;
    protected $templating;
    private $from = 'reservations@flyaround.com';

    /**
     * Mailer constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $templating
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * @param $to
     * @param $name
     */
    public function sendMail($to, $type)
    {
        switch ($type) {
            case 'Notification':
                // Pilot mail
                $message = (new \Swift_Message('Notification de réservation'))
                        ->setFrom($this->from)
                        ->setTo($to)
                        ->setBody($this->templating->render('email/notification.html.twig'), 'text/html');

                $this->mailer->send($message);
                break;
            case 'Confirmation':
                // Passenger mail
                $message = (new \Swift_Message('Confirmation de réservation'))
                        ->setFrom($this->from)
                        ->setTo($to)
                        ->setBody($this->templating->render('email/confirmation.html.twig'), 'text/html');
                $this->mailer->send($message);
                break;
        }


    }
}



