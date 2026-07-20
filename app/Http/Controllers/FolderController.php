<?php

namespace App\Http\Controllers;

use App\Mail\StatusMessage;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FolderController extends Controller
{

    public function index()
    {
        $user = User::find(Auth::user()->id);
        $user->load(['folders']);
        return view(
            'folder.list',
            [
                'folders' => $user->folders,
            ]
        );
    }

    public function add()
    {
        return view('folder.add');
    }

    public function create(\App\Http\Requests\StoreFolderRequest $request)
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
        if ($join_piece['state'] == false) {
            return back()->with('error', $join_piece['message']);
        }

        $folder->join_piece = $join_piece['url'];


        $folder->status = STATUT_RECEIVE;

        $folder->service_id = $request->service_id;
        $folder->country_id = $request->country_id;


        $folder->user_id = auth()->user()->id;

        if ($folder->save()) {

            return back()->with('success', "Votre dossier  a été crée.");
        } else {
            return back()->with('error', 'Une erreur s\'est produite, Veuillez réessayer !');
        }
    }

    public function quote(Quote $quote)
    {
        $this->authorize('convert', $quote);

        $folder = new Folder();

        $folder->reference = $quote->reference;

        $folder->lastname = $quote->lastname;

        $folder->firstname = $quote->firstname;
        $folder->birthday = $quote->birthday;

        $folder->gender = $quote->gender;

        $folder->email = $quote->email;
        $folder->phone = $quote->phone;

        $folder->category = $quote->category;
        // A quote stores three documents; the medical report is the most
        // relevant one to carry over to the folder. (The legacy code copied
        // $quote->join_piece, a column that does not exist on quotes, which
        // produced a NULL and crashed on the NOT NULL folders.join_piece.)
        $folder->join_piece = $quote->join_piece_rapport
            ?? $quote->join_piece_passport
            ?? $quote->join_piece_exam;


        $folder->status = STATUT_RECEIVE;

        $folder->service_id = $quote->service_id;
        $folder->country_id = $quote->country_id;


        $folder->user_id = auth()->user()->id;

        if ($folder->save()) {
            $quote->folder = true;
            $quote->save();
            return back()->with('success', "Votre dossier a été crée avec succès.");
        } else {
            return back()->with('error', 'Une erreur s\'est produite, Veuillez réessayer !');
        }
    }

    public function pay(Folder $folder)
    {
        $this->authorize('pay', $folder);

        return PaymentController::singpay('folder', $folder);
    }

    public function update(Request $request, Folder $folder)
    {
        Controller::he_can('Folders', 'updat');

        if ($request->has('delete')) {
            if ($folder->delete()) {
                return back()->with('success', 'Le dossier a été supprimée.');
            } else {
                return back()->with('error', 'La dossier n\'a pas été supprimée.');
            }
        } else {
            $folder->lastname = $request->lastname;

            $folder->firstname = $request->firstname;
            $folder->birthday = $request->birthday;

            $folder->genre = $request->genre;

            $folder->email = $request->email;
            $folder->phone = $request->phone;

            $folder->category = $request->category;

            $join_piece = FileController::folder_file($request->file('join_piece'));

            if ($join_piece['state'] == false) {
                return back()->with('error', $join_piece['message']);
            }

            $folder->join_piece = $join_piece['url'];

            if ($folder->save()) {
                return back()->with('success', 'Le statut de la demande a été mise à jour.');
            } else {
                return back()->with('error', 'Le statut de la demande n\'a pas été mise à jour.');
            }
        }
    }

    public function updateState(Request $request, $folder)
    {
        // This action changes the client-facing status AND the price, and mails
        // the client: it must be gated like every other back-office write.
        Controller::he_can('Folders', 'updat');

        $request->validate([
            'status' => 'required|in:' . implode(',', [
                STATUT_RECEIVE, STATUT_PENDING, STATUT_APPROVE, STATUT_REFUSED, STATUT_CANCEL,
            ]),
            'price' => 'required|numeric|min:0',
        ]);

        $folder = Folder::findOrFail($folder);
        $folder->status = $request->status;
        $folder->price = $request->price;
        $folder->load(['user']);
        if ($folder->save()) {
            try {
                Mail::to($folder->user->email)->queue(new StatusMessage($folder, "folder"));
            } catch (\Throwable $e) {
                // Was `catch (Swift_TransportException)` — a class that no longer
                // exists on Laravel 12 (Symfony Mailer), so any SMTP failure
                // escaped as a 500 *after* the status had been saved. It also
                // echoed the error into the response body.
                Log::warning('Folder status notification failed: ' . $e->getMessage());
            }
            return back()->with('success', "Le status du dossier a bien été mis à jour !");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }
}
