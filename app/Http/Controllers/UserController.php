<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;




class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function config(){
        return view('user.config');
    }

    public function update(Request $request){


        $user = \Auth::user();

        //Validar los datos del formulario
        $id= $user->id;
       $validate= $this->validate($request, [
           'name' => 'required | string | max:255',
           'surname' => 'required | string | max:255',
           'nick' => 'required | string | max:255 | unique:users,nick,'.$id,
           'email' => 'required | string | email | max:255 | unique:users,email,'.$id
       ]);


       /*$id= \Auth::user()->id;*/
       $name= $request->input('name');
       $surname= $request->input('surname');
       $nick= $request->input('nick');
       $email= $request->input('email');

       //Asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //subir la imagen
        $image_path= $request->file('image_path');
        if($image_path){
            //Poner nombre unico
            $image_path_name = time().$image_path->getClientOriginalName();
            //Guardarla en al crpeta storage users
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            //Seteo el nombre de al imagen en el objeto
            $user->image = $image_path_name;
        }




        //Ejecutar consulta y cambios en la bd
        $user->update();

        return redirect()->route('config')
                            ->with(['message'=>'Usuario actualizado correctamente']);

    }

    public function  getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

}
