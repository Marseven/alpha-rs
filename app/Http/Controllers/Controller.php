<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

define('STATUT_RECEIVE', 0);     // Largeur max de l'image en pixels
define('STATUT_PENDING', 1);
define('STATUT_APPROVE', 2);     // Largeur max de l'image en pixels
define('STATUT_REFUSED', 3);
define('STATUT_CANCEL', 4);
define('STATUT_PAID', 5);
define('STATUT_DO', 6);

define('STATUT_ENABLE', 7);
define('STATUT_DISABLE', 8);

define('STATUT_DELIVEDRED', 9);
define('STATUT_OUT_DELIVERED', 10);

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function str_random($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    static function status($status){
        switch ($status) {
            case STATUT_RECEIVE:
                return $message = "Reçu";
                break;
            case STATUT_PENDING:
                return $message = "En cours de traitement";
                break;
            case STATUT_APPROVE:
                return $message = "Approuvé";
                break;
            case STATUT_REFUSED:
                return $message = "Refusé";
                break;
            case STATUT_CANCEL:
                return $message = "Annulé";
                break;
            case STATUT_PAID:
                return $message = "Payé";
                break;
            case STATUT_DO:
                return $message = "Traité";
                break;
            case STATUT_ENABLE:
                return $message = "Actif";
                break;
            case STATUT_DISABLE:
                return $message = "Désactivé";
                break;
            case STATUT_DELIVEDRED:
                return $message = "Livré";
                break;
            case STATUT_OUT_DELIVERED:
                return $message = "Sans Livraison";
                break;
        }
    }

    static function work_status(){
        print '<option value="'.STATUT_RECEIVE.'">Reçu</option>';
        print '<option value="'.STATUT_PENDING.'">En cours de traitement</option>';
        print '<option value="'.STATUT_APPROVE.'">Appouvé</option>';
        print '<option value="'.STATUT_REFUSED.'">Refusé</option>';
        print '<option value="'.STATUT_CANCEL.'">Annulé</option>';
    }

    static function enable_status(){
        print '<option value="'.STATUT_ENABLE.'">Actif</option>';
        print '<option value="'.STATUT_DISABLE.'">Inactif</option>';
    }

    static function quote_status(){
        print '<option value="'.STATUT_RECEIVE.'">Reçu</option>';
        print '<option value="'.STATUT_PENDING.'">En cours de traitement</option>';
        print '<option value="'.STATUT_DO.'">Traité</option>';
    }

    static function he_can($controller, $action){
        $user = Auth::user();
        $rolepermissions = DB::table('security_role_permission')
            ->join('security_permissions', 'security_permissions.id', '=', 'security_role_permission.security_permission_id')
            ->select('security_role_permission.*', 'security_permissions.*')
            ->where('security_role_permission.security_role_id', $user->security_role_id)
            ->get();

        foreach($rolepermissions as $permission){

            if($permission->name == $controller){

                switch ($action) {
                    case 'look':
                        if($permission->look != "on"){

                            return redirect('logout')->with('error',"Vous n'avez pas le droit de faire cette action.");
                        }
                        break;
                    case 'creat':
                        if($permission->creat != "on"){

                            return redirect('logout')->with('error',"Vous n'avez pas le droit de faire cette action.");
                        }
                        break;
                    case 'updat':
                        if($permission->updat != "on"){

                            return redirect('logout')->with('error',"Vous n'avez pas le droit de faire cette action.");
                        }
                        break;
                    case 'del':
                        if($permission->del != "on"){

                            return redirect('logout')->with('error',"Vous n'avez pas le droit de faire cette action.");
                        }
                        break;
                }
            }

        }
    }

}
