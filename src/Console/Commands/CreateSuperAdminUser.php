<?php

namespace Frontiernxt\Console\Commands;

use Illuminate\Console\Command;
use stdclass;
use exception;
use Frontiernxt\Jobs\CreateSuperAdminUser as CreateSuperAdmin;

class CreateSuperAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flsk:install:createadmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a super admin user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        process_start:

        $first_name = $this->ask('What is your first name?');

        if (empty($first_name) || $first_name == '')
        {

            $first_name = $this->ask('What is your first name?');            
        }   

        $last_name = $this->ask('What is your last name?');

        $email = $this->ask('What is your email?');

        password_routine_start:

        {
            $password = $this->ask('Enter the password you want to use');

            $password_confirm = $this->ask('Confirm the password that you just entered');

        }

        if ($password_confirm !== $password)
        {

            $this->error("The passwords do not match, please try again");

            goto password_routine_start;

        }

        $table_headers = ['First Name', 'Last Name', 'Email', 'Password'];

        $this->table($table_headers, array([$first_name, $last_name, $email, $password]));

        if ($this->confirm('This will create a user with the details provided above. Do you want to proceed?')) {

            $userdata = new stdClass;

            $userdata->first_name = $first_name;
            $userdata->last_name = $last_name;
            $userdata->email = $email;
            $userdata->password = $password;

            try {
                
                

                dispatch(new CreateSuperAdmin($userdata));

                //$this->info('trying dispatch 2');
                
                $this->info('User successfully created');

            } catch (Exception $e) {
                
                $this->error($e->getMessage());
            }


            //dispatch(new CreateSuperAdminUser($userdata));
            
            
        } else {

            goto process_start;
        }

    }
}
