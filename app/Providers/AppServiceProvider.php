<?php namespace App\Providers;

use App\Emprestimo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->composer('layouts.master', function($view)
		{
			$view->with('notificacoes', array_sum(Emprestimo::notificacoes()))
				->with('paraMim', Emprestimo::notificacoes()['paraMim'])
				->with('concluir', Emprestimo::notificacoes()['concluir'])
			;
		});

	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		if ($this->app->environment() == 'local') {
        	$this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
			$this->app->register('Barryvdh\Debugbar\ServiceProvider');
			$this->app->register('Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
    	}
	}

}
