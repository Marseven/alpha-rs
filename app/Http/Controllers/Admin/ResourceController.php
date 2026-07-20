<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Minimal CRUD base for the security back-office (roles / objects / permissions).
 *
 * Replaces the former 330-line GenericController scaffolding. Those controllers
 * only ever route to their own custom index()/save() (plus permission()), and to
 * the two generic endpoints below:
 *   - edit   → fetch a single row as JSON (consumed by the inline edit modals)
 *   - delete → remove a row (legacy AJAX callers expect a truthy body)
 */
abstract class ResourceController extends Controller
{
    protected ?Model $model = null;

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    /** Return a single row as JSON. */
    public function edit(Request $request, $parent_id = null, $_id = null)
    {
        $_id = $_id ?? $parent_id;

        $object = DB::table($this->model->getTable())
            ->where($this->model->getKeyName(), '=', $_id)
            ->first();

        return response()->json(['model' => $object], 200);
    }

    /** Delete a row by primary key. Returns 1 for the legacy AJAX callers. */
    public function delete(Request $request, $parent_id = null, $_id = null)
    {
        // Only the three RBAC controllers extend this base, and they all gate on
        // the "Users" object. Deleting a role/object/permission is destructive
        // and was previously reachable with no permission check at all.
        \App\Http\Controllers\Controller::he_can('Users', 'del');

        $_id = $_id ?? $parent_id;

        $modelClass = get_class($this->model);
        $data = $modelClass::find($_id);
        if ($data !== null) {
            $data->delete();
        }

        return 1;
    }
}
