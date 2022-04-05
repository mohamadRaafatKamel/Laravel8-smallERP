<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
//use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
//        $this->reportable(function (Throwable $e) {
//            //
//        });
    }

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $e)
    {
        // "message": "No query results for model ID" in API
        if ($e instanceof ModelNotFoundException) {
            return response()->json(['error' => 'Data not found.']);
        }

//        if($this->isHttpException($e))
//        {
//            switch ($e->getStatusCode())
//            {
//                // not found
//                case 404:
//                    return redirect()->guest('home');
//                    break;
//
//                // internal error
//                case '500':
//                    return redirect()->guest('home');
//                    break;
//
//                default:
//                    return $this->renderHttpException($e);
//                    break;
//            }
//        }
//        else
//        {
//            return parent::render($request, $e);
//        }
        return parent::render($request, $e);
    }
}
