<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Product;
use App\Exception\ProductNotFoundException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class CartManager implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['checkProductAvailability', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function checkProductAvailability(GetResponseForControllerResultEvent $event): void
    {
        $product = $event->getControllerResult();

        if (!$product instanceof Product || !$event->getRequest()->isMethodSafe(false)) {
            return;
        }

        if ($product->getId() == 1) {
            throw new ProductNotFoundException(sprintf('The product %s does not exists.', $product->getId()));
        }
    }
}