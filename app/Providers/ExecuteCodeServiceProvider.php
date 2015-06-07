<?php namespace App\Providers;
use App\ExecuteCode\Execute;
use Illuminate\Support\ServiceProvider;


class ExecuteCodeServiceProvider extends ServiceProvider {

	public function register()
	{
        $this->app->bind('executeCode', function()
        {
            return new Execute;
        });
	}

}
