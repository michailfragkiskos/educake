<?php

namespace App\Observers;
use App\User;

class UsersObserver
{
    /**
     * @Function   retrieved
     * @param User $user
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:58 μ.μ.
     */
   public function retrieved(User $user){
       $user->setAttribute('created',$user->created_at->diffForHumans());
   }

    /**
     * @Function   updating
     * @param User $user
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:58 μ.μ.
     */
   public function updating(User $user){
      unset($user->created);

   }
}
