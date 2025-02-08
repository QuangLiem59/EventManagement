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

    'accepted' => 'Tham số :attribute tính phải được chấp nhận.',
    'accepted_if' => 'Tham số :attribute phải được chấp nhận khi :other là :value.',
    'active_url' => 'Tham số :attribute không phải là URL hợp lệ.',
    'after' => 'Tham số :attribute phải là một ngày sau ngày :date.',
    'after_or_equal' => 'Tham số :attribute phải là một ngày sau hoặc bằng ngày :date.',
    'alpha' => 'Tham số :attribute chỉ được chứa các ký tự chữ cái.',
    'alpha_dash' => 'Tham số :attribute chỉ được chứa các chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => 'Tham số :attribute chỉ được chứa các chữ cái và số.',
    'array' => 'Tham số :attribute phải là một mảng.',
    'before' => 'Tham số :attribute phải là một ngày trước ngày :date.',
    'before_or_equal' => 'Tham số :attribute phải là một ngày trước hoặc bằng ngày :date.',
    'between' => [
        'array' => 'Tham số :attribute phải có giữa các mục :min và :max.',
        'file' => 'Tham số :attribute phải nằm giữa :min và :max kb.',
        'numeric' => 'Tham số :attribute phải nằm giữa :min và :max.',
        'string' => 'Tham số :attribute phải nằm giữa :min và :max ký tự.',
    ],
    'boolean' => 'Tham số :attribute phải là true hoặc false.',
    'confirmed' => 'Tham số :attribute không phù hợp.',
    'current_password' => 'Mật khẩu không đúng.',
    'date' => 'Tham số :attribute không phải là một ngày.',
    'date_equals' => 'Tham số :attribute không phải là ngày :date.',
    'date_format' => 'Tham số :attribute không đúng định dạng :format.',
    'declined' => 'Tham số :attribute phải bị từ chối.',
    'declined_if' => 'Tham số :attribute phải bị từ chối khi :other là :value.',
    'different' => 'Tham số :attribute và :other phải khác nhau.',
    'digits' => 'Tham số :attribute phải là :digits chữ số.',
    'digits_between' => 'Tham số :attribute phải nằm giữa :min và :max chữ số.',
    'dimensions' => 'Tham số :attribute kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Tham số :attribute có giá trị trùng lặp.',
    'email' => 'Tham số :attribute phải là một email hợp lệ.',
    'ends_with' => 'Tham số :attribute phải kết thúc bằng một trong những giá trị sau đây: :values.',
    'enum' => 'Lựa chọn :attribute không hợp lệ.',
    'exists' => 'Lựa chọn :attribute không tồn tại.',
    'file' => 'Tham số :attribute phải là một tập tin.',
    'filled' => 'Tham số :attribute phải có một giá trị.',
    'gt' => [
        'array' => 'Tham số :attribute phải lớn hơn :value phần tử.',
        'file' => 'Tham số :attribute phải lớn hơn :value kb.',
        'numeric' => 'Tham số :attribute phải lớn hơn :value.',
        'string' => 'Tham số :attribute phải lớn hơn :value ký tự.',
    ],
    'gte' => [
        'array' => 'Tham số :attribute phải có :value hoặc nhiều hơn.',
        'file' => 'Tham số :attribute phải lớn hơn hoặc bằng :value kb.',
        'numeric' => 'Tham số :attribute phải lớn hơn hoặc bằng :value.',
        'string' => 'Tham số :attribute phải lớn hơn hoặc bằng :value ký tự.',
    ],
    'image' => 'Tham số :attribute phải là một ảnh.',
    'in' => 'Lựa chọn :attribute không hợp lệ.',
    'in_array' => 'Tham số :attribute không tồn tại trong :other.',
    'integer' => 'Tham số :attribute phải là một số nguyên.',
    'ip' => 'Tham số :attribute phải là một địa chỉ IP.',
    'ipv4' => 'Tham số :attribute phải là một địa chỉ IPv4.',
    'ipv6' => 'Tham số :attribute phải là một địa chỉ IPv6.',
    'json' => 'Tham số :attribute phải là một chuỗi JSON.',
    'lt' => [
        'array' => 'Tham số :attribute phải nhỏ hơn :value phần tử.',
        'file' => 'Tham số :attribute phải nhỏ hơn :value kb.',
        'numeric' => 'Tham số :attribute phải nhỏ hơn :value.',
        'string' => 'Tham số :attribute phải nhỏ hơn :value ký tự.',
    ],
    'lte' => [
        'array' => 'Tham số :attribute không được có nhiều hơn :value phần tử.',
        'file' => 'Tham số :attribute phải hơn hơn hoặc bằng :value kb.',
        'numeric' => 'Tham số :attribute phải hơn hơn hoặc bằng :value.',
        'string' => 'Tham số :attribute phải hơn hơn hoặc bằng :value ký tự.',
    ],
    'mac_address' => 'Tham số :attribute phải là một địa chỉ MAC hợp lệ.',
    'max' => [
        'array' => 'Tham số :attribute không được có nhiều hơn :max phần tử.',
        'file' => 'Tham số :attribute phải có dung lượng tối đa là :max kb.',
        'numeric' => 'Tham số :attribute không được lớn hơn :max.',
        'string' => 'Tham số :attribute không được lớn hơn :max ký tự.',
    ],
    'mimes' => 'Tham số :attribute phải là một tập tin có định dạng: :values.',
    'mimetypes' => 'Tham số :attribute phải là một tập tin có định dạng: :values.',
    'min' => [
        'array' => 'Tham số :attribute phải có ít nhất :min phần tử.',
        'file' => 'Tham số :attribute phải có dung lượng tối thiểu là :min kb.',
        'numeric' => 'Tham số :attribute không được nhỏ hơn :min.',
        'string' => 'Tham số :attribute không được nhỏ hơn :min ký tự.',
    ],
    'missing_if' => 'Tham số :attribute không được xuất hiện',
    'multiple_of' => 'Tham số :attribute phải là bội số của :value.',
    'not_in' => 'Lựa chọn :attribute không được phép.',
    'not_regex' => 'Tham số :attribute định dạng không hợp lệ.',
    'numeric' => 'Tham số :attribute phải là một con số.',
    'password' => [
        'letters' => 'Tham số :attribute phải chứa ít nhất một chữ cái.',
        'mixed' => 'Tham số :attribute phải chứa ít nhất một chữ hoa và một chữ thường.',
        'numbers' => 'Tham số :attribute phải chứa ít nhất một con số.',
        'symbols' => 'Tham số :attribute phải chứa ít nhất một ký tự đặc biệt.',
        'uncompromised' => 'Tham số :attribute đã cho đã xuất hiện trong một vụ rò rỉ dữ liệu. Vui lòng chọn một giá trị khác.',
    ],
    'present' => 'Tham số :attribute phải được xuất hiện.',
    'prohibited' => 'Tham số :attribute bị cấm.',
    'prohibited_if' => 'Tham số :attribute bị cấm khi :other là :value.',
    'prohibited_unless' => 'Tham số :attribute bị cấm trừ khi :other nằm trong :values.',
    'prohibits' => 'Tham số :attribute bị cấm khi :other không có xuất hiện.',
    'regex' => 'Tham số :attribute định dạng không hợp lệ.',
    'required' => 'Tham số :attribute là bắt buộc.',
    'required_array_keys' => 'Tham số :attribute phải chứa tất cả giá trị: :values.',
    'required_if' => 'Tham số :attribute bắt buộc khi :other là :value.',
    'required_unless' => 'Tham số :attribute bắt buộc trừ khi :other có trong :values.',
    'required_with' => 'Tham số :attribute bắt buộc khi :values xuất hiện.',
    'required_with_all' => 'Tham số :attribute bắt buộc khi tất cả các giá trị :values xuất hiện.',
    'required_without' => 'Tham số :attribute bắt buộc khi :values không xuất hiện.',
    'required_without_all' => 'Tham số :attribute bắt buộc khi tất cả các giá trị :values không xuất hiện.',
    'same' => 'Tham số :attribute và :other phải giống nhau.',
    'size' => [
        'array' => 'Tham số :attribute phải chứa :size phần tử.',
        'file' => 'Tham số :attribute phải có dung lượng là :size kb.',
        'numeric' => 'Tham số :attribute phải là :size.',
        'string' => 'Tham số :attribute phải là :size ký tự.',
    ],
    'starts_with' => 'Tham số :attribute phải bắt đầu bằng một trong những điều sau: :values.',
    'string' => 'Tham số :attribute phải là một chuỗi.',
    'timezone' => 'Tham số :attribute phải là một timezone hợp lệ.',
    'unique' => 'Tham số :attribute đã tồn tại.',
    'uploaded' => 'Tham số :attribute không thể upload.',
    'url' => 'Tham số :attribute phải là một URL hợp lệ.',
    'uuid' => 'Tham số :attribute phải là một UUID hợp lệ.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
    'invalid' => 'Tham số :attribute không hợp lệ',
];
