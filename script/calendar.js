 console.log("JavaScript file loaded successfully");
 document.addEventListener("DOMContentLoaded", () => {
            const monthYear = document.getElementById("monthYear");
            const calendarDates = document.getElementById("calendarDates");
            const currentDateEl = document.getElementById("currentDate");
            const todayBtn = document.getElementById("todayBtn");
            const prevMonthBtn = document.getElementById("prevMonth");
            const nextMonthBtn = document.getElementById("nextMonth");
            const addEventBtn = document.getElementById("addEventBtn");
            const eventModal = document.getElementById("eventModal");
            const closeModal = document.getElementById("closeModal");
            const eventForm = document.getElementById("eventForm");
            const eventList = document.getElementById("eventList");

            let today = new Date();
            let currentMonth = today.getMonth();
            let currentYear = today.getFullYear();

            // Store events in memory
            let events = [];

            // Display current date
            function updateCurrentDate() {
                const options = { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                };
                currentDateEl.textContent = today.toLocaleDateString('en-US', options);
            }

            function renderCalendar(month, year) {
                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                monthYear.textContent = new Date(year, month).toLocaleString("default", {
                    month: "long",
                    year: "numeric",
                });

                calendarDates.innerHTML = "";

                // Add empty divs for padding days before 1st
                for (let i = 0; i < firstDay; i++) {
                    const empty = document.createElement("div");
                    empty.classList.add("empty-day");
                    calendarDates.appendChild(empty);
                }

                // Fill days
                for (let day = 1; day <= daysInMonth; day++) {
                    const dateEl = document.createElement("div");
                    dateEl.className = "date";
                    dateEl.textContent = day;

                    const thisDate = new Date(year, month, day);
                    const isoDate = thisDate.toISOString().split("T")[0];

                    const isToday =
                        thisDate.getDate() === today.getDate() &&
                        thisDate.getMonth() === today.getMonth() &&
                        thisDate.getFullYear() === today.getFullYear();

                    if (isToday) {
                        dateEl.classList.add("today");
                    }

                    // Add event dots inside date
                    const dayEvents = events.filter((e) => e.date === isoDate);
                    dayEvents.forEach((e) => {
                        const dot = document.createElement("div");
                        dot.className = `event-dot ${e.category}`;
                        dateEl.appendChild(dot);
                    });

                    calendarDates.appendChild(dateEl);
                }
                renderEventList();
            }

            function renderEventList() {
                eventList.innerHTML = "";
                if (events.length === 0) {
                    const li = document.createElement("li");
                    li.textContent = "No upcoming events";
                    li.style.color = "#666";
                    li.style.fontStyle = "italic";
                    eventList.appendChild(li);
                    return;
                }

                // Sort events by date ascending
                const sortedEvents = events
                    .slice()
                    .sort((a, b) => new Date(a.date) - new Date(b.date));

                sortedEvents.forEach((e) => {
                    const li = document.createElement("li");
                    li.className = "event-item";

                    const dot = document.createElement("span");
                    dot.className = `dot ${e.category}`;
                    li.appendChild(dot);

                    const eventText = document.createElement("span");
                    eventText.textContent = `${e.title} — ${formatDate(e.date)}`;
                    li.appendChild(eventText);

                    eventList.appendChild(li);
                });
            }

            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', { 
                    month: 'short', 
                    day: 'numeric' 
                });
            }

            // Initialize
            updateCurrentDate();
            renderCalendar(currentMonth, currentYear);

            // Event listeners
            prevMonthBtn.onclick = () => {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                renderCalendar(currentMonth, currentYear);
            };

            nextMonthBtn.onclick = () => {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                renderCalendar(currentMonth, currentYear);
            };

            todayBtn.onclick = () => {
                today = new Date();
                currentMonth = today.getMonth();
                currentYear = today.getFullYear();
                updateCurrentDate();
                renderCalendar(currentMonth, currentYear);
            };

            addEventBtn.onclick = () => {
                eventModal.classList.add("show");
                // Set default date to today
                document.getElementById("eventDate").value = today.toISOString().split("T")[0];
            };

            closeModal.onclick = () => {
                eventModal.classList.remove("show");
            };

            // Close modal when clicking outside modal content
            eventModal.onclick = (e) => {
                if (e.target === eventModal) {
                    eventModal.classList.remove("show");
                }
            };

            // Close modal on ESC key press
            document.addEventListener("keydown", (e) => {
                if (e.key === "Escape") {
                    eventModal.classList.remove("show");
                }
            });

            eventForm.onsubmit = (e) => {
                e.preventDefault();
                const title = document.getElementById("eventTitle").value.trim();
                const date = document.getElementById("eventDate").value;
                const category = document.getElementById("eventCategory").value;

                if (!title || !date) return;

                events.push({ title, date, category });
                renderCalendar(currentMonth, currentYear);
                eventModal.classList.remove("show");
                eventForm.reset();
            };
        });