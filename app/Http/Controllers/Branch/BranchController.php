<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchCreate;
use App\Http\Requests\BranchUpdate;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin',['except' => ['allBranch']]);
    }

    /**
     * Get All Branch Information.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function allBranch()
    {
        return response()->json(Branch::all());
    }
    /**
     * Create a new Branch.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(BranchCreate $request)
    {
        $data =  $request->all();
        /*$branch = new Branch;
        $branch->create($data);*/
        Branch::create($data);
        return response()->json(['message'=> 'New branch create successfully.']);
    }
    /**
     * Update Branch Informations.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BranchUpdate $request)
    {
        $data =  $request->all();
        $branch = Branch::findOrFail($request->branch_id);
        $data =  $request->except('branch_id');
        $branch->update($data);
        return response()->json(['message'=> 'Branch update successfully.']);
    }
    /**
     * Delete a Branch.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        Branch::findOrFail($request->branch_id)->delete();
        return response()->json(['message'=> 'Branch delete successfully.']);
    }

}
