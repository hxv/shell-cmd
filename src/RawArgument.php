<?php
declare( strict_types=1 );

namespace hxv\ShellCmd;

class RawArgument {
    /** @var string */
    protected $argument;

    public function __construct(string $argument) {
        $this->argument = $argument;
    }

    public function __toString() {
        return $this->argument;
    }
}
