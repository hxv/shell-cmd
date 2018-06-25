<?php
declare( strict_types=1 );

namespace hxv\ShellCmd;

class ShellCmd {
    /** @var string */
    protected $command;
    /** @var array */
    protected $arguments;

    /**
     * @param string $command
     * @param array  $arguments
     */
    public function __construct(string $command, array $arguments = []) {
        $this->command = $command;
        $this->arguments = $arguments;
    }

    public function __toString() {
        $command = $this->command;

        if (count($this->arguments) === 0)
            return $command;

        $command .= ' ' . $this->escapeArgument($this->arguments);

        return $command;
    }

    /**
     * @param mixed $argument
     *
     * @return string
     */
    protected function escapeArgument($argument) : string {
        if (is_array($argument)) {
            $argument = array_map([$this, 'escapeArgument'], $argument);

            return join(' ', $argument);
        }

        if (!$argument instanceof RawArgument)
            $argument = escapeshellarg((string) $argument);

        return (string) $argument;
    }
}
