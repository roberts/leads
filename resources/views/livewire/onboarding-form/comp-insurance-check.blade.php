<div>
    <h3 class="onboarding-form__heading">
        Do you currently have workers comp coverage in force?
    </h3>

    <form wire:submit.prevent="submit">
        <div class="onboarding-form__block-group">
            <div class="onboarding-form__radio">
                <input
                    type="radio"
                    wire:model="attributes.should_add_insurance_details"
                    value="1"
                    name="should_add_insurance_details"
                    id="yes"
                />

                <label class="onboarding-form__label" for="yes">
                    <i class="onboarding-form__radio-button"></i> Yes
                </label>
            </div>

            <div class="onboarding-form__radio">
                <input
                    type="radio"
                    wire:model="attributes.should_add_insurance_details"
                    value="0"
                    name="should_add_insurance_details"
                    id="no"
                />

                <label class="onboarding-form__label" for="no">
                    <i class="onboarding-form__radio-button"></i> No
                </label>
            </div>

            @error('attributes.should_add_insurance_details')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="onboarding-form__next-button"
        >
            Next
        </button>
    </form>
</div>
