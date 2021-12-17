<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Carrera;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidarRut;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[2]!='NOMBRE'){
            $contrasena = substr($row[1], 0, 6);
            $carrera = Carrera::where('codigo',$row[0])->first();
            $id_carrera = $carrera->id;

            $validator = Validator::make($row, [
                $row[2] => ['required', 'string', 'max:255'],
                $row[3] => ['required', 'string', 'email', 'max:255', 'unique:users'],
                $row[1] => ['required', 'string', 'unique:users','min:8', 'max:9',new ValidarRut],
                $id_carrera =>['exists:App\Models\Carrera,id']
            ]);

            if (!$validator->fails()) {
                dd($row);
                return new User([
                    'name' => $row[2],
                    'email' => $row[3],
                    'rut' => $row[1],
                    'rol' => 'Estudiante',
                    'habilitado' => 1,
                    'password' => bcrypt($contrasena),
                    'carrera_id' => $id_carrera,
                ]);
            }
        }
    }
}
