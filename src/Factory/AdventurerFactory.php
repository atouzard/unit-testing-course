<?php

namespace App\Factory;

use App\Entity\Adventurer;
use App\Repository\AdventurerRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Adventurer>
 *
 * @method        Adventurer|Proxy                     create(array|callable $attributes = [])
 * @method static Adventurer|Proxy                     createOne(array $attributes = [])
 * @method static Adventurer|Proxy                     find(object|array|mixed $criteria)
 * @method static Adventurer|Proxy                     findOrCreate(array $attributes)
 * @method static Adventurer|Proxy                     first(string $sortedField = 'id')
 * @method static Adventurer|Proxy                     last(string $sortedField = 'id')
 * @method static Adventurer|Proxy                     random(array $attributes = [])
 * @method static Adventurer|Proxy                     randomOrCreate(array $attributes = [])
 * @method static AdventurerRepository|RepositoryProxy repository()
 * @method static Adventurer[]|Proxy[]                 all()
 * @method static Adventurer[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Adventurer[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Adventurer[]|Proxy[]                 findBy(array $attributes)
 * @method static Adventurer[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Adventurer[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class AdventurerFactory extends ModelFactory
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
            'class' => self::faker()->text(),
            'health' => self::faker()->randomNumber(),
            'name' => self::faker()->text(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Adventurer $adventurer): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Adventurer::class;
    }
}
