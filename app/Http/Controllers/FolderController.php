<?php

namespace App\Http\Controllers;

use App\Mail\StatusMessage;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FolderController extends Controller
{

    public function index()
    {
        $user = User::find(Auth::user()->id);
        $user->load(['folders']);
        return view('folders.list',
        [
            'folders' => $user->folders,
        ]);
    }

    public function add()
    {
    	return view('folders.add');
    }

    public function create(Request $request)
    {

    	$folder = new Folder();

        $folder->reference = $this->str_random(8);

        $folder->lastname = $request->lastname;

        $folder->firstname = $request->firstname;
        $folder->birthday = $request->birthday;

        $folder->gender = $request->gender;

        $folder->email = $request->email;
        $folder->phone = $request->phone;

        $folder->category = $request->category;

        $join_piece = FileController::folder_file($request->file('join_piece'));
        if($join_piece['state'] == false){
            return back()->with('error',$join_piece['message']);
        }

        $folder->join_piece = $join_piece['url'];


        $folder->status = STATUT_RECEIVE;

        $folder->service_id = $request->service_id;
        $folder->country_id = $request->country_id;


        $folder->user_id = auth()->user()->id;

        if($folder->save()){

            return back()->with('succes',"Votre dossier  a été crée.");

        }else{
            return back()->with('error','Une erreur s\'est produite, Veuillez réessayer !');
        }
    }

    public function quote(Quote $quote){

        $folder = new Folder();

        $folder->reference = $this->str_random(8);

        $folder->lastname = $quote->lastname;

        $folder->firstname = $quote->firstname;
        $folder->birthday = $quote->birthday;

        $folder->gender = $quote->gender;

        $folder->email = $quote->email;
        $folder->phone = $quote->phone;

        $folder->category = $quote->category;
        $folder->join_piece = $quote->join_piece;


        $folder->status = STATUT_RECEIVE;

        $folder->service_id = $quote->service_id;
        $folder->country_id = $quote->country_id;


        $folder->user_id = auth()->user()->id;

        if($folder->save()){

            return back()->with('succes',"Votre dossier a été crée avec succès.");

        }else{
            return back()->with('error','Une erreur s\'est produite, Veuillez réessayer !');
        }

    }

    public function pay(Folder $folder){

        return PaymentController::ebilling('folder', $folder);

    }

    public function edit(Folder $folder)
    {
    	if (auth()->user()->id == $folder->user_id)
        {
            return view('edit', compact('folder'));
        }else {
            return back();
        }
    }

    public function update(Request $request, Folder $folder)
    {
        Controller::he_can('Folders', 'updat');

    	if(isset($_POST['delete'])) {
    		if($folder->delete()){
                return back()->with('success','Le dossier a été supprimée.');
            }else{
                return back()->with('error', 'La dossier n\'a pas été supprimée.');
            }
    	}else{
            $folder->lastname = $request->lastname;

            $folder->firstname = $request->firstname;
            $folder->birthday = $request->birthday;

            $folder->genre = $request->genre;

            $folder->email = $request->email;
            $folder->phone = $request->phone;

            $folder->category = $request->category;

            $join_piece = FileController::folder_file($request->file('join_piece'));

            if($join_piece['state'] == false){
                return back()->with('error',$join_piece['message']);
            }

            $folder->join_piece = $join_piece['url'];

            if($folder->save()){
                return back()->with('success', 'Le statut de la demande a été mise à jour.');
            }else{
                return back()->with('error', 'Le statut de la demande n\'a pas été mise à jour.');
            }
    	}
    }

    public function updateState(Request $request, $folder)
    {
        $folder = Folder::find($folder);
        $folder->status = $request->status;
        $folder->price = $request->price;
        $folder->load(['user']);
        if($folder->save()){
            Mail::to($folder->user->email)->queue(new StatusMessage($folder, "folder"));
            return back()->with('success', "Le status du dossier a bien été mis à jour !");
        }else{
            return back()->with('error', "Une erreur s'est produite.");
        }

    }


}
