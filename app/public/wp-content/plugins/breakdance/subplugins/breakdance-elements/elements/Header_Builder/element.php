<?php

namespace EssentialElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "EssentialElements\\HeaderBuilder",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class HeaderBuilder extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'BrowserIcon';
    }

    static function tag()
    {
        return 'header';
    }

    static function tagOptions()
    {
        return ['section', 'div', 'footer', 'aside', 'nav'];
    }

    static function tagControlPath()
    {
        return false;
    }

    static function name()
    {
        return 'Header Builder';
    }

    static function className()
    {
        return 'bde-header-builder';
    }

    static function category()
    {
        return 'site';
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
        "background",
        "Background",
        [c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "borders",
        "Borders",
        [c(
        "top",
        "Top",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "fill",
        "Fill",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "bottom",
        "Bottom",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "fill",
        "Fill",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "shadow",
        "Shadow",
        [],
        ['type' => 'shadow', 'layout' => 'vertical'],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "layout",
        "Layout",
        [c(
        "stack_vertically_at",
        "Stack Vertically At",
        [],
        ['type' => 'breakpoint_dropdown', 'layout' => 'inline', 'breakpointOptions' => ['enableNever' => true]],
        false,
        false,
        [],
      ), c(
        "gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "size",
        "Size",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => ['0' => ['value' => 'contained', 'text' => 'Contained'], '1' => ['text' => 'Full', 'value' => 'full'], '2' => ['text' => 'Custom', 'value' => 'custom']]],
        true,
        false,
        [],
      ), c(
        "custom_width",
        "Custom Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => 'design.size.width', 'operand' => 'equals', 'value' => 'custom']],
        true,
        false,
        [],
      ), c(
        "min_height",
        "Min Height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "spacing",
        "Spacing",
        [c(
        "padding",
        "Padding",
        [],
        ['type' => 'spacing_complex', 'layout' => 'vertical'],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "sticky",
        "Sticky",
        [c(
        "enable",
        "Enable",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "position",
        "Position",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => ['0' => ['value' => 'top', 'text' => 'Top'], '1' => ['text' => 'Bottom', 'value' => 'bottom']], 'condition' => ['0' => ['0' => ['path' => 'design.sticky.enable', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "page_top_margin",
        "Page Top Margin",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => 'design.sticky.position', 'operand' => 'is not set', 'value' => ''], '1' => ['path' => 'design.sticky.enable', 'operand' => 'is set', 'value' => '']], '1' => ['0' => ['path' => 'design.sticky.position', 'operand' => 'equals', 'value' => 'top'], '1' => ['path' => 'design.sticky.enable', 'operand' => 'is set', 'value' => '']]]],
        true,
        false,
        [],
      ), c(
        "page_bottom_margin",
        "Page Bottom Margin",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => 'design.sticky.position', 'operand' => 'equals', 'value' => 'bottom'], '1' => ['path' => 'design.sticky.enable', 'operand' => 'is set', 'value' => '']]]],
        true,
        false,
        [],
      ), c(
        "offset",
        "Offset",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => 'design.sticky.enable', 'operand' => 'is set', 'value' => '']]]],
        true,
        false,
        [],
      ), c(
        "scroll_behavior",
        "Scroll Behavior",
        [c(
        "hide_after",
        "Hide After",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'px']]],
        false,
        false,
        [],
      ), c(
        "hide_until_scroll",
        "Hide Until Scroll",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "scroll_distance",
        "Scroll Distance",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => 'design.sticky.scroll_behavior.hide_until_scroll', 'operand' => 'is set', 'value' => 'show_after_scroll'], 'unitOptions' => ['types' => ['0' => 'px']]],
        false,
        false,
        [],
      ), c(
        "reveal_animation",
        "Reveal Animation",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => ['0' => ['value' => 'fade', 'text' => 'Fade'], '1' => ['text' => 'Slide', 'value' => 'slide']]],
        false,
        false,
        [],
      ), c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'ms']], 'condition' => ['path' => 'design.sticky.scroll_behavior.reveal_animation', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
      ), c(
        "reveal_on_scroll_up",
        "Reveal On Scroll Up",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "offset_after_scroll",
        "Offset After Scroll",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => 'design.sticky.enable', 'operand' => 'is set', 'value' => '']]]],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout'], 'condition' => ['path' => 'design.sticky.enable', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
      ), c(
        "style",
        "Style",
        [c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        true,
        false,
        [],
      ), c(
        "min_height",
        "Min Height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "borders",
        "Borders",
        [c(
        "top",
        "Top",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "fill",
        "Fill",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "bottom",
        "Bottom",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "fill",
        "Fill",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "shadow",
        "Shadow",
        [],
        ['type' => 'shadow', 'layout' => 'vertical'],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout'], 'condition' => ['path' => 'design.sticky.enable', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
      ), c(
        "disable_at",
        "Disable At",
        [],
        ['type' => 'breakpoint_dropdown', 'layout' => 'inline', 'condition' => ['path' => 'design.sticky.enable', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
      ), c(
        "z_index",
        "Z-Index",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => 'design.sticky.enable', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'accordion']],
        false,
        false,
        [],
      ), c(
        "overlay",
        "Overlay",
        [c(
        "enable",
        "Enable",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "keep_style",
        "Keep Style",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => ['path' => 'design.overlay.enable', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
      ), c(
        "z_index",
        "Z-Index",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => 'design.overlay.enable', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "advanced",
        "Advanced",
        [c(
        "disable_builder_preview_mode",
        "Disable Builder Preview Mode",
        [],
        ['type' => 'toggle', 'layout' => 'vertical'],
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
        return ['0' =>  ['scripts' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%elements/Header_Builder/header-builder.js'],'title' => 'header-builder.js',],'1' =>  ['title' => 'frontend init','inlineScripts' => ['new BreakdanceHeaderBuilder("%%SELECTOR%%", "%%ID%%", false);'],'builderCondition' => 'return false;',],];
    }

    static function settings()
    {
        return ['proOnly' => true];
    }

    static function addPanelRules()
    {
        return false;
    }

    static public function actions()
    {
        return [

'onPropertyChange' => [['script' => 'if (window.breakdanceHeaders && window.breakdanceHeaders[%%ID%%]) {
    window.breakdanceHeaders[%%ID%%].destroy();
}

window.breakdanceHeaders[%%ID%%] = new BreakdanceHeaderBuilder("%%SELECTOR%%", "%%ID%%", true);',
],],

'onMountedElement' => [['script' => 'if (!window.breakdanceHeaders) window.breakdanceHeaders = {};

if (window.breakdanceHeaders && window.breakdanceHeaders[%%ID%%]) {
  window.breakdanceHeaders[%%ID%%].destroy();
}

window.breakdanceHeaders[%%ID%%] = new BreakdanceHeaderBuilder("%%SELECTOR%%", "%%ID%%", true);',
],],

'onActivatedElement' => [['script' => 'const element = document.querySelector(\'[data-node-id="%%ID%%"]\');
const headerElement = element.closest(\'.bde-header-builder\');
const headerId = headerElement ? headerElement.dataset.nodeId : null;

if (
  headerId &&
  window.breakdanceHeaders &&
  window.breakdanceHeaders[headerId]
) {
  window.breakdanceHeaders[headerId].refresh();
}','runForAllChildren' => true,
],],

'onBeforeDeletingElement' => [['script' => 'if (window.breakdanceHeaders && window.breakdanceHeaders[%%ID%%]) {
  window.breakdanceHeaders[%%ID%%].destroy();
  delete window.breakdanceHeaders[%%ID%%];
}',
],],];
    }

    static function nestingRule()
    {
        return ["type" => "section",   ];
    }

    static function spacingBars()
    {
        return ['0' => ['cssProperty' => 'padding-top', 'location' => 'inside-top', 'affectedPropertyPath' => 'design.spacing.padding.%%BREAKPOINT%%.top'], '1' => ['cssProperty' => 'padding-bottom', 'location' => 'inside-bottom', 'affectedPropertyPath' => 'design.spacing.padding.%%BREAKPOINT%%.bottom']];
    }

    static function attributes()
    {
        return [['name' => 'data-sticky-scroll-hide-after', 'template' => '{% if design.sticky.enable %}
{{ design.sticky.scroll_behavior.hide_after.number }}
{% endif %}'], ['name' => 'data-sticky-hide-until-scroll-distance', 'template' => '{% if design.sticky.scroll_behavior.hide_until_scroll %}
{{ design.sticky.scroll_behavior.scroll_distance.number|default(\'300\') }}
{% endif %}'], ['name' => 'data-sticky-reveal-on-scroll-up', 'template' => '{% if design.sticky.scroll_behavior.reveal_on_scroll_up %}
yes
{% endif %}']];
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
        return [['name' => 'bde-header-builder--sticky', 'template' => '{% if design.sticky.enable %}yes{% endif %}'], ['name' => 'bde-header-builder--sticky-scroll-slide', 'template' => '{% if design.sticky.scroll_behavior.reveal_animation|default(\'slide\') == \'slide\' %}yes{% endif %}'], ['name' => 'bde-header-builder--sticky-scroll-fade', 'template' => '{% if design.sticky.scroll_behavior.reveal_animation == \'fade\' %}yes{% endif %}'], ['name' => 'bde-header-builder--sticky-styles', 'template' => '{% if design.sticky.scroll_behavior.hide_until_scroll %}
yes
{% endif %}'], ['name' => 'bde-header-builder--sticky-scroll-start-off-hidden', 'template' => '{% if design.sticky.scroll_behavior.hide_until_scroll %}
yes
{% endif %}'], ['name' => 'bde-header-builder--sticky-scroll-hide', 'template' => '{% if design.sticky.scroll_behavior.hide_until_scroll %}
yes
{% endif %}'], ['name' => 'bde-header-builder--sticky-bottom', 'template' => '{% if design.sticky.position == \'bottom\' %}
yes
{% endif %}'], ['name' => 'bde-header-builder--overlay', 'template' => '{% if design.overlay.enable %}
yes
{% endif %}']];
    }

    static function projectManagement()
    {
        return false;
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return ['design.sticky.disable_at', 'design.layout.stack_vertically_at', 'design.overlay.no_overlay_at', 'design.sticky.position', 'design.sticky.enable'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
