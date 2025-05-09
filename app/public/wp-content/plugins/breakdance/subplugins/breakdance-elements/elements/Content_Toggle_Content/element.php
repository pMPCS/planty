<?php

namespace EssentialElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "EssentialElements\\ContentToggleContent",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ContentToggleContent extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'SquareIcon';
    }

    static function tag()
    {
        return 'div';
    }

    static function tagOptions()
    {
        return [];
    }

    static function tagControlPath()
    {
        return false;
    }

    static function name()
    {
        return 'Content Toggle - Content';
    }

    static function className()
    {
        return 'bde-content-toggle-content';
    }

    static function category()
    {
        return 'advanced';
    }

    static function badge()
    {
        return false;
    }

    static function slug()
    {
        return __CLASS__;
    }

    static function template()
    {
        return file_get_contents(__DIR__ . '/html.twig');
    }

    static function defaultCss()
    {
        return file_get_contents(__DIR__ . '/default.css');
    }

    static function defaultProperties()
    {
        return ['design' => ['layout' => ['gap' => ['breakpoint_base' => ['number' => 30, 'unit' => 'px', 'style' => '30px']]]]];
    }

    static function defaultChildren()
    {
        return false;
    }

    static function cssTemplate()
    {
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [getPresetSection(
            "EssentialElements\\simpleLayout",
            "Layout",
            "layout",
            ['condition' => ['0' => ['0' => ['path' => 'design.layout', 'operand' => 'is set', 'value' => '']]], 'type' => 'popout']
        ), getPresetSection(
            "EssentialElements\\LayoutV2",
            "Layout",
            "layout_v2",
            ['condition' => ['0' => ['0' => ['path' => 'design.layout', 'operand' => 'is not set', 'value' => '']]], 'type' => 'popout']
        ), c(
            "size",
            "Size",
            [c(
                "width",
                "Width",
                [],
                ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => []]],
                false,
                false,
                [],
            )],
            ['type' => 'section'],
            false,
            false,
            [],
        ), c(
            "text_colors",
            "Text Colors",
            [c(
                "headings",
                "Headings",
                [],
                ['type' => 'color', 'layout' => 'inline'],
                false,
                false,
                [],
            ), c(
                "text",
                "Text",
                [],
                ['type' => 'color', 'layout' => 'inline'],
                false,
                false,
                [],
            ), c(
                "link",
                "Link",
                [],
                ['type' => 'color', 'layout' => 'inline'],
                false,
                true,
                [],
            ), c(
                "primary",
                "Primary",
                [],
                ['type' => 'color', 'layout' => 'inline'],
                false,
                false,
                [],
            )],
            ['type' => 'section', 'condition' => ['0' => ['0' => ['path' => 'design.text_colors', 'operand' => 'is set', 'value' => '']]]],
            false,
            false,
            [],
        ), getPresetSection(
            "EssentialElements\\background",
            "Background",
            "background",
            ['type' => 'accordion']
        ), getPresetSection(
            "EssentialElements\\borders",
            "Borders",
            "borders",
            ['type' => 'accordion']
        ), getPresetSection(
            "EssentialElements\\spacing_padding_all",
            "Spacing",
            "spacing",
            ['type' => 'accordion']
        )];
    }

    static function contentControls()
    {
        return [];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return false;
    }

    static function settings()
    {
        return false;
    }

    static function addPanelRules()
    {
        return false;
    }

    static public function actions()
    {
        return [

            'onActivatedElement' => [[
                'script' => 'window.BreakdanceContentToggle && window.BreakdanceContentToggle.activateTabFromStructurePanel(\'%%SELECTOR%%\');', 'runForAllChildren' => true,
            ],],

            'onMovedElement' => [[
                'script' => 'window.BreakdanceContentToggle && window.BreakdanceContentToggle.activateTabFromStructurePanel(\'%%SELECTOR%%\');', 'runForAllChildren' => true,
            ],],

            'onPropertyChange' => [[
                'script' => 'window.BreakdanceContentToggle && window.BreakdanceContentToggle.activateTabFromStructurePanel(\'%%SELECTOR%%\');', 'runForAllChildren' => true,
            ],],
        ];
    }

    static function nestingRule()
    {
        return ["type" => "container", "restrictedToBeADirectChildOf" => ['EssentialElements\ContentToggle'],];
    }

    static function spacingBars()
    {
        return [];
    }

    static function attributes()
    {
        return false;
    }

    static function experimental()
    {
        return false;
    }

    static function order()
    {
        return 0;
    }

    static function dynamicPropertyPaths()
    {
        return false;
    }

    static function additionalClasses()
    {
        return false;
    }

    static function projectManagement()
    {
        return false;
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return ['design.layout.horizontal.vertical_at', 'design.layout_v2.layout', 'design.layout_v2.h_vertical_at', 'design.layout_v2.h_alignment_when_vertical', 'design.layout_v2.a_display'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
