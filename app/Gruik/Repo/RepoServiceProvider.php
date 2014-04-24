<?php namespace Gruik\Repo;

use Illuminate\Support\ServiceProvider;

use Gruik\Repo\User\EloquentUser;
use \User;
use Gruik\Repo\Asteroid\EloquentAsteroid;
use \Asteroid;
use Gruik\Repo\Building\EloquentBuilding;
use \Building;
use Gruik\Repo\BuildingBlueprint\EloquentBuildingBlueprint;
use \BuildingBlueprint;
use Gruik\Repo\Colony\EloquentColony;
use \Colony;
use Gruik\Repo\Ore\EloquentOre;
use \Ore;
use Gruik\Repo\Settler\EloquentSettler;
use \Settler;
use Gruik\Repo\Game\EloquentGame;
use \Game;

class RepoServiceProvider extends ServiceProvider {

    public function register()
    {
        $app = $this->app;

        $app->bind('Gruik\Repo\User\UserInterface', function($app)
        {
            return new EloquentUser(new User);
        });

        $app->bind('Gruik\Repo\Asteroid\AsteroidInterface', function($app)
        {
            $oreRepo = App::make('Gruik\Repo\Ore\OreInterface');

            return new EloquentAsteroid(new Asteroid, $oreRepo);
        });

        $app->bind('Gruik\Repo\Building\BuildingInterface', function($app)
        {
            return new EloquentBuilding(new Building);
        });

        $app->bind('Gruik\Repo\BuildingBlueprint\BuildingBlueprintInterface', function($app)
        {
            return new EloquentBuildingBlueprint(new BuildingBlueprint);
        });

        $app->bind('Gruik\Repo\Colony\ColonyInterface', function($app)
        {
            return new EloquentColony(new Colony);
        });

        $app->bind('Gruik\Repo\Ore\OreInterface', function ( $app )
        {
            return new EloquentOre( new Ore );
        });

        $app->bind('Gruik\Repo\Settler\SettlerInterface', function($app)
        {
            return new EloquentSettler(new Settler);
        });

        $app->bind('Gruik\Repo\Game\GameInterface', function($app)
        {
            return new EloquentGame(new Game);
        });
    }
}