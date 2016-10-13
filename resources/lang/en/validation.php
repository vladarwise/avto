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

    'accepted' => 'Вы должны принять ":attribute".',
    'active_url' => 'Поле ":attribute" содержит недействительный URL.',
    'after' => 'В поле ":attribute" должна быть дата после :date.',
    'alpha' => 'Поле ":attribute" может содержать только буквы.',
    'alpha_dash' => 'Поле ":attribute" может содержать только буквы, цифры и дефис.',
    'alpha_num' => 'Поле ":attribute" может содержать только буквы и цифры.',
    'array' => 'Поле ":attribute" должно быть массивом.',
    'before' => 'В поле ":attribute" должна быть дата до :date.',
    'between' => [
        'numeric' => 'Поле ":attribute" должно быть между :min и :max.',
        'file' => 'Размер файла в поле ":attribute" должен быть между :min и :max Килобайт(а).',
        'string' => 'Количество символов в поле ":attribute" должно быть между :min и :max.',
        'array' => 'Количество элементов в поле ":attribute" должно быть между :min и :max.',
    ],
    'boolean' => 'Поле ":attribute" должно иметь значение логического типа.',
    // калька 'истина' или 'ложь' звучала бы слишком неестественно
    'confirmed' => 'Поле ":attribute" не совпадает с подтверждением.',
    'date' => 'Поле ":attribute" не является датой.',
    'date_format' => 'Поле ":attribute" не соответствует формату :format.',
    'different' => 'Поля ":attribute" и :other должны различаться.',
    'digits' => 'Длина цифрового поля ":attribute" должна быть :digits.',
    'digits_between' => 'Длина цифрового поля ":attribute" должна быть между :min и :max.',
    'email' => 'Поле ":attribute" должно быть действительным электронным адресом.',
    'filled' => 'Поле ":attribute" обязательно для заполнения.',
    'exists' => 'Выбранное значение для ":attribute" некорректно.',
    'image' => 'Поле ":attribute" должно быть изображением.',
    'in' => 'Выбранное значение для ":attribute" ошибочно.',
    'integer' => 'Поле ":attribute" должно быть целым числом.',
    'ip' => 'Поле ":attribute" должно быть действительным IP-адресом.',
    'json' => 'Поле ":attribute" должно быть JSON строкой.',
    'max' => [
        'numeric' => 'Поле ":attribute" не может быть более :max.',
        'file' => 'Размер файла в поле ":attribute" не может быть более :max Килобайт(а).',
        'string' => 'Количество символов в поле ":attribute" не может превышать :max.',
        'array' => 'Количество элементов в поле ":attribute" не может превышать :max.',
    ],
    'mimes' => 'Поле ":attribute" должно быть файлом одного из следующих типов: :values.',
    'min' => [
        'numeric' => 'Поле ":attribute" должно быть не менее :min.',
        'file' => 'Размер файла в поле ":attribute" должен быть не менее :min Килобайт(а).',
        'string' => 'Количество символов в поле ":attribute" должно быть не менее :min.',
        'array' => 'Количество элементов в поле ":attribute" должно быть не менее :min.',
    ],
    'not_in' => 'Выбранное значение для ":attribute" ошибочно.',
    'numeric' => 'Поле ":attribute" должно быть числом.',
    'regex' => 'Поле ":attribute" имеет ошибочный формат.',
    'required' => 'Поле ":attribute" обязательно для заполнения.',
    'required_if' => 'Поле ":attribute" обязательно для заполнения, когда :other равно :value.',
    'required_unless' => 'Поле ":attribute" обязательно для заполнения, когда :other не равно :values.',
    'required_with' => 'Поле ":attribute" обязательно для заполнения, когда :values указано.',
    'required_with_all' => 'Поле ":attribute" обязательно для заполнения, когда :values указано.',
    'required_without' => 'Поле ":attribute" обязательно для заполнения, когда :values не указано.',
    'required_without_all' => 'Поле ":attribute" обязательно для заполнения, когда ни одно из :values не указано.',
    'same' => 'Значение ":attribute" должно совпадать с :other.',
    'size' => [
        'numeric' => 'Поле ":attribute" должно быть равным :size.',
        'file' => 'Размер файла в поле ":attribute" должен быть равен :size Килобайт(а).',
        'string' => 'Количество символов в поле ":attribute" должно быть равным :size.',
        'array' => 'Количество элементов в поле ":attribute" должно быть равным :size.',
    ],
    'string' => 'Поле ":attribute" должно быть строкой.',
    'timezone' => 'Поле ":attribute" должно быть действительным часовым поясом.',
    'unique' => 'Такое значение поля ":attribute" уже существует.',
    'url' => 'Поле ":attribute" имеет ошибочный формат.',
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
        'role' => [
            'required' => 'Укажите как вы хотите зарегестрироваться, как профессионал или как пользователь',
        ],
        'name' => [
            'required' => 'Введите имя пользователя',
            'max' => 'Имя пользователя не более :max символов',
        ],
        'surname' => [
            'required' => 'Введите фамилию пользователя',
            'max' => 'Фамилия пользователя не более :max символов',
        ],
        'email' => [
            'required' => 'Введите электронная почту',
            'max' => 'Электронная почта не более :max символов',
            'unique' => 'Пользователь с такой электронной почтой уже зарегестрирован',
            'exists' => 'Пользователь с такой электронной почтой не зарегестрирован',
        ],
        'password' => [
            'required' => 'Введите пароль',
            'confirmed' => 'Пароли не совпадают',
            'min' => 'Пароль не менее :min символов',
            'max' => 'Пароль не более :max символов',
        ],
        'password_confirmation' => [
            'confirmed' => 'Пароли не совпадают',
            'required' => 'Введите подтверждение пароля',
        ],
        'location' => [
            'required' => 'Введите место жительства',
            'max' => 'Место жительства не более :max символов',
        ],
        'info' => [
            'max' => 'Информация не более :max символов',
        ],
        'confirmed' => [
            'accepted' => 'Для регистрации ознакомтесь и примите условия использования портала',
        ],
        'id' => [
            'exists' => 'Не найдена запись в базе данных',
        ],
        'protectionCode' => [
            'required' => 'Введите защитный код',
            'in' => 'Защитный код не совпадает',
        ],
    ],
];
