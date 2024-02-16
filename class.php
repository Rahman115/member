<?php
/** class Bot */
class bot
{
    public $token;
    public $param = array();
    public $value;

    public $url = "https://api.telegram.org/bot";


    public function __construct($token)
    {
        $this->token = $token;
    }

    public function contect($var)
    {
        $data = file_get_contents($var);
        $getData = json_decode($data, true);
        return $getData;
    }

    public function ex($param, $value)
    {
        $this->value = $value;
        $api = $this->url . $this->token . "/" . $this->value;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));

        $result = curl_exec($ch);
        curl_close($ch);
        // var_dump($result);
        return $result;
    }

}

/** End Class Bot */