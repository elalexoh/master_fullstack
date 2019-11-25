<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function pruebas(Request $request)
    {
        return 'Accion de pruebas de user-controller';
    }
    public function register(Request $request)
    {
        //Recoger los datos del usuario por post
        $json = $request->input('json', null);
        $params = json_decode($json); //objeto
        $params_array = json_decode($json, true); //array

        if (!empty($params) && !empty($params_array)) {
            //limpiar datos
            $params_array = array_map('trim', $params_array); //trim en todos los campos

            //validar datos 
            $validate = \Validator::make($params_array, [
                'name' => 'required|alpha',
                'surname' => 'required|alpha',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);
            if ($validate->fails()) {
                //validacion fallida
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'El usuario no se ha creado',
                    'errors' => $validate->errors(),
                );
            } else {
                //validacion pasada correctamente
                //Cifrar Contraseña
                $pwd = \password_hash($params->password, PASSWORD_BCRYPT, ['cost' => 4]);

                //Crear el usuario
                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->role = 'Role_User';

                //guarda el usuario
                $user->save();

                //respuesta
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'El usuario se ha creado correctamente',
                    'user' => $user
                );
            }
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviado no son correctos'
            );
        }

        return response()->json($data, $data['code']);
    }
    public function login(Request $request)
    {
        return 'accion de login de usuarios';
    }
}
