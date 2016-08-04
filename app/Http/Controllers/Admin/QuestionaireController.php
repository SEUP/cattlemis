<?php

namespace App\Http\Controllers\Admin;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/30/2016
 * Time: 8:33 AM
 */

use App\Models\FarmOwner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use \App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;


class QuestionaireController extends Controller
{
    private $namespace = __NAMESPACE__;

    public function index()
    {
        $farmOwners = FarmOwner::paginate(20);
        return view('admin.questionaire.search')
            ->with('farmOwners', $farmOwners);
    }

    public function add()
    {
        return view('admin.questionaire.addform');
    }

    function doAdd(UserCreateRequest $request)
    {

    }

    function edit($id)
    {
        $farmOwner = FarmOwner::find($id);
        return view('admin.questionaire.editform')
            ->with('farmOwner', $farmOwner);
    }

    function doEdit(Request $request, $id)
    {

    }

    function doDelete($id)
    {
        $farmOwner = FarmOwner::find($id);
        $farmOwner->delete();
        return redirect()->action("\\$this->namespace\\QuestionaireController@index")->with("SUCCESS_MESSAGE", ["msg" => "ลบข้อมูลเกษตรเรียบร้อย"]);
    }

    function export($id)
    {
        $pdf = \App::make('dompdf.wrapper');

        $farmOwner = FarmOwner::find($id);
        $view = view('admin.questionaire.export')
            ->with("farmOwner", $farmOwner)->render();

        $pdf->loadHTML($view);
        return $pdf->stream();
    }

}