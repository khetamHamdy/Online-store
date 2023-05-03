<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
                                'numeric' => 'The :attribute must be between :min and :max.',
                                'file'    => 'The :attribute must be between :min and :max kilobytes.',
                                'string'  => 'The :attribute must be between :min and :max characters.',
                                'array'   => 'The :attribute must have between :min and :max items.',
                              ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
                                'numeric' => 'The :attribute may not be greater than :max.',
                                'file'    => 'The :attribute may not be greater than :max kilobytes.',
                                'string'  => 'The :attribute may not be greater than :max characters.',
                                'array'   => 'The :attribute may not have more than :max items.',
                              ],
    'gt'                  => [
                                'numeric' => 'The :attribute must be greater than :max.',
                            ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
                                'numeric' => 'The :attribute must be at least :min.',
                                'file'    => 'The :attribute must be at least :min kilobytes.',
                                'string'  => 'The :attribute must be at least :min characters.',
                                'array'   => 'The :attribute must have at least :min items.',
                              ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',

    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [

        'status' => 'status',
        'store_area_id' => 'Store Area',
        'minimum' => 'Minimum',
        'delivery_cost' => 'Delivery Cost',
        'product_id' => 'Product',
        'additions' => 'Additions',
        'calories' => 'Calories',
        'unit' => 'Unit',
        'extra_images' => 'Extra Images',
        'category_id' => 'Category',
        'text' => 'Text',
        'user_id' => 'User ID',
        'position_id' => 'Position',
        'store_id' => 'Store',
        'accept_condition' => 'Accept Condition',
        'longitude' => 'Longitude',
        'latitude' => 'Latitude',
        'commercial_registeration_file' => 'Commercial Registeration File',
        'tax_number' => 'Tax Number',
        'license_number' => 'License Number',
        'telephone' => 'Telephone',
        'store_name' => 'Store Name',
        'owner_mobile' => 'Owner Mobile',
        'owner_name' => 'Owner Name',
        'street' => 'Street',
        'address' => 'Address',
        'area_id' => 'Area',
        'code' => 'Code',
        'country_id' => 'Country',
        'gender' => 'Gender',
        'date_of_birth' => 'Date of Birth',
        'last_name' => 'Last Name',
        'first_name' => 'First Name',
        'full_name' => 'Full Name',
        'device_type' => 'Device Type',
        'mobile' => 'Mobile',
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'type' => 'Type',
        'confirm_password' => 'Confirm Password',
        'description' => 'Description',
        'description_en' => 'English Description',
        'description_ar' => 'Arabic Description',
        'full_description' => 'Full Description',
        'image' => 'Image',
        'opening_time' => 'Opening Time',
        'closing_time' => 'Closing Time',
        'main_category' => 'Main Category',
        'job_id' => 'Job',
        'profile_image' => 'Profile Image',
        'sub_Category' => 'Sub Category',
        'activity_id' => 'Activity',
        'name_ar' => 'Arabic Name',
        'name_en' => 'English Name',
        'message'=>'Message',
        'phone'=>'Phone',


        'backend' => [
            'access' => [
                'permissions' => [
                    'associated_roles' => 'الأدوار المرفقة',
                    'dependencies'     => 'المتعلقات',
                    'display_name'     => 'إسم العرض',
                    'group'            => 'المجموعة',
                    'group_sort'       => 'ترتيب المجموعة',

                    'groups' => [
                        'name' => 'إسم المجموعة',
                    ],

                    'name'   => 'الإسم',
                    'system' => 'نظام؟',
                ],

                'roles' => [
                    'associated_permissions' => 'الصلاحيات المرفقة',
                    'name'                   => 'الإسم',
                    'sort'                   => 'الترتيب',
                ],

                'users' => [
                    'active'                  => 'مفعل',
                    'associated_roles'        => 'الأدوار المرفقة',
                    'confirmed'               => 'مؤكد',
                    'mobile'               => 'الموبايل',
                    'email'                   => 'عنوان البريد الإلكتروني',
                    'name'                    => 'الإسم',
                    'other_permissions'       => 'الصلاحيات الأخرى',
                    'password'                => 'كلمة المرور',
                    'password_confirmation'   => 'تأكيد كلمة المرور',
                    'send_confirmation_email' => 'إرسال رسالة التفعيل',
                ],
            ],
        ],

        'frontend' => [
            'email'                     => 'عنوان البريد الإلكتروني',
            'name'                      => 'الإسم',
            'password'                  => 'كلمة المرور',
            'password_confirmation'     => 'تأكيد كلمة المرور',
            'phone' => 'Phone',
            'mobile' => 'موبايل',
            'message' => 'Message',
            'old_password'              => 'كلمة المرور القديمة',
            'new_password'              => 'كلمة المرور الجديدة',
            'new_password_confirmation' => 'تأكيد كلمة المرور الجديدة',
        ],
    ],

];
