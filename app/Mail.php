<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Mail extends Model
{
    //
    protected $fillable = ['soporte_id', 'trabajadores_id', 'subject','message', 'sent_by', 'nivel', 'status'];


    public function iniciado($id)
    {
        if(Auth::user()->nivel <> 2)
        {
            $datos = $this->join('soportes', 'soportes.id', '=', 'mails.sent_by')
                    ->select('soportes.nombre_completo as iniciado')->where('mails.id', '=', $id)->first();
        }
        else
        {
            $datos = $this->join('trabajadores', 'trabajadores.id', '=', 'mails.sent_by')
                    ->select('trabajadores.nombre_completo as iniciado')->where('mails.id', '=', $id)->first();   
        }

    	return $datos['iniciado'];

    }

    public function iniciado_enviado($id)
    {
        if(Auth::user()->nivel == 2)
        {
            $datos = $this->join('soportes', 'soportes.id', '=', 'mails.sent_by')
                    ->select('soportes.nombre_completo as iniciado')->where('mails.id', '=', $id)->first();
        }
        else
        {
            $datos = $this->join('trabajadores', 'trabajadores.id', '=', 'mails.sent_by')
                    ->select('trabajadores.nombre_completo as iniciado')->where('mails.id', '=', $id)->first();   
        }

        return $datos['iniciado'];        
    }

    public function cantidad_mensajes()
    {
        if(Auth::user()->nivel == 2)
        {
            return $this->where([
                ['soporte_id', '=', Auth::user()->trabajadores_id],
                ['nivel', '<>', 2],
                ['eliminado','=',0]
                ])->count();
            
        }
        else
        {
             return  $this->where([
                ['trabajadores_id', '=', Auth::user()->trabajadores_id],
                ['nivel', '=', 2],
                ['eliminado','=',0]
                ])->count();
            
        }
    }

    public function cantidad_mensajes_nuevos()
    {
        if(Auth::user()->nivel == 2)
        {
            return $this->where([
                ['soporte_id', '=', Auth::user()->trabajadores_id],
                ['status', '=', 1],
                ['nivel', '<>', 2],
                ['eliminado','=',0]
                ])->count();
            
        }
        else
        {
             return $this->where([
                ['trabajadores_id', '=', Auth::user()->trabajadores_id],
                ['status', '=', 1],
                ['nivel', '=', 2],
                ['eliminado','=',0]
                ])->count();
            
        }   
    }

    public function cantidad_mensajes_enviados()
    {
        if(Auth::user()->nivel == 2)
        {
            return $this->where([
                ['soporte_id', '=', Auth::user()->trabajadores_id],
                ['sent_by', '=', Auth::user()->trabajadores_id],
                ['nivel', '=', 2],
                ['eliminado','=',0]

                ])->count();
            
        }
        else
        {
             return $this->where([
                ['trabajadores_id', '=', Auth::user()->trabajadores_id],
                ['sent_by', '=', Auth::user()->trabajadores_id],
                ['nivel','<>', 2],
                ['eliminado','=',0]
                ])->count();
            
        }   
    }

    public function buscar_correos_entrada($req)
    {
        if(Auth::user()->nivel == 2)
        {
            $datos = $this->join('trabajadores', 'trabajadores.id', '=', 'mails.trabajadores_id')
                    ->select('mails.subject')
                    ->where([
                        ['trabajadores.nombre_completo', 'like', '%'.$req.'%'],
                        ['nivel','<>', 2],
                        ['eliminado', '<>',2]
                    ])->get();

            if(count($datos) < 1)
            {
                $datos = $this->join('trabajadores', 'trabajadores.id', '=', 'mails.trabajadores_id')
                    ->select('mails.subject')
                    ->where([
                        ['mails.subject', 'like', '%'.$req.'%'],
                        ['nivel','<>', 2],
                        ['eliminado', '<>',2]
                    ])->get();

                    if(count($datos) < 1)
                    {
                        $datos = $this->join('trabajadores', 'trabajadores.id', '=', 'mails.trabajadores_id')
                                    ->select('mails.subject')
                                    ->where([
                                        ['mails.created_at', 'like', '%'.$req.'%'],
                                        ['nivel','<>', 2],
                                        ['eliminado', '<>',2]
                                    ])->get();                        

                        if(count($datos) < 1)
                        {
                            return "";
                        }
                        else
                        {
                            return $datos;
                        }
                    }
                    else
                    {
                        return $datos;
                    }
            }
            else
            {
                return $datos;
            }
        }
        else
        {
            $datos = $this->join('soportes', 'soportes.id', '=', 'mails.soporte_id')
                    ->select('mails.subject')
                    ->where([
                        ['soportes.nombre_completo', 'like', '%'.$req.'%'],
                        ['nivel','=', 2],
                        ['eliminado', '<>',2]
                    ])->get();

            if(count($datos) < 1)
            {
                $datos = $this->join('soportes', 'soportes.id', '=', 'mails.soporte_id')
                    ->select('mails.subject')
                    ->where([
                        ['mails.subject', 'like', '%'.$req.'%'],
                        ['nivel','=', 2],
                        ['eliminado', '<>',2]
                    ])->get();
                if(count($datos) < 1)
                {
                    $datos = $this->join('soportes', 'soportes.id', '=', 'mails.soporte_id')
                                ->select('mails.subject')
                                ->where([
                                    ['mails.created_at', 'like', '%'.$req.'%'],
                                    ['nivel','=', 2],
                                    ['eliminado', '<>',2]
                                ])->get();

                    if(count($datos) < 1)
                    {
                        return "";
                    }
                    else
                    {
                        return $datos;
                    }
                }
                else
                {
                    return $datos;
                }
            }
            else
            {
                return $datos;
            }
        }       
    }

    public function buscar_correos_salida($req)
    {
        if(Auth::user()->nivel == 2)
        {
            $datos = $this->join('soportes', 'soportes.id', '=', 'mails.soporte_id')
                    ->select('mails.subject')
                    ->where([
                        ['soportes.nombre_completo', 'like', '%'.$req.'%'],
                        ['nivel','=', 2],
                        ['eliminado', '<>',2]
                    ])->get();   

            if(count($datos) < 1)
            {
                $datos = $this->join('soportes', 'soportes.id', '=', 'mails.soporte_id')
                    ->select('mails.subject')
                    ->where([
                        ['mails.subject', 'like', '%'.$req.'%'],
                        ['nivel','=', 2],
                        ['eliminado', '<>',2]
                    ])->get();
                if(count($datos) < 1)
                {
                    $datos = $this->join('soportes', 'soportes.id', '=', 'mails.soporte_id')
                                ->select('mails.subject')
                                ->where([
                                    ['mails.created_at', 'like', '%'.$req.'%'],
                                    ['nivel','=', 2],
                                    ['eliminado', '<>',2]
                                ])->get();

                    if(count($datos) < 1)
                    {
                        return "";
                    }
                    else
                    {
                        return $datos;
                    }
                }
                else
                {
                    return $datos;
                }
            }
            else
            {
                return $datos;
            }
        }
        else
        {
            $datos = $this->join('trabajadores', 'trabajadores.id', '=', 'mails.trabajadores_id')
                    ->select('mails.subject')
                    ->where([
                        ['trabajadores.nombre_completo', 'like', '%'.$req.'%'],
                        ['nivel','<>', 2],
                        ['eliminado', '<>',2]
                    ])->get();

            if(count($datos) < 1)
            {
                $datos = $this->join('trabajadores', 'trabajadores.id', '=', 'mails.trabajadores_id')
                    ->select('mails.subject')
                    ->where([
                        ['mails.subject', 'like', '%'.$req.'%'],
                        ['nivel','<>', 2],
                        ['eliminado', '<>',2]
                    ])->get();

                    if(count($datos) < 1)
                    {
                        $datos = $this->join('trabajadores', 'trabajadores.id', '=', 'mails.trabajadores_id')
                                    ->select('mails.subject')
                                    ->where([
                                        ['mails.created_at', 'like', '%'.$req.'%'],
                                        ['nivel','<>', 2],
                                        ['eliminado', '<>',2]
                                    ])->get();                        

                        if(count($datos) < 1)
                        {
                            return "";
                        }
                        else
                        {
                            return $datos;
                        }
                    }
                    else
                    {
                        return $datos;
                    }
            }
            else
            {
                return $datos;
            }
        }       
    }
}
