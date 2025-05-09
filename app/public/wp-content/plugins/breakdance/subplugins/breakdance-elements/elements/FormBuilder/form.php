<?php

namespace EssentialElements;

use Breakdance\Forms\Actions\ActionProvider;
use function Breakdance\Elements\c;
use function Breakdance\Elements\control;
use function Breakdance\Elements\controlSection;
use function Breakdance\Elements\PresetSections\getPresetSection;
use function Breakdance\Forms\fieldTypes;
use function Breakdance\Subscription\getFieldItemsWithProLabelForProOnlyFields;
use function Breakdance\Subscription\getActionItemsWithProAppendedToProOnlyActions;
use function Breakdance\Subscription\getProOnlyFieldTypes;
use function Breakdance\Subscription\getProOnlyFormActionSlugs;

class FormBuilder extends \Breakdance\Elements\Element
{

    static function uiIcon()
    {
        return '<svg aria-hidden="true" focusable="false"   class="svg-inline--fa fa-envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M448 64H64C28.65 64 0 92.65 0 128v256c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64V128C512 92.65 483.3 64 448 64zM64 96h384c17.64 0 32 14.36 32 32v36.01l-195.2 146.4c-17 12.72-40.63 12.72-57.63 0L32 164V128C32 110.4 46.36 96 64 96zM480 384c0 17.64-14.36 32-32 32H64c-17.64 0-32-14.36-32-32V203.1L208 336c14.12 10.61 31.06 16.02 48 16.02S289.9 346.6 304 336L480 203.1V384z"></path></svg>';
    }

    static function tag()
    {
        return 'div';
    }

    static function name()
    {
        return 'Form Builder';
    }

    static function slug()
    {
        return __CLASS__;
    }

    static function category()
    {
        return 'forms';
    }

    static function className()
    {
        return 'bde-form-builder';
    }

    static function template()
    {
        return file_get_contents(__DIR__ . '/html.twig');
    }

    static function defaultCss()
    {
        return file_get_contents(__DIR__ . '/default.css');
    }

    static function cssTemplate()
    {
        return file_get_contents(__DIR__ . '/css.twig');
    }

    static function designControls()
    {
        return [
            getPresetSection("EssentialElements\\form-container", "Container", "container", ['type' => 'popout']),
            getPresetSection("EssentialElements\\AtomV1FormDesign", 'Form', 'form', ['type' => 'popout']),
            controlSection('layout', 'Layout', [
                \Breakdance\Elements\control("layout", "Layout", [
                    'type' => 'button_bar',
                    'layout' => 'inline',
                    'items' => [
                        ['value' => 'vertical', 'text' => 'Vertical'],
                        ['text' => 'Horizontal', 'value' => 'horizontal'],
                    ],
                ]),

                \Breakdance\Elements\control("vertical_at", "Vertical at", [
                    'type' => 'breakpoint_dropdown',
                    'layout' => 'inline',
                ]),
            ]),
            getPresetSection("EssentialElements\\spacing_margin_y", "Spacing", "spacing", ['type' => 'popout']),
        ];
    }

    static function contentControls()
    {
        $actions = ActionProvider::getInstance();
        $actionsControls = $actions->getControls();
        $typesControls = getTypesControls();
        $extraControls = [
            \Breakdance\Elements\control('form_id', 'Form HTML ID', [
                'type' => 'text',
            ]),
            \Breakdance\Elements\control('submit_button_id', 'Submit HTML ID', [
                'type' => 'text',
            ]),
            \Breakdance\Forms\Recaptcha\controls(),
            c(
                "free_mode_warning",
                "Free mode warning",
                [],
                ['type' => 'pro_only_alert_box', 'layout' => 'vertical', 'condition' => ['path' => 'content.advanced.honeypot_enabled', 'operand' => 'is set', 'value' => '',], 'alertBoxOptions' => ['style' => 'warning', 'content' => '<p>The honeypot option is only available in Breakdance Pro.</p>']],
                false,
                false,
                [],
            ),
            \Breakdance\Elements\control('honeypot_enabled', 'Add Honeypot Field', [
                'type' => 'toggle',
            ]),
            \Breakdance\Elements\control('csrf_enabled', 'Enable CSRF Protection', [
                'type' => 'toggle',
            ]),
            \Breakdance\Elements\control("csrf_disabled_warning", "CSRF Disabled", [
                'type' => 'alert_box',
                'layout' => 'vertical',
                'alertBoxOptions' => [
                    'style' => 'info',
                    'content' => '<p>CSRF protection can enhance the security of forms gated behind a login screen - <a href="https://breakdance.com/documentation/other/security/" target="_blank">see details</a>.</p>',
                ],
                'condition' => [
                    'path' => 'content.advanced.csrf_enabled',
                    'operand' => 'is not set',
                    'value' => '',
                ],
            ])
        ];

        return array_merge(
            [
                controlSection('form', 'Form', [
                    \Breakdance\Elements\control('form_name', 'Form Name', [
                        'type' => 'text',
                    ]),
                    \Breakdance\Elements\repeaterControl(
                        'fields',
                        'Fields',
                        array_merge(
                            [
                                c(
                                    "free_mode_warning",
                                    "Free mode warning",
                                    [],
                                    ['type' => 'pro_only_alert_box', 'layout' => 'vertical', 'condition' => ['path' => '%%CURRENTPATH%%.type', 'operand' => 'is one of', 'value' => getProOnlyFieldTypes()], 'alertBoxOptions' => ['style' => 'warning', 'content' => '<p>This field type is only available in Breakdance Pro</p>']],
                                    false,
                                    false,
                                    [],
                                ),
                                \Breakdance\Elements\control('type', 'Type', [
                                    'type' => 'dropdown',
                                    'layout' => 'vertical',
                                    'items' => getFieldItemsWithProLabelForProOnlyFields(fieldTypes()),
                                ]),
                                \Breakdance\Elements\control('label', 'Label', [
                                    'type' => 'text',
                                    'layout' => 'vertical',
                                ]),
                            ],
                            $typesControls,
                            [
                                controlSection('advanced', 'Advanced', [
                                    \Breakdance\Elements\control('id', 'ID', [
                                        'type' => 'text',
                                        'condition' => [
                                            'path' => '%%CURRENTPATH%%.type',
                                            'operand' => 'is none of',
                                            'value' => ['html'],
                                        ]
                                    ]),
                                    \Breakdance\Elements\control('value', 'Value', [
                                        'type' => 'text',
                                        'layout' => 'vertical',
                                        'condition' => [
                                            'path' => '%%PARENTPATH%%.type',
                                            'operand' => 'is none of',
                                            'value' => ['radio', 'checkbox', 'select', 'html', 'date', 'time', 'number'],
                                        ],
                                    ]),
                                    \Breakdance\Elements\control('value', 'Value', [
                                        'type' => 'number',
                                        'layout' => 'vertical',
                                        'condition' => [
                                            'path' => '%%PARENTPATH%%.type',
                                            'operand' => 'equals',
                                            'value' => 'number',
                                        ],
                                    ]),
                                    \Breakdance\Elements\control('value', 'Value', [
                                        'type' => 'date_picker',
                                        'layout' => 'vertical',
                                        'condition' => [
                                            'path' => '%%PARENTPATH%%.type',
                                            'operand' => 'equals',
                                            'value' => 'date',
                                        ],
                                    ]),
                                    \Breakdance\Elements\control('value', 'Value', [
                                        'type' => 'time_picker',
                                        'layout' => 'vertical',
                                        'condition' => [
                                            'path' => '%%PARENTPATH%%.type',
                                            'operand' => 'equals',
                                            'value' => 'time',
                                        ],
                                    ]),
                                    \Breakdance\Elements\control('placeholder', 'Placeholder', [
                                        'type' => 'text',
                                        'layout' => 'vertical',
                                        'condition' => [
                                            'path' => '%%PARENTPATH%%.type',
                                            'operand' => 'is none of',
                                            'value' => ['radio', 'checkbox', 'hidden', 'date', 'time', 'file', 'html'],
                                        ],
                                    ]),
                                    \Breakdance\Elements\control('required', 'Required', [
                                        'type' => 'toggle',
                                        'condition' => [
                                            'path' => '%%PARENTPATH%%.type',
                                            'operand' => 'is none of',
                                            'value' => ['hidden', 'html'],
                                        ],
                                    ]),
                                    \Breakdance\Elements\control('width', 'Width', [
                                        'type' => 'number',
                                        'layout' => 'inline',
                                        'rangeOptions' => ['step' => 1, 'min' => 1, 'max' => 12]
                                    ]),
                                    c(
                                        "free_mode_warning",
                                        "Free mode warning",
                                        [],
                                        [
                                            'type' => 'pro_only_alert_box', 'layout' => 'vertical',
                                            'alertBoxOptions' => ['style' => 'warning', 'content' => '<p>Conditional Field Display is only available in Breakdance Pro</p>',],
                                            'condition' => [
                                                'path' => '%%CURRENTPATH%%.conditional',
                                                'operand' => 'equals',
                                                'value' => true,
                                            ],
                                        ],
                                        false,
                                        false,
                                        [],
                                    ),
                                    \Breakdance\Elements\control('conditional', 'Conditional', [
                                        'type' => 'toggle'
                                    ]),
                                    \Breakdance\Elements\control('condition', 'Condition', [
                                        'type' => 'conditional_form_field',
                                        'layout' => 'vertical',
                                        'noLabel' => true,
                                        'dropdownOptions' => [
                                            'populate' => [
                                                'path' => 'content.form.fields',
                                                'text' => 'label',
                                                'value' => 'advanced.id',
                                                'condition' => [
                                                    'path' => 'advanced.id',
                                                    'operand' => 'not equals',
                                                    'value' => 'advanced.id',
                                                ],
                                            ],
                                        ],
                                        'condition' => [
                                            'path' => '%%CURRENTPATH%%.conditional',
                                            'operand' => 'equals',
                                            'value' => true,
                                        ],
                                    ]),
                                    \Breakdance\Elements\control('hide_label', 'Hide Label', [
                                        'type' => 'toggle'
                                    ]),
                                ], ['condition' => [
                                    'path' => '%%CURRENTPATH%%.type',
                                    'operand' => 'is none of',
                                    'value' => ['step'],
                                ]], 'popout'),
                            ],
                        ),
                        [
                            'repeaterOptions' => [
                                'titleTemplate' => '{label}',
                                'defaultTitle' => 'Field',
                                'buttonName' => 'Add Field',
                                'defaultNewValue' => [
                                    'type' => 'text',
                                    'label' => 'Name',
                                    'advanced' => ['id' => '{random_string}'],
                                ],
                                'duplicateNewValue' => [
                                    'advanced' => ['id' => '{random_string}'],
                                ],
                            ],
                        ]
                    ),
                    control('submit_text', 'Submit Text', ['type' => 'text', 'layout' => 'vertical']),
                    control('success_message', 'Success Message', ['type' => 'text', 'layout' => 'vertical']),
                    control('error_message', 'Error Message', ['type' => 'text', 'layout' => 'vertical']),
                    control('hide_on_success', 'Hide Form On Success', ['type' => 'toggle']),
                    control('redirect', 'Redirect After Submit', ['type' => 'toggle']),
                    control(
                        'redirect_url',
                        'Redirect URL',
                        [
                            'type' => 'url',
                            'layout' => 'vertical',
                            'condition' => [
                                'path' => 'content.form.redirect',
                                'operand' => 'equals',
                                'value' => true,
                            ],
                        ]
                    ),
                ]),
                controlSection(
                    'actions',
                    'Actions',
                    array_merge([
                        c(
                            "free_mode_warning",
                            "Free mode warning",
                            [],
                            ['type' => 'pro_only_alert_box', 'layout' => 'vertical', 'condition' => ['path' => '%%CURRENTPATH%%.actions', 'operand' => 'includes', 'value' => getProOnlyFormActionSlugs()], 'alertBoxOptions' => ['style' => 'warning', 'content' => '<p>Please upgrade to Breakdance Pro to use pro-only form actions.</p>']],
                            false,
                            false,
                            [],
                        ),
                        control('actions', 'Actions After Submission', [
                            'type' => 'multiselect',
                            'layout' => 'vertical',
                            'placeholder' => 'No action selected',
                            'items' => getActionItemsWithProAppendedToProOnlyActions($actions->getActions()),
                        ]),
                    ], $actionsControls)
                ),
                controlSection(
                    'advanced',
                    'Advanced',
                    $extraControls
                ),
            ],
        );
    }

    static function settingsControls()
    {
        return [];
    }

    static function defaultProperties()
    {
        $currentUser = wp_get_current_user();
        return
            [
                'content' => [
                    'form' => [
                        'form_name' => 'Contact Form',
                        'fields' => [
                            [
                                'type' => 'text',
                                'label' => 'Name',
                                'advanced' => [
                                    'required' => true,
                                    'id' => 'name',
                                ],
                            ],
                            [
                                'type' => 'email',
                                'label' => 'Email',
                                'advanced' => [
                                    'required' => true,
                                    'id' => 'email',
                                ],
                            ],
                            [
                                'type' => 'textarea',
                                'label' => 'Message',
                                'advanced' => [
                                    'required' => true,
                                    'id' => 'message',
                                ],
                            ],
                        ],
                        'submit_text' => 'Submit',
                        'success_message' => 'Your message has been received!',
                        'error_message' => 'Something went wrong',
                    ],
                    'actions' => [
                        'actions' => [
                            'email',
                            'store_submission',
                        ],
                        'store_submission' => [
                            'submission_title' => '{email}',
                            'store_files' => true
                        ],
                        'email' => [
                            'emails' => [[
                                'message' => "{all_fields}",
                                'subject' => "New contact form message",
                                'from' => get_option('admin_email'),
                                'from_name' => "{name}",
                                'reply_to' => "{email}",
                                'to' => $currentUser->user_email,
                            ]],
                        ],
                    ],
                ],
                'design' => [
                    'form' => [
                        'theme' => 'default',
                    ],
                ],
            ];
    }

    static function dynamicPropertyPaths()
    {
        return ['0' => ['accepts' => 'string', 'path' => 'content.form.fields[].advanced.value']];
    }

    static function nestingRule()
    {
        return ['type' => 'final'];
    }

    static function dependencies()
    {
        return \Breakdance\Forms\getAjaxDependencies();
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return ['design.form.fields.advanced.hide_labels', 'design.layout.vertical_at', 'design.form.submit_button.styles.size.full_width_at', 'design.form.fields.advanced.file_input.button.size.full_width_at', 'design.form.other.stepper.stack_vertically_at', 'design.form.other.stepper.disable_at'];
    }

    static function spacingBars()
    {
        return ['0' => ['location' => 'outside-top', 'cssProperty' => 'margin-top', 'affectedPropertyPath' => 'design.spacing.margin_top.%%BREAKPOINT%%'], '1' => ['location' => 'outside-bottom', 'cssProperty' => 'margin-bottom', 'affectedPropertyPath' => 'design.spacing.margin_bottom.%%BREAKPOINT%%']];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return ['content.form.fields', 'content.advanced', 'design.layout', 'content.form.submit_text'];
    }

    public static function actions()
    {
        return [
            "onMountedElement" => [
                ["script" => "const form = document.querySelector('%%SELECTOR%% .breakdance-form'); breakdanceForm.initConditionalFields(form, true); breakdanceForm.initSteps(form, true)"],
            ],
            "onBeforeDeletingElement" => [
                ["script" => "breakdanceForm.destroy('%%SELECTOR%%');"],
            ],
        ];
    }
}
