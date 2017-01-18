<?php

namespace Frontiernxt\Repositories\;

use Frontiernxt\Repositories\Contracts\UserRepositoryInterface;
use Frontiernxt\Models\User;

class AdminRepository implements UserRepositoryInterface
{
        protected $user;
        
        public function __construct(User $user)
        {
                $this->user = $user;
        }
        
        public function find($id)
        {
                return $this->user->find($id);
        }
        
        public function findBy($att, $column)
        {
                return $this->user->where($att, $column)
        }

        public function findall()
        {

                return User::where('');
        }
}
?>