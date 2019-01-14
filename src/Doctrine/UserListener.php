<?php
namespace App\Doctrine;


use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

class UserListener
{
    /**
     * @var EncoderFactory
     */
    private $encoderFactory;

    /**
     * UserListener constructor.
     */
    public function __construct(EncoderFactory $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $this->handleEvent($eventArgs);
    }

    public function preUpdate(LifecycleEventArgs $eventArgs)
    {
        $this->handleEvent($eventArgs);
    }

    private function handleEvent(LifecycleEventArgs $eventArgs)
    {
        $user = $eventArgs->getEntity();

        if ($user instanceof User) {
            $encoder = $this->encoderFactory->getEncoder($user);
            $plainPassword = $user->getPlainPassword();

            if (!is_null($plainPassword)) {
                $password = $encoder->encodePassword($plainPassword, $user->getSalt());
                $user->setPassword($password);
            }
        }
    }
}