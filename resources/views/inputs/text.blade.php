<div class="onboarding-form__block-group">
    <input
        type="text"
        wire:model="attributes.{{ $field->name }}"
        class="onboarding-form__text-input @if(!empty($attributes[$field->name])) onboarding-form__text-input--filled @endif"
        id="{{ $field->name }}"
    />

    @error('attributes.' . $field->name) <p class="onboarding-form__error">{{ $message }}</p> @enderror

    <label
        for="{{ $field->name }}"
        class="onboarding-form__label"
    >
        {{ $field->label }}
    </label>
</div>
