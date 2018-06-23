<?

class votbox {

    private $curl;

    private $login;
    private $password;

    private $file;
    private $filename;
    private $fileurl;

    public function __construct($params = [])
    {
        if(empty($params['login']) || empty($params['password']))
            new Exception("Неверный логин или пароль");

        $this->login = 'ivan@y2m.ru';
        $this->password = '17367614';

        $this->filename = 'list.csv';
        $this->file = $_SERVER['DOCUMENT_ROOT'] . '/web/lbs/votbox/' . $this->filename;
        $this->fileurl = 'https://ivannikitin.ru/lbs/votbox/' . $this->filename;
    }

    private function request($script = '', $params = [])
    {
        $curl = curl_init();
        if( $curl ) {
            $params = array_merge($params, ['username' => $this->login, 'password' => md5($this->password)]);

            curl_setopt($curl, CURLOPT_URL, $script);
            curl_setopt($curl, CURLOPT_TIMEOUT, 5);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            $out = curl_exec($curl);

            if($out === false) {
                return curl_error($curl);
            } else {
                curl_close($curl);
                return $out;
            }
        }
    }

    private function read($xml = null)
    {
        if(null === $xml)
            return false;

        if($xml) {
            $parser = simplexml_load_string($xml);

            if($parser->error['code'] != 0)
                return (string) $parser->error['message'];
            else
                return $parser;
        }
    }

    public function saveToFile($phoneNumber = null, $filename = null)
    {
        if(empty($phoneNumber))
            return false;

        $data = [
            $this->normPhone($phoneNumber),
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        ];

        $file = $filename !== null ? $_SERVER['DOCUMENT_ROOT'] . '/web/lbs/votbox/' . $filename : $this->file;

        $fp = fopen($file, 'a');
        fputcsv($fp, $data, ';');
        fclose($fp);
    }

    public function reset($filename = null)
    {
        $file = $filename !== null ? $_SERVER['DOCUMENT_ROOT'] . '/web/lbs/votbox/' . $filename : $this->file;
        return unlink($file);
    }

    public function autocall($params = [], $filename = null)
    {
        if(empty($params))
            return false;

        $file = $filename !== null ? $_SERVER['DOCUMENT_ROOT'] . '/lbs/votbox/' . $filename : $_SERVER['DOCUMENT_ROOT'] . '/web/lbs/votbox/' . $this->filename;

        $xml = $this->request('http://www.votbox.ru/api/autocall.api.php', array_merge($params, ['FLIST' => curl_file_create($file)]));

        return $this->read($xml);
    }

    public function start($task_id = null)
    {
        if($task_id === null)
            return false;

        $xml = $this->request('http://www.votbox.ru/api/autocall.start.api.php', array("taskid" => $task_id));

        return $this->read($xml);
    }

    function normPhone($phone) {
        $resPhone = preg_replace("/[^0-9]/", "", $phone);

        if (strlen($resPhone) === 11) {
            $resPhone = preg_replace("/^7/", "8", $resPhone);
        }
        return $resPhone;
    }

}