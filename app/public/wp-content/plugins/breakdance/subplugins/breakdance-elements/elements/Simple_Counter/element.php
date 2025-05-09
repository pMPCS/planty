<?php

namespace EssentialElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "EssentialElements\\SimpleCounter",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class SimpleCounter extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><defs></defs><title>time-clock-circle</title><circle cx="12" cy="12" r="10.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px"></circle><line x1="12" y1="12" x2="12" y2="8.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px"></line><line x1="12" y1="12" x2="16.687" y2="16.688" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px"></line></svg>';
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
        return 'Simple Counter';
    }

    static function className()
    {
        return 'bde-simple-counter';
    }

    static function category()
    {
        return 'blocks';
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
        return ['content' => ['counter' => ['title' => 'Happy Customers', 'duration' => ['number' => 1000, 'unit' => 'ms', 'style' => '1000ms'], 'start' => 69, 'end' => 420]], 'design' => ['wrapper' => ['background' => '#551FCCFF', 'content_alignment' => null, 'width' => ['breakpoint_base' => ['number' => 400, 'unit' => 'px', 'style' => '400px']], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'right' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'top' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'bottom' => ['number' => 40, 'unit' => 'px', 'style' => '40px']]]]], 'typography' => ['number' => ['color' => ['breakpoint_base' => '#FFFFFFFF']], 'title' => ['color' => ['breakpoint_base' => '#FFFFFFFF']]], 'spacing' => ['below_number' => null, 'around_number' => null, 'wrapper' => ['margin_top' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'margin_bottom' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]]];
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
        return [c(
        "wrapper",
        "Wrapper",
        [c(
        "content_alignment",
        "Content Alignment",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => ['0' => ['value' => 'left', 'text' => 'Left', 'icon' => 'FlexAlignLeftIcon'], '1' => ['value' => 'center', 'text' => 'Center', 'icon' => 'FlexAlignCenterHorizontalIcon'], '2' => ['value' => 'right', 'text' => 'Right;', 'icon' => 'FlexAlignRightIcon']]],
        true,
        false,
        [],
      ), c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        false,
        false,
        [],
      ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "typography",
        "Typography",
        [getPresetSection(
      "EssentialElements\\typography",
      "Number",
      "number",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Prefix",
      "prefix",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Suffix",
      "suffix",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Title",
      "title",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "spacing",
        "Spacing",
        [c(
        "below_number",
        "Below Number",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        true,
        false,
        [],
      ), c(
        "around_number",
        "Around Number",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        true,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_margin_y",
      "Wrapper",
      "wrapper",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      )];
    }

    static function contentControls()
    {
        return [c(
        "counter",
        "Counter",
        [c(
        "title",
        "Title",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "prefix",
        "Prefix",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "suffix",
        "Suffix",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "start",
        "Start",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "end",
        "End",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'ms']]],
        false,
        false,
        [],
      ), c(
        "ease_count",
        "Ease Count",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "format_number",
        "Format Number",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "separator",
        "Separator",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'condition' => ['path' => 'content.counter.format_number', 'operand' => 'is set', 'value' => ''], 'items' => ['0' => ['text' => 'Space', 'value' => 'space'], '1' => ['text' => 'Dot', 'value' => 'dot'], '2' => ['text' => 'Comma', 'value' => 'comma']]],
        false,
        false,
        [],
      ), c(
        "html_tags",
        "HTML Tags",
        [c(
        "title",
        "Title",
        [],
        ['type' => 'dropdown', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'div', 'text' => 'div'], '1' => ['value' => 'h1', 'text' => 'h1'], '2' => ['value' => 'h2', 'text' => 'h2'], '3' => ['value' => 'h3', 'text' => 'h3'], '4' => ['value' => 'h4', 'text' => 'h4'], '5' => ['value' => 'h5', 'text' => 'h5'], '6' => ['value' => 'h6', 'text' => 'h6']]],
        false,
        false,
        [],
      ), c(
        "number",
        "Number",
        [],
        ['type' => 'dropdown', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'div', 'text' => 'div'], '1' => ['value' => 'h1', 'text' => 'h1'], '2' => ['value' => 'h2', 'text' => 'h2'], '3' => ['value' => 'h3', 'text' => 'h3'], '4' => ['value' => 'h4', 'text' => 'h4'], '5' => ['value' => 'h5', 'text' => 'h5'], '6' => ['value' => 'h6', 'text' => 'h6']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      )];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return ['0' =>  ['title' => 'Breakdance Counter ','scripts' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/breakdance-counter.js/breakdance-counter.js'],],'1' =>  ['title' => 'Frontend Init','inlineScripts' => ['new BreakdanceCounter(\'%%SELECTOR%%\', {{ content.counter|json_encode }});'],],];
    }

    static function settings()
    {
        return ['dependsOnGlobalScripts' => false];
    }

    static function addPanelRules()
    {
        return false;
    }

    static public function actions()
    {
        return [

'onPropertyChange' => [['script' => '(function() {
  if (window.breakdanceCounterInstances && window.breakdanceCounterInstances[%%ID%%]) {
    window.breakdanceCounterInstances[%%ID%%].destroy();
  }

  window.breakdanceCounterInstances[%%ID%%] = new BreakdanceCounter(\'%%SELECTOR%%\', {{ content.counter|json_encode }});
}());',
],],

'onMountedElement' => [['script' => '(function() {
    if (!window.breakdanceCounterInstances) window.breakdanceCounterInstances = {};

    if (window.breakdanceCounterInstances && window.breakdanceCounterInstances[%%ID%%]) {
      window.breakdanceCounterInstances[%%ID%%].destroy();
    }

    window.breakdanceCounterInstances[%%ID%%] = new BreakdanceCounter(\'%%SELECTOR%%\', {{ content.counter|json_encode }} );
  }());',
],],

'onMovedElement' => [['script' => '(function() {
  if (window.breakdanceCounterInstances && window.breakdanceCounterInstances[%%ID%%]) {
    window.breakdanceCounterInstances[%%ID%%].update();
  }
}());',
],],

'onBeforeDeletingElement' => [['script' => '  (function() {
    if (window.breakdanceCounterInstances && window.breakdanceCounterInstances[%%ID%%]) {
      window.breakdanceCounterInstances[%%ID%%].destroy();
      delete window.breakdanceCounterInstances[%%ID%%];
    }
  }());',
],],];
    }

    static function nestingRule()
    {
        return ["type" => "final",   ];
    }

    static function spacingBars()
    {
        return ['0' => ['location' => 'outside-top', 'cssProperty' => 'margin-top', 'affectedPropertyPath' => 'design.spacing.wrapper.margin_top.%%BREAKPOINT%%'], '1' => ['location' => 'outside-bottom', 'cssProperty' => 'margin-bottom', 'affectedPropertyPath' => 'design.spacing.wrapper.margin_bottom.%%BREAKPOINT%%']];
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
        return 950;
    }

    static function dynamicPropertyPaths()
    {
        return [];
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
        return [];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
