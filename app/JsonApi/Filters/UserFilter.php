<?php

namespace App\JsonApi\Filters;

use LaravelJsonApi\Core\Support\Str;
use LaravelJsonApi\Eloquent\Contracts\Filter;
use LaravelJsonApi\Eloquent\Filters\Concerns\DeserializesValue;
use LaravelJsonApi\Eloquent\Filters\Concerns\IsSingular;
use LaravelJsonApi\Eloquent\Schema;

class UserFilter implements Filter
{
    use DeserializesValue;
    use IsSingular;

    private string $name;

    /**
     * Create a new filter.
     *
     * @param string $name
     * @param string|null $column
     * @return UserFilter
     */
    public static function make(string $name, array $column = []): self
    {
        return new static($name, $column);
    }

    /**
     * UserFilter constructor.
     *
     * @param string $name
     * @param string|null $column
     */
    public function __construct(string $name, private array $column = [])
    {
        $this->name = $name;
    }

    /**
     * Get the key for the filter.
     *
     * @return string
     */
    public function key(): string
    {
        return $this->name;
    }

    /**
     * Apply the filter to the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply($query,  $value)
    {
        // @TODO
        return $query->where('name', 'LIKE', '%' . $value . '%');
        
    }
}
