import pandas as pd
import json
import os
from datetime import datetime

def main():
    try:
        # Obtener la ruta absoluta del script
        script_dir = os.path.dirname(os.path.abspath(__file__))
        
        # Construir la ruta al CSV (subir dos niveles y entrar en front)
        csv_path = os.path.abspath(os.path.join(script_dir, '..', '..', 'front', 'server_data.csv'))
        json_path = os.path.join(script_dir, 'dashboard_data.json')

        print(f"Ruta del script: {script_dir}")
        print(f"Intentando leer archivo desde: {csv_path}")
        
        # Verificar si el archivo existe
        if not os.path.exists(csv_path):
            print(f"Error: El archivo CSV no existe en la ruta especificada.")
            print("Verificando directorio front...")
            front_dir = os.path.join(script_dir, '..', 'front')
            if os.path.exists(front_dir):
                print(f"El directorio front existe en: {front_dir}")
                print("Contenido del directorio front:")
                for file in os.listdir(front_dir):
                    print(f"- {file}")
            else:
                print(f"El directorio front no existe en: {front_dir}")
            return

        # Leer el CSV
        server_data = pd.read_csv(csv_path, sep='|', on_bad_lines='skip', encoding='utf-8')
        print(f"Datos cargados: {len(server_data)} registros")
        print(f"Columnas disponibles: {', '.join(server_data.columns)}")

        # Preprocesar datos
        server_data['REQUEST_TIME'] = pd.to_datetime(server_data['REQUEST_TIME'], unit='s')
        server_data['DATE'] = server_data['REQUEST_TIME'].dt.date
        server_data['HOUR'] = server_data['REQUEST_TIME'].dt.hour
        server_data['WEEKDAY'] = server_data['REQUEST_TIME'].dt.day_name()

        # Estadísticas generales
        stats = {
            'general': {
                'total_visits': len(server_data),
                'unique_visitors': server_data['VISITOR_ID'].nunique() if 'VISITOR_ID' in server_data.columns else 0,
                'unique_pages': server_data['REQUEST_URI'].nunique(),
                'countries_count': server_data['COUNTRY'].nunique() if 'COUNTRY' in server_data.columns else 0,
                'last_updated': datetime.now().strftime('%Y-%m-%d %H:%M:%S')
            }
        }

        # Análisis temporal
        hourly_visits = server_data['HOUR'].value_counts().sort_index()
        weekday_order = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
        weekday_visits = server_data['WEEKDAY'].value_counts().reindex(weekday_order).fillna(0)

        temporal = {
            'hourly': {
                'labels': [str(h) for h in range(24)],
                'values': [int(hourly_visits.get(h, 0)) for h in range(24)]
            },
            'weekday': {
                'labels': weekday_order,
                'values': [int(weekday_visits.get(day, 0)) for day in weekday_order]
            }
        }

        # Análisis técnico
        browsers = server_data['BROWSER'].value_counts().head(10) if 'BROWSER' in server_data.columns else pd.Series()
        technical = {
            'browsers': {
                'labels': [str(b) for b in browsers.index],
                'values': [int(v) for v in browsers.values]
            }
        }

        # Análisis de contenido
        pages = server_data['REQUEST_URI'].value_counts().head(10)
        content = {
            'top_pages': {
                'labels': [str(p) for p in pages.index],
                'values': [int(v) for v in pages.values]
            }
        }

        # Análisis geográfico
        if 'COUNTRY' in server_data.columns:
            country_stats = server_data['COUNTRY'].value_counts()
            geographic = {
                'countries': {
                    'labels': [str(c) for c in country_stats.index],
                    'values': [int(v) for v in country_stats.values]
                }
            }
        else:
            geographic = {'countries': {'labels': [], 'values': []}}

        # Preparar datos finales
        dashboard_data = {
            'stats': stats,
            'temporal': temporal,
            'technical': technical,
            'content': content,
            'geographic': geographic
        }

        # Guardar JSON
        print(f"Guardando datos en: {json_path}")
        with open(json_path, 'w', encoding='utf-8') as f:
            json.dump(dashboard_data, f, indent=4, ensure_ascii=False)
        
        print("Datos guardados exitosamente")
        print(f"Estadísticas generadas:")
        print(f"- Visitas totales: {stats['general']['total_visits']}")
        print(f"- Visitantes únicos: {stats['general']['unique_visitors']}")
        print(f"- Países diferentes: {stats['general']['countries_count']}")

    except Exception as e:
        print(f"Error durante el procesamiento: {str(e)}")
        import traceback
        print(traceback.format_exc())

if __name__ == "__main__":
    main()