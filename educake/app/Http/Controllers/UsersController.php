<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * @Function   index
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 8:13 μ.μ.
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index() {
        return User::all();
    }

    /**
     * @Function   show
     * @param $id
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 8:13 μ.μ.
     * @return mixed
     */
    public function show($id) {
        return User::find($id);
    }

    /**
     * @Function   store
     * @param Request $request
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 8:13 μ.μ.
     * @return mixed
     */
    public function store(Request $request) {
        return User::create($request->all());
    }

    /**
     * @Function   update
     * @param Request $request
     * @param $id
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 8:12 μ.μ.
     * @return mixed
     */
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return $user;
    }

    /**
     * @Function   delete
     * @param Request $request
     * @param $id
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 8:12 μ.μ.
     * @return int
     */
    public function delete(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->delete();
        return 204;
    }
}
