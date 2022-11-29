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

define('STATUT_SIMULATOR', 11);

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function str_random($length)
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    static function str_random_pay($length)
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    static function formatPhone($num)
    {
        if (preg_match("#^0[6-7][0-7]([-. ]?[0-9]{2}){3}$#", $num)) {
            $meta_carac = array("-", ".", " ");
            $num = str_replace($meta_carac, "", $num);
            return $num;
        }

        return false;
    }

    static function status($status)
    {
        switch ($status) {
            case STATUT_RECEIVE:
                $message['type'] = "primary";
                $message['message'] = "Reçue";
                return $message;
                break;
            case STATUT_PENDING:
                $message['type'] = "warning";
                $message['message'] = "En cours";
                return $message;
                break;
            case STATUT_APPROVE:
                $message['type'] = "success";
                $message['message'] = "Approuvée";
                return $message;
                break;
            case STATUT_REFUSED:
                $message['type'] = "danger";
                $message['message'] = "Refusée";
                return $message;
                break;
            case STATUT_CANCEL:
                $message['type'] = "danger";
                $message['message'] = "Annulée";
                return $message;
                break;
            case STATUT_PAID:
                $message['type'] = "secondary";
                $message['message'] = "Payée";
                return $message;
                break;
            case STATUT_DO:
                $message['type'] = "success";
                $message['message'] = "Traitée";
                return $message;
                break;
            case STATUT_ENABLE:
                $message['type'] = "success";
                $message['message'] = "Actif";
                return $message;
                break;
            case STATUT_DISABLE:
                $message['type'] = "danger";
                $message['message'] = "Désactivé";
                return $message;
                break;
            case STATUT_DELIVEDRED:
                $message['type'] = "success";
                $message['message'] = "Livrée";
                return $message;
                break;
            case STATUT_OUT_DELIVERED:
                $message['type'] = "secondary";
                $message['message'] = "Récupérée en Agence";
                return $message;
                break;
            case STATUT_SIMULATOR:
                $message['type'] = "info";
                $message['message'] = "Simulation";
                return $message;
                break;
        }
    }

    static function work_status()
    {
        print '<option value="' . STATUT_RECEIVE . '">Reçu</option>';
        print '<option value="' . STATUT_PENDING . '">En cours de traitement</option>';
        print '<option value="' . STATUT_APPROVE . '">Appouvé</option>';
        print '<option value="' . STATUT_REFUSED . '">Refusé</option>';
        print '<option value="' . STATUT_CANCEL . '">Annulé</option>';
    }

    static function enable_status()
    {
        print '<option value="' . STATUT_ENABLE . '">Actif</option>';
        print '<option value="' . STATUT_DISABLE . '">Inactif</option>';
    }

    static function quote_status()
    {
        print '<option value="' . STATUT_RECEIVE . '">Reçu</option>';
        print '<option value="' . STATUT_PENDING . '">En cours de traitement</option>';
        print '<option value="' . STATUT_DO . '">Traité</option>';
    }

    static function he_can($controller, $action)
    {
        $user = Auth::user();
        $rolepermissions = DB::table('security_role_permission')
            ->join('security_permissions', 'security_permissions.id', '=', 'security_role_permission.security_permission_id')
            ->select('security_role_permission.*', 'security_permissions.*')
            ->where('security_role_permission.security_role_id', $user->security_role_id)
            ->get();

        foreach ($rolepermissions as $permission) {

            if ($permission->name == $controller) {

                switch ($action) {
                    case 'look':
                        if ($permission->look != "on") {

                            return redirect('logout')->with('error', "Vous n'avez pas le droit de faire cette action.");
                        }
                        break;
                    case 'creat':
                        if ($permission->creat != "on") {

                            return redirect('logout')->with('error', "Vous n'avez pas le droit de faire cette action.");
                        }
                        break;
                    case 'updat':
                        if ($permission->updat != "on") {

                            return redirect('logout')->with('error', "Vous n'avez pas le droit de faire cette action.");
                        }
                        break;
                    case 'del':
                        if ($permission->del != "on") {

                            return redirect('logout')->with('error', "Vous n'avez pas le droit de faire cette action.");
                        }
                        break;
                }
            }
        }
    }
}
