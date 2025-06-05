 <div class="calendar-tab">
        <div class="in-container">
            <div class="calendar-wrapper">
                <div class="calendar-header">
                    <h2 class="section-title">Calendar</h2>
                    <div id="currentDate"></div>
                </div>
                <div class="calendar-box">
                    <div class="calendar-controls">
                        <div id="prevMonth">‹</div>
                        <div id="monthYear"></div>
                        <div id="nextMonth">›</div>
                        <button id="todayBtn">Today</button>
                    </div>
                    <div class="calendar-days">
                        <div class="day-name">Sun</div>
                        <div class="day-name">Mon</div>
                        <div class="day-name">Tue</div>
                        <div class="day-name">Wed</div>
                        <div class="day-name">Thu</div>
                        <div class="day-name">Fri</div>
                        <div class="day-name">Sat</div>
                    </div>
                    <div class="calendar-dates" id="calendarDates"></div>
                </div>
            </div>
        </div>
        
        <div class="events-panel">
            <div class="events-header">
                <h3>Events</h3>
                <button id="addEventBtn">Add Event</button>
            </div>
            <ul class="event-list" id="eventList"></ul>
            <div class="event-categories">
                <h4>Categories</h4>
                <ul>
                    <li><span class="dot meeting"></span>Meeting</li>
                    <li><span class="dot review"></span>Review</li>
                    <li><span class="dot training"></span>Training</li>
                    <li><span class="dot holiday"></span>Holiday</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Event Modal -->
    <div class="modal" id="eventModal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h3>Add New Event</h3>
            <form id="eventForm">
                <label for="eventTitle">Event Title:</label>
                <input type="text" id="eventTitle" required>
                
                <label for="eventDate">Date:</label>
                <input type="date" id="eventDate" required>
                
                <label for="eventCategory">Category:</label>
                <select id="eventCategory" required>
                    <option value="meeting">Meeting</option>
                    <option value="review">Review</option>
                    <option value="training">Training</option>
                    <option value="holiday">Holiday</option>
                </select>
                
                <button type="submit">Add Event</button>
            </form>
        </div>
    </div>
    
<script src="calendar.js"></script>