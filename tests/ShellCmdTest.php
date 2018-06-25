<?php
declare( strict_types=1 );

namespace hxv\ShellCmd\Tests;

use hxv\ShellCmd\RawArgument;
use hxv\ShellCmd\ShellCmd;
use PHPUnit\Framework\TestCase;

class ShellCmdTest extends TestCase {
    public function test_returns_command_without_arguments() : void {
        $cmd = new ShellCmd('ls');

        self::assertEquals('ls', (string) $cmd);
    }

    public function test_returns_command_with_escaped_arguments() : void {
        $cmd = new ShellCmd('ls', ['-lha']);

        self::assertEquals("ls '-lha'", (string) $cmd);
    }

    public function test_returns_command_with_escaped_arguments_but_keeps_raw_argument_unescaped() : void {
        $cmd = new ShellCmd('ls', ['-lha', new RawArgument('*')]);

        self::assertEquals("ls '-lha' *", (string) $cmd);
    }

    public function test_returns_command_with_flat_flat_arguments_from_multidimensional_array() : void {
        $cmd = new ShellCmd('git', ['commit', ['-m', 'Test']]);

        self::assertEquals("git 'commit' '-m' 'Test'", (string) $cmd);
    }

    public function test_returns_command_with_escaped_command_as_argument() : void {
        $cmd = new ShellCmd('bash', ['-c', new ShellCmd('ls', ['-lha', new RawArgument('> /tmp/test')])]);

        self::assertEquals("bash '-c' 'ls '\''-lha'\'' > /tmp/test'", (string) $cmd);
    }
}

