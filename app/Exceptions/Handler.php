<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Company;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // Check if the exception is a 404 error (Page Not Found)
        if ($exception instanceof NotFoundHttpException) {
            // Fetch company data to pass to the 404 view
            $company = Company::with(['contact', 'socialMedias'])->findOrFail(1);
            dd($company);
            // Return a custom 404 page view with the company data
            return response()->view('errors.404', compact('company'), 404);
        }

        // For all other exceptions, call the parent method to handle them
        return parent::render($request, $exception);
    }
}
