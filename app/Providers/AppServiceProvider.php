<?php namespace App\Providers;

use App\Emprestimo;
use Illuminate\Support\ServiceProvider;

use Auth;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->composer('layouts.master', function ($view) {
			$notificacoes = Auth::user() ? array_sum(Emprestimo::notificacoes()) : 0;
			$paraMim = Auth::user() ? Emprestimo::notificacoes()['paraMim'] : 0;
			$concluir = Auth::user() ? Emprestimo::notificacoes()['concluir'] : 0;
			$view->with('notificacoes', $notificacoes)
				->with('paraMim', $paraMim)
				->with('concluir', $concluir);
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
