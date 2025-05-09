<?php

namespace EssentialElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "EssentialElements\\Advancedslider",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Advancedslider extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" fill="currentColor" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 500 500"> <path d="M96.5 53c-8.279 0-15 6.721-15 15s6.721 15 15 15h307c8.28 0 15-6.721 15-15s-6.72-15-15-15h-307Zm0 306c-8.279 0-15 6.721-15 15s6.721 15 15 15h307c8.28 0 15-6.721 15-15s-6.72-15-15-15h-307ZM250 417c-8.278 0-15 6.721-15 15s6.722 15 15 15c8.28 0 15-6.721 15-15s-6.72-15-15-15Zm-44 0c-8.278 0-15 6.721-15 15s6.722 15 15 15c8.28 0 15-6.721 15-15s-6.72-15-15-15Zm88 0c-8.278 0-15 6.721-15 15s6.722 15 15 15c8.28 0 15-6.721 15-15s-6.72-15-15-15Z"/> <path d="M81.5 374c0 8.278 6.721 15 15 15s15-6.722 15-15V68c0-8.28-6.721-15-15-15s-15 6.72-15 15v306Zm307 0c0 8.278 6.721 15 15 15s15-6.722 15-15V68c0-8.28-6.721-15-15-15s-15 6.72-15 15v306Zm77.61-153-16.324-22.143c-4.912-6.663-3.49-16.062 3.173-20.974 6.664-4.913 16.063-3.49 20.975 3.173l20.73 28.121c3.584 3.013 5.43 7.407 5.332 11.823a15 15 0 0 1-5.332 11.822l-20.73 28.122c-4.912 6.663-14.31 8.085-20.975 3.173-6.663-4.912-8.085-14.31-3.173-20.975L466.11 221Zm-432.219 0 16.323-22.143c4.912-6.663 3.49-16.062-3.173-20.974-6.664-4.913-16.063-3.49-20.975 3.173l-20.73 28.121C1.752 212.19-.094 216.584.004 221a15 15 0 0 0 5.332 11.822l20.73 28.122c4.912 6.663 14.311 8.085 20.975 3.173 6.663-4.912 8.085-14.31 3.173-20.975L33.891 221ZM158.5 255a13.947 13.947 0 0 1-.867-.025l-.096-.005c-.095-.007-.191-.013-.285-.021l-.095-.008a17.49 17.49 0 0 1-.472-.05l-.008-.001a13.753 13.753 0 0 1-.831-.124l-.092-.017a14.909 14.909 0 0 1-3.277-1.009l-.064-.029-.039-.017a14.869 14.869 0 0 1-2.481-1.411l-.074-.052-.073-.052-.073-.053a18.241 18.241 0 0 1-.145-.108l-.072-.054a14.79 14.79 0 0 1-1.065-.886l-.182-.169a15.319 15.319 0 0 1-1.322-1.418 15.008 15.008 0 0 1-2.243-3.739l-.035-.084a16.927 16.927 0 0 1-.269-.71 14.814 14.814 0 0 1-.344-1.121l-.023-.09a7.638 7.638 0 0 1-.054-.217 9.049 9.049 0 0 1-.075-.326l-.02-.091c-.026-.122-.05-.244-.073-.367l-.017-.092-.022-.132A15.009 15.009 0 0 1 143.5 240v-90a15.31 15.31 0 0 1 .187-2.376l.016-.093.009-.055c.028-.167.059-.333.093-.497l.019-.092.04-.182.02-.091a14.918 14.918 0 0 1 .691-2.197l.034-.085c.162-.395.34-.781.533-1.158l.042-.081a14.922 14.922 0 0 1 2.337-3.309c.289-.311.592-.61.907-.895l.055-.051.019-.017a15.657 15.657 0 0 1 1.026-.839l.072-.054a14.98 14.98 0 0 1 3.599-1.963l.146-.054a13.89 13.89 0 0 1 1.121-.361 14.855 14.855 0 0 1 2.235-.443l.172-.02c.159-.017.319-.032.48-.044l.089-.006.095-.007.071-.004c.295-.017.592-.026.892-.026h90c.097 0 .194.001.29.003l.097.002.192.006.097.004c.202.009.403.022.603.039l.064.005.095.009.085.009c.086.008.171.018.257.028.236.028.471.061.704.1l.077.013.02.004c.161.028.322.058.48.091l.052.011c.106.023.213.046.319.071l.044.011.091.021.09.023.09.023.09.023.089.024.089.024.089.025.089.026.023.007.154.046.088.027.088.028.088.028.036.011c.308.102.613.213.912.333h.001a15.18 15.18 0 0 1 1.28.586l.044.023.041.021c.109.057.217.116.325.176l.033.018.029.017a14.722 14.722 0 0 1 1.764 1.161l.138.107c.2.157.396.319.588.485l.125.109.067.06a14.755 14.755 0 0 1 1.498 1.554l.058.069.167.206a14.98 14.98 0 0 1 1.361 2.027l.044.079A14.9 14.9 0 0 1 263.5 150v90a14.96 14.96 0 0 1-1.937 7.374l-.012.021a15 15 0 0 1-1.055 1.607l-.032.042-.054.072c-.092.119-.185.237-.28.353l-.057.07c-.134.162-.271.321-.411.478l-.061.066c-.275.303-.563.595-.862.875l-.023.021-.066.062c-.331.304-.676.594-1.034.869l-.072.054c-.311.236-.632.46-.962.672l-.076.048a14.886 14.886 0 0 1-2.588 1.306l-.005.002c-.854.331-1.746.586-2.667.757l-.092.017-.093.016a15.11 15.11 0 0 1-1.598.188c-.085.005-.169.01-.254.013-.235.011-.471.017-.709.017h-90Zm15-90v60h60v-60h-60Zm75-30ZM356.5 292c0-8.279-6.721-15-15-15h-183c-8.279 0-15 6.721-15 15s6.721 15 15 15h183c8.279 0 15-6.721 15-15Z"/> </svg>';
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
        return 'Advanced Slider';
    }

    static function className()
    {
        return 'bde-advancedslider';
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
        return false;
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Advancedslide', 'defaultProperties' => ['design' => ['layout' => null, 'background' => ['layers' => ['breakpoint_base' => []], 'clip' => null]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Put anything you want in a slide.']]], 'children' => []]]], ['slug' => 'EssentialElements\Advancedslide', 'defaultProperties' => ['design' => ['layout' => null, 'background' => null]], 'children' => [['slug' => 'EssentialElements\Columns', 'defaultProperties' => null, 'children' => [['slug' => 'EssentialElements\Column', 'defaultProperties' => ['design' => ['size' => ['width' => ['unit' => '%', 'number' => 31.57, 'style' => '31.57%']]]], 'children' => [['slug' => 'EssentialElements\Image', 'defaultProperties' => ['design' => ['image' => null]], 'children' => []]]], ['slug' => 'EssentialElements\Column', 'defaultProperties' => ['design' => ['size' => ['width' => ['unit' => '%', 'number' => 68.43, 'style' => '68.43%']], 'layout' => ['align' => null, 'vertical_align' => ['breakpoint_base' => 'center']]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Advanced Slider']], 'design' => ['spacing' => ['margin_bottom' => ['breakpoint_base' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]]]], 'children' => []]]]]]]], ['slug' => 'EssentialElements\Advancedslide', 'defaultProperties' => ['design' => ['layout' => null, 'background' => null]], 'children' => [['slug' => 'EssentialElements\Video', 'defaultProperties' => ['content' => ['video' => ['video' => ['title' => 'Sample Videos / Dummy Videos For Demo Use', 'provider' => 'youtube', 'url' => 'https://www.youtube.com/watch?v=EngW7tLk6R8', 'embedUrl' => 'https://www.youtube.com/embed/EngW7tLk6R8?feature=oembed', 'thumbnail' => 'https://i.ytimg.com/vi/EngW7tLk6R8/hqdefault.jpg', 'format' => 'video', 'type' => 'oembed']]], 'design' => ['container' => ['width' => ['breakpoint_base' => ['number' => 600, 'unit' => 'px', 'style' => '600px']]]]], 'children' => []]]]];
    }

    static function cssTemplate()
    {
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [c(
        "container",
        "Container",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'fit-content', 'text' => 'Fit Content'], ['text' => 'Viewport', 'value' => 'viewport'], ['text' => 'Custom', 'value' => 'custom']]],
        false,
        false,
        [],
      ), c(
        "custom_height",
        "Custom Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => 'design.container.height', 'operand' => 'equals', 'value' => 'custom']],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\AtomV1SwiperSettings",
      "Slider",
      "slider",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_margin_y",
      "Spacing",
      "spacing",
       ['type' => 'popout']
     )];
    }

    static function contentControls()
    {
        return [c(
        "slides",
        "Slides",
        [c(
        "add_slide",
        "Add Slide",
        [],
        ['type' => 'add_registered_children', 'layout' => 'vertical'],
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

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return ['0' =>  ['scripts' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/swiper@8/swiper-bundle.min.js','%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/breakdance-swiper/breakdance-swiper.js'],'styles' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/swiper@8/swiper-bundle.min.css','%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%dependencies-files/swiper@8/breakdance-swiper-preset-defaults.css'],'inlineScripts' => ['window.BreakdanceSwiper().update({
            id: \'%%UNIQUESLUG%%\',
            selector:\'%%SELECTOR%%\',
            settings:{{ design.slider.settings|json_encode }},
            paginationSettings:{{ design.slider.pagination|json_encode }},
          });'],],];
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

'onPropertyChange' => [['script' => 'window.BreakdanceSwiper().update({
  id: \'%%ID%%\',
  selector:\'%%SELECTOR%%\',
  settings:{{ design.slider.settings|json_encode }},
  paginationSettings:{{ design.slider.pagination|json_encode }},
});',
],],

'onMountedElement' => [['script' => 'window.BreakdanceSwiper().update({
  id: \'%%ID%%\',
  selector:\'%%SELECTOR%%\',
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
        return ["type" => "container-restricted",    ];
    }

    static function spacingBars()
    {
        return [['location' => 'outside-top', 'cssProperty' => 'margin-top', 'affectedPropertyPath' => 'design.spacing.margin_top.%%BREAKPOINT%%'], ['location' => 'outside-bottom', 'cssProperty' => 'margin-bottom', 'affectedPropertyPath' => 'design.spacing.margin_bottom.%%BREAKPOINT%%']];
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
        return 14;
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
        return ['design.container.height', 'design.slider.settings.advanced.one_per_view_at', 'design.slider.settings.advanced.slides_per_group', 'design.slider.arrows.overlay', 'design.slider.arrows.disable'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
