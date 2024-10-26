from datetime import datetime, timedelta

def generate_specific_weekday_dates(start_date, end_date, target_weekday):
    # Convert strings to datetime objects
    start = datetime.strptime(start_date, '%Y-%m-%d')
    end = datetime.strptime(end_date, '%Y-%m-%d')
    
    # List to hold dates
    dates_list = []
    
    # Find the first target weekday on or after the start date
    current_date = start
    while current_date.weekday() != target_weekday - 1:  # weekday() returns Monday as 0
        current_date += timedelta(days=1)
    
    # Iterate through the range and collect matching weekdays
    while current_date <= end:
        dates_list.append(current_date.strftime('%Y-%m-%d'))
        current_date += timedelta(days=7)  # Move to the next week
    
    return dates_list