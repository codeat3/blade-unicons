<?php

declare(strict_types=1);

namespace Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Config;
use BladeUI\Icons\BladeIconsServiceProvider;
use Codeat3\BladeUnicons\BladeUniconsServiceProvider;

class CompilesIconsTest extends TestCase
{
    /** @test */
    public function it_compiles_a_single_anonymous_component()
    {
        $result = svg('uni-paperclip')->toHtml();

        // Note: the empty class here seems to be a Blade components bug.
        $expected = <<<'SVG'
            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.1,12.4l-6.2,6.2c-1.7,1.7-4.4,1.7-6,0c-1.7-1.7-1.7-4.4,0-6l8-8c1-0.9,2.5-0.9,3.5,0c1,1,1,2.6,0,3.5l-6.9,6.9c-0.3,0.3-0.8,0.3-1.1,0c0,0,0,0,0,0c-0.3-0.3-0.3-0.8,0-1.1l5.1-5.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L8,12.6c-1.1,1.1-1.1,2.8,0,3.9c1.1,1,2.8,1,3.9,0l6.9-6.9c1.8-1.8,1.8-4.6,0-6.4c-1.8-1.8-4.6-1.8-6.4,0l-8,8c-1.2,1.2-1.8,2.8-1.8,4.4c0,3.5,2.8,6.2,6.3,6.2c1.7,0,3.2-0.7,4.4-1.8l6.2-6.2c0.4-0.4,0.4-1,0-1.4S18.5,12,18.1,12.4z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_classes_to_icons()
    {
        $result = svg('uni-paperclip', 'w-6 h-6 text-gray-500')->toHtml();

        $expected = <<<'SVG'
            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.1,12.4l-6.2,6.2c-1.7,1.7-4.4,1.7-6,0c-1.7-1.7-1.7-4.4,0-6l8-8c1-0.9,2.5-0.9,3.5,0c1,1,1,2.6,0,3.5l-6.9,6.9c-0.3,0.3-0.8,0.3-1.1,0c0,0,0,0,0,0c-0.3-0.3-0.3-0.8,0-1.1l5.1-5.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L8,12.6c-1.1,1.1-1.1,2.8,0,3.9c1.1,1,2.8,1,3.9,0l6.9-6.9c1.8-1.8,1.8-4.6,0-6.4c-1.8-1.8-4.6-1.8-6.4,0l-8,8c-1.2,1.2-1.8,2.8-1.8,4.4c0,3.5,2.8,6.2,6.3,6.2c1.7,0,3.2-0.7,4.4-1.8l6.2-6.2c0.4-0.4,0.4-1,0-1.4S18.5,12,18.1,12.4z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_styles_to_icons()
    {
        $result = svg('uni-paperclip', ['style' => 'color: #555'])->toHtml();

        $expected = <<<'SVG'
            <svg style="color: #555" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.1,12.4l-6.2,6.2c-1.7,1.7-4.4,1.7-6,0c-1.7-1.7-1.7-4.4,0-6l8-8c1-0.9,2.5-0.9,3.5,0c1,1,1,2.6,0,3.5l-6.9,6.9c-0.3,0.3-0.8,0.3-1.1,0c0,0,0,0,0,0c-0.3-0.3-0.3-0.8,0-1.1l5.1-5.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L8,12.6c-1.1,1.1-1.1,2.8,0,3.9c1.1,1,2.8,1,3.9,0l6.9-6.9c1.8-1.8,1.8-4.6,0-6.4c-1.8-1.8-4.6-1.8-6.4,0l-8,8c-1.2,1.2-1.8,2.8-1.8,4.4c0,3.5,2.8,6.2,6.3,6.2c1.7,0,3.2-0.7,4.4-1.8l6.2-6.2c0.4-0.4,0.4-1,0-1.4S18.5,12,18.1,12.4z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_default_class_from_config()
    {
        Config::set('blade-unicons.class', 'awesome');

        $result = svg('uni-paperclip')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.1,12.4l-6.2,6.2c-1.7,1.7-4.4,1.7-6,0c-1.7-1.7-1.7-4.4,0-6l8-8c1-0.9,2.5-0.9,3.5,0c1,1,1,2.6,0,3.5l-6.9,6.9c-0.3,0.3-0.8,0.3-1.1,0c0,0,0,0,0,0c-0.3-0.3-0.3-0.8,0-1.1l5.1-5.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L8,12.6c-1.1,1.1-1.1,2.8,0,3.9c1.1,1,2.8,1,3.9,0l6.9-6.9c1.8-1.8,1.8-4.6,0-6.4c-1.8-1.8-4.6-1.8-6.4,0l-8,8c-1.2,1.2-1.8,2.8-1.8,4.4c0,3.5,2.8,6.2,6.3,6.2c1.7,0,3.2-0.7,4.4-1.8l6.2-6.2c0.4-0.4,0.4-1,0-1.4S18.5,12,18.1,12.4z"/></svg>
            SVG;

        $this->assertSame($expected, $result);

    }

    /** @test */
    public function it_can_merge_default_class_from_config()
    {
        Config::set('blade-unicons.class', 'awesome');

        $result = svg('uni-paperclip', 'w-6 h-6')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome w-6 h-6" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.1,12.4l-6.2,6.2c-1.7,1.7-4.4,1.7-6,0c-1.7-1.7-1.7-4.4,0-6l8-8c1-0.9,2.5-0.9,3.5,0c1,1,1,2.6,0,3.5l-6.9,6.9c-0.3,0.3-0.8,0.3-1.1,0c0,0,0,0,0,0c-0.3-0.3-0.3-0.8,0-1.1l5.1-5.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L8,12.6c-1.1,1.1-1.1,2.8,0,3.9c1.1,1,2.8,1,3.9,0l6.9-6.9c1.8-1.8,1.8-4.6,0-6.4c-1.8-1.8-4.6-1.8-6.4,0l-8,8c-1.2,1.2-1.8,2.8-1.8,4.4c0,3.5,2.8,6.2,6.3,6.2c1.7,0,3.2-0.7,4.4-1.8l6.2-6.2c0.4-0.4,0.4-1,0-1.4S18.5,12,18.1,12.4z"/></svg>
            SVG;

        $this->assertSame($expected, $result);

    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            BladeUniconsServiceProvider::class,
        ];
    }
}
