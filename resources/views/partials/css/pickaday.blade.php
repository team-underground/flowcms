@push('styles')
<style>
.pikaday-white {
	--backgroundColor: #ffffff;
	--textColor: #718096;
	--currentDateTextColor: #3182ce;
	--selectedDateBackgroundColor: #3182ce;
	--selectedDateTextColor: #ffffff;

	--labelTextColor: #4a5568; /* eg. May 2020 */
	--weekDaysTextColor: #a0aec0; /* eg. Mo Tu We ....*/

	background-color: var(--backgroundColor);
	border-radius: 10px;
	padding: 0.7rem;
	z-index: 2000;
    margin: 6px 0 0 0;
	box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .30), 0 1px 3px 1px rgba(60, 64, 67, .15);
	font-family: inherit;
}

.pikaday-white.is-hidden {
    display: none;
}

.pikaday-white .pika-title {
    padding: 0.2rem 0;
    width: 100%;
	text-align: center;
	display: flex;
	justify-content: flex-start;
}

/* Next/Previous */
.pikaday-white .pika-prev,
.pikaday-white .pika-next {
    position: absolute;
    outline: none;
    padding: 0;
    width: 24px;
	height: 24px;
	top: 15px;
	display: inline-block;
    margin-top: 0;
    cursor: pointer;
	/* hide text using text-indent trick, using width value (it's enough) */
    text-indent: -9999px;
    white-space: nowrap;
    overflow: hidden;
    background-color: transparent;
    background-position: center center;
    background-repeat: no-repeat;
	opacity: .7;
}
.pikaday-white .pika-prev:hover,
.pikaday-white .pika-next:hover {
	opacity: 1;
}
.pikaday-white .pika-prev {
	right: 30px;
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23a0aec0'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 19l-7-7 7-7'%3E%3C/path%3E%3C/svg%3E");
}
.pikaday-white .pika-next {
	right: 10px;
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23a0aec0'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 5l7 7-7 7'%3E%3C/path%3E%3C/svg%3E");
}
.pika-prev.is-disabled,
.pika-next.is-disabled {
    cursor: default;
    opacity: .2;
}

.pikaday-white .pika-label {
	font-size: 1.2rem;
	font-weight: 700;
	padding-right: 4px;
	padding-left: 4px;
	color: var(--labelTextColor);
}

/* Show Month & Year select */
.pikaday-white .pika-select-month,
.pikaday-white .pika-select-year {
	display: none;
}

.pikaday-white table {
    width: 100%;
    border-collapse: collapse;
}
.pikaday-white table th {
    width: 2em;
    height: 2em;
    font-weight: normal;
    color: var(--weekDaysTextColor);
    text-align: center;
}
.pikaday-white table th abbr {
    text-decoration: none;
}
.pikaday-white table td {
	padding: 1px;
}
.pikaday-white table td button {
    width: 2em;
    height: 2em;
    text-align: center;
    border-radius: 50%;
}
.pikaday-white table td:not(.is-disabled) button:hover {
    background-color: var(--selectedDateBackgroundColor);
}
.pikaday-white table td.is-disabled button {
	cursor: disabled;
	opacity: 0.5;
}
.pikaday-white table td.is-disabled button:hover {
    background-color: transparent;
	color: inherit;
}
.pikaday-white table td.is-today button {
	color: var(--currentDateTextColor);
}
.pikaday-white table td.is-selected button {
	background-color: var(--selectedDateBackgroundColor);
}

.pikaday-white table td button {
	color: var(--textColor);
}
.pikaday-white table td button:hover,
.pikaday-white table td.is-selected button,
.pikaday-white table td.is-selected button:hover {
    color: var(--selectedDateTextColor);
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js" data-turbolinks-track="reload"></script>
@endpush