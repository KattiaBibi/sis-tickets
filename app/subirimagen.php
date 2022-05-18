<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class subirimagen extends Model
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
                Storage::disk('public')->delete("$imgactual");
            }

            $imageName = Str::slug($nombre) . time() . '.' . $ext;
            $imagen =  Image::make($imagen)->encode($ext, 20);
            Storage::disk('public')->put("$ruta/$imageName", $imagen->stream());
            $compl = $ruta . $imageName;
            return $compl;
        } else {
            return false;
        }
    }
}
