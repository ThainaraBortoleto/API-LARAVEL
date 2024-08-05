<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function create(Request $request) {
        DB::beginTransaction();

//        $user = new User();
//        $user->name = $request->get('name');
//        $user->email = $request->get('email');
//        $user->password = bcrypt($request->get('password'));
//        $user->save();
//
        try {
            DB::table('users')->insert([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password'))
            ]);
            DB::commit();

            return "OK";

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            // something went wrong
        }
    }
}