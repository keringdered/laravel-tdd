<?php

namespace Tests;

use App\Exceptions\Handler;
use App\User;
use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    protected $oldExceptionHandler;
    protected function setUp(): void
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }
    protected function disableExceptionHandling(){
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this->app->instance(ExceptionHandler::class,new class extends  Handler{
            public function __construct(){}
            public function report(Exception $exception){}
            public function render($request,Exception $e){
                throw $e;
            }
        });
    }
    protected function  withExceptionHandling(){
        $this->app->instance(ExceptionHandler::class,$this->oldExceptionHandler);
        return $this;
    }
    protected function signIn($user = null){
        $user = $user ?:create(User::class);
        $this->actingAs($user);
        return $this;
    }
    protected function validate_required($class,$url,$overrides =[]){
        $this->withExceptionHandling()->signIn();
        $record = make($class,$overrides);
       return  $this->post($url,$record->toArray());
    }
}
