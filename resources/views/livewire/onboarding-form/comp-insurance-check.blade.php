<div>
    <h3 class="onboarding-form__heading">
        Do you currently have workers comp coverage in force?
    </h3>

    <form wire:submit.prevent="submit">
        <div class="onboarding-form__block-group">
            <div class="onboarding-form__radio">
                <input
                    type="radio"
                    wire:model="attributes.has_comp_insurance"
                    value="1"
                    name="has_comp_insurance"
                    id="yes"
                />

                <label class="onboarding-form__label" for="yes">
                    <i class="onboarding-form__radio-button"></i> Yes
                </label>
            </div>

            <div class="onboarding-form__radio">
                <input
                    type="radio"
                    wire:model="attributes.has_comp_insurance"
                    value="0"
                    name="has_comp_insurance"
                    id="no"
                />

                <label class="onboarding-form__label" for="no">
                    <i class="onboarding-form__radio-button"></i> No
                </label>
            </div>

            @error('attributes.has_comp_insurance')
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
