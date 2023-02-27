<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneralJsonException extends Exception
{
    /**
     * @return void
     */
    public function report(){
//        dump('Report Exception');
    }


    /**
     * @paramRequest $request
     */
    public function render(Request $request)
    {
        return new JsonResponse([
            'errors' => [
                'message' =>$this->getMessage(),
            ],
        ], $this->getCode());
    }
}
