<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    public function saveEmployee(Request $req) {
        // dd($req->all());

        $req->validate([
            "name" => ['required', 'min:2', 'max:100'],
            'email' => ['required', 'email', 'unique:employees,email'],
            "doj" => ['required', 'date'],
            "avatar" => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', "max:2048"]
        ]);

        if(isset($req->dol)) {
            $req->validate([
                "dol" => ['required', 'date'],
            ]);
        }

        $data = [
            'name' => $req->name,
            'email' => $req->email,
            'doj' => $req->doj,
            'dol' => isset($req->dol) ? $req->dol : null,
        ];

        if (isset($req->avatar)) {
            $imageavatar = 'avatar' . time() . '.' . $req->avatar->extension();
            $req->avatar->move(public_path('images'), $imageavatar);
            $data['avatar'] = $imageavatar;
        }


        employee::create($data);

        return redirect()->back();
    }

    public function deleteEmp(Request $req) {
        employee::where('id', $req->id)->delete();

        return response()->json([
            'msg' => 'deleted'
        ]);
    }
}
