<?php namespace App\Providers;
use Illuminate\Support\ServiceProvider;

use App\DefaultTemplates\Template;

class TemplateServiceProvider extends ServiceProvider {

	public function register()
	{
        $this->app->bind('defaulttemplate', function()
        {
            return new Template;
        });
	}

}
