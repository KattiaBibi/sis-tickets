<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class subirarchivo extends Model
{
    /**
     * $imagen->  la imagen que entra por post (store)
     * $ruta, por si se quiere reutilizar la funcion en otro lado
     * $nombre->     es para el slug que se está usando
     * $imgactual-> para el actualizar para que cambie la imagen anterior por la nueva
     */
    public static function imagen($imagen, $nombre, $ruta, $imgactual = false)
    {
        //valida la imagen
        if ($imagen) {
            //obtienes la extension
            $ext = $imagen->extension();
            //valida si viene un valor en el paremetro para cambiar la iamgen (update)
            if ($imgactual) {
                //elimina la imagen anterior (update)
                Storage::disk('public')->delete($ruta . $imgactual);
            }

            $imageName = Str::slug($nombre) . time() . '.' . $ext;
            $imagen =  Image::make($imagen)->encode($ext, 20);
            Storage::disk('public')->put("$ruta/$imageName", $imagen->stream());
            $compl = $ruta . $imageName;
            return $imageName;
        } else {
            return false;
        }
    }

    public static function archivo($archivo2, $nombre2, $ruta2, $archivoactual = false)
    {

        if ($archivo2) {
            //obtenemos el nombre del archivo
            $nombre2 = "archivo_".time().$archivo2->getClientOriginalName();

            if ($archivoactual) {
                //elimina el archivo anterior (update)
                Storage::disk('public')->delete($ruta2 . $archivoactual);
            }

            //indicamos que queremos guardar un nuevo archivo en el disco local
            Storage::disk('public')->put("$ruta2/$nombre2",  File::get($archivo2));
            return $nombre2;

            } else {
                return false;
            }

    }

}
