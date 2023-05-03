<?php

namespace App\Imports;

use App\User;
use App\Models\UserAddresse;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel ,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        // return new User([
        //    'name'     => $row[0],
        //    'email'    => $row[1], 
        //    'mobile'    => $row[2], 
        //    'password' => Hash::make($row[3]),
        //    'avatar'    => $row[4], 
        //    'gender'    => $row[5], 
        //    'birthdate'    => $row[6], 
        //    'city_id'    => $row[7], 
        //    'country_id'    => $row[8], 
        //    'remember_token'    => $row[9], 
        //    'status'    => $row[10], 
           
        // ]);

        $user= new User();
        $user->name     =  $row['name'] ?? null;
        $user->email   =  $row['email'] ?? null; 
        $user->mobile    = $row['cit_id'] ?? null;
        $user->password =bcrypt(55);
        $user->avatar   =  $row['avatar'] ?? null;
        $user->gender   =  $row['gender'] ?? null;
        //$user->birthdate   = $ $row['birthdate'] ?? null;
        $user->city_id    =  $row['city_id'] ?? null;
        $user->country_id    = $row['country_id'] ?? null;
        $user->remember_token    =  $row['remember_token'] ?? null;
        $user->status   =  $row['status'] ?? null;
         //  dd( $row);
        $user->save();

        // $adress=new UserAddresse();

        // $adress->user_id= $user->id;
        // $adress->city_id= $row[11];
        // $adress->area= $row[12];
        // $adress->mobile= $row[13];
        // $adress->addres = $row[14];
        // $adress->save();
        return;
    }
}
