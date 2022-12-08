<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\Models\Image;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['update', 'edit']);
        // $this->authorizeResource(User::class, 'user');
    }



    public function show(User $user)
    {
        // $this->authorize('view', $user);
        // dd($user->image);
        return view('users.show', ['user' => $user->withCount('questions')->withCount('answers')->findOrFail($user->id)]);
    }



    public function edit(User $user)
    {

        $this->authorize('update', $user);
        return view('users.edit', ['user' => $user]);
    }


    
    public function update(UpdateUser $request, User $user)
    {

        $this->authorize('update', $user);

        // $question = 
        // $this->authorize(Question::findOrFail($id));

        $validatedData = $request->validated();
        
        if($request->hasFile('avatar'))
        {
            $path = $request->file('avatar')->store('usersProfile');

            if ($user->image) {
                
                $user->image->path = $path;
                $user->image->save();

            }
            else
            {
                $user->image()->save(Image::make(['path' => $path]));
            }

        }

        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->save();

        return redirect()->back()->withStatus('profile was updated');
    }
}
