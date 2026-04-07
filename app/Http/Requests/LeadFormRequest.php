<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeadFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $merge = [];

        if ($this->has('your_postnum')) {
            $merge['your_postnum'] = $this->normalizePostalCode($this->input('your_postnum'));
        }

        foreach (['your_mobile', 'your_tel', 'your_company_tel'] as $field) {
            if (! $this->has($field)) {
                continue;
            }
            $v = $this->input($field);
            if ($v === null || $v === '') {
                $merge[$field] = $field === 'your_tel' ? '' : $v;
                continue;
            }
            $merge[$field] = $this->normalizePhoneDigits($v);
        }

        $this->merge($merge);
    }

    /**
     * 全角数字・ハイフン表記を半角7桁 + 123-4567 形式に揃える。
     */
    protected function normalizePostalCode(?string $value): string
    {
        if ($value === null) {
            return '';
        }
        $value = mb_convert_kana(trim($value), 'n', 'UTF-8');
        $digits = preg_replace('/\D/u', '', $value);

        return strlen($digits) === 7 ? substr($digits, 0, 3).'-'.substr($digits, 3, 4) : $value;
    }

    /**
     * 全角数字や記号を除き、半角数字のみにする（ハイフンは保存時に不要）。
     */
    protected function normalizePhoneDigits(string $value): string
    {
        $value = mb_convert_kana(trim($value), 'n', 'UTF-8');

        return preg_replace('/\D/u', '', $value);
    }

    public function rules()
    {
        $birthYears = array_keys(config('lead_form.birth_year_label', []));

        return [
            'name_sei' => ['required', 'string', 'max:50'],
            'name_mei' => ['required', 'string', 'max:50'],
            'name_kana' => ['required', 'string', 'max:50'],
            'your_mail' => ['required', 'string', 'max:100', 'email'],
            'your_line' => ['nullable', 'string', 'max:50', 'regex:/^[a-zA-Z0-9]*$/'],
            'birth_year' => ['required', Rule::in($birthYears)],
            'birth_month' => ['required', 'integer', 'between:1,12'],
            'birth_date' => ['required', 'integer', 'between:1,31'],
            'your_postnum' => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'pref_id' => ['required', 'integer', 'between:1,47'],
            'addr1' => ['required', 'string', 'max:100'],
            'addr2' => ['required', 'string', 'max:100'],
            'addr3' => ['nullable', 'string', 'max:100'],
            'your_mobile' => ['required', 'string', function ($attribute, $value, $fail) {
                if (! $this->passesJapaneseTel($value)) {
                    $fail('携帯電話番号を正しく入力してください。');
                }
            }],
            'your_tel' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if ($value !== null && $value !== '' && ! $this->passesJapaneseTel($value)) {
                    $fail('固定電話番号を正しく入力してください。');
                }
            }],
            'job' => ['required', 'string', Rule::in(array_keys(config('custom.job')))],
            'your_company' => ['required', 'string', 'max:100'],
            'your_company_tel' => ['required', 'string', function ($attribute, $value, $fail) {
                if (! $this->passesJapaneseTel($value)) {
                    $fail('勤務先電話番号を正しく入力してください。');
                }
            }],
            'income' => ['required', 'string', Rule::in(['10万円以下', '11～20万円', '21～30万円', '31～40万円', '41万円以上'])],
            'desired_borrowing' => ['required', 'string', Rule::in(array_keys(config('custom.expectation')))],
            'your_borrowing_num' => ['required', 'string', 'max:50'],
            'your_borrowing_num2' => ['required', 'string', 'max:50'],
            'time' => ['required', 'string', Rule::in(array_keys(config('custom.connect')))],
            'your_message' => ['nullable', 'string', 'max:10000'],
            '個人情報保護方針' => ['required', Rule::in(['同意する'])],
        ];
    }

    public function attributes()
    {
        return [
            'name_sei' => '姓',
            'name_mei' => '名',
            'name_kana' => 'お名前（ふりがな）',
            'your_mail' => 'メールアドレス',
            'your_line' => 'LINE ID',
            'birth_year' => '生年月日（年）',
            'birth_month' => '生年月日（月）',
            'birth_date' => '生年月日（日）',
            'your_postnum' => '郵便番号',
            'pref_id' => '都道府県',
            'addr1' => '市区町村',
            'addr2' => '番地等',
            'addr3' => '建物名・部屋番号',
            'your_mobile' => '携帯電話番号',
            'your_tel' => '固定電話番号',
            'job' => '職業',
            'your_company' => '勤務先名',
            'your_company_tel' => '勤務先電話番号',
            'income' => '月収',
            'desired_borrowing' => '借入希望金額',
            'your_borrowing_num' => '他者借入件数',
            'your_borrowing_num2' => '他者借入金額',
            'time' => '希望連絡時間帯',
            'your_message' => 'その他ご要望など',
            '個人情報保護方針' => '同意',
        ];
    }

    public function messages()
    {
        return [
            '個人情報保護方針.required' => '同意するにチェックしてください。',
            '個人情報保護方針.in' => '同意するにチェックしてください。',
            'your_postnum.regex' => '郵便番号は7桁の数字で入力してください（例：123-4567）。',
        ];
    }

    /**
     * 携帯（070/080/090/050）は11桁。それ以外の国内番号は市外局番により10桁または11桁。
     */
    protected function passesJapaneseTel($input)
    {
        if ($input === null || $input === '') {
            return false;
        }
        $tel = preg_replace('/\D/u', '', $input);
        if ($tel === '') {
            return false;
        }
        if (! preg_match('/^[0-9]+$/', $tel)) {
            return false;
        }
        $len = strlen($tel);
        if ($len < 10 || $len > 11) {
            return false;
        }
        if ($tel[0] !== '0') {
            return false;
        }
        if (preg_match('/^0[5789]0/', $tel)) {
            return $len === 11;
        }

        return $len === 10 || $len === 11;
    }
}
