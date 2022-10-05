<?php

namespace Domain\Collection;

abstract class Collection
{

    public abstract function all(): array;

    // Rare situation, when inheritance is acceptable.
    public function filter(callable $function): static
    {
        return new static(...array_filter($this->all(), $function));
    }

    public function diff(Collection $b): static
    {
        return new static(...array_diff($this->all(), $b->all()));
    }

    public function count(): int
    {
        return count($this->all());
    }
}