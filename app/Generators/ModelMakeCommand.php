<?php

namespace App\Generators;

use Illuminate\Foundation\Console\ModelMakeCommand as BaseModelCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\Schema as Schema;

class ModelMakeCommand extends BaseModelCommand
{

    protected $exclude = ['id', 'password', 'created_at', 'updated_at'];


    protected function getStub()
    {
        if ($this->option('translatable')) {
           return __DIR__.'/stubs/model.trans.stub'; 
        }
        return __DIR__.'/stubs/model.plain.stub';
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
        ->replaceClass($stub, $name);
    }

    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the model already exists.'],

            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model.'],

            ['controller', 'c', InputOption::VALUE_NONE, 'Create a new controller for the model.'],

            ['resource', 'r', InputOption::VALUE_NONE, 'Indicates if the generated controller should be a resource controller.'],
            ['translatable', 't', InputOption::VALUE_NONE, 'Create a new translatable file for the model.'],
        ];
    }
}