<div>
    <h3 class="onboarding-form__heading">
        Payroll Classifications
    </h3>

    <form wire:submit.prevent="submit">
        <div class="onboarding-form__block-group">
            <input
                type="text"
                wire:model="attributes.class_code"
                class="onboarding-form__text-input @if(!empty($attributes['class_code'])) onboarding-form__text-input--filled @endif"
                autofocus
            />

            @error('attributes.class_code')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Class code</label>
        </div>

        <div class="onboarding-form__block-group">
            <input
                type="number"
                wire:model="attributes.number_of_employees"
                class="onboarding-form__text-input @if(!empty($attributes['number_of_employees'])) onboarding-form__text-input--filled @endif"
            />

            @error('attributes.number_of_employees')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Number of employees</label>
        </div>

        <div class="onboarding-form__block-group">
            <input
                type="number"
                wire:model="attributes.annual_payroll"
                class="onboarding-form__text-input @if(!empty($attributes['annual_payroll'])) onboarding-form__text-input--filled @endif"
            />

            @error('attributes.annual_payroll')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Annual payroll</label>
        </div>

        <button
            type="submit"
            class="onboarding-form__next-button"
        >
            Next
        </button>
    </form>
</div>
