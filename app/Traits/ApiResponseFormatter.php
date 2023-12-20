<?php

namespace app\Traits;

trait ApiResponseFormatter
{
    public function apiResponse($code = 200, $message = "Data Game successfully collected", $data = [])
    {
        // Dari parameter akan di format menjadi seperti dibawah ini
        return json_encode([
            "code" => $code,
            "message" => $message,
            "data" => $data
        ]);
    }
}
