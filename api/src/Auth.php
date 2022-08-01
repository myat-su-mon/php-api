<?php

class Auth 
{
    private int $user_id;

    public function __construct(private UserGateway $user_gateway, private JWTCode $codec)
    {

    }

    public function authenticateAPIKey(): bool
    {
        if(empty($_SERVER["HTTP_X_API_KEY"])) {
            http_response_code(400);
            echo json_encode(["message" => "missing API key"]);
            return false;
        }

        $api_key = $_SERVER["HTTP_X_API_KEY"];

        $user = $this->user_gateway->getByAPIKey($api_key);

        if ($user === false) {
            http_response_code(401);
            echo json_encode(["message" => "invalid API Key"]);
            return false;
        }

        $this->user_id = $user["id"];

        return true;
    }

    public function getUserID(): int {
        return $this->user_id;
    }

    public function authenticateAccessToken(): bool {
        if (!preg_match("/^Bearer\s+(.*)$/", $_SERVER["HTTP_AUTHENTICATION"], $matches)) {
            http_response_code(400);
            echo json_encode(["message" => "incomplete authorization header"]);
            return false;
        }

        // $plain_text = base64_decode($matches[1], true);

        // if($plain_text === false) {
        //     http_response_code(400);
        //     echo json_encode(["message" => "invalid authorization header"]);
        //     return false;
        // }

        // $data = json_decode($plain_text, true);

        // if ($data === null) {
        //     http_response_code(400);
        //     echo json_encode(["message" => "invalid JSON"]);
        //     return false;
        // }

        try {
            $data = $this->codec->decode($matches[1]);
        } catch (InvalidSignatureException) {
            http_response_code(401);
            echo json_encode(["message" => "invalid signature"]);
            return false;
        } catch (TokenExpiredExcepiton) {
            http_response_code(401);
            echo json_encode(["message" => "token has expired"]);
            return false;
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
            return false;
        }

        $this->user_id = $data["sub"];

        return true;
    }
}