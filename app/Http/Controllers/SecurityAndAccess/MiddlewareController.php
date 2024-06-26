<?php

namespace App\Http\Controllers\SecurityAndAccess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SecurityAndAccess\Middleware;
use Illuminate\Support\Facades\DB;

class MiddlewareController extends Controller
{
    public function middlewareSearch(Request $req)
    {
        $query = $req->input('query');
        $middlewares = Middleware::search($query)->paginate(10);
        return view('security_and_access.middleware.index', array('middlewares' => $middlewares));
    }

    public function middlewareCreate()
    {
        return view('security_and_access.middleware.create');
    }

    public function middlewareStore(Request $request)
    {
        $name = $request->name;
        $description = $request->description;
        $status = $request->status;
        if ($status == 'true') {
            $status = true;
        } else {
            $status = false;
        }
        try {
            $insert = Middleware::create([
                'name' => $name,
                'description' => $description,
                'active_status' => $status,
            ]);
            DB::commit();
            return redirect()->back()->with("success", "Middleware Create Successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e . " Something want wrong!, please try again");
        }
    }

}