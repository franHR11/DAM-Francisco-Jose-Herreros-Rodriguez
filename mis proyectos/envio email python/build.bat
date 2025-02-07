@echo off
REM Crear y activar entorno virtual
python -m venv venv
call venv\Scripts\activate

REM Instalar dependencias en el entorno limpio
python -m pip install --upgrade pip
python -m pip install ttkbootstrap==1.10.1
python -m pip install pyinstaller==6.1.0

REM Crear el ejecutable con opciones específicas
python -m PyInstaller ^
    --noconfirm ^
    --onefile ^
    --windowed ^
    --icon=logo.ico ^
    --add-data "venv\Lib\site-packages/ttkbootstrap;ttkbootstrap" ^
    --hidden-import=ttkbootstrap ^
    --name "Envio_email" ^
    envioemail.py

REM Desactivar entorno virtual
deactivate

echo Proceso completado. Revisa la carpeta "dist"
pause
