<div class="onboarding-form">
    <h3 class="onboarding-form__heading">
        {{ $leadType->name }} - {{ $this->activeStep->title }}
    </h3>

    <form wire:submit.prevent="submit">
        @if ($this->hasMoreSteps)
            <button
                type="submit"
                class="onboarding-form__next-button"
            >
                Next
            </button>
        @endif
    </form>
</div>
