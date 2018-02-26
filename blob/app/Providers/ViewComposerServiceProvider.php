<?php

namespace App\Providers;

use \Datetime;
use App\Mongo\Facade as Mongo;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('sidebar', function($view) {
            $collection = Mongo::get()->homestead->posts;
            
            $months = $collection->aggregate(
                [
                    [
                        '$group' => [
                            '_id' => [
                                'month' => ['$month' => '$date'],
                                'year' => ['$year' => '$date'],
                            ]
                        ]
                    ]
                ]
            )->toArray();

            foreach ($months as $monthObj) {
                $monthObj->_id->monthName = DateTime::createFromFormat('!m', $monthObj->_id->month)->format('F');
            }

            $view->with('months', $months);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
