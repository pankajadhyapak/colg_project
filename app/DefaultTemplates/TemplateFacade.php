<?php namespace App\DefaultTemplates;

class TemplateFacade extends \Illuminate\Support\Facades\Facade {

protected static function getFacadeAccessor() { return 'defaulttemplate'; }

}