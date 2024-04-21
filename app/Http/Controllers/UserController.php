<?php
namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;


Class UserController extends Controller {

    use ApiResponser;

    private $request;

    public function __construct(Request $request){
    $this->request = $request;
    }

    //GET USERS

    public function getUsers(){
        $users = User::all();
        return response()->json($users, 200);
    }

    //INDEXING

    public function index(){
        $users = User::all();
        return $this->successResponse($users);
    }

    //ADD USERS

    public function add(Request $request ){
        $rules = [
        'username' => 'required|max:20',
        'password' => 'required|max:20',
        'gender' => 'required|in:Male,Female',
        ];
        $this->validate($request,$rules);
        $user = User::create($request->all());
        return $this->successResponse($user,Response::HTTP_CREATED);
    }

    //SHOW ID INFORMATION

    public function show($id){
        $user = User::findOrFail($id);
        return $this->successResponse($user);
    }

    //UPDATE USER ID
    
    public function update(Request $request,$id){
        $rules = [
        'username' => 'max:20',
        'password' => 'max:20',
        'gender' => 'in:Male,Female',
        ];
        $this->validate($request, $rules);
        $user = User::findOrFail($id);

        $user->fill($request->all());

        // if no changes happen
        if ($user->isClean()) {
        return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->save();
        return $this->successResponse($user);
    }

    //DELETE USER ID

    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return $this->successResponse($user);
    }

}