<?php
/**
 * @license proprietary?
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace NoobPress\Dependencies\LaunchpadFrameworkOptions;


use NoobPress\Dependencies\LaunchpadCore\Container\AbstractServiceProvider;
use NoobPress\Dependencies\LaunchpadOptions\Interfaces\OptionsInterface;
use NoobPress\Dependencies\LaunchpadOptions\Interfaces\TransientsInterface;
use NoobPress\Dependencies\LaunchpadOptions\Options;
use NoobPress\Dependencies\LaunchpadOptions\Transients;
use NoobPress\Dependencies\League\Container\Definition\DefinitionInterface;

class ServiceProvider extends AbstractServiceProvider
{

    protected function define()
    {
        $this->register_service(OptionsInterface::class, function (DefinitionInterface $definition) {
            $definition->addArgument('prefix');
        }, Options::class);

        $this->register_service(TransientsInterface::class, function (DefinitionInterface $definition) {
            $definition->addArgument('prefix');
        }, Transients::class);
    }
}