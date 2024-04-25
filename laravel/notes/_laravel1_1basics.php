<!-- Laravel Basics -->
<!-- https://teamtreehouse.com/library/laravel-basics-2 -->

<!-- One of the most popular frameworks that uses the MCV design pattern -->

<!-- Creating a Laravel 6 Project
    composer create-project --prefer-dist laravel/laravel=^6 treehouse
    composer create-project --prefer-dist laravel/laravel=^9 treehouse
-->

<!-- Requires Local Dev Environment to be Running -->

<!-- Create database in phpadmin -->

<!-- .env settings
    Change DB_DATABASE to be your database (.env file, line 14)
    Change DB_USERNAME to be your username (.env file, line 15)
    hange DB_PASSWORD to be your password (blank) (.env file, line 16)
-->

<!-- php artisan migrate
    In VSCode Terminal to check the database is linked correctly
-->

<!-- To View Site
    php artisan serve --host=localhost
    Open link to view site
-->

<!-- Important Folders and files

    * app/Http/Controllers - Controllers
    * database - Databases (migrations for schema, seed to insert initial values)
    * resources - Markup for welcome page (js and css folders)
    * resources/views - Blade components for UI
    * routes - web and api routes
    * composer.json and package.json - Manage packages and dependancies
    * .env - Defines database, credendials, app url and environment state (development, staging, production)

-->

<!-- In routes/web.php
    Copy Route function to create other web rouses
-->
<?php

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/tracks', function () {
        return view('welcome');
    });

    Route::get('/community', function () {
        return view('welcome');
    });

    Route::get('/support', function () {
        return view('welcome');
    });

?>

<!-- Closures -->
<?php
    //Can directly modify html here
    Route::get('/', function () {
        return "<h1>Hello world</h1>";
    });

    //But you'll probably view an actual page (resources/views)
    Route::get('/', function () {
        return view('welcome');
    });
?>

<!-- Artisan Commands (In VSCode Terminal)
    php artisan list - View all artisan commands
    php artisan help {command name} - view details of command
    php artisan migrate - Test database credentials
    php artisan route:list - Get a list of all routes
    php artisan tinker - Look inside database, perform database migrations or seed database
-->

<!-- Intro to Controllers

    Create a new controller with the following command:
        php artisan make:controller {controller name}
    Example:
        php artisan make:controller AppController

    Created controller should be in app/Http/Controllers folder with the given name
-->
<?php
    //Create index function in controller
    class AppController extends Controller
    {
        public function index()
        {
            return view('welcome');
        }
    }

    //Then replace rouse in wep.php to use this function
    Route::get('/', [AppController::class, 'index']);

    //May need to add at top of web.php file
    // use App\Http\Controllers\Appcontroller;
?>

<!-- Resource Controllers

    Resource controllers have CRUD operations built in

    Create a new resource controller with the following command:
        php artisan make:controller {controller name} -r
    Example:
        php artisan make:controller ResourceController -r

    Created controller should be in app/Http/Controllers folder with the given name
-->

<!-- Creating views with Blade
    Blade is a templating engine
    Blades can be used like php files that make up the content of your page, use like html docs
-->

<!-- Using Includes
    Much like including files in php, but can do this directly in the html
-->
@include("head")

<!-- Extending Blade Templates
    Extend other files using the extends keyword
-->
@extends("treehouse") <!-- In other pages: Extends the treehouse file with the contents in this file -->
@section('body')
    <!-- HTML/PHP Content Here -->
@endsection

@yield('body') <!-- In main page: Determines where in the treehouse file the contents will be places -->

<!-- Update web.php with new web routes -->
<!-- Update index in AppController -->
<?php
    class AppController extends Controller
    {
        public function index()
        {
            return view('library');
        }
    }
?>

<!-- May need to update .env

    Go into your env file for the project
    Change APP_URL from http://localhost to http://localhost:8000
    Restart your development environment

-->

<!-- Intro to Models
    Direct connection between database and Laravel application

    Create a new Model with the following command:
        php artisan make:model {model name} -m
    Example
        php artisan make:model Course -m

    Created model should be in database/migrations folder
    Name should have the date and timestamp
-->
<?php
    // Then need to update the model schema in the up function
    // (should be in database/migrations)
    class ClassName
    {
        public function up()
        {
            Schema::create('courses', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->longText('summary');
                $table->integer('duration');
                $table->string('language');
                $table->string('difficulty');
                $table->integer('stages');
                $table->timestamps();
            });
        }
    }

    // In AppController, modify index to get data from Course table
    class AppController extends Controller
    {
        public function index()
        {
            return view('library', ["courses" => Course::all()]);
        }
    }
?>

<!-- Intro to Tinker

    Use Tinker to Seed the Database
    
    Open the tinker shell environment with the following command:
        php artisan tinker

    Get info on tinker functions with:
        help

-->

<!-- Deploying Migrations

    Create a table seeder with the following command:
        php artisan make:seeder {name of seeder}
    Example:
        php artisan make:seeder CoursesTableSeeder

    Created table seeder should be in database/seeders folder with the given name

-->

<?php //In CoursesTablerSeeder.php

    // Ensure seeder files uses the following:
    // use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    // use Illuminate\Database\Seeder;
    // use Illuminate\Support\Facades\DB;

    class CoursesTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            #region Seed Database Values
            DB::table('courses')->insert([
                'title' => 'Using SQL ORMs with Node.js',
                'summary' => 'In this course, you\'ll learn how to use the Sequelize ORM to leverage the power of SQL within your Node.js applications.',
                'duration' => '121',
                'language' => 'JavaScript',
                'difficulty' => 'Intermediate',
                'stages' => '3',
            ]);
            DB::table('courses')->insert([
                'title' => 'Introducing Dictionaries',
                'summary' => 'Another useful Python data structure is the dictionary. Learn how to write one and use one in your day to day Python code.',
                'duration' => '60',
                'language' => 'Python',
                'difficulty' => 'Beginner',
                'stages' => '2',
            ]);
            DB::table('courses')->insert([
                'title' => 'Python Sequences',
                'summary' => 'Discover several types of Python sequences, many ways of sequence iterations, and all of the common sequence operations.',
                'duration' => '61',
                'language' => 'Python',
                'difficulty' => 'Intermediate',
                'stages' => '2',
            ]);
            DB::table('courses')->insert([
                'title' => 'Functions, Packing, and Unpacking',
                'summary' => 'Learn the ins and outs of Python functions, how to send and receive values to functions, and all about Python packing and unpacking.',
                'duration' => '65',
                'language' => 'Python',
                'difficulty' => 'Beginner',
                'stages' => '3',
            ]);
            DB::table('courses')->insert([
                'title' => 'Introducing Tuples',
                'summary' => 'Learn about a python data structures that\'s similar to lists, but with one key difference!',
                'duration' => '13',
                'language' => 'Python',
                'difficulty' => 'Beginner',
                'stages' => '1',
            ]);
            DB::table('courses')->insert([
                'title' => 'React Authentication',
                'summary' => 'In this course, you will learn how to implement the Basic Authentication scheme in a React application using an Express REST API.',
                'duration' => '82',
                'language' => 'JavaScript',
                'difficulty' => 'Intermediate',
                'stages' => '3',
            ]);
            DB::table('courses')->insert([
                'title' => 'Designing Layouts',
                'summary' => 'In this course you\'ll learn how to apply design principles through a series of examples. Each example will include some component that can be improved, and by making the improvement, you\'ll develop strong aesthetic sensibilities about things like visual and typographic hierarchy, the use of grids and alignment in layouts, and how to choose colors.',
                'duration' => '52',
                'language' => 'Design',
                'difficulty' => 'Beginner',
                'stages' => '2',
            ]);
            DB::table('courses')->insert([
                'title' => 'AJAX Basics',
                'summary' => 'AJAX is an important front-end web technology that lets JavaScript communicate with a web server. It lets you load new content without leaving the current page, creating a better, faster experience for your web site\'s visitors. In this course, you\'ll learn how AJAX works and how you can use JavaScript to communicate with a web server. We\'ll use plain JavaScript to create AJAX requests and use the response to dynamically update your web pages. Along the way, you\'ll build mini-projects to reinforce your learning.',
                'duration' => '149',
                'language' => 'JavaScript',
                'difficulty' => 'Intermediate',
                'stages' => '2',
            ]);
            DB::table('courses')->insert([
                'title' => 'Build a Simple iPhone App with Swift v5',
                'summary' => 'Building the Random Facts app will teach you how to use the Swift language and the Xcode and Interface Builder tools. You will also learn about core concepts such as views and view controllers, creating a data model, and how to refactor your code. Towards the end you will have finished creating a fun app that will get you oriented with the world of iOS development.',
                'duration' => '120',
                'language' => 'iOS',
                'difficulty' => 'Beginner',
                'stages' => '6',
            ]);
            DB::table('courses')->insert([
                'title' => 'C# Basics',
                'summary' => 'C# is the most popular programming language in the Microsoft ecosystem of products. C# code is designed to run fast and to be easily maintainable. In C# Basics, we\'ll learn how to work with C# to write simple programs.',
                'duration' => '188',
                'language' => 'C#',
                'difficulty' => 'Beginner',
                'stages' => '5',
            ]);
            DB::table('courses')->insert([
                'title' => 'Design Systems',
                'summary' => 'Design Systems are more than just bits of UI and visual guidelines. They\'re living documents, usually created by companies or design groups, that are intended to guide the creation of user experiences. They often touch upon everything from high level goals and user interface metaphors down to details like buttons and drop shadows. In this course, we\'ll learn about the fundamentals of design systems.',
                'duration' => '82',
                'language' => 'Design',
                'difficulty' => 'Intermediate',
                'stages' => '3',
            ]);
            DB::table('courses')->insert([
                'title' => 'Using Cookies and JWTs for Secure Authentication',
                'summary' => 'Refactor an existing authentication project by using cookies and JSON Web Token to increase security. Cookies are a way for a browser to store information while tokens are a stand-in or representation for something else.',
                'duration' => '71',
                'language' => 'PHP',
                'difficulty' => 'Advanced',
                'stages' => '2',
            ]);
            #endregion
        }
    }

?>

<?php //In AppController.php
    // Add the use table under the namespace

    // namespace App\Http\Controllers;

    // Add table here (pick one of these depending on tinker)
    // use App\Course;
    // use App\Models\Course;

    // use Illuminate\Http\Request;

    class AppController extends Controller
    {
        public function index()
        {
            return view('library', ["courses" => Course::all()]);
        }
    }

?>

<?php //InDatabaseSeeder.php

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run()
        {
            $this->call(CoursesTableSeeder::class);
        }
    }

?>

<!-- Seeding Database with Tinker

    Use Tinker to Seed the Database:
        php artisan migrate
        php artisan db:seed

    Check if data is in database:
        php artisan tinker
            Course::all();

-->

<!-- Add for each loop in library.blade.php within the first dive element, below the second -->
@foreach($courses as $course)
    <div class="col-lg-4 mb-3">
        <div class="card m-0 bg-white" style="max-height: 300px; height:300px;">
            <div class="card-header" style="background-color:{{$course->language === 'JavaScript' ? '#3659a2' : ($course->language === 'Python' ? '#008297' : ($course->language === 'iOS' ? '#30826C' : ($course->language === 'C#' ? '#008297' : ($course->language === 'PHP' ? '#008297' : '#9F4B84'))))}}">
                <p class="float-right text-white" ><b>{{$course->duration >= 120 ? round($course->duration / 60) . ' hours' : $course->duration . ' min'}}</b></p>
            </div>

            <div class="card-body" style="max-height:175px; height:175px">
                <h6 class="m-0">Course</h6>
                <h5 class="m-0">{{$course->title}}</h5>
                <p style="overflow:hidden; text-overflow:ellipsis; height:75px; max-height:75px" >{{$course->summary}}</p>
            </div>
            <div class="card-footer bg-white">
                <button class="btn rounded bg-white border-dark" style="border-radius:2em !important; color:{{$course->language === 'JavaScript' ? '#3659a2' : ($course->language === 'Python' ? '#008297' : ($course->language === 'iOS' ? '#30826C' : '#9F4B84'))}}" ><b>{{$course->language}}</b></button> <button class="btn rounded bg-white border-dark" style="border-radius:2em !important;"><b>{{$course->difficulty}}</b></button></h5>
            </div>
        </div>
    </div>
@endforeach