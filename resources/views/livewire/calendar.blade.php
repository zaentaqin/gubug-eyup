<div>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <div wire:ignore id='calendar'></div>

    <style>
        #calendar {
            max-width: 900px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var disabledDates = @json($disabledDates); // Get initial disabled dates

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($orders),
                navLinks: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listWeek'
                },
                footerToolbar: {
                    left: '',
                    center: '',
                    right: 'disableDateButton'
                },

                customButtons: {
                    disableDateButton: {
                        text: 'Disable Date',
                        click: function() {
                            var dateStr = prompt('Enter a date in YYYY-MM-DD format');
                            var date = new Date(dateStr + 'T00:00:00');

                            if (!isNaN(date.valueOf())) { // valid?
                                if (disabledDates.includes(dateStr)) {
                                    alert('This date is already disabled.');
                                } else {
                                    // Emit Livewire event to disable date
                                    @this.disableDate(dateStr); // Ensure this is correct
                                    disabledDates.push(dateStr); // Update locally to reflect the change
                                    calendar.refetchEvents(); // Refresh calendar to reflect changes
                                    alert('Date has been disabled.');
                                }
                            } else {
                                alert('Invalid date.');
                            }
                        }
                    }
                },

                // Use dayCellDidMount to render disabled dates
                dayCellDidMount: function(info) {
                    let localDateStr = info.date.toLocaleDateString(
                    'en-CA'); // en-CA ensures ISO format (YYYY-MM-DD)

                    if (disabledDates.includes(localDateStr)) { // Compare with disabledDates array
                        info.el.classList.add(
                        'fc-disabled-date'); // Add a class to style disabled dates
                        info.el.style.backgroundColor =
                        '#f8d7da'; // Optionally, add some style to distinguish them
                        info.el.style.pointerEvents = 'none'; // Disable click on these dates
                    }
                }
            });

            calendar.render();

            // Listen for updates from Livewire to re-render the calendar with new disabled dates
            Livewire.on('calendarUpdate', function(newDisabledDates) {
                disabledDates = newDisabledDates; // Update disabled dates
                calendar.refetchEvents(); // Refresh events and rerender
            });
        });
    </script>
</div>
