<?php

namespace App\Factory;

use App\Entity\Alert;
use App\Repository\AlertRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Alert>
 *
 * @method        Alert|Proxy                     create(array|callable $attributes = [])
 * @method static Alert|Proxy                     createOne(array $attributes = [])
 * @method static Alert|Proxy                     find(object|array|mixed $criteria)
 * @method static Alert|Proxy                     findOrCreate(array $attributes)
 * @method static Alert|Proxy                     first(string $sortedField = 'id')
 * @method static Alert|Proxy                     last(string $sortedField = 'id')
 * @method static Alert|Proxy                     random(array $attributes = [])
 * @method static Alert|Proxy                     randomOrCreate(array $attributes = [])
 * @method static AlertRepository|RepositoryProxy repository()
 * @method static Alert[]|Proxy[]                 all()
 * @method static Alert[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Alert[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Alert[]|Proxy[]                 findBy(array $attributes)
 * @method static Alert[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Alert[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class AlertFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'active' => self::faker()->boolean(),
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'reason' => self::faker()->text(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Alert $alert): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Alert::class;
    }
}
