<div class="lead-form__block-group">
    <textarea
        wire:model="attributes.{{ $field->name }}"
        class="lead-form__text-input @if(!empty($attributes[$field->name])) lead-form__text-input--filled @endif"
        id="{{ $field->name }}"
    ></textarea>

    <label
        for="{{ $field->name }}"
        class="lead-form__label"
    >
        {{ $field->label }}
    </label>

    @error('attributes.' . $field->name) <p class="lead-form__error">{{ $message }}</p> @enderror
</div>
