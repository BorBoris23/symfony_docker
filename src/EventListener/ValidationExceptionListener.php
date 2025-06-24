<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class ValidationExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $validationException = null;
        if ($exception instanceof ValidationFailedException) {
            $validationException = $exception;
        } elseif ($exception->getPrevious() instanceof ValidationFailedException) {
            $validationException = $exception->getPrevious();
        }

        if (!$validationException instanceof ValidationFailedException) {
            return;
        }

        $status = Response::HTTP_BAD_REQUEST;

        $errors = [];
        foreach ($validationException->getViolations() as $v) {
            $errors[] = [
                'field' => $v->getPropertyPath(),
                'message' => $v->getMessage(),
            ];
        }

        $response = new JsonResponse(
            ['status' => 'error', 'errors' => $errors],
            $status
        );
        $event->setResponse($response);
    }
}
