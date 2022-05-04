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
 * $ruta, por si quieres reutilizar la funcion en otro lado
 * $nombre->    supongo que es para el slug que estas usando
 * $imgactual-> para el actualizar para que cambie la imagen anterior por la nueva
 */
 public static function imagen($imagen,$nombre,$ruta,$imgactual=false){
    //validas la iamgen :v
    if($imagen){
        //obtienes la extension
        $ext=$imagen->extension();
        //validas si viene un valor en el paremetro para cambiar la iamgen (update)
        if($imgactual) {
            //eliminas la imagen anterior (update)
            Storage::disk('public')->delete("$imgactual");
        }

        $imageName = Str::slug($nombre).time().'.'.$ext;
        $imagen =  Image::make($imagen)->encode($ext, 20);
        Storage::disk('public')->put("$ruta/$imageName", $imagen->stream());
        $compl=$ruta.$imageName;
        return $compl;
    }else{
        return false;
    }

 }

}
