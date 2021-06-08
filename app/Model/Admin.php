<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    protected $table = 'admins';

    private function convertToArrayData($data)
    {
        $result = [];
        if ($data) {
            $result = $data->toArray();
        }
        return $result;
    }

    public function handleLogin($username, $password)
    {
        $data = Admin::where(['username' => $username, 'password' => $password])->first();
        return $this->convertToArrayData($data);
    }

    public function updateLastLogin($id)
    {
//        $status = DB::table('admins')
//            ->where('id', $id)
//            ->update([
//                'last_login' => date('Y-m-d H:i:s')
//            ]);

        $admin = Admin::find($id);
        $admin->last_login = date('Y-m-d H:i:s');
        $status = $admin->save();

        if ($status) {
            return true;
        }
        return false;

    }
}
