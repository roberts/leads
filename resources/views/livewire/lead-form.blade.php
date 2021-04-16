<div class="lead-form">
    <div class="lead-form__lead-heading">{{ $leadType->name }}</div>

    <h3 class="lead-form__step-heading">
        {{ $this->activeStep->title }}
    </h3>

    <form wire:submit.prevent="submit">
        @foreach($this->activeStep->fields as $field)
            @include('leads::inputs.' . $field->type)
        @endforeach

        @if($this->hasMoreSteps)
            <button
                type="submit"
                class="lead-form__next-button"
            >
                Next
            </button>
        @endif
    </form>
</div>
