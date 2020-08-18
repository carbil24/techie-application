<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
        
        $titles = ['Front-End Developper', 'Database Administrator', 'Java Developper', 'Web Designer', 'Back-end Junior Developper', 'Senior Systems Analyst', 'React Developper', 'Tech-Support - Linux', 'Tech-Support', 'Senior Full Stack Developer', 'C# Intern', 'Project Manager', 'IT Development', 'Data Analyst', 'Junior Full Stack Web Developper'];
        
        $companies = ['Google', 'Amazon', 'Microsoft', 'Air Canada', 'Facebook', 'Shopify', 'Ubisoft', 'John Abbott College', 'MUHC'];
        
        $locations = ['Montreal', 'San Fransicso', 'Toronto', 'Ottawa', 'Seattle', 'New York', 'Sainte-Anne-de-Bellevue'];

    
        for($i = 0; $i < 100; $i++){
            DB::table('jobs')->insert([
            ['title' => $titles[array_rand($titles)], 
            'location' => $locations[array_rand($locations)], 
            'company' => $companies[array_rand($companies)], 
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s', (mt_rand(1, time()))),
            'updated_at' => date('Y-m-d H:i:s', (time()))]
            ]);          
        }
        DB::table('users')->insert([
            ['first_name' => 'Carlos', 
            'last_name' => 'Bilbao', 
            'email' => 'carbil2@hotmail.com', 
            'password' => \Hash::make('carbil24'),
            'phone' => '555-5555555',
            'created_at' => date('Y-m-d H:i:s', (time())),
            'updated_at' => date('Y-m-d H:i:s', (time()))]
            ]);

        DB::table('users')->insert([
            ['first_name' => 'admin', 
            'last_name' => 'admin', 
            'email' => 'admin@techie.com', 
            'password' => \Hash::make('password'),
            'phone' => '555-5555555',
            'created_at' => date('Y-m-d H:i:s', (time())),
            'updated_at' => date('Y-m-d H:i:s', (time()))]
            ]);

        DB::table('contacts')->insert([
            ['name' => 'Carlos Bilbao', 
            'email' => 'carbil2@hotmail.com', 
            'subject' => 'Reset password', 
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'answer' => null,
            'isUser' => 'yes',
            'replied' => null,
            'created_at' => '2020-01-11 02:34:38',
            'updated_at' => date('Y-m-d H:i:s', (time()))]
        ]);

        DB::table('contacts')->insert([
            ['name' => 'John Smith', 
            'email' => 'jsmith@hotmail.com', 
            'subject' => 'Login issue', 
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'answer' => null,
            'isUser' => null,
            'replied' => null,
            'created_at' => date('Y-m-d H:i:s', (time())),
            'updated_at' => date('Y-m-d H:i:s', (time()))]
        ]);


    }
}
