<?php

/*The API service provider macro*/

namespace Frontiernxt\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class APIResponseMacroServiceProvider extends ServiceProvider
{
  public function boot()
  {
    Response::macro('api_success', function ($data) {
        return Response::json([
          'status_code'  => 200,
          'status_message' => 'Request executed successfully',
          'data' => $data,
        ]);
    });

    Response::macro('api_error', function ($message, $status = 400) {
        return Response::json([
          'status_code'  => $status,
          'status_message'  => $message,
        ], $status);
    });
  }
}