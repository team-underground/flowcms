<div class="mb-5">
	@if($label ?? null)
		<label class="form-label block mb-1 font-semibold text-gray-700">
			{{ $label }}
		</label>
	@endif
	
	<div class="relative w-full">
		<input
			x-data
    		x-ref="input"
			x-init="
				datepicker = new Pikaday({ 
					defaultDate: $refs.input.value,
					field: $refs.input,
					theme: 'pikaday-white',
					minDate: new Date(),
					firstDay: 1,
					{{-- format: 'D/M/YYYY',
					toString(date, format) {
						const day = date.getDate();
						const month = date.getMonth() + 1;
						const year = date.getFullYear();
						return `${day}/${month}/${year}`;
					}, --}}
					i18n: {
						previousMonth: 'Prev',
						nextMonth: 'Next',
						months: [
							'January',
							'February',
							'March',
							'April',
							'May',
							'June',
							'July',
							'August',
							'September',
							'October',
							'November',
							'December'
						],
						weekdays: [
							'Sunday',
							'Monday',
							'Tuesday',
							'Wednesday',
							'Thursday',
							'Friday',
							'Saturday'
						],
						weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa']
					},

					onSelect() {
						$dispatch('input', $refs.input.value)
					}
				})"
			{{ $attributes->merge([
				'class' => 'pl-12 pr-2 py-2 leading-normal block w-full text-gray-800 font-sans rounded-lg text-left appearance-none border bg-white focus:outline-none focus:shadow-outline shadow-sm w-full'
			]) }}
			type="text"
			readonly
		>
		
		<svg style="top: 8px; left: 12px" class="absolute text-gray-400 w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
	</div>
</div>