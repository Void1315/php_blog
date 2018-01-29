<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App;
// use App\Contracts\TestContract;

class TestController extends Controller
{
    //依赖注入
    // public function __construct(TestContract $test){
    //     $this->test = $test;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @author LaravelAcademy.org
     */

    public function index()
    {
            $source = "hello1,hello2,hello3,hello4,hello5";//按逗号分离字符串 
            $hello = explode(',',$source); 
            echo array_search('hello1',$hello);
            for($index=0;$index<count($hello);$index++) 
            { 
            echo $hello[$index];echo "</br>"; 
            } 
        // $this->test->callMe('TestController');
    }

}