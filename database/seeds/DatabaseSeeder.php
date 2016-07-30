<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Role;
use App\CategoryConfiguration;
use App\Configuration;
use App\BlogTag;
use App\PersonalInformation;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();
        //insert Users
        $this->call('UserTableSeeder');
        $this->command->info('User table seeded!');

        $this->call('ConfigurationTableSeeder');
        $this->command->info('Configuration table seeded!');

        DB::unprepared(File::get('database/dump/blogEntriesData.sql'));
        $this->command->info('blogEntries data dump table seeded!');

        $this->call('BlogTagTableSeeder');
        $this->command->info('BlogTag table seeded!');

        $this->call('PersonalInformationTableSeeder');
        $this->command->info('PersonalInformation table seeded!');

        $this->call('NavigationUrlTableSeeder');
        $this->command->info('NavigationUrl table seeded!');
        
        Model::reguard();
    }
}

//clase para insertar usuarios
class UserTableSeeder extends Seeder {

    public function run() {

        DB::table('users')->delete();
        DB::table('role_user')->delete();
        DB::table('roles')->delete();

        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'User Administrator'; // optional
        $admin->description = 'User is allowed to manage all the app'; // optional
        $admin->save();

        $usersAdmin = array(['name' => 'admin', 'email' => 'admin@test.com', 'password' => Hash::make('123456')]);

        // Loop through each user above and create the record for them in the database
        foreach ($usersAdmin as $userAdmin) {
            User::create($userAdmin);
        }

        $userAdminRole = User::where('name', '=', 'admin')->first();
        $userAdminRole->attachRole($admin); //asignamos el rol al usuario

        $member = new Role();
        $member->name = 'member';
        $member->display_name = 'User Member'; // optional
        $member->description = 'User is not allowed to manage all the app'; // optional
        $member->save();

        $usersMember = array(['name' => 'member', 'email' => 'member@test.com', 'password' => Hash::make('123456')]);

        // Loop through each user above and create the record for them in the database
        foreach ($usersMember as $userMember) {
            User::create($userMember);
        }

        $userMemberRole = User::where('name', '=', 'member')->first();
        $userMemberRole->attachRole($member); //asignamos el rol al usuario
    }
}

class ConfigurationTableSeeder extends Seeder {

    public function run() {

        DB::table('category_configurations')->delete();
        DB::table('configurations')->delete();

        $categoryConfiguration = new CategoryConfiguration();
        $categoryConfiguration->name = 'states';
        $categoryConfiguration->save();


        $configurationList = array(['name' => 'enabled', 'category_configurations_id' => $categoryConfiguration->id],
            ['name' => 'disabled', 'category_configurations_id' => $categoryConfiguration->id]);

        // Loop through each user above and create the record for them in the database
        foreach ($configurationList as $configuration) {
            Configuration::create($configuration);
        }
    }
}

class BlogTagTableSeeder extends Seeder {

    public function run() {

        DB::table('blog_tags')->delete();

        $blogTagList = array(['name' => 'Sql', 'state' => '1'],
            ['name' => 'Azure', 'state' => '1'],
            ['name' => 'PHP', 'state' => '1'],
            ['name' => 'Android', 'state' => '1'],
            ['name' => '.Net', 'state' => '1'],
            ['name' => 'C#', 'state' => '1']
        );

        // Loop through each user above and create the record for them in the database
        foreach ($blogTagList as $blogTag) {
            BlogTag::create($blogTag);
        }
    }
}

class PersonalInformationTableSeeder extends Seeder {

    public function run() {

        DB::table('personal_informations')->delete();

        $personalInformation = new PersonalInformation();
        $personalInformation->siteName = "Henry Gustavo's Blog";
        $personalInformation->firstName = 'Henry';
        $personalInformation->lastName = 'Fuentes';
        $personalInformation->email = 'henrygustavof@gmail.com';
        $personalInformation->country = 'Peru';
        $personalInformation->phoneNumber = '+51949333390';
        $personalInformation->photoId = '0ByH61UfQn23nYTFmTWQ4d003MFU';
        $personalInformation->description = 'developer';
        $personalInformation->facebook = 'https://www.facebook.com/henrygustavo';
        $personalInformation->twitter = 'https://twitter.com/henrygfv';
        $personalInformation->googlePlus = 'https://plus.google.com/u/0/+henryfuentesvillanueva';
        $personalInformation->save();
    }
}

class NavigationUrlTableSeeder extends Seeder {

    public function run() {

        DB::table('navigation_urls')->delete();

        $navigationUrlList = array(
            ['name' => 'DashBoard','value' => 'home','url' => 'home','icon' => 'fa-home','order' => '1', 'state' => '1', 'isAdmin' => '1'],
            ['name' => 'Blog Entries','value' => 'blogEntries','url' => 'blogEntriesList','icon' => 'fa-edit','order' => '2', 'state' => '1', 'isAdmin' => '1'],
            ['name' => 'Personal Information','value' => 'personalInformation','url' => 'personalInformationList','icon' => 'fa-edit','order' => '3', 'state' => '1', 'isAdmin' => '1'],
            ['name' => 'Navigation Url','value' => 'navigationUrl','url' => 'navigationUrlList','icon' => 'fa-edit','order' => '4', 'state' => '1', 'isAdmin' => '1'],
            ['name' => 'Home','value' => 'home','url' => 'home','icon' => '','order' => '1', 'state' => '1', 'isAdmin' => '0']
        );

        // Loop through each user above and create the record for them in the database
        foreach ($navigationUrlList as $navigationUrl) {
            App\NavigationUrl::create($navigationUrl);
        }
    }
}
