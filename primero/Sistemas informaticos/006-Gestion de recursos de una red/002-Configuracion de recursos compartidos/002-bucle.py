import psutil

def get_system_load():
    cpu_load = psutil.cpu_percent(interval=1)

    memory = psutil.virtual_memory()
    total_ram = memory.total / (1024 ** 3)  # Convert bytes to GB
    used_ram = memory.used / (1024 ** 3)   # Convert bytes to GB
    ram_usage_percentage = memory.percent

    return [cpu_load, ram_usage_percentage]

if __name__ == "__main__":
    print(get_system_load())