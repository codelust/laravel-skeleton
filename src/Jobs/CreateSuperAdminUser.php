<?php

namespace Frontiernxt\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Frontiernxt\Models\User;
use Frontiernxt\Models\Role;
use Frontiernxt\Models\RoleUser;
use Exception;

class CreateSuperAdminUser implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;


    protected $userdata;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userdata, $context = null)
    {
        //
        $this->userdata = $userdata;
        $this->context = $context;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //check for user email



        if (User::where('email', $this->userdata->email)->count() > 0)
        {
            throw new Exception("There is already a user with that email ID", 1);
            
        }



        /*check whether is_global_superadmin role exists*/

        if (Role::where('name', 'is_global_superadmin')->count() == 0)
        {
            

            $role = new Role;
            $role->name = 'is_global_superadmin';
            $role->save();

            
        } else {

            $role = Role::where('name', 'is_global_superadmin')->first();

        }

        //dd($role);

        /*create the user*/

        
        $user = new User;
        $user->name = $this->userdata->first_name.' '.$this->userdata->last_name;
        $user->first_name = $this->userdata->first_name;
        $user->last_name = $this->userdata->last_name;
        $user->email = $this->userdata->email;
        $user->password = bcrypt($this->userdata->password);
        $user->save();

        /*add super admin role*/


        $role_user = new RoleUser;
        $role_user->user_id =  $user->id;
        $role_user->role_id =  $role->id;
        $role_user->subject_id = $user->id;
        $role_user->object_id = null;
        $role_user->subject_type = 'Frontiernxt\Models\User::class';
        $role_user->object_type =  null;
        $role_user->save();

        if ($role_user instanceof RoleUser)
        {

            if($this->context == 'artisan_command')
            {
                return true;
            }
        }

    }
}
