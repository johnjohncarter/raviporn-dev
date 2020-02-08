<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function success($message = null)
    {
        $result['success'] = true;
        if (is_array($message)) {
            if (isset($message['data'])) {
                $result = $result + $message;
            } else {
                $result['data'] = $message;
            }
        } else if (is_string($message)) {
            $result['data'] = ['message' => $message];
        } else {
            $result['data'] = $message;
        }
        return $result;
    }

    protected function error($message = null)
    {
        $result['success'] = false;
        if (is_string($message)) {
            $result['errors'] = ['message' => $message];
        } else if (is_array($message)) {
            $result = $result + $message;
        } else {
            $result['errors'] = $message;
        }
        return $result;
    }
}
