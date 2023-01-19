<?php

namespace App\Http\Controllers;

use App\Models\Crud;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CrudController extends Controller
{
    public function showData()
    {
        // $showData = Crud::all();
        $showData = Crud::paginate(3);
        // $showData = Crud::simplePaginate(3);

        return view('show_data', compact('showData'));
    }
    public function addData()
    {
        return view('add_data');
    }

    public function storeData(Request $request)
    {
        $rules = [
            'name' => 'required | max: 10',
            'email' => 'required | email',
        ];
        $this->validate($request, $rules);

        $crud = new Crud();
        $crud->name = $request->name;
        $crud->email = $request->email;
        $crud->save();
        Session::flash('msg', "Data successfully added");
        // return $request->all(); // it retruns the the data in json format
        return redirect('/');

    }

    public function editData($id = null)
    {
        $editData = Crud::find($id);
        return view('edit_data', compact('editData'));
    }


    public function updateData(Request $request, $id)
    {
        $rules = [
            'name' => 'required | max: 10',
            'email' => 'required | email',
        ];
        $this->validate($request, $rules);

        $updateData = Crud::find($id);
        $updateData->name = $request->name;
        $updateData->email = $request->email;
        $updateData->save();
        Session::flash('msg', "Data successfully updated");
        // return $request->all(); // it retruns the the data in json format
        return redirect('/');

    }

    public function deleteData($id = null)
    {
        $deleteData = Crud::find($id);
        $deleteData->delete();
        Session::flash('msg', "Data successfully deleted");
        return redirect('/');


    }
}