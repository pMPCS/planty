<?php
/**
 *
 * @psalm-type AjaxForm = array{
 * slug:string,
 * loggedIn:boolean,
 * handler:Closure():mixed,
 * args?: FilterInputArrayOptions,
 * optional_args?: string[]
 * }
 *
 * @psalm-type ApiKeyInput = array{type: string, apiKey: string|null, apiUrl?: string}
 *
 * @psalm-type StoredFormField = array{
 * type:string,
 * label:string,
 * advanced: array{
 *  id:string,
 *  value?:string,
 *  placeholder?:string,
 *  required:boolean,
 *  autocomplete_disabled?: boolean,
 *  tabindex?: string,
 *  conditional?:bool,
 *  condition?: array {
 *    field?: string|array {
 *      type:string,
 *      label:string,
 *      advanced: array{
 *          id:string,
 *      }
 *    },
 *    operand?: string,
 *    value?: string
 *  }
 * },
 * options?:array{value: string, label: string}[],
 * max_file_size?: int,
 * max_number_of_files?: int,
 * allowed_file_types?: string[],
 * audience?: string,
 * interest_category?: string,
 * api_key_input: ApiKeyInput
 * }
 *
 * @psalm-type ParsedFormField = StoredFormField & array{
 * name:string,
 * class?:string[],
 * options:array{value: string, label: string}[],
 * attributes?:array<string, string>,
 * append?: string
 * }
 *
 * @psalm-type FormUserSubmittedContents = array<string, string|array>[]
 *
 * @psalm-type FormFieldWithValue = ParsedFormField & array{
 *  value: string,
 *  originalValue: mixed,
 * }
 *
 * @psalm-type FormData = FormFieldWithValue[]
 *
 * @psalm-type DropdownData = array{text: string, value: string};
 *
 * @psalm-type FormRequestContext = array{context: array{api_key_input: ApiKeyInput }}
 *
 * @psalm-type FormRequestContextMailChimp = array{context: array{api_key_input: ApiKeyInput, audience: string, category?: string }}
 * @psalm-type FormRequestContextDrip = array{context: array{api_key_input: ApiKeyInput, account: string }}
 *
 * @psalm-type NormalizedUploadedFiles = array<string, array<array-key, array<string, int|string>>>
 *
 * @psalm-type FormFile = array{
 * file: string,
 * url: string,
 * type: string,
 * fieldId: string,
 * error?: boolean
 * }
 *
 * @psalm-type FormFieldType = array{label: string, slug: string, handler: string, proOnly?: boolean}
 *
 * @psalm-type FormFileGroup = array<string, FormFile[]>
 *
 * @psalm-type FormExtra = array{
 * files: FormFile[],
 * uploads: NormalizedUploadedFiles,
 * fields: FormUserSubmittedContents,
 * formId: int,
 * postId: int,
 * ip: string,
 * referer: string,
 * userAgent: string,
 * userId: int
 * }
 *
 * @psalm-type FormEmail = array{
 * message: string,
 * subject: string,
 * cc: string,
 * bcc: string,
 * to: string,
 * from: string,
 * from_name: string,
 * reply_to: string,
 * attach_files: boolean
 * }
 *
 * @psalm-type FormSettings = array{
 *  form: array{
 *   form_name: string,
 *   fields: StoredFormField[],
 *   success_message: string,
 *   error_message: string,
 *   submit_text: string,
 *   next_step_text: string,
 *   previous_step_text: string,
 *   redirect: boolean,
 *   redirect_url: string,
 *  },
 *  advanced: array{
 *   form_id: string,
 *   submit_button_id: string,
 *   recaptcha: array{
 *    enabled: boolean,
 *    api_key_input: ApiKeyInput
 *   },
 *   honeypot_enabled: boolean,
 *   conditional?:bool,
 *   condition: array {
 *     field?: string,
 *     operand?: string,
 *     value?: string
 *   },
 *   csrf_enabled: boolean
 *  },
 *  actions: array{
 *   actions: string[],
 *   email: array{
 *    emails: FormEmail[],
 *   },
 *   slack: array{
 *    api_key_input: ApiKeyInput,
 *    description: string,
 *    pre_text: string,
 *    title: string,
 *    include_form_data: boolean,
 *    include_timestamp: boolean,
 *    color: string,
 *   },
 *   discord: array{
 *    api_key_input: ApiKeyInput,
 *    username: string,
 *    title: string,
 *    description: string,
 *    avatar: array{url: string},
 *    image: array{url: string},
 *    include_form_data: boolean,
 *    include_timestamp: boolean,
 *    color: string,
 *   },
 *   mailchimp: array{
 *    api_key_input: ApiKeyInput,
 *    double_optin: boolean,
 *    field_mapping: array{
 *     fields: array | null
 *    },
 *    audience: string,
 *    interests: array {
 *      groups: array{interest:string}[]
 *    },
 *   },
 *   mailerlite: array{
 *    api_key_input: ApiKeyInput,
 *    field_mapping: array{
 *     fields: array | null
 *    },
 *    group: string,
 *    resubscribe: boolean
 *   },
 *   getresponse: array{
 *     api_key_input: ApiKeyInput,
 *     field_mapping: array{
 *      fields: array | null
 *     },
 *      dayOfCycle: int | null,
 *      tags: array,
 *      list: array,
 *   },
 *   convertkit: array{
 *     api_key_input: ApiKeyInput,
 *     field_mapping: array{
 *      fields: array | null
 *     },
 *      dayOfCycle: int | null,
 *      form: string,
 *      tags: array{tag: string}[] | null,
 *   },
 *   drip: array{
 *     api_key_input: ApiKeyInput,
 *     field_mapping: array{
 *      fields: array | null
 *     },
 *     account: string,
 *     tags: string[],
 *     include_all_fields: boolean,
 *   },
 *   activecampaign: array{
 *     api_key_input: ApiKeyInput,
 *     account: string,
 *     list: string,
 *     tags: string[],
 *     field_mapping: array{
 *      fields: array | null
 *     },
 *   },
 *   webhook: array{
 *    webhook_url: string,
 *    webhook_field_map: array{name:string, value: string}[],
 *    webhook_headers: array{name:string, value: string}[]
 *   },
 *   custom_javascript: array{
 *    js_on_success: string,
 *    js_on_error: string
 *   },
 *   store_submission: array{
 *    submission_title: string,
 *    store_files: boolean,
 *    store_files_as_attachment: boolean,
 *    restrict_file_access: boolean,
 *   },
 *   popup: array{
 *    popups_on_success: array{popup: string, action: string}[],
 *    popups_on_error: array{popup: string, action: string}[]
 *   }
 *  },
 * }
 *
 * @psalm-type FormDesign = array{
 *  form: array{
 *    submit_button: mixed,
 *    fields: mixed,
 *    advanced: mixed,
 *    layout: mixed,
 *    stepper: mixed
 *  },
 *  layout: array{
 *    layout: string,
 *    vertical_at: string,
 *  }
 * }
 *
 * @psalm-type FormError = array{
 * type: "error" | "user-error",
 * message: string,
 * executed_at: string
 * }
 *
 * @psalm-type FormSuccess = array{
 * type: "success",
 * message: string,
 * response?: mixed,
 * executed_at: string
 * }
 *
 * @psalm-type FormSubmissionMeta = array{
 * formId: int,
 * postId: int,
 * form: FormData,
 * fields: FormUserSubmittedContents,
 * settings: FormSettings|null,
 * formName: string,
 * postTitle: string,
 * postType: string|false,
 * postTypeLabel: string,
 * status: string|false,
 * date: string|int|false,
 * modified: string|int|false,
 * editUrl: string|null,
 * builderUrl: string,
 * ip: string,
 * referer: string,
 * userAgent: string,
 * user: WP_User|false
 * }
 *
 * @psalm-type FormInputType = "text"|"email"|"number"|"password"|"date"|"time"
 *
 * @psalm-type ReCaptchaResponse = array{
 * success: boolean,
 * score: float,
 * challenge_ts: string,
 * hostname: string,
 * action: string,
 * error-codes: array
 * }
 *
 * @psalm-type MailChimpField = array{id: string, tag: string, name: string}
 * @psalm-type MailChimpInterest = array{list_id: string, id: string, name: string, category_id:string}
 * @psalm-type MailChimpInterestCategory = array{list_id: string, id: string, title: string, type:string}
 *
 * @psalm-type ConvertKitList = array{uid: string, name: string}
 * @psalm-type ConvertKitField = array{id: number, key: string, name: string, label: string}
 *
 * @psalm-type ActionContext = array{
 * section: string,
 * data: array<array-key, mixed>,
 * }
 *
 * @psalm-type ActionError = array{
 * type: "error" | "user-error",
 * message: string,
 * response?: mixed,
 * id?: int,
 * context?: ActionContext[]
 * }
 *
 * @psalm-type ActionSuccess = array{
 * type: "success",
 * message: string,
 * response?: mixed,
 * id?: int,
 * context?: ActionContext[]
 * }
 *
 * @psalm-type _FILES = array{
 * name: array<string, string[]>,
 * type: array<string, string[]>,
 * tmp_name: array<string, string[]>,
 * error: array<string, int[]>,
 * size: array<string, int[]>
 * }
 * @psalm-type _FILE = array{name: string, type: string, tmp_name: string, error: int, size: int}
 *
 * @psalm-type WordPressUploadDirectory = array{
 *  url: string,
 *  path: string,
 *  basedir: string,
 *  baseurl: string,
 *  subdir: string,
 *  error: string
 * }
 *
 */
