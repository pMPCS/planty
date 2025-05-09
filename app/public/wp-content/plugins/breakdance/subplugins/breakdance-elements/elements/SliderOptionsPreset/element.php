<?php

namespace EssentialElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "EssentialElements\\Slideroptionspreset",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Slideroptionspreset extends \Breakdance\Elements\Element
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
        return 'SliderOptionsPreset';
    }

    static function className()
    {
        return 'bde-slideroptionspreset';
    }

    static function category()
    {
        return 'other';
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
        return false;
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
        "slider",
        "Slider",
        [c(
        "settings",
        "Settings",
        [c(
        "effect",
        "Effect",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => ['0' => ['value' => 'slide', 'text' => 'Slide'], '1' => ['text' => 'Fade', 'value' => 'fade'], '2' => ['text' => 'Coverflow', 'value' => 'coverflow'], '3' => ['text' => 'Flip', 'value' => 'flip']]],
        false,
        false,
        [],
      ), c(
        "coverflow",
        "Coverflow",
        [c(
        "shadow",
        "Shadow",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "depth",
        "Depth",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px'], 'rangeOptions' => ['step' => 1, 'max' => 300, 'min' => -300]],
        false,
        false,
        [],
      ), c(
        "rotate",
        "Rotate",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px'], 'rangeOptions' => ['step' => 1, 'max' => 15, 'min' => -15]],
        false,
        false,
        [],
      ), c(
        "stretch",
        "Stretch",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px'], 'rangeOptions' => ['step' => 1, 'max' => 100, 'min' => -100]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'sectionOptions' => ['type' => 'popout'], 'condition' => ['path' => '%%CURRENTPATH%%.effect', 'operand' => 'equals', 'value' => 'coverflow']],
        false,
        false,
        [],
      ), c(
        "speed",
        "Speed",
        [],
        ['layout' => 'inline', 'type' => 'unit', 'unitOptions' => ['types' => ['0' => 'ms'], 'defaultType' => 'ms'], 'rangeOptions' => ['step' => 100, 'min' => 0, 'max' => 5000]],
        false,
        false,
        [],
      ), c(
        "infinite",
        "Infinite",
        [],
        ['layout' => 'inline', 'items' => ['0' => ['text' => 'Disabled', 'value' => 'disabled'], '1' => ['value' => 'enabled', 'text' => 'Enabled (frontend only)']], 'type' => 'dropdown'],
        false,
        false,
        [],
      ), c(
        "center_slides",
        "Center Slides",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => ['path' => '%%CURRENTPATH%%.infinite', 'operand' => 'equals', 'value' => 'enabled']],
        false,
        false,
        [],
      ), c(
        "autoplay",
        "Autoplay",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => ['0' => ['text' => 'Disabled', 'value' => 'disabled'], '1' => ['value' => 'enabled', 'text' => 'Enabled (frontend only)']]],
        false,
        false,
        [],
      ), c(
        "autoplay_settings",
        "Autoplay Settings",
        [c(
        "speed",
        "Speed",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'ms'], 'defaultType' => 'ms'], 'rangeOptions' => ['step' => 100, 'min' => 0, 'max' => 10000]],
        false,
        false,
        [],
      ), c(
        "stop_on_interaction",
        "Stop On Interaction",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "pause_on_hover",
        "Pause On Hover",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout'], 'condition' => ['path' => '%%CURRENTPATH%%.autoplay', 'operand' => 'equals', 'value' => 'enabled']],
        false,
        false,
        [],
      ), c(
        "advanced",
        "Advanced",
        [c(
        "swipe_on_scroll",
        "Swipe On Scroll",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "auto_height",
        "Auto Height",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "between_slides",
        "Between Slides",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'step' => 10, 'max' => 100], 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px']],
        true,
        false,
        [],
      ), c(
        "slides_per_view",
        "Slides Per View",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.effect', 'operand' => 'is none of', 'value' => ['0' => 'flip', '1' => 'fade']]]]],
        true,
        false,
        [],
      ), c(
        "initial_slide",
        "Initial Slide",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "one_per_view_at",
        "One Per View At",
        [],
        ['type' => 'breakpoint_dropdown', 'layout' => 'vertical', 'breakpointOptions' => ['enableNever' => true]],
        false,
        false,
        [],
      ), c(
        "slides_per_group",
        "Slides Per Group",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.effect', 'operand' => 'is none of', 'value' => ['0' => 'flip', '1' => 'fade']]]]],
        true,
        false,
        [],
      ), c(
        "disable_keyboard_control",
        "Disable Keyboard Control",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "play_animations_on",
        "Play Animations On",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'transition_start', 'text' => 'Transition Start'], '1' => ['text' => 'Transition End', 'value' => 'transition_end']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "arrows",
        "Arrows",
        [c(
        "disable",
        "Disable",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline', 'condition' => ['path' => '%%CURRENTPATH%%.disable', 'operand' => 'is not set', 'value' => '']],
        false,
        false,
        [],
      ), c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px'], 'condition' => ['path' => '%%CURRENTPATH%%.disable', 'operand' => 'is not set', 'value' => '']],
        true,
        false,
        [],
      ), c(
        "overlay",
        "Overlay",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'items' => ['0' => ['value' => 'inside', 'text' => 'Inside'], '1' => ['text' => 'Outside', 'value' => 'outside']], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.disable', 'operand' => 'is not set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "space_to_slides",
        "Space To Slides",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => '%%CURRENTPATH%%.disable', 'operand' => 'is not set', 'value' => 'null'], 'unitOptions' => ['types' => ['0' => 'px', '1' => 'rem'], 'defaultType' => 'px']],
        true,
        false,
        [],
      ), c(
        "space_to_edge",
        "Space To Edge",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'px', '1' => 'rem'], 'defaultType' => 'px'], 'condition' => ['path' => '%%CURRENTPATH%%.disable', 'operand' => 'is not set', 'value' => '']],
        true,
        false,
        [],
      ), c(
        "custom_icons",
        "Custom Icons",
        [c(
        "next",
        "Next",
        [],
        ['type' => 'icon', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "previous",
        "Previous",
        [],
        ['type' => 'icon', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout'], 'condition' => ['path' => '%%CURRENTPATH%%.disable', 'operand' => 'is not set', 'value' => '']],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "pagination",
        "Pagination",
        [c(
        "type",
        "Type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => ['0' => ['value' => 'bullets', 'text' => 'Bullets'], '1' => ['text' => 'Fraction', 'value' => 'fraction'], '2' => ['text' => 'Progress Bar', 'value' => 'progressbar'], '3' => ['text' => 'None', 'value' => 'none']], 'buttonBarOptions' => ['layout' => 'default', 'size' => 'small']],
        false,
        false,
        [],
      ), c(
        "bullets",
        "Bullets",
        [c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "space_between",
        "Space Between",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'px', '1' => 'em', '2' => 'rem'], 'defaultType' => 'px']],
        true,
        false,
        [],
      ), c(
        "radius",
        "Radius",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'items' => ['0' => ['value' => 'square', 'text' => 'Square'], '1' => ['text' => 'Round', 'value' => 'round']], 'unitOptions' => ['types' => ['0' => 'px', '1' => '%'], 'defaultType' => 'px']],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout'], 'condition' => ['path' => '%%CURRENTPATH%%.type', 'operand' => 'is none of', 'value' => ['0' => 'progressbar', '1' => 'fraction', '2' => 'none']]],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Fraction",
      "fraction",
       ['type' => 'popout']
     ), c(
        "progress_bar",
        "Progress Bar",
        [c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "progress",
        "Progress",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "position",
        "Position",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => ['0' => ['value' => 'top', 'text' => 'Top'], '1' => ['text' => 'Bottom', 'value' => 'bottom']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout'], 'condition' => ['path' => '%%CURRENTPATH%%.type', 'operand' => 'equals', 'value' => 'progressbar']],
        false,
        false,
        [],
      ), c(
        "overlay",
        "Overlay",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'items' => ['0' => ['value' => 'inside', 'text' => 'Inside'], '1' => ['text' => 'Outside', 'value' => 'outside']], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.type', 'operand' => 'is none of', 'value' => ['0' => 'none']]]]],
        false,
        false,
        [],
      ), c(
        "margin",
        "Margin",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => '%%CURRENTPATH%%.type', 'operand' => 'is none of', 'value' => ['0' => 'none']]],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
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
        return ['0' =>  ['styles' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/swiper@8/swiper-bundle.min.css','%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/swiper@8/breakdance-swiper-preset-defaults.css'],'scripts' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/swiper@8/swiper-bundle.min.js','%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/breakdance-swiper/breakdance-swiper.js'],'inlineScripts' => ['window.BreakdanceSwiper().update({
  id: \'%%UNIQUESLUG%%\', selector:\'%%SELECTOR%%\',
  settings:{{ design.slider.settings|json_encode }},
  paginationSettings:{{ design.slider.pagination|json_encode }},
});'],],];
    }

    static function settings()
    {
        return false;
    }

    static function addPanelRules()
    {
        return ['alwaysHide' => true];
    }

    static public function actions()
    {
        return [

'onMountedElement' => [['script' => 'window.BreakdanceSwiper().update({
  id: \'%%ID%%\', selector:\'%%SELECTOR%%\',
  settings:{{ design.slider.settings|json_encode }},
  paginationSettings:{{ design.slider.pagination|json_encode }},
});',
],],

'onPropertyChange' => [['script' => 'window.BreakdanceSwiper().update({
  id: \'%%ID%%\', selector:\'%%SELECTOR%%\',
  settings:{{ design.slider.settings|json_encode }},
  paginationSettings:{{ design.slider.pagination|json_encode }},
});',
],],

'onBeforeDeletingElement' => [['script' => 'window.BreakdanceSwiper().destroy(
  \'%%ID%%\'
);',
],],];
    }

    static function nestingRule()
    {
        return ["type" => "final",   ];
    }

    static function spacingBars()
    {
        return false;
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
        return ['design.slider.settings.advanced.one_per_view_at', 'design.slider.settings.advanced.slides_per_group', 'design.slider.arrows.overlay', 'design.slider.arrows.disable'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
