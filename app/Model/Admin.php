<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    protected $table = 'admins';

    private function convertToArrayData($data)
    {
        $result = [];
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function handleLogin($username, $password)
    {
        $data = Admins::where(['username' => $username, 'password' => $password])->first();
        return $this->convertToArrayData($data);
    }
}
