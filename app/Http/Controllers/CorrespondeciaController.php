<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Mail;

use App\Soporte;

use App\Trabajadores;

use Session;

use Dialog;

class CorrespondeciaController extends Controller
{
    //

    public function __Construct()
    {
        $this->middleware('validate.user');
    }
    
// ================================= FUNCIONES BÁSICAS =============================================
    public function index()
    {
    	$mail = new Mail;
    	$soportes = new Soporte;
    	$trabajadores = new Trabajadores;
    	$correos = "";

    	if(Auth::user()->nivel == 2)
        {
    	   $correos =  Mail::select('id','subject','created_at','status')->where([
                                ['soporte_id', '=', Auth::user()->trabajadores_id],
                                ['nivel', '<>', Auth::user()->nivel],
                                ['eliminado','=',0]
                            ])->orderBy('created_at','desc')->paginate(10);
        }
        else
        {
            $correos =	Mail::select('id','subject','created_at','status')->where([
                    ['trabajadores_id', '=', Auth::user()->trabajadores_id],
                    ['nivel','<>', Auth::user()->nivel],
                    ['eliminado','=',0]
                ])->orderBy('created_at','desc')->paginate(10);
        }

    	return view('correspondencia.index',['mail' => $mail, 'soportes' => $soportes, 'trabajadores' => $trabajadores, 'correos' => $correos]);
    }

    public function create(Request $request)
    {
    	$mail = new Mail;
    	
        $valid = $request->hasFile('archivos');
        
        $archivosName = "";

        if($valid)
        {   
            foreach($request->file('archivos') as $files) 
            {
                $imageName = $files->getClientOriginalName();
                $archivosName .= $imageName.",";
                $path = base_path().'/public/img/mails/';
                $files->move($path , $imageName);
            }

            $archivosName = substr($archivosName, 0, strlen($archivosName) -1);
        }

        $mail->soporte_id = $request->soporte_id;
        $mail->trabajadores_id = $request->trabajadores_id;
        $mail->subject = $request->subject;
        $mail->message = $request->message;
        $mail->sent_by = $request->sent_by;
        $mail->nivel = $request->nivel;
        $mail->status = 1;
        $mail->files = $archivosName;
        $mail->save();

    	Session::flash('flash_create', 'Correo enviado con éxito');
    	return redirect('correspondencia');
    }

    public function eliminar($id)
    {
        
    // ================== FUNCIÓN PARA ENVIAR CORREOS A CORREOS BASURA=========================

        $array = explode(',', $id);
        $cantidad = count($array);

        foreach ($array as $row)
        {
            $correo = Mail::where('id', '=',$row)->firstOrFail();
            $correo->eliminado = 1;
            $correo->save();
        }

        if($cantidad > 1)
        {
            Session::flash('flash_create', 'Se han eliminado los correos con éxito');
        }
        else
        {   
            Session::flash('flash_create', 'Se ha eliminado el correo con éxito');
        }

        return redirect('/correspondencia');

    }

    public function eliminarUnico($id)
    {

    // ================== FUNCIÓN PARA ENVIAR CORREO DEL DIALOGO A CORREOS BASURA=========================

        $correo = Mail::where('id', '=',$id)->firstOrFail();

        Session::flash('flash_create', 'Se ha eliminado el correo con éxito');

        return redirect('/correspondencia');

    }

    public function eliminarPermanente($id)
    {

    // ================== FUNCIÓN PARA ELIMINAR CORREOS DE TODAS LAS VISTAS=========================
        $array = explode(',', $id);
        $cantidad = count($array);

        foreach ($array as $row)
        {
            $correo = Mail::where('id', '=',$row)->firstOrFail();
            $correo->eliminado = 2;
            $correo->save();
        }

        if($cantidad > 1)
        {
            Session::flash('flash_create', 'Se han eliminado los correos permanentemente con éxito');
        }
        else
        {   
            Session::flash('flash_create', 'Se ha eliminado el correo con permanentemente éxito');
        }

        return redirect('/correspondencia');

    }

//*************************************************************************************************

// ======================= FUNCIÓN PARA VER CORREOS ENVIADOS =====================================

    public function enviados()
    {
        $mail = new Mail;
        $soportes = new Soporte;
        $trabajadores = new Trabajadores;

        $correos = "";

        if(Auth::user()->nivel == 2)
        {
           $correos =  Mail::select('id','subject','created_at','status')->where([
                    ['soporte_id', '=', Auth::user()->trabajadores_id],
                    ['sent_by', '=', Auth::user()->trabajadores_id],
                    ['nivel', '=', 2],
                    ['eliminado','=',0]
                ])->orderBy('created_at','desc')->simplePaginate(10);
        }
        else
        {
            $correos =  Mail::select('id','subject','created_at','status')->where([
                            ['trabajadores_id', '=', Auth::user()->trabajadores_id],
                            ['sent_by', '=', Auth::user()->trabajadores_id],
                            ['nivel', '<>', Auth::user()->trabajadores_id],
                            ['eliminado','=',0]
                ])->orderBy('created_at','desc')->simplePaginate(10);
        }

        return view('correspondencia.enviados',['mail' => $mail, 'soportes' => $soportes, 'trabajadores' => $trabajadores, 'correos' => $correos]);
    }

//*************************************************************************************************************

// ======================= FUNCIÓN PARA VER EL DETALLE DEL CORREO =====================================

    public function dialogo($id)
    {
        $mail = new Mail;
        $soporte = new Soporte;
        $conversacion = Mail::where('id', '=', $id)->firstOrFail();
        $trabajadores = new Trabajadores;

        if($conversacion->status == 1 && $conversacion->nivel <> Auth::user()->nivel)
        {
                $conversacion->status = 0;
                $conversacion->save();
        }

        return view('correspondencia.dialogo',['mail' => $mail, 'conversacion' => $conversacion, 'soportes' => $soporte, 'trabajadores' => $trabajadores]);
    }

    public function dialogo_search($busqueda)
    {
        $mail = new Mail;
        $soporte = new Soporte;
        $conversacion = Mail::where('subject', 'like', '%'.$busqueda.'%')->firstOrFail();
        $trabajadores = new Trabajadores;

        if($conversacion->status == 1 && $conversacion->nivel <> Auth::user()->nivel)
        {
                $conversacion->status = 0;
                $conversacion->save();
        }

        return view('correspondencia.dialogo',['mail' => $mail, 'conversacion' => $conversacion, 'soportes' => $soporte, 'trabajadores' => $trabajadores]);
    }

//*************************************************************************************************************

// ======================= FUNCIÓN PARA VER EL CORREO BASURA =====================================

    public function ver_basura()
    {
        $mail = new Mail;
        $soportes = new Soporte;
        $trabajadores = new Trabajadores;
        $correos = "";

        if(Auth::user()->nivel == 2)
        {
           $correos =  Mail::select('id','subject','created_at','status')->where([
                                ['soporte_id', '=', Auth::user()->trabajadores_id],
                                ['eliminado','=',1]
                            ])->orderBy('created_at','desc')->paginate(10);
        }   
        else
        {
            $correos =  Mail::select('id','subject','created_at','status')->where([
                    ['trabajadores_id', '=', Auth::user()->trabajadores_id],
                    ['eliminado','=',1]
                ])->orderBy('created_at','desc')->paginate(10);
        }

        return view('correspondencia.basura',['mail' => $mail, 'soportes' => $soportes, 'trabajadores' => $trabajadores, 'correos' => $correos]);   
    }

//*************************************************************************************************************

// ======================= FUNCIÓN PARA RESTAURAR EL CORREO BASURA =====================================

    public function restaurar($id)
    {
        $array = explode(',', $id);
        $cantidad = count($array);

        foreach ($array as $row)
        {
            $correo = Mail::where('id', '=',$row)->firstOrFail();
            $correo->eliminado = 0;
            $correo->save();
        }

        if($cantidad > 1)
        {
            Session::flash('flash_create', 'Se han restaurado los correos con éxito');
        }
        else
        {   
            Session::flash('flash_create', 'Se ha restaurado el correo con éxito');
        }

        return redirect('/correspondencia');

    }
//*************************************************************************************************************

// ======================= FUNCIONES PARA EL BUSCADOR DE CORREOS ===========================================

    public function traerCorreos(Request $request)
    {
        // TRAE LOS CORREOS DE EL BUZÓN DE ENTRADA

        $mail = new Mail;

        $correos = $mail->buscar_correos_entrada($request->art);

        if($request->ajax())
        {
            return response()->json($correos);
        }       
    }

    public function traerCorreosEnviados(Request $request)
    {
        // TRAE LOS CORREOS DE EL BUZÓN DE SALIDA

        $mail = new Mail;

        $correos = $mail->buscar_correos_salida($request->art);

        if($request->ajax())
        {
            return response()->json($correos);
        }   
    }

//*************************************************************************************************************
}

