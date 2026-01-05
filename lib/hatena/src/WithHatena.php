<?php

declare(strict_types=1);

namespace Revolution\Hatena;

trait WithHatena
{
    protected array $config;

    public function withHatena(array $config): static
    {
        $this->config = $config;

        return $this;
    }
}
