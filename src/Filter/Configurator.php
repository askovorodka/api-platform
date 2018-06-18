<?php

namespace App\Filter;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Configurator
{
    /**
     * @var ObjectManager $em
     */
    protected $em;
    protected $tokenStorage;
    protected $reader;
    protected $currentRequest;

    public function __construct(ObjectManager $manager, TokenStorageInterface $storage, RequestStack $requestStack, Reader $reader)
    {
        $this->em = $manager;
        $this->tokenStorage = $storage;
        $this->reader = $reader;
        $this->currentRequest = $requestStack->getCurrentRequest();
    }

    public function onKernelRequest()
    {
        if ($this->currentRequest->query->get('admin')) {
            return '';
        }

        $filter = $this->em->getFilters()->enable('is_active_filter');
        $filter->setAnnotationReader($this->reader);
    }

    private function getUser()
    {
        $token = $this->tokenStorage->getToken();

        if (!$token) {
            return null;
        }

        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return null;
        }

        return $user;
    }
}