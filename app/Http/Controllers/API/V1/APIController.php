<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Response;

trait APIController {

    /**
     * @var int
     */
    protected $statusCode = 'success';

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode('failed')->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function respondBadRequest($message = 'Bad Request')
    {
        return $this->setStatusCode('failed')->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function respondServerError($message = 'Server Error')
    {
        return $this->setStatusCode('failed')->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function respondConflict($message = 'Conflict')
    {
        return $this->setStatusCode('failed')->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function respondUnprocessable($message = 'Unprocessable Entity')
    {
        return $this->setStatusCode('failed')->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function respondUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode('failed')->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function respondForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode('failed')->respondWithError($message);
    }

    /**
     * @param array $data
     * @param string $message
     * @return mixed
     */
    public function respondCreated($data = [],$message = 'Created Successfully')
    {
        return $this->setStatusCode('success')->respond($data,$message);
    }

    /**
     * @param $data;
     * @param $message;
     * @param array $headers
     *
     * @return mixed
     */
    public function respond($data, $message = '', $headers = [])
    {
        if ($data){
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $data
            ], 200, $headers);
        }else{
            return response()->json([
                'status' => $this->getStatusCode(),
                'message' => $message
            ], 200, $headers);
        }
    }

    /**
     * @param $message
     *
     * @return mixed
     */
    public function respondWithError($message)
    {
        return $this->respond([],$message);
    }
}
