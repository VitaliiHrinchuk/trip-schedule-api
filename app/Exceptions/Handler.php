<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        //  return parent::render($request, $exception);

        $errors = [];

        # 401
        if ($exception instanceof UnauthorizedHttpException) {
            $errors[] = [
                'status' => $exception->getStatusCode(),
                'title' => $exception->getMessage(),
            ];
            return new JsonResponse(compact('errors'), $exception->getStatusCode(), $exception->getHeaders());
        }

        # 403
        elseif ($exception instanceof AccessDeniedHttpException) {
            $errors[] = [
                'status' => $exception->getStatusCode(),
                'title' => $exception->getMessage(),
            ];
            return new JsonResponse(compact('errors'), $exception->getStatusCode(), $exception->getHeaders());
        }

        # 4XX
        elseif ($exception instanceof HttpException) {
            $errors[] = [
                'status' => $exception->getStatusCode(),
                'title' => $exception->getMessage(),
            ];
            return new JsonResponse(compact('errors'), $exception->getStatusCode(), $exception->getHeaders());
        }

        # 422
        elseif ($exception instanceof ValidationException) {
            foreach ($exception->errors() as $param => $messages) {
                foreach ($messages as $message) {
                    $errors[] = [
                        'status' => 422,
                        'title' => $message,
                        'source' => $param,
                    ];
                }
            }
            return new JsonResponse(compact('errors'), 422, []);
        }

        $errors[] = [
            'status' => 500,
            'title' => $exception->getMessage(),
            'source' => null,
            'meta' => env('APP_ENV') == 'local' ? [
                'source' => $exception->getFile().':'.$exception->getLine(),
                'trace' => array_map(function($t) {
                    return [
                        'file' => isset($t['file']) ? $t['file'] : '-',
                        'line' => isset($t['line']) ? $t['line'] : 0,
                        'class' => isset($t['class']) ? $t['class'] : '-',
                        'fn' => isset($t['function']) ? $t['function'] : '-'
                    ];
                }, $exception->getTrace())
            ] : [],
        ];
        return new JsonResponse(compact('errors'), 500);
    }
}
