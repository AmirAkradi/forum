<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Question $question)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Question $question)
    {
        return $user->id == $question->user->id;
        // return true;
    }

    public function delete(User $user, Question $question)
    {
        return $user->id == $question->user->id;
    }

    public function restore(User $user, Question $question)
    {
        return false;
    }

    public function forceDelete(User $user, Question $question)
    {
        return false;
    }
}
