try:
    from PIL import Image
    print("Pillow instalado correctamente")
except ImportError:
    print("Error: Pillow no instalado")
    print("Ejecuta: pip install Pillow")
    exit(1)

import os

def optimizar_imagen(input_path, output_path, max_width=800, quality=85):
    """
    Optimiza una imagen reduciendo su tamaño y calidad manteniendo buena apariencia
    """
    with Image.open(input_path) as img:
        # Calcular nuevo tamaño manteniendo proporción
        ratio = max_width / float(img.size[0])
        height = int(float(img.size[1]) * ratio)
        
        if ratio < 1:  # Solo redimensionar si la imagen es más grande que max_width
            img = img.resize((max_width, height), Image.Resampling.LANCZOS)
        
        # Guardar con optimización
        img.save(output_path, 
                quality=quality, 
                optimize=True)

def get_file_size(filepath):
    """Retorna el tamaño del archivo en MB"""
    return os.path.getsize(filepath) / (1024 * 1024)

def main():
    # Definir rutas absolutas - solo necesitamos la carpeta de entrada
    script_dir = os.path.dirname(os.path.abspath(__file__))
    project_root = os.path.dirname(os.path.dirname(os.path.dirname(script_dir)))
    input_folder = os.path.join(project_root, "127-python tratamiento de imagenes", "static")
    
    print(f"Carpeta de imágenes: {input_folder}")
    
    # Verificar que la carpeta existe
    if not os.path.exists(input_folder):
        print(f"Error: La carpeta no existe: {input_folder}")
        print("¿Desea crear la carpeta? (s/n)")
        if input().lower() == 's':
            try:
                os.makedirs(input_folder)
                print(f"Carpeta creada en: {input_folder}")
                print("Por favor, coloque las imágenes en esta carpeta y ejecute el script nuevamente.")
            except Exception as e:
                print(f"Error al crear la carpeta: {str(e)}")
        return

    # Obtener lista de imágenes
    imagenes = [f for f in os.listdir(input_folder) 
                if f.lower().endswith(('.png', '.jpg', '.jpeg', '.gif'))]
    
    if not imagenes:
        print("No se encontraron imágenes para procesar")
        return

    print(f"Se encontraron {len(imagenes)} imágenes")
    print("ADVERTENCIA: Las imágenes originales serán sobreescritas")
    print("¿Desea continuar? (s/n)")
    if input().lower() != 's':
        print("Operación cancelada")
        return

    print(f"Procesando {len(imagenes)} imágenes...")
    print("-" * 50)
    
    total_original = 0
    total_optimizado = 0
    procesadas = 0
    
    for filename in imagenes:
        input_path = os.path.join(input_folder, filename)
        # Usar la misma ruta para entrada y salida
        output_path = input_path
        
        try:
            # Obtener tamaño original
            original_size = get_file_size(input_path)
            total_original += original_size
            
            # Optimizar imagen
            optimizar_imagen(input_path, output_path)
            
            # Obtener tamaño optimizado
            optimized_size = get_file_size(output_path)
            total_optimizado += optimized_size
            procesadas += 1
            
            # Mostrar resultados individuales
            reduccion = ((original_size - optimized_size) / original_size) * 100
            print(f"Archivo: {filename}")
            print(f"Original: {original_size:.2f}MB")
            print(f"Optimizado: {optimized_size:.2f}MB")
            print(f"Reducción: {reduccion:.1f}%")
            print("-" * 50)
            
        except Exception as e:
            print(f"Error procesando {filename}: {str(e)}")
            continue
    
    # Mostrar resumen final solo si se procesaron imágenes
    if procesadas > 0:
        print("\nRESUMEN FINAL")
        print(f"Imágenes procesadas: {procesadas}")
        print(f"Total original: {total_original:.2f}MB")
        print(f"Total optimizado: {total_optimizado:.2f}MB")
        reduccion_total = ((total_original - total_optimizado) / total_original) * 100
        print(f"Reducción total: {reduccion_total:.1f}%")
    else:
        print("\nNo se pudo procesar ninguna imagen")

if __name__ == "__main__":
    main()