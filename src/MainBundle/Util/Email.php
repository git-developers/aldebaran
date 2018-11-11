<?php

namespace MainBundle\Util;
use MainBundle\Entity\ConfigurationEmail;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

class Email
{

    //http://symfony.com/doc/current/cookbook/controller/service.html
    private $templating;
    private $container;
    private $em;
    private $mapeo = [];

    /**
     * Constructor
     * @param Container $container
     */
    public function __construct(Container $container, EngineInterface $templating)
    {
        $this->templating = $templating;
        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function enviarEmailATodosSocios(\MainBundle\Entity\Post  $post)
    {

        $emails = $this->getEmailsSocios();
        $subject = 'Se creo un documento importante en el sistema';
        $body = $this->templating->renderResponse(
            'Emails/postCreated.html.twig',
            array(
                'post' => $post
            )
        )->getContent();

        $this->procesar($emails, $subject, $body);
    }

    public function enviarEmailParaValidacionNews(\MainBundle\Entity\News  $news)
    {

        $emails = $this->getEmailsAdmistradores();
        $subject = 'Se creo una noticia en el sistema';
        $body = $this->templating->renderResponse(
            'Emails/newsCreated.html.twig',
            array(
                'news' => $news
            )
        )->getContent();

        $this->procesar($emails, $subject, $body);
    }

    private function getEmailsAdmistradores()
    {
        $emails = [];
        $entity = $this->em->getRepository('MainBundle:User')->findAllByRole('ROLE_CHANGE_NEWS_STATUS');

        foreach($entity as $key => $value){
            $emails[] = $value->getEmail();
        }

        return $emails;
    }

    private function getEmailsSocios()
    {
        $emails = [];
        $entity = $this->em->getRepository('MainBundle:User')->findAllByRole('ROLE_RECEIVE_NOTIFICATIONS_BY_EMAIL');

        foreach($entity as $key => $value){
            $emails[] = $value->getEmail();
        }

        return $emails;
    }

    public function procesar($emails, $subject, $body)
    {

        $entity = $this->em->getRepository('MainBundle:ConfigurationEmail')->findActive();

        if(!$entity){
            $entity = new ConfigurationEmail();
        }

        $host = $entity->getHost();
        $port = $entity->getPort();
        $encryption = $entity->getEncryption();
        $username = $entity->getUsername();
        $password = $entity->getPassword();
        $fromName = $entity->getFromName();
        $fromEmail = $entity->getFromEmail();


        try {
            // Create the Transport
            $transport = \Swift_SmtpTransport::newInstance($host, $port, $encryption);
            $transport->setUsername($username);
            $transport->setPassword($password);

            // Create the Mailer using your created Transport
            $mailer = \Swift_Mailer::newInstance($transport);

            // Create the message
            $message = \Swift_Message::newInstance();

            // Give the message a subject
            $message->setSubject($subject);

            // Set the From address with an associative array
            $message->setFrom([$fromEmail => $fromName]);

            // Set the To addresses with an associative array
            $message->setTo($emails); // array('tianosweb@gmail.com')

            // Give it a body
            $message->setBody($body, 'text/html');

            // Send the message!
            $result = $mailer->send($message);

        }catch (\Exception $e){

        }

    }






/*
$transport = \Swift_SmtpTransport::newInstance('smtp.mailgun.org', 587, 'tls');
$transport->setUsername('postmaster@sandboxe1475239ac1a4a81a92061f38b85064f.mailgun.org');
$transport->setPassword('0e86e7b9144a4b618294031f26a647d8');
*/




}