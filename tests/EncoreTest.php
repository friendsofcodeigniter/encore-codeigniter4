<?php

namespace Friendsofcodeigniter\Encore\Tests;

use CodeIgniter\Test\CIUnitTestCase;

class EncoreTest extends CIUnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        config('Encore')->output_path = __DIR__ . '/fixtures/build';
        helper('Friendsofcodeigniter\Encore\encore');
    }

    /** @test */
    public function it_returns_js_files()
    {
        $this->assertEquals(
            [
                'build/file1.js',
                'build/file2.js',
            ],
            encore_entry_js_files('my_entry')
        );
    }

    /** @test */
    public function it_returns_css_files()
    {
        $this->assertEquals(
            [
                "build/styles.css",
                "build/styles2.css",
            ],
            encore_entry_css_files('my_entry')
        );
    }

    /** @test */
    public function it_render_script_tags()
    {
        $this->assertSame(
            '<script src="build/file1.js" defer></script><script src="build/file2.js" defer></script>',
            encore_entry_script_tags('my_entry')
        );

        $this->assertSame(
            '<script src="build/file1.js" defer crossorigin="anonymous"></script><script src="build/file2.js" defer crossorigin="anonymous"></script>',
            encore_entry_script_tags('my_entry', '_default', [
                'crossorigin' => 'anonymous',
            ])
        );
    }

    /** @test */
    public function it_render_link_tags()
    {
        $this->assertSame(
            '<link rel="stylesheet" href="build/styles.css" ><link rel="stylesheet" href="build/styles2.css" >',
            encore_entry_link_tags('my_entry')
        );

        $this->assertSame(
            '<link rel="stylesheet" href="build/styles.css" crossorigin="anonymous"><link rel="stylesheet" href="build/styles2.css" crossorigin="anonymous">',
            encore_entry_link_tags('my_entry', '_default', [
                'crossorigin' => 'anonymous',
            ])
        );
    }
}
