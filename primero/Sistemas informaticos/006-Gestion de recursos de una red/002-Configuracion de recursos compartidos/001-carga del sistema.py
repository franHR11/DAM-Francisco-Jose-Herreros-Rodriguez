import psutil

def get_system_load():
    # Get CPU load as a percentage
    cpu_load = psutil.cpu_percent(interval=1)

    # Get RAM usage
    memory = psutil.virtual_memory()
    total_ram = memory.total / (1024 ** 3)  # Convert bytes to GB
    used_ram = memory.used / (1024 ** 3)   # Convert bytes to GB
    ram_usage_percentage = memory.percent

    return {
        "CPU Load (%)": cpu_load,
        "Total RAM (GB)": round(total_ram, 2),
        "Used RAM (GB)": round(used_ram, 2),
        "RAM Usage (%)": ram_usage_percentage,
    }

if __name__ == "__main__":
    system_load = get_system_load()
    for key, value in system_load.items():
        print(f"{key}: {value}")