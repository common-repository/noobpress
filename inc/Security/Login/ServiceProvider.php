<?php
namespace NoobPress\Security\Login;

use NoobPress\Dependencies\LaunchpadCore\Container\AbstractServiceProvider;
use NoobPress\Dependencies\LaunchpadOptions\Interfaces\TransientsInterface;
use NoobPress\Dependencies\League\Container\Definition\DefinitionInterface;

class ServiceProvider extends AbstractServiceProvider
{

    public function get_common_subscribers(): array
    {
        return [
          LimitLoginSubscriber::class
        ];
    }

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_service(State::class)->share();

        $this->register_service(LimitLoginSubscriber::class)->share()->set_definition(function (DefinitionInterface $definition) {
            $definition->addArgument(State::class);
            $definition->addArgument(TransientsInterface::class);
        });
    }
}