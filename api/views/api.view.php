<?php
class APIView
{

    public function response($data, $status)
    {
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        echo json_encode($data);
    }

    private function requestStatus($code)
    {
        $status = array(
            200 => "OK",
            201 => "Created",
            400 => "Bad request",
            404 => "Not found",
            401 => "Unauthorized",
            500 => "Internal Server Error"
        );
        return (isset($status[$code])) ? $status[$code] : $status[500];
    }


}

?>