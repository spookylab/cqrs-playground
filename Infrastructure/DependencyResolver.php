<?php

namespace CqrsPlayground\Infrastructure;

use Phalcon\Di;
use \InvalidArgumentException;

class DependencyResolver
{
    /** @var Di */
    private $container;
    private $dependencies = [];

    public function __construct(Di $container)
    {
        $this->container = $container;
    }

    public function autowire(string $className)
    {
        if (isset($this->dependencies[$className])) {
            return $this->dependencies[$className];
        }

        $reflector = new \ReflectionClass($className);
        $constructor = $reflector->getConstructor();

        if ($constructor === null) {
            $instance = $reflector->newInstance();
        } else {
            $parameters = $constructor->getParameters();
            $dependencies = $this->resolveDependencies($reflector, $parameters);
    
            $instance = $reflector->newInstanceArgs($dependencies);
        }

        return $this->dependencies[$className] = $instance;
    }

    private function resolveDependencies(\ReflectionClass $reflector, array $parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $class = $parameter->getClass();
            $dependencyName = null;

            if ($this->container->has($parameter->name)) {
                $dependencies[] = $this->container->get($parameter->name);
            } elseif ($class !== null && $this->container->has($class->name)) {
                $dependencies[] = $this->container->get($class->name);
            } else {
                $name = $parameter->hasType()
                    ? "{$parameter->getType()} \${$parameter->name}"
                    : "\${$parameter->name}";

                throw new InvalidArgumentException(
                    "Cannot resolve dependency \"$name\" for {$reflector->name}"
                );
            }
        }

        return $dependencies;
    }
}
