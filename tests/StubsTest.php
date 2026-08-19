<?php

declare(strict_types=1);

namespace ActionSchedulerStubs\Tests;

use PHPUnit\Framework\TestCase;

/**
 * The stubs parse, and they still describe the Action Scheduler they were generated from.
 *
 * The failure a stubs package actually has is staleness: upstream adds a function, these files do
 * not, and the only symptom is `Function not found` in somebody else's project. Nothing about the
 * package itself looks broken. So the coverage that matters is the comparison against source/.
 */
final class StubsTest extends TestCase
{
    private const ROOT = __DIR__ . '/..';

    /** Where the upstream copy is installed by the post-install hook. */
    private const UPSTREAM = self::ROOT . '/source/vendor/woocommerce/action-scheduler';

    /**
     * @return array<string, array{0: string}>
     */
    public function stubFileProvider(): array
    {
        return [
            'declarations' => ['action-scheduler-stubs.stub'],
            'constants' => ['action-scheduler-constants-stubs.stub'],
        ];
    }

    /**
     * @dataProvider stubFileProvider
     */
    public function testTheStubFileIsValidPhp(string $file): void
    {
        $path = self::ROOT . '/' . $file;

        $this->assertFileExists($path);

        // TOKEN_PARSE makes the tokenizer raise ParseError on invalid source rather than returning a
        // best-effort token list, which is what makes this an actual syntax check.
        token_get_all((string) file_get_contents($path), TOKEN_PARSE);

        $this->addToAssertionCount(1);
    }

    /**
     * Every public API function upstream declares is declared here too.
     *
     * `as_*` is Action Scheduler's public surface -- the functions consumers call and the reason this
     * package exists. A missing one is the whole failure mode.
     */
    public function testEveryPublicFunctionIsStubbed(): void
    {
        $upstream = $this->upstreamFunctions();

        $this->assertNotEmpty($upstream, 'no as_* functions found upstream -- the comparison would be vacuous');

        $stubbed = $this->stubbedFunctions();

        $this->assertSame([], array_values(array_diff($upstream, $stubbed)), 'upstream functions missing from the stubs');
    }

    /**
     * And nothing is declared here that upstream does not have.
     *
     * A stub for a function that no longer exists is the quieter half of the same problem: consumers
     * keep calling something upstream removed, and static analysis says it is fine.
     */
    public function testNoStubbedFunctionHasBeenRemovedUpstream(): void
    {
        $upstream = $this->upstreamFunctions();

        $this->assertNotEmpty($upstream, 'no as_* functions found upstream -- the comparison would be vacuous');

        $this->assertSame([], array_values(array_diff($this->stubbedFunctions(), $upstream)), 'stubbed functions that upstream no longer declares');
    }

    /**
     * The generated header names this repository, so a stub file pasted somewhere can be traced back.
     */
    public function testTheStubsCarryTheGeneratedHeader(): void
    {
        $this->assertStringContainsString(
            'Generated stub declarations for Action Scheduler',
            (string) file_get_contents(self::ROOT . '/action-scheduler-stubs.stub')
        );
    }

    /**
     * @return string[] Sorted `as_*` function names declared by the installed upstream copy.
     */
    private function upstreamFunctions(): array
    {
        if (!is_dir(self::UPSTREAM)) {
            $this->markTestSkipped('Upstream Action Scheduler is not installed; run `composer install` to fetch it into source/.');
        }

        return $this->functionsIn((string) file_get_contents(self::UPSTREAM . '/functions.php'));
    }

    /**
     * @return string[] Sorted `as_*` function names declared by the stubs.
     */
    private function stubbedFunctions(): array
    {
        return $this->functionsIn((string) file_get_contents(self::ROOT . '/action-scheduler-stubs.stub'));
    }

    /**
     * @return string[] Sorted, unique.
     */
    private function functionsIn(string $source): array
    {
        preg_match_all('/^\s*function\s+(as_[a-z0-9_]+)\s*\(/mi', $source, $matches);

        $names = array_unique($matches[1]);
        sort($names);

        return $names;
    }
}
